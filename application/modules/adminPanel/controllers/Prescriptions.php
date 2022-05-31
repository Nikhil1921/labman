<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Prescriptions extends Admin_controller  {

    public function __construct()
	{
		parent::__construct();
		$this->path = $this->config->item('prescription');
	}

	private $table = 'prescription';
	protected $redirect = 'prescriptions';
	protected $title = 'Prescription';
	protected $name = 'prescriptions';
	
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

        $this->load->model('Prescription_model', 'data');
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
            $sub_array[] = $row->mobile;
            $sub_array[] = $row->email;
            $sub_array[] = $row->date;

            $action = '<div class="btn-group" role="group"><button class="btn btn-success dropdown-toggle" id="btnGroupVerticalDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="icon-settings"></span></button><div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start">';
            
            if($update)
                $action .= anchor($this->redirect."/add/".e_id($row->id), '<i class="fa fa-file-text"></i> Add', 'class="dropdown-item"');
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

    public function add($id)
    {
        check_access($this->name, 'update');
        
        $this->form_validation->set_rules('address', 'Address', 'required|is_natural', ['required' => "%s is required", 'is_natural' => "%s is invalid"]);
        $this->form_validation->set_rules('family', 'Family', 'required|is_natural', ['required' => "%s is required", 'is_natural' => "%s is invalid"]);
        $this->form_validation->set_rules('ref_doctor', 'Ref doctor', 'max_length[100]', ['max_length' => "Max 100 chars allowed."]);
        $this->form_validation->set_rules('remarks', 'Doctor Remarks', 'max_length[100]', ['max_length' => "Max 100 chars allowed."]);
        $this->form_validation->set_rules('collection_date', 'Collection date', 'required', ['required' => "%s is required"]);
        $this->form_validation->set_rules('collection_time', 'Collection time', 'required', ['required' => "%s is required"]);
        $this->form_validation->set_rules('lab_id', 'Lab', 'required|is_natural', ['required' => "%s is required", 'is_natural' => "%s is invalid"]);
        
        $data['title'] = $this->title;
        $data['name'] = $this->name;
        $data['id'] = $id;
        $data['operation'] = "Add";
        $data['save'] = "$this->redirect/add/$id";
        $data['url'] = $this->redirect;
        $data['data'] = $this->main->get($this->table, 'u_id, CONCAT("'.$this->path.'", prescription) prescription', ['id' => d_id($id)]);
        $data['cities'] = $this->main->getAll('cities', 'c_name, hard_copy, home_visit, fix_price', ['is_deleted' => 0]);
        $data['tests'] = $this->main->getAll('tests', 'id, t_name', ['is_deleted' => 0]);
        $city = $this->input->post('city') ? $this->input->post('city') : $this->input->get('city');
        
        if($data['data']){
            $data['user'] = $this->main->get('users', 'name', ['id' => $data['data']['u_id']]);
            $data['address'] = $this->main->getAll('addresses', 'id, ad_location, ad_city', ['user_id' => $data['data']['u_id'], 'is_deleted' => 0, 'ad_city' => $city]);
            $data['members'] = $this->main->getAll('user_members', 'id, name', ['u_id' => $data['data']['u_id'], 'is_deleted' => 0]);
        }else{
            $data['user'] = ['name' => ''];
            $data['address'] = [];
            $data['members'] = [];
        }
        
        if ($this->form_validation->run() == FALSE){
            $data['labs'] = $this->main->searchLab($this->input->get('tests'));
            return $this->template->load('template', "$this->redirect/form", $data);
        }else{
            $this->load->model('prescription_model');
            $add = $this->prescription_model->addOrder($this->input->post(), d_id($id));

            flashMsg($add, "$this->title added.", "$this->title not added.", $this->redirect);
        }
    }

    public function delete()
    {
        check_access($this->name, 'delete');
        
        $this->form_validation->set_rules('id', 'id', 'required|is_natural');
        
        if ($this->form_validation->run() == FALSE)
            flashMsg(0, "", "Some required fields are missing.", $this->redirect);
        else{
            $id = $this->main->update(['id' => d_id($this->input->post('id'))], ['is_booked' => 1], $this->table);
            flashMsg($id, "$this->title deleted.", "$this->title not deleted.", $this->redirect);
        }
    }

    public function add_member()
    {
        check_ajax();

        $this->form_validation->set_rules('relation', 'Relation', 'required|max_length[15]', ['required' => "%s is required", 'max_length' => 'Max 15 chars allowed.']);
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[100]', ['required' => "%s is required", 'max_length' => 'Max 100 chars allowed.']);
        $this->form_validation->set_rules('email', 'Email', 'required|max_length[100]|valid_email', ['required' => "%s is required", 'valid_email' => "%s is invalid", 'max_length' => "Max 100 chars allowed"]);
        $this->form_validation->set_rules('gender', 'Gender', 'required|max_length[6]', ['required' => "%s is required", 'max_length' => 'Max 6 chars allowed.']);
        $this->form_validation->set_rules('dob', 'Date of birth', 'required', ['required' => "%s is required"]);
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|is_natural|exact_length[10]', ['required' => "%s is required", 'is_natural' => "%s is invalid", 'exact_length' => "%s is invalid",]);
        
        $this->form_validation->set_error_delimiters('<span class="text-white">', '</span><br />');
        
        if ($this->form_validation->run() == FALSE)
            $res = ['error' => true, 'message' => validation_errors()];
        else{
            $post = [
                'relation' => $this->input->post('relation'),
                'name'     => $this->input->post('name'),
                'email'    => $this->input->post('email'),
                'gender'   => $this->input->post('gender'),
                'dob'      => $this->input->post('dob'),
                'mobile'   => $this->input->post('mobile'),
                'u_id'     => d_id($this->input->post('u_id')),
            ];
            
            $id = $this->main->add($post, 'user_members');
            
            if($id)
                $res = ['error' => false, 'message' => "Member added success."];
            else
                $res = ['error' => true, 'message' => "Something is not going good. Try again."];
        }
        
        die(json_encode($res));
    }

    public function add_address()
    {
        check_ajax();

        $this->form_validation->set_rules('faddress', 'Full Address (With landmark)', 'required|max_length[100]', ['required' => "%s is required", 'max_length' => 'Max 100 chars allowed.']);
        $this->form_validation->set_rules('address', 'Location', 'required|max_length[100]', ['required' => "%s is required", 'max_length' => 'Max 100 chars allowed.']);
        $this->form_validation->set_rules('city', 'City', 'required|max_length[100]', ['required' => "%s is required", 'max_length' => 'Max 100 chars allowed.']);
        $this->form_validation->set_rules('lat', 'Lat', 'required|decimal|max_length[100]', ['required' => "%s is required", 'max_length' => 'Max 100 chars allowed.', 'decimal' => '%s is invalid.']);
        $this->form_validation->set_rules('lng', 'Lng', 'required|decimal|max_length[100]', ['required' => "%s is required", 'max_length' => 'Max 100 chars allowed.', 'decimal' => '%s is invalid.']);
        
        $this->form_validation->set_error_delimiters('<span class="text-white">', '</span><br />');
        
        if ($this->form_validation->run() == FALSE)
            $res = ['error' => true, 'message' => validation_errors()];
        else{
            $post = [
                'faddress' => $this->input->post('faddress'),
                'ad_location'     => $this->input->post('address'),
                'ad_city'    => $this->input->post('city'),
                'latitude'   => $this->input->post('lat'),
                'longitude'      => $this->input->post('lng'),
                'user_id'     => d_id($this->input->post('u_id')),
            ];
            
            $id = $this->main->add($post, 'addresses');
            
            if($id)
                $res = ['error' => false, 'message' => "Address added success."];
            else
                $res = ['error' => true, 'message' => "Something is not going good. Try again."];
        }
        
        die(json_encode($res));
    }
}