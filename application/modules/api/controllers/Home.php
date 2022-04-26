<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends API_controller {

	private $table = 'users';
	
	public function send_otp()
	{
		post();

		$this->form_validation->set_rules('mobile', 'Mobile', 'required|is_natural|exact_length[10]', ['required' => "%s is required", 'is_natural' => "%s is invalid", 'exact_length' => "%s is invalid"]);
		verifyRequiredParams();
		
		$post = [
			'mobile'   => $this->input->post('mobile')
		];

		$id = $this->main->check($this->table, $post, 'id');
		$otp = rand(1000, 9999);
		
		// sms for otp start
		$sms = $this->config->item('otp');
		$sms = str_replace('{#var#}', $otp, $sms);
		send_sms($post['mobile'], $sms['sms'], $sms['temp']);
		// sms for otp end
		
		$response['row']['id'] = $id ? $id : '0';
		$response['row']['otp'] = $otp;
		$response['error'] = false;
		$response['message'] = "OTP send.";

		echoRespnse(200, $response);
	}

	public function register()
	{
		post();

		$this->form_validation->set_rules('name', 'Name', 'required|max_length[100]', ['required' => "%s is required", 'max_length' => "Max 100 chars allowed."]);
		$this->form_validation->set_rules('mobile', 'Mobile', 'required|is_natural|exact_length[10]|is_unique[users.mobile]', ['required' => "%s is required", 'is_natural' => "%s is invalid", 'exact_length' => "%s is invalid", 'is_unique' => '%s already in use.']);
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[100]|is_unique[users.email]', ['required' => "%s is required", 'is_natural' => "%s is invalid", 'max_length' => "Max 100 chars allowed.", 'is_unique' => '%s already in use.']);
		$this->form_validation->set_rules('dob', 'Date of birth', 'required', ['required' => "%s is required"]);
		$this->form_validation->set_rules('gender', 'Gender', 'required|in_list[Male,Female]', ['required' => "%s is required", 'in_list' => "%s is invalid"]);
		
		verifyRequiredParams();
		
		$post = [
				'name' => $this->input->post('name'),
				'mobile' => $this->input->post('mobile'),
				'email' => $this->input->post('email'),
				'dob' => date('Y-m-d', strtotime($this->input->post('dob'))),
				'gender' => $this->input->post('gender'),
				'wallet' => 0,
				'create_date' => date('Y-m-d'),
				'create_time' => date('H:i:s'),
			];
		
		if ($id = $this->main->add($post, $this->table)) {
			$response['row']['id'] = $id;
			$response['error'] = false;
			$response['message'] = "Register success.";
		}else{
			$response['error'] = true;
			$response['message'] = "Register not success.";
		}

		echoRespnse(200, $response);
	}

	public function getPackages()
	{
		get();

		$tests = $this->main->getPackages();

		$response['row'] = $tests;
		$response['error'] = false;
		$response['message'] = "Packages list success.";

		echoRespnse(200, $response);
	}

	public function getCities()
	{
		get();

		$cities = $this->main->getCities();

		$response['row'] = $cities;
		$response['error'] = false;
		$response['message'] = "City list success.";

		echoRespnse(200, $response);
	}

	public function getTests()
	{
		get();

		$tests = array_map(function($v){
			return ['id' => e_id($v['id']), 't_name' => $v['t_name']];
		}, $this->main->getTests());

		$response['row'] = $tests;
		$response['error'] = false;
		$response['message'] = "Tests list success.";

		echoRespnse(200, $response);
	}

	public function getDeps()
	{
		get();

		$deps = array_map(function($v){
			return ['id' => e_id($v['id']), 'd_name' => $v['d_name'], 'image' => $v['image']];
		}, $this->main->getDeps());

		$response['row'] = $deps;
		$response['error'] = false;
		$response['message'] = "Department list success.";

		echoRespnse(200, $response);
	}
	
	public function searchTests()
	{
		get();
		verifyRequiredParams(['city', 'tests']);
		
		$data['labs'] = $this->main->searchLab(explode(',', $this->input->get('tests')));
        $data['tests'] = $data['labs'] ? $this->main->getTests(explode(',', $this->input->get('tests'))) : [];

		$response['row'] = $data;
		$response['error'] = false;
		$response['message'] = "Labs list success.";

		echoRespnse(200, $response);
	}
}