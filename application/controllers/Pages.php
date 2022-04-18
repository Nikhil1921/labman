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
    
    public function employee_registration()
    {
        $data['title'] = 'employee_registration';
        $data['name'] = 'employee_registration';
        
        return $this->template->load('template', 'pages/employee_registration', $data);
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
}