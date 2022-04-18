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
		
		$response['row']['id'] = $id ? $id : '0';
		$response['row']['otp'] = 9999;
		$response['error'] = false;
		$response['message'] = "OTP send.";

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
		verifyRequiredParams(['city']);

		$data['labs'] = $this->main->searchLab();
        $data['tests'] = $data['labs'] ? $this->main->getTests($this->input->get('tests')) : [];

		$response['row'] = $data;
		$response['error'] = false;
		$response['message'] = "Labs list success.";

		echoRespnse(200, $response);
	}
}