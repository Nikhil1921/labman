<?php defined('BASEPATH') OR exit('No direct script access allowed');

class City extends Admin_controller  {

	private $table = 'cities';
	protected $redirect = 'city';
	protected $title = 'City';
	protected $name = 'city';
	
	public function index()
	{
        check_access($this->name, 'view');
        
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
        $this->load->model('city_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $update = verify_access($this->name, 'update');
        $delete = verify_access($this->name, 'delete');
        $sr = $this->input->get('start') + 1;
        $data = [];

        foreach($fetch_data as $row)
        {
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->c_name;
            $sub_array[] = $row->hard_copy;
            $sub_array[] = $row->home_visit;
            $sub_array[] = $row->fix_price;
            
            $action = '<div class="btn-group" role="group"><button class="btn btn-success btn-xs dropdown-toggle" id="btnGroupVerticalDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="icon-settings"></span></button><div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start">';
            if($update)
                $action .= anchor($this->redirect."/update/".e_id($row->id), '<i class="fa fa-edit"></i> Edit</a>', 'class="dropdown-item"');
            if($delete)
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
        check_access($this->name, 'add');
        
        $this->form_validation->set_rules($this->validate);

        $data['title'] = $this->title;
        $data['name'] = $this->name;
        $data['operation'] = "Add";
        $data['url'] = $this->redirect;
        $data['labs'] = $this->main->getAll('logins', 'id, name', ['role' => 'Lab partner', 'is_deleted' => 0]);
        
        if ($this->form_validation->run() == FALSE)
            return $this->template->load('template', "$this->redirect/form", $data);
        else{
            $lab_ids = array_map(function($id){
                return d_id($id);
            }, $this->input->post('lab_ids'));

            $post = [
                'c_name'        => $this->input->post('c_name'),
                'hard_copy'     => $this->input->post('hard_copy'),
                'home_visit'    => $this->input->post('home_visit'),
                'fix_price'     => $this->input->post('fix_price'),
                'lab_ids'       => implode(',', $lab_ids),
            ];

            $id = $this->main->add($post, $this->table);

            flashMsg($id, "$this->title added.", "$this->title not added. Try again.", $this->redirect);
            
        }
	}

	public function update($id)
	{
        check_access($this->name, 'update');
        
        $this->form_validation->set_rules($this->validate);

        if ($this->form_validation->run() == FALSE)
        {
            $data['title'] = $this->title;
            $data['name'] = $this->name;
            $data['operation'] = "Update";
            $data['url'] = $this->redirect;
            $data['data'] = $this->main->get($this->table, 'c_name, hard_copy, home_visit, fix_price, lab_ids', ['id' => d_id($id)]);
            $data['labs'] = $this->main->getAll('logins', 'id, name', ['role' => 'Lab partner', 'is_deleted' => 0]);
            
            return $this->template->load('template', "$this->redirect/form", $data);
        }else{
            $lab_ids = array_map(function($id){
                return d_id($id);
            }, $this->input->post('lab_ids'));

            $post = [
                'c_name'        => $this->input->post('c_name'),
                'hard_copy'     => $this->input->post('hard_copy'),
                'home_visit'    => $this->input->post('home_visit'),
                'fix_price'     => $this->input->post('fix_price'),
                'lab_ids'       => implode(',', $lab_ids),
            ];
            
            $id = $this->main->update(['id' => d_id($id)], $post, $this->table);

            flashMsg($id, "$this->title updated.", "$this->title not updated. Try again.", $this->redirect);
        }
	}

	public function delete()
    {
        check_access($this->name, 'delete');
        
        $this->form_validation->set_rules('id', 'id', 'required|is_natural');
        
        if ($this->form_validation->run() == FALSE)
            flashMsg(0, "", "Some required fields are missing.", $this->redirect);
        else{
            $id = $this->main->update(['id' => d_id($this->input->post('id'))], ['is_deleted' => 1], $this->table);
            flashMsg($id, "$this->title deleted.", "$this->title not deleted.", $this->redirect);
        }
    }

    protected $validate = [
        [
            'field' => 'c_name',
            'label' => 'city name',
            'rules' => 'required|max_length[100]|alpha_numeric_spaces|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 100 chars allowed.",
                'alpha_numeric_spaces' => "Only characters and numbers are allowed.",
            ],
        ],
        [
            'field' => 'hard_copy',
            'label' => 'Hard Copy',
            'rules' => 'required|max_length[6]|is_natural|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 6 chars allowed.",
                'is_natural' => "%s is invalid",
            ],
        ],
        [
            'field' => 'home_visit',
            'label' => 'Home Visit',
            'rules' => 'required|max_length[6]|is_natural|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 6 chars allowed.",
                'is_natural' => "%s is invalid",
            ],
        ],
        [
            'field' => 'fix_price',
            'label' => 'Fix To Price',
            'rules' => 'required|max_length[6]|is_natural|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 6 chars allowed.",
                'is_natural' => "%s is invalid",
            ],
        ],
        [
            'field' => 'lab_ids[]',
            'label' => 'Labs',
            'rules' => 'required|trim',
            'errors' => [
                'required' => "%s is required",
            ],
        ],
    ];
}