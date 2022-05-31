<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Packages extends Admin_controller  {

    public function __construct()
	{
		parent::__construct();
		$this->path = $this->config->item('packages');
	}

	private $table = 'packages';
	protected $redirect = 'packages';
	protected $title = 'Package';
	protected $name = 'packages';
	
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
        $this->load->model('packages_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $update = verify_access($this->name, 'update');
        $delete = verify_access($this->name, 'delete');
        $sr = $this->input->get('start') + 1;
        $data = [];

        foreach($fetch_data as $row)
        {
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->name;
            $sub_array[] = $row->p_name;
            $sub_array[] = $row->price;
            $sub_array[] = img(['src' => $this->path.$row->image, 'width' => '50', 'height' => '50']);
            
            $action = '<div class="btn-group" role="group"><button class="btn btn-success dropdown-toggle" id="btnGroupVerticalDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="icon-settings"></span></button><div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start">';
            
            if($update)
                $action .= anchor($this->redirect."/update/".e_id($row->id), '<i class="fa fa-edit"></i> Edit', 'class="dropdown-item"');
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
        $data['labs'] = $this->main->getAll('logins', 'id, name', ['is_deleted' => 0, 'role' => 'Lab partner']);
        $data['tests'] = $this->main->getAll('tests', 'id, t_name', ['is_deleted' => 0]);

        if ($this->form_validation->run() == FALSE)
            return $this->template->load('template', "$this->redirect/form", $data);
        else{
            $image = $this->uploadImage('image');

            if ($image['error'] == TRUE){
                $this->session->set_flashdata('error', $image["message"]);
                return $this->template->load('template', "$this->redirect/form", $data);
            }else{
                $tests = array_map(function($id){
                    return d_id($id);
                }, $this->input->post('tests'));

                $post = [
                    'lab_id' => d_id($this->input->post('lab_id')),
                    'price' => $this->input->post('price'),
                    'p_type' => $this->input->post('p_type'),
                    'p_name' => $this->input->post('p_name'),
                    'tests' => implode(',', $tests),
                    'description' => $this->input->post('description'),
                    'image'     => $image['message']
                ];

                $id = $this->main->add($post, $this->table);

                flashMsg($id, "$this->title added.", "$this->title not added. Try again.", $this->redirect);
            }
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
            $data['data'] = $this->main->get($this->table, 'lab_id, price, p_type, p_name, tests, description, image', ['id' => d_id($id)]);
            $data['labs'] = $this->main->getAll('logins', 'id, name', ['is_deleted' => 0, 'role' => 'Lab partner']);
            $data['tests'] = $this->main->getAll('tests', 'id, t_name', ['is_deleted' => 0]);
            
            return $this->template->load('template', "$this->redirect/form", $data);
        }else{
            $tests = array_map(function($id){
                return d_id($id);
            }, $this->input->post('tests'));

            $post = [
                'lab_id' => d_id($this->input->post('lab_id')),
                'price' => $this->input->post('price'),
                'p_type' => $this->input->post('p_type'),
                'p_name' => $this->input->post('p_name'),
                'tests' => implode(',', $tests),
                'description' => $this->input->post('description')
            ];

            if (!empty($_FILES['image']['name'])) {
                $image = $this->uploadImage('image');
                if ($image['error'] == TRUE)
                    flashMsg(0, "", $image["message"], "$this->redirect/update/$id");
                else{
                    if (is_file($this->path.$this->input->post('image')))
                        unlink($this->path.$this->input->post('image'));
                    $post['image'] = $image['message'];
                }
            }
            
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
            'field' => 'lab_id',
            'label' => 'Lab Name',
            'rules' => 'required|is_natural|trim',
            'errors' => [
                'required' => "%s is required",
                'is_natural' => "%s is invalid",
            ],
        ],
        /* [
            'field' => 'org_price',
            'label' => 'Original price',
            'rules' => 'required|max_length[6]|is_natural|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 6 chars allowed.",
                'is_natural' => "%s is invalid",
            ],
        ], */
        [
            'field' => 'price',
            'label' => 'Discounted price',
            'rules' => 'required|max_length[6]|is_natural|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 6 chars allowed.",
                'is_natural' => "%s is invalid",
            ],
        ],
        [
            'field' => 'p_type',
            'label' => 'Package Type',
            'rules' => 'required|max_length[15]|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 15 chars allowed.",
            ],
        ],
        [
            'field' => 'p_name',
            'label' => 'Packages Name',
            'rules' => 'required|max_length[100]|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 100 chars allowed.",
            ],
        ],
        [
            'field' => 'tests[]',
            'label' => 'Test Names',
            'rules' => 'required|trim',
            'errors' => [
                'required' => "%s is required",
            ],
        ],
        [
            'field' => 'description',
            'label' => 'Description',
            'rules' => 'required|trim',
            'errors' => [
                'required' => "%s is required",
            ],
        ],
    ];
}