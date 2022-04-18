<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class API_controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('api');
	}

	public function error_404()
	{
		$response['error'] = true;
		$response['message'] = "The page you are attempting to reach is currently not available.";
		
		echoRespnse(404, $response);
	}
}