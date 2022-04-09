<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class MY_Controller extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_modal', 'main');
	}

	public function error_404()
	{
		$data['title'] = 'Error 404';
        $data['name'] = 'Error 404';

		return $this->template->load('template', 'error_404', $data);
	}
}