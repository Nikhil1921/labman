<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends Admin_controller  {

    public function __construct()
	{
		parent::__construct();
		$this->path = $this->config->item('employee');
	}

	private $table = 'employees';
	protected $redirect = 'employees';
	protected $title = 'Employee';
	protected $name = 'employees';
	
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
        $this->load->model('Employee_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $status = verify_access($this->name, 'status');
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
            $sub_array[] = "<p style='white-space: normal;'>$row->address</p>";
            $sub_array[] = $row->qulification;

            if($status)
                $sub_array[] = form_open($this->redirect.'/change-status', 'id="status_'.e_id($row->id).'"', ['id' => e_id($row->id), 'status' => $row->is_blocked ? 0 : 1]).
                    '<a class="btn btn-pill btn-outline-'.($row->is_blocked ? 'danger' : 'success').' btn-air-'.($row->is_blocked ? 'success' : 'danger').' btn-xs" onclick=\'script.delete("status_'.e_id($row->id).'"); return false;\' href="javascript:;">'.($row->is_blocked ? 'Blocked' : 'Unblocked').'</a>'.
                    form_close();
            else
                $sub_array[] = '<a class="btn btn-pill btn-outline-'.($row->is_blocked ? 'danger' : 'success').' btn-air-'.($row->is_blocked ? 'success' : 'danger').' btn-xs" href="javascript:;">'.($row->is_blocked ? 'Blocked' : 'Unblocked').'</a>';
            
            $action = '<div class="btn-group" role="group"><button class="btn btn-success dropdown-toggle" id="btnGroupVerticalDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

    public function form($data)
    {
        $data['title'] = $this->title;
        $data['name'] = $this->name;
        $data['url'] = $this->redirect;

        return $this->template->load('template', "$this->redirect/form", $data);
    }

    public function add()
	{
        check_access($this->name, 'add');

        $this->form_validation->set_rules($this->validate);
        $data['operation'] = "Add";
        
        if ($this->form_validation->run() == FALSE)
            return $this->form($data);
        else{
            $qulimg = $this->uploadImage('qulimg', 'png|jpg|jpeg', [], 'qulimg-'.microtime(true)*10000);

            if($qulimg['error']){
                $data['qulimg'] = '<span class="text-danger">'.$qulimg['message'].'</span>';
                return $this->form($data);
            }

            $licence = $this->uploadImage('driving-licence', 'png|jpg|jpeg', [], 'licence-'.microtime(true)*10000);
            
            if($licence['error']){
                $data['licence'] = '<span class="text-danger">'.$licence['message'].'</span>';
                unlink($this->path.$qulimg['message']);
                return $this->form($data);
            }

            $computer = $this->uploadImage('comp-certificate', 'png|jpg|jpeg', [], 'computer-'.microtime(true)*10000);
            
            if($computer['error']){
                $data['computer'] = '<span class="text-danger">'.$computer['message'].'</span>';
                unlink($this->path.$qulimg['message']);
                unlink($this->path.$licence['message']);
                return $this->form($data);
            }

            $aadhar = $this->uploadImage('aadhar-card', 'png|jpg|jpeg', [], 'aadhar-'.microtime(true)*10000);
            
            if($aadhar['error']){
                $data['aadhar'] = '<span class="text-danger">'.$aadhar['message'].'</span>';
                unlink($this->path.$qulimg['message']);
                unlink($this->path.$licence['message']);
                unlink($this->path.$computer['message']);
                return $this->form($data);
            }

            /* $photo = $this->uploadImage('photo', 'png|jpg|jpeg', [], 'photo-'.microtime(true)*10000);
            
            if($photo['error']){
                $data['photo'] = '<span class="text-danger">'.$photo['message'].'</span>';
                unlink($this->path.$qulimg['message']);
                unlink($this->path.$licence['message']);
                unlink($this->path.$computer['message']);
                unlink($this->path.$aadhar['message']);
                return $this->form($data);
            } */

            $photo['message'] = 'user.png';

            $imgs = [
                'photo'     => $photo['message'],
                'qulimg'    => $qulimg['message'],
                'licence'   => $licence['message'],
                'computer'  => $computer['message'],
                'aadhar'    => $aadhar['message'],
            ];

            $this->load->model('Employee_model', 'employee');

            $id = $this->employee->add_update(false, $imgs, 1);

            if($id)
                flashMsg($id, "$this->title added.", "", $this->redirect.'/update/'.e_id($id));
            else{
                foreach ($imgs as $img):
                    unlink($this->path.$img);
                endforeach;
                flashMsg($id, "", "$this->title not added. Try again.", "$this->redirect/add");
            }
        }
	}

	public function update($id)
	{
        check_access($this->name, 'update');

        $this->form_validation->set_rules($this->validate);
        $this->load->model('Employee_model', 'employee');

        if ($this->form_validation->run() == FALSE)
        {
            $data['title'] = $this->title;
            $data['name'] = $this->name;
            $data['operation'] = "Update";
            $data['url'] = $this->redirect;
            $data['data'] = $this->employee->getEmployee(d_id($id));
            
            return $this->template->load('template', "$this->redirect/form", $data);
        }else{
            $imgs = [];
            
            if(!empty($_FILES['qulimg']['name'])){
                $image = $this->uploadImage('qulimg', 'png|jpg|jpeg', [], 'qulimg-'.microtime(true)*10000);
                if(! $image['error']) $imgs['qulimg'] = $image['message'];
            }
            if(!empty($_FILES['photo']['name'])){
                $image = $this->uploadImage('photo', 'png|jpg|jpeg', [], 'photo-'.microtime(true)*10000);
                if(! $image['error']) $imgs['photo'] = $image['message'];
            }
            if(!empty($_FILES['comp-certificate']['name'])){
                $image = $this->uploadImage('comp-certificate', 'png|jpg|jpeg', [], 'computer-'.microtime(true)*10000);
                if(! $image['error']) $imgs['computer'] = $image['message'];
            }
            if(!empty($_FILES['aadhar-card']['name'])){
                $image = $this->uploadImage('aadhar-card', 'png|jpg|jpeg', [], 'aadhar-'.microtime(true)*10000);
                if(! $image['error']) $imgs['aadhar_img'] = $image['message'];
            }
            if(!empty($_FILES['driving-licence']['name'])){
                $image = $this->uploadImage('driving-licence', 'png|jpg|jpeg', [], 'licence-'.microtime(true)*10000);
                if(! $image['error']) $imgs['licence_img'] = $image['message'];
            }
            
            $uid = $this->employee->add_update(d_id($id), $imgs);
            
            foreach ($imgs as $i => $im):
                if ($uid){
                    if(is_file($this->path.$this->input->post($i))) unlink($this->path.$this->input->post($i));
                }else
                    unlink($this->path.$im);
            endforeach;

            flashMsg($uid, "$this->title updated.", "$this->title not updated. Try again.", $this->redirect.'/update/'.$id);
        }
	}

    public function change_status()
    {
        check_access($this->name, 'status');
        
        $this->form_validation->set_rules('id', '', 'required|is_natural');
        $this->form_validation->set_rules('status', '', 'required|is_natural');
        
        if ($this->form_validation->run() == FALSE)
            flashMsg(0, "", "Some required fields are missing.", $this->redirect);
        else{
            $id = $this->main->update(['id' => d_id($this->input->post('id'))], ['is_blocked' => $this->input->post('status')], 'logins');
            flashMsg($id, "$this->title updated.", "$this->title not updated.", $this->redirect);
        }
    }

	public function delete()
    {
        check_access($this->name, 'delete');

        $this->form_validation->set_rules('id', 'id', 'required|is_natural');
        
        if ($this->form_validation->run() == FALSE)
            flashMsg(0, "", "Some required fields are missing.", $this->redirect);
        else{
            $id = $this->main->update(['id' => d_id($this->input->post('id'))], ['is_deleted' => 1], 'logins');
            flashMsg($id, "$this->title deleted.", "$this->title not deleted.", $this->redirect);
        }
    }

    public function mobile_check($str)
    {   
        $check = $this->uri->segment(4) ? d_id($this->uri->segment(4)) : 0;
        $where = ['mobile' => $str, 'id != ' => $check, 'role' => $this->input->post('role'), 'is_deleted' => 0];
        
        if ($this->main->check('logins', $where, 'id'))
        {
            $this->form_validation->set_message('mobile_check', 'The %s is already in use');
            return FALSE;
        } else
            return TRUE;
    }

    public function email_check($str)
    {   
        $check = $this->uri->segment(4) ? d_id($this->uri->segment(4)) : 0;
        $where = ['email' => $str, 'id != ' => $check, 'role' => $this->input->post('role'), 'is_deleted' => 0];
        
        if ($this->main->check('logins', $where, 'id'))
        {
            $this->form_validation->set_message('email_check', 'The %s is already in use');
            return FALSE;
        } else
            return TRUE;
    }

    public function password_check($str)
    {   
        if (! $str && ! $this->uri->segment(4))
        {
            $this->form_validation->set_message('password_check', "%s is required");
            return FALSE;
        } else
            return TRUE;
    }

    protected $validate = [
        [
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required|max_length[100]|alpha_numeric_spaces|trim',
            'errors' => [
                'required' => "%s is required",
                'alpha_numeric_spaces' => "%s is invalid",
                'max_length' => "Max 100 characters allowed",
            ],
        ],
        [
            'field' => 'mobile',
            'label' => 'Contact no.',
            'rules' => 'required|exact_length[10]|is_natural|callback_mobile_check|trim',
            'errors' => [
                'required' => "%s is required",
                'exact_length' => "%s is invalid",
                'is_natural' => "%s is invalid",
            ],
        ],
        [
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'max_length[100]|callback_password_check|trim',
            'errors' => [
                'max_length' => "Max 100 chars allowed.",
            ],
        ],
        [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|max_length[100]|valid_email|callback_email_check|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 100 chars allowed.",
                'valid_email' => "%s is invalid",
            ],
        ],
        [
            'field' => 'gender',
            'label' => 'Gender',
            'rules' => 'required|in_list[Male,Female]|trim',
            'errors' => [
                'required' => "%s is required",
                'in_list' => "%s is invalid",
            ],
        ],
        [
            'field' => 'dob',
            'label' => 'Date Of Birth',
            'rules' => 'required|trim',
            'errors' => [
                'required' => "%s is required",
            ],
        ],
        [
            'field' => 'society',
            'label' => 'Flate No / House No / Socity',
            'rules' => 'required|max_length[50]|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 50 chars allowed.",
            ],
        ],
        [
            'field' => 'area',
            'label' => 'Area',
            'rules' => 'required|max_length[255]|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 255 chars allowed.",
            ],
        ],
        [
            'field' => 'pincode',
            'label' => 'Pincode',
            'rules' => 'required|exact_length[6]|is_natural|trim',
            'errors' => [
                'required' => "%s is required",
                'exact_length' => "%s is invalid",
                'is_natural' => "%s is invalid",
            ],
        ],
        [
            'field' => 'city',
            'label' => 'City',
            'rules' => 'required|is_natural|trim',
            'errors' => [
                'required' => "%s is required",
                'is_natural' => "%s is invalid",
            ],
        ],
        [
            'field' => 'role',
            'label' => 'Apply For',
            'rules' => 'required|in_list[Administrative,Receptionist,Call center,Accountant,Marketing,Phlebetomist]|trim',
            'errors' => [
                'required' => "%s is required",
                'in_list' => "%s is invalid",
            ],
        ],
        [
            'field' => 'marital',
            'label' => 'Marital Status',
            'rules' => 'required|in_list[Unmarried,Married]|trim',
            'errors' => [
                'required' => "%s is required",
                'in_list' => "%s is invalid",
            ],
        ],
        [
            'field' => 'qulification',
            'label' => 'Qulification',
            'rules' => 'required|in_list[10th Standard,12th Standard,Under Graduation,Post Graduation]|trim',
            'errors' => [
                'required' => "%s is required",
                'in_list' => "%s is invalid",
            ],
        ],
        [
            'field' => 'physical',
            'label' => 'Physical Status',
            'rules' => 'required|in_list[Healthy,Handycapt]|trim',
            'errors' => [
                'required' => "%s is required",
                'in_list' => "%s is invalid",
            ],
        ],
        [
            'field' => 'licence',
            'label' => 'Driving Licence',
            'rules' => 'required|in_list[Two Wheeler,Four Wheeler]|trim',
            'errors' => [
                'required' => "%s is required",
                'in_list' => "%s is invalid",
            ],
        ],
        [
            'field' => 'vehicle',
            'label' => 'Have Any Vehicle',
            'rules' => 'required|in_list[Moped,Bike]|trim',
            'errors' => [
                'required' => "%s is required",
                'in_list' => "%s is invalid",
            ],
        ],
        [
            'field' => 'office-time',
            'label' => 'Office Time',
            'rules' => 'required|in_list[Day,Night]|trim',
            'errors' => [
                'required' => "%s is required",
                'in_list' => "%s is invalid",
            ],
        ],
        [
            'field' => 'aadhar',
            'label' => 'Aadhar Card No',
            'rules' => 'required|exact_length[12]|is_natural|trim',
            'errors' => [
                'required' => "%s is required",
                'exact_length' => "%s is invalid",
                'is_natural' => "%s is invalid",
            ],
        ],
        [
            'field' => 'language[]',
            'label' => 'Language',
            'rules' => 'required|trim',
            'errors' => [
                'required' => "%s is required",
            ],
        ],
    ];
}