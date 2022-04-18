<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Public_controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		if($this->session->userId)
        {
            $this->user = $this->main->get('users', 'name, mobile, email, gender, dob, image, wallet', ['id' => $this->session->userId]);
        }
	}
}