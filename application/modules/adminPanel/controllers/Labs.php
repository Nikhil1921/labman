<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Labs extends Admin_controller  {

    public function __construct()
	{
		parent::__construct();
		$this->path = $this->config->item('lab-partner');
	}

	private $table = 'lab_partners';
	protected $redirect = 'labs';
	protected $title = 'Lab partner';
	protected $name = 'labs';
	
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
        $this->load->model('Labs_model', 'data');
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
            $sub_array[] = "<p style='white-space: normal;'>$row->l_name</p>";
            $sub_array[] = "<p style='white-space: normal;'>$row->doc_name</p>";
            $sub_array[] = $row->mobile;
            $sub_array[] = "<p style='white-space: normal;'>$row->address</p>";
            $sub_array[] = $row->certificate;

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

    public function add()
	{
        check_access($this->name, 'add');

        $this->form_validation->set_rules($this->validate);

        $data['title'] = $this->title;
        $data['name'] = $this->name;
        $data['operation'] = "Add";
        $data['url'] = $this->redirect;
        $data['report_time'] = $this->main->getAll('report_time', 'id, re_time', ['is_deleted' => 0]);

        if ($this->form_validation->run() == FALSE)
            return $this->template->load('template', "$this->redirect/form", $data);
        else{
            $this->load->model('Labs_model', 'lab');
            $id = $this->lab->add_update();

            if($id):
                $cert_image = $this->uploadImage('cert_image');
                if($cert_image['error']) flashMsg(0, "", $cert_image['message'], "$this->redirect/update/".e_id($id));
                if(!$this->main->update(['id' => $id], ['$post' => $cert_image['message']], $this->table))
                    unlink($this->path.$cert_image['message']);

                $logo = $this->uploadImage('logo');
                if($logo['error']) flashMsg(0, "", $logo['message'], "$this->redirect/update/".e_id($id));
                if(!$this->main->update(['id' => $id], ['$post' => $logo['message']], $this->table))
                    unlink($this->path.$logo['message']);
            endif;

            flashMsg($id, "$this->title added.", "$this->title not added. Try again.", "$this->redirect/add");
        }
	}

	public function update($id)
	{
        check_access($this->name, 'update');

        $this->form_validation->set_rules($this->validate);
        $this->load->model('Labs_model', 'lab');

        if ($this->form_validation->run() == FALSE)
        {
            $data['title'] = $this->title;
            $data['name'] = $this->name;
            $data['operation'] = "Update";
            $data['url'] = $this->redirect;
            $data['data'] = $this->lab->getLab(d_id($id));
            $data['report_time'] = $this->main->getAll('report_time', 'id, re_time', ['is_deleted' => 0]);
            
            return $this->template->load('template', "$this->redirect/form", $data);
        }else{
            $id = $this->lab->add_update(d_id($id));

            if($id):

                if(!empty($_FILES['cert_image']['name'])){
                    $cert_image = $this->uploadImage('cert_image');
                    if($cert_image['error']) flashMsg(0, "", "Certificate : ".$cert_image['message'], "$this->redirect/update/".e_id($id));
                    if(!$this->main->update(['id' => $id], ['cert_image' => $cert_image['message']], $this->table))
                        unlink($this->path.$cert_image['message']);
                    else
                        if(is_file($this->path.$this->input->post('cert_image'))) unlink($this->path.$this->input->post('cert_image'));
                }

                if(!empty($_FILES['logo']['name'])){
                    $logo = $this->uploadImage('logo');
                    if($logo['error']) flashMsg(0, "", "Logo : ".$logo['message'], "$this->redirect/update/".e_id($id));
                    if(!$this->main->update(['id' => $id], ['logo' => $logo['message']], $this->table))
                        unlink($this->path.$logo['message']);
                    else
                        if(is_file($this->path.$this->input->post('logo'))) unlink($this->path.$this->input->post('logo'));
                }

            endif;

            flashMsg($id, "$this->title updated.", "$this->title not updated. Try again.", $this->redirect.'/update/'.e_id($id));
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

    public function mobile_check($str)
    {   
        $check = $this->uri->segment(4) ? d_id($this->uri->segment(4)) : 0;
        $where = ['mobile' => $str, 'id != ' => $check, 'role' => "Lab partner", 'is_deleted' => 0];
        
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
        $where = ['email' => $str, 'id != ' => $check, 'role' => "Lab partner", 'is_deleted' => 0];
        
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
            'field' => 'l_name',
            'label' => 'Lab name',
            'rules' => 'required|max_length[255]|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 255 chars allowed.",
            ],
        ],
        [
            'field' => 'doc_name',
            'label' => 'Doctor name',
            'rules' => 'required|max_length[100]|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 100 chars allowed.",
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
            'field' => 'address',
            'label' => 'Address',
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
            'field' => 'certificate[]',
            'label' => 'Certificate',
            'rules' => 'required|trim',
            'errors' => [
                'required' => "%s is required",
            ],
        ],
        [
            'field' => 'del_time',
            'label' => 'Report Delivery Time',
            'rules' => 'required|is_natural|trim',
            'errors' => [
                'required' => "%s is required",
                'is_natural' => "%s is invalid",
            ],
        ],
    ];
}