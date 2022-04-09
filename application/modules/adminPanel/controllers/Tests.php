<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tests extends Admin_controller  {

	private $table = 'tests';
	protected $redirect = 'tests';
	protected $title = 'Test';
	protected $name = 'tests';
	
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
        $this->load->model('Tests_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $sr = $this->input->get('start') + 1;
        $data = [];

        foreach($fetch_data as $row)
        {
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->t_code;
            $sub_array[] = $row->cat_name;
            $sub_array[] = "<p style='white-space: normal;'>$row->t_name</p>";
            $sub_array[] = "<p style='white-space: normal;'>$row->d_name</p>";
            $sub_array[] = "<p style='white-space: normal;'>$row->s_name</p>";
            $sub_array[] = "<p style='white-space: normal;'>$row->m_name</p>";
            $sub_array[] = $row->re_time;
            $sub_array[] = $row->t_price;
            
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
        $data['category'] = $this->main->getAll('category', 'id, cat_name', ['is_deleted' => 0]);
        $data['department'] = $this->main->getAll('department', 'id, d_name', ['is_deleted' => 0]);
        $data['methods'] = $this->main->getAll('methods', 'id, m_name', ['is_deleted' => 0]);
        $data['report_time'] = $this->main->getAll('report_time', 'id, re_time', ['is_deleted' => 0]);
        $data['samples'] = $this->main->getAll('samples', 'id, s_name', ['is_deleted' => 0]);

        if ($this->form_validation->run() == FALSE)
            return $this->template->load('template', "$this->redirect/form", $data);
        else{
            $post = [
                't_name'        => $this->input->post('t_name'),
                'cat_id'        => d_id($this->input->post('cat_id')),
                'dep_id'        => d_id($this->input->post('dep_id')),
                'method_id'     => d_id($this->input->post('method_id')),
                'samp_id'       => d_id($this->input->post('samp_id')),
                're_time_id'    => d_id($this->input->post('re_time_id')),
                't_code'        => 'LM'.rand(100,999),
                't_price'       => $this->input->post('t_price'),
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
            $data['category'] = $this->main->getAll('category', 'id, cat_name', ['is_deleted' => 0]);
            $data['department'] = $this->main->getAll('department', 'id, d_name', ['is_deleted' => 0]);
            $data['methods'] = $this->main->getAll('methods', 'id, m_name', ['is_deleted' => 0]);
            $data['report_time'] = $this->main->getAll('report_time', 'id, re_time', ['is_deleted' => 0]);
            $data['samples'] = $this->main->getAll('samples', 'id, s_name', ['is_deleted' => 0]);
            $data['data'] = $this->main->get($this->table, 't_name, cat_id, dep_id, method_id, samp_id, re_time_id, t_price', ['id' => d_id($id)]);
            
            return $this->template->load('template', "$this->redirect/form", $data);
        }else{
            $post = [
                't_name'        => $this->input->post('t_name'),
                'cat_id'        => d_id($this->input->post('cat_id')),
                'dep_id'        => d_id($this->input->post('dep_id')),
                'method_id'     => d_id($this->input->post('method_id')),
                'samp_id'       => d_id($this->input->post('samp_id')),
                're_time_id'    => d_id($this->input->post('re_time_id')),
                't_price'       => $this->input->post('t_price'),
            ];
            
            $id = $this->main->update(['id' => d_id($id)], $post, $this->table);

            flashMsg($id, "$this->title updated.", "$this->title not updated. Try again.", $this->redirect);
        }
	}

	public function delete()
    {
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
            'field' => 't_name',
            'label' => 'Test name',
            'rules' => 'required|max_length[255]|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 255 chars allowed.",
            ],
        ],
        [
            'field' => 't_price',
            'label' => 'Test price',
            'rules' => 'required|max_length[5]|is_natural|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 5 chars allowed.",
                'is_natural' => "Only numbers are allowed.",
            ],
        ],
        [
            'field' => 'cat_id',
            'label' => 'Test category',
            'rules' => 'required|is_natural|trim',
            'errors' => [
                'required' => "%s is required",
                'is_natural' => "Only numbers are allowed.",
            ],
        ],
        [
            'field' => 'dep_id',
            'label' => 'Test department',
            'rules' => 'required|is_natural|trim',
            'errors' => [
                'required' => "%s is required",
                'is_natural' => "Only numbers are allowed.",
            ],
        ],
        [
            'field' => 'method_id',
            'label' => 'Test method',
            'rules' => 'required|is_natural|trim',
            'errors' => [
                'required' => "%s is required",
                'is_natural' => "Only numbers are allowed.",
            ],
        ],
        [
            'field' => 'samp_id',
            'label' => 'Test sample',
            'rules' => 'required|is_natural|trim',
            'errors' => [
                'required' => "%s is required",
                'is_natural' => "Only numbers are allowed.",
            ],
        ],
        [
            'field' => 're_time_id',
            'label' => 'Test report time',
            'rules' => 'required|is_natural|trim',
            'errors' => [
                'required' => "%s is required",
                'is_natural' => "Only numbers are allowed.",
            ],
        ],
    ];
}