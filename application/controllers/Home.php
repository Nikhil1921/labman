<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_controller {
	
	public function index()
	{
		$data['title'] = 'Home';
        $data['name'] = 'home';
        $data['banners'] = $this->main->getBanners();
        $data['tests'] = $this->main->getPopularTests();
        $data['packs'] = $this->main->getPackages();
        $data['deps'] = $this->main->getDeps();
        $data['labs'] = $this->main->getLabs();
		
		return $this->template->load('template', 'home', $data);
	}

	public function callback()
	{
        check_ajax();

        $post = [
            'name'         => $this->input->post('name'),
            'email'        => $this->input->post('email'),
            'mobile'       => $this->input->post('mobile'),
            'created_date' => date('Y-m-d'),
            'created_time' => date('H:i:s')
        ];
        
        if($this->main->add($post, 'callback_form'))
            $res = ['error' => false, 'message' => 'Thank you. We will get back to you soon.'];
        else
            $res = ['error' => true, 'message' => 'Something is not going good.'];

		die(json_encode($res));
	}
    
	public function institutional()
	{
        check_ajax();

        $post = [
            'c_name'       => $this->input->post('c_name'),
            'total'        => $this->input->post('total'),
            'address'      => $this->input->post('address'),
            'requirement'  => $this->input->post('requirement'),
            'name'         => $this->input->post('name'),
            'email'        => $this->input->post('email'),
            'mobile'       => $this->input->post('mobile'),
            'created_date' => date('Y-m-d'),
            'created_time' => date('H:i:s')
        ];
        
        if($this->main->add($post, 'institutional_form'))
            $res = ['error' => false, 'message' => 'Thank you. We will get back to you soon.'];
        else
            $res = ['error' => true, 'message' => 'Something is not going good.'];

		die(json_encode($res));
	}

	public function prescription()
	{
        check_ajax();

        $this->path = $this->config->item('prescription');

        $prescription = $this->uploadImage('prescription');
        
        if ($prescription['error'] == TRUE) die(json_encode($prescription));

        $post = [
            'prescription' => $prescription['message'],
            'u_id'         => $this->session->userId,
            'created_date' => date('Y-m-d'),
            'created_time' => date('H:i:s')
        ];
        
        if($this->main->add($post, 'prescription'))
            $res = ['error' => false, 'message' => 'Thank you. We will get back to you soon.'];
        else
            $res = ['error' => true, 'message' => 'Something is not going good.'];

		die(json_encode($res));
	}

	public function error_404()
	{
		$data['title'] = 'Error 404';
        $data['name'] = 'error_404';
		
		return $this->template->load('template', 'error_404', $data);
	}
}