<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Public_controller {
	
	public function index()
	{
		$data['title'] = 'Login';
        $data['name'] = 'login';
		
		return $this->template->load('template', 'auth/login', $data);
	}

	public function register()
	{
		$data['title'] = 'Register';
        $data['name'] = 'register';
		
		return $this->template->load('template', 'auth/register', $data);
	}
}