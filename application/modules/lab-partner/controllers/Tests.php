<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tests extends Admin_controller  {

	private $table = 'lab_tests';
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
        $this->load->model('Test_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $sr = $this->input->get('start') + 1;
        $data = [];

        foreach($fetch_data as $row)
        {
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = "<p style='white-space: break-spaces;'>$row->cat_name</p>";
            $sub_array[] = "<p style='white-space: break-spaces;'>$row->t_name</p>";
            $sub_array[] = "<p style='white-space: break-spaces;'>$row->s_name</p>";
            $sub_array[] = "<p style='white-space: break-spaces;'>$row->d_name</p>";
            $sub_array[] = "<p style='white-space: break-spaces;'>$row->m_name</p>";
            $sub_array[] = $row->re_time;
            $sub_array[] = $row->ltl_mrp;
            $sub_array[] = $row->ltl_price;
            
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

        if ($this->form_validation->run() == FALSE)
        {
            $data['title'] = $this->title;
            $data['name'] = $this->name;
            $data['operation'] = "Update";
            $data['url'] = $this->redirect;
            $check = array_map(function($arr){
                return $arr['test_id'];
            }, $this->main->getAll($this->table, 'test_id', ['lab_id' => $this->session->auth]));

            $data['tests'] = $this->main->getAll("tests", 'id, t_name', 'id NOT IN ('.implode(',', $check).')');
            
            return $this->template->load('template', "$this->redirect/form", $data);
        }else{
            $post = [
                'test_id'     => d_id($this->input->post('test_id')),
                'lab_id'      => $this->session->auth,
                'ltl_mrp'     => $this->input->post('ltl_mrp'),
                'ltl_price'   => $this->input->post('ltl_price'),
            ];
            
            $id = $this->main->add($post, $this->table);

            flashMsg($id, "$this->title added.", "$this->title not added. Try again.", "$this->redirect/add");
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
            $data['tests'] = $this->main->getAll("tests", 'id, t_name', ['id' => d_id($id)]);
            $data['data'] = $this->main->get($this->table, 'ltl_mrp, ltl_price', ['lab_id' => $this->session->auth, 'test_id' => d_id($id)]);
            
            return $this->template->load('template', "$this->redirect/form", $data);
        }else{
            $post = [
                'ltl_mrp'     => $this->input->post('ltl_mrp'),
                'ltl_price'   => $this->input->post('ltl_price'),
            ];
            
            $id = $this->main->update(['lab_id' => $this->session->auth, 'test_id' => d_id($id)], $post, $this->table);

            flashMsg($id, "$this->title updated.", "$this->title not updated. Try again.", $this->redirect);
        }
	}

    public function delete()
    {
        $this->form_validation->set_rules('id', 'id', 'required|is_natural');
        
        if ($this->form_validation->run() == FALSE)
            flashMsg(0, "", "Some required fields are missing.", $this->redirect);
        else{
            $post = [
                'lab_id' => $this->session->auth,
                'test_id' => d_id($this->input->post('id'))
            ];
            
            $id = $this->main->delete($this->table, $post);
            
            flashMsg($id, "$this->title deleted.", "$this->title not deleted.", $this->redirect);
        }
    }

    protected $validate = [
        [
            'field' => 'test_id',
            'label' => 'Test name',
            'rules' => 'required|is_natural|trim',
            'errors' => [
                'required' => "%s is required",
                'is_natural' => "Only numbers are allowed.",
            ],
        ],
        [
            'field' => 'ltl_mrp',
            'label' => 'Test MRP',
            'rules' => 'required|max_length[5]|is_natural|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 5 chars allowed.",
                'is_natural' => "Only numbers are allowed.",
            ],
        ],
        [
            'field' => 'ltl_price',
            'label' => 'Test Price',
            'rules' => 'required|max_length[5]|is_natural|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 5 chars allowed.",
                'is_natural' => "Only numbers are allowed.",
            ],
        ],
    ];
}