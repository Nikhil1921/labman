<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Public_controller {
	
	public function __construct()
	{
		parent::__construct();
        if(!$this->session->userId)
        {
            flashMsg(0, "", "Login to continue.", 'login');
        }
	}

	public function index()
	{
		$data['title'] = 'Home';
        $data['name'] = 'home';
		
		return $this->template->load('template', 'home', $data);
	}

	public function cart()
	{
		$data['title'] = 'Cart';
        $data['name'] = 'cart';
		
		return $this->template->load('template', 'cart', $data);
	}

	public function logout()
    {
        $this->session->sess_destroy();
        return redirect('login');
    }
}