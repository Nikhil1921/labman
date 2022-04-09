<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends Admin_controller  {

	private $table = 'category';
	protected $redirect = 'category';
	protected $title = 'Category';
	protected $name = 'category';
	
	public function index()
	{
		$data['title'] = $this->title;
        $data['name'] = $this->name;
        $data['url'] = $this->redirect;
        $data['operation'] = "List";
        $data['datatable'] = "$this->redirect/get";
		
		return $this->template->load('template', "$this->redirect/home", $data);
	}

    public function get()
    {
        check_ajax();
        $this->load->model('Category_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $sr = $this->input->get('start') + 1;
        $data = [];

        foreach($fetch_data as $row)
        {
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->cat_name;
            $sub_array[] = $row->cat_slug;
            
            $action = '<div class="btn-group" role="group"><button class="btn btn-success dropdown-toggle" id="btnGroupVerticalDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="icon-settings"></span></button><div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start">';
            
            $action .= anchor($this->redirect."/update/".e_id($row->id), '<i class="fa fa-edit"></i> Edit</a>', 'class="dropdown-item"');
        
            $action .= form_open($this->redirect.'/delete', 'id="'.e_id($row->id).'"', ['id' => e_id($row->id)]).
                '<a class="dropdown-item" onclick="script.delete('.e_id($row->id).'); return false;" href=""><i class="fa fa-trash"></i> Delete</a>'.
                form_close();

            $action .= '</div></div>';
            $sub_array[] = $action;

            $data[] = $sub_array;  
            $sr++;
        }

        $output = [
            "draw"              => intval($this->input->get('draw')),  
            "recordsTotal"      => $this->data->count(),
            "recordsFiltered"   => $this->data->get_filtered_data(),
            "data"              => $data
        ];
        
        die(json_encode($output));
    }

    public function add()
	{
        $this->form_validation->set_rules($this->validate);

        $data['title'] = $this->title;
        $data['name'] = $this->name;
        $data['operation'] = "Add";
        $data['url'] = $this->redirect;

        if ($this->form_validation->run() == FALSE)
            return $this->template->load('template', "$this->redirect/form", $data);
        else{
            $post = [
                'cat_name'        => $this->input->post('cat_name'),
                'cat_slug'        => strtolower($this->input->post('cat_slug')),
                'seo_title'       => $this->input->post('seo_title'),
                'seo_keyword'     => $this->input->post('seo_keyword'),
                'seo_description' => $this->input->post('seo_description')
            ];

            $id = $this->main->add($post, $this->table);

            flashMsg($id, "$this->title added.", "$this->title not added. Try again.", $this->redirect);
            
        }
	}

	public function update($id)
	{
        $this->form_validation->set_rules($this->validate);

        if ($this->form_validation->run() == FALSE)
        {
            $data['title'] = $this->title;
            $data['name'] = $this->name;
            $data['operation'] = "Update";
            $data['url'] = $this->redirect;
            $data['data'] = $this->main->get($this->table, 'cat_name, seo_title, seo_keyword, seo_description, cat_slug', ['id' => d_id($id)]);
            
            return $this->template->load('template', "$this->redirect/form", $data);
        }else{
            $post = [
                'cat_name'        => $this->input->post('cat_name'),
                'cat_slug'        => strtolower($this->input->post('cat_slug')),
                'seo_title'       => $this->input->post('seo_title'),
                'seo_keyword'     => $this->input->post('seo_keyword'),
                'seo_description' => $this->input->post('seo_description')
            ];
            
            $id = $this->main->update(['id' => d_id($id)], $post, $this->table);

            flashMsg($id, "$this->title updated.", "$this->title not updated. Try again.", $this->redirect);
        }
	}

	public function delete()
    {
        $this->form_validation->set_rules('id', 'id', 'required|numeric');
        
        if ($this->form_validation->run() == FALSE)
            flashMsg(0, "", "Some required fields are missing.", $this->redirect);
        else{
            $id = $this->main->update(['id' => d_id($this->input->post('id'))], ['is_deleted' => 1], $this->table);
            flashMsg($id, "$this->title deleted.", "$this->title not deleted.", $this->redirect);
        }
    }

    public function slug_check($slug)
    {
        $check = $this->uri->segment(4) ? d_id($this->uri->segment(4)) : 0;

        $where = ['cat_slug' => $slug, 'id != ' => $check, 'is_deleted' => 0, 'parent_id' => 0];

        if ($this->main->check($this->table, $where, 'id'))
        {
            $this->form_validation->set_message('slug_check', 'The %s is already in use');
            return FALSE;
        } else
            return TRUE;
    }

    protected $validate = [
        [
            'field' => 'cat_name',
            'label' => 'Category name',
            'rules' => 'required|max_length[50]|alpha_numeric_spaces|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 50 chars allowed.",
                'alpha_numeric_spaces' => "Only characters and numbers are allowed.",
            ],
        ],
        [
            'field' => 'cat_slug',
            'label' => 'Category slug',
            'rules' => 'required|max_length[50]|alpha_dash|trim|callback_slug_check',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 50 chars allowed.",
                'alpha_dash' => "Only characters and numbers are allowed.",
            ],
        ]
    ];
}