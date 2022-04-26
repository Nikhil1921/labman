<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends Public_controller {

    public function about()
	{
        $data['title'] = 'about';
        $data['name'] = 'about';
        
        return $this->template->load('template', 'pages/about', $data);
	}

    public function how_to_work()
	{
        $data['title'] = 'How to work';
        $data['name'] = 'how_to_work';
        
        return $this->template->load('template', 'pages/how_to_work', $data);
	}

    public function packages()
	{
        $data['title'] = 'Packages';
        $data['name'] = 'packages';
        $data['packs'] = $this->main->getPackages();
        
        return $this->template->load('template', 'pages/packages', $data);
	}

    public function labs()
	{
        $data['title'] = 'Labs';
        $data['name'] = 'labs';
        $data['labs'] = $this->main->getLabs();
        
        return $this->template->load('template', 'pages/labs', $data);
	}

    public function career()
	{
        $data['title'] = 'Career';
        $data['name'] = 'career';
        $data['openings'] = [];
        
        return $this->template->load('template', 'pages/career', $data);
	}

    public function faq()
	{
        $data['title'] = "faq's";
        $data['name'] = 'faq';
        
        return $this->template->load('template', 'pages/faq', $data);
	}

    public function gallery()
	{
        $data['title'] = 'Gallery';
        $data['name'] = 'gallery';
        $data['gallery'] = $this->main->getGallery();
        
        return $this->template->load('template', 'pages/gallery', $data);
	}

    public function contact()
    {
        $data['title'] = 'Contact';
        $data['name'] = 'contact';
        
        return $this->template->load('template', 'pages/contact', $data);
    }
    
    public function corporate()
    {
        $data['title'] = 'corporate';
        $data['name'] = 'corporate';
        
        return $this->template->load('template', 'pages/corporate', $data);
    }
    
    public function institute()
    {
        $data['title'] = 'institute';
        $data['name'] = 'institute';
        
        return $this->template->load('template', 'pages/institute', $data);
    }
    
    public function franchise_inquiry()
    {
        $data['title'] = 'franchise_inquiry';
        $data['name'] = 'franchise_inquiry';
        
        return $this->template->load('template', 'pages/franchise_inquiry', $data);
    }
    
    public function lab_registration()
    {
        $data['title'] = 'lab_registration';
        $data['name'] = 'lab_registration';
        $data['report_time'] = $this->main->getAll('report_time', 'id, re_time', ['is_deleted' => 0]);
        
        return $this->template->load('template', 'pages/lab_registration', $data);
    }

    public function lab_register()
    {
        $this->form_validation->set_rules($this->lab_register);
        
        if ($this->form_validation->run() == FALSE)
            return $this->lab_registration();
        else{
            $this->path = $this->config->item('lab-partner');
            
            $cert_image = $this->uploadImage('cert_image');
            
            if($cert_image['error']){
                $this->session->set_flashdata('error', "Certificate : ".$cert_image['message']);
                return $this->lab_registration();
            }
            
            $logo = $this->uploadImage('logo');
            
            if($logo['error']){
                $this->session->set_flashdata('error', "Logo : ".$logo['message']);
                unlink($this->path.$cert_image['message']);
                return $this->lab_registration();
            }
            
            $this->load->model(admin('Labs_model'), 'lab');
            
            $id = $this->lab->add_update(false, $logo['message'], $cert_image['message'], 1);
            
            if(!$id){
                unlink($this->path.$logo['message']);
                unlink($this->path.$cert_image['message']);
            }

            flashMsg($id, "Your request saved. We will contact soon.", "Your request not saved. Try again.", "lab-registration");
        }
    }
    
    public function employee_registration()
    {
        $data['title'] = 'Employee registration';
        $data['name'] = 'employee_registration';
        
        return $this->template->load('template', 'pages/employee_registration', $data);
    }

    public function employee_register()
    {
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
        if ($this->form_validation->run('employee') == FALSE)
            return $this->employee_registration();
        else{
            $this->path = $this->config->item('employee');
            
            $qulimg = $this->uploadImage('qulimg', 'png|jpg|jpeg', [], 'qulimg-'.microtime(true)*10000);

            if($qulimg['error']){
                $this->session->set_flashdata('error', "Qulification : ".$qulimg['message']);
                return $this->employee_registration();
            }

            $licence = $this->uploadImage('driving-licence', 'png|jpg|jpeg', [], 'licence-'.microtime(true)*10000);
            
            if($licence['error']){
                $this->session->set_flashdata('error', "Licence : ".$licence['message']);
                unlink($this->path.$qulimg['message']);
                return $this->employee_registration();
            }

            $computer = $this->uploadImage('comp-certificate', 'png|jpg|jpeg', [], 'computer-'.microtime(true)*10000);
            
            if($computer['error']){
                $this->session->set_flashdata('error', "Computer : ".$computer['message']);
                unlink($this->path.$qulimg['message']);
                unlink($this->path.$licence['message']);
                return $this->employee_registration();
            }

            $aadhar = $this->uploadImage('aadhar-card', 'png|jpg|jpeg', [], 'aadhar-'.microtime(true)*10000);
            
            if($aadhar['error']){
                $this->session->set_flashdata('error', "Aadhar : ".$aadhar['message']);
                unlink($this->path.$qulimg['message']);
                unlink($this->path.$licence['message']);
                unlink($this->path.$computer['message']);
                return $this->employee_registration();
            }

            $photo = $this->uploadImage('photo', 'png|jpg|jpeg', [], 'photo-'.microtime(true)*10000);
            
            if($photo['error']){
                $this->session->set_flashdata('error', "Photo : ".$photo['message']);
                unlink($this->path.$qulimg['message']);
                unlink($this->path.$licence['message']);
                unlink($this->path.$computer['message']);
                unlink($this->path.$aadhar['message']);
                return $this->employee_registration();
            }

            $imgs = [
                'photo'     => $photo['message'],
                'qulimg'    => $qulimg['message'],
                'licence'   => $licence['message'],
                'computer'  => $computer['message'],
                'aadhar'    => $aadhar['message'],
            ];
            
            $this->load->model(admin('Employee_model'), 'employee');
            
            $id = $this->employee->add_update(false, $imgs, 1);
            
            if(!$id){
                unlink($this->path.$qulimg['message']);
                unlink($this->path.$licence['message']);
                unlink($this->path.$computer['message']);
                unlink($this->path.$photo['message']);
                unlink($this->path.$aadhar['message']);
            }

            flashMsg($id, "Your request saved. We will contact soon.", "Your request not saved. Try again.", "employee-registration");
        }
    }
    
    public function terms_condition()
    {
        $data['title'] = 'Term & Conditions';
        $data['name'] = 'terms_condition';
        
        return $this->template->load('template', 'pages/terms_condition', $data);
    }
    
    public function refund()
    {
        $data['title'] = ' Refund & Cancellation Policy';
        $data['name'] = 'refund';
        
        return $this->template->load('template', 'pages/refund', $data);
    }

    public function mobile_check($str)
    {   
        $where = ['mobile' => $str, 'role' => "Lab partner", 'is_deleted' => 0];
        
        if ($this->main->check('logins', $where, 'id'))
        {
            $this->form_validation->set_message('mobile_check', 'The %s is already in use');
            return FALSE;
        } else
            return TRUE;
    }

    public function email_check($str)
    {   
        $where = ['email' => $str, 'role' => "Lab partner", 'is_deleted' => 0];
        
        if ($this->main->check('logins', $where, 'id'))
        {
            $this->form_validation->set_message('email_check', 'The %s is already in use');
            return FALSE;
        } else
            return TRUE;
    }

    protected $lab_register = [
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
            'rules' => 'max_length[100]|required|trim',
            'errors' => [
                'required' => "%s is required",
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