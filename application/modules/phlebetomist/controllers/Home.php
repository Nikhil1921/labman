<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends API_controller {

	public function __construct()
    {
        parent::__construct($this->table);
		$this->load->model('api_model', 'api');
    }

    protected $table = 'logins';
	
	public function login()
	{
		post();

		$this->form_validation->set_rules('mobile', 'Mobile', 'required|is_natural|exact_length[10]', ['required' => "%s is required", 'is_natural' => "%s is invalid", 'exact_length' => "%s is invalid"]);
		$this->form_validation->set_rules('password', 'Password', 'required', ['required' => "%s is required"]);
		verifyRequiredParams();
		
		$post = [
			'mobile'     => $this->input->post('mobile'),
			'password'   => my_crypt($this->input->post('password'))
		];

		$user = $this->api->getProfile($post);
		
		$response['row'] = $user ? $user : [];
		$response['error'] = $user ? false : true;
		$response['message'] = $user ? "Login success." : "Invalid credentials or mobile not registered.";

		echoRespnse(200, $response);
	}
}