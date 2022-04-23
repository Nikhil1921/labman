<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Permissions extends Admin_controller  {

	private $table = 'permissions';
	protected $redirect = 'permissions';
	protected $title = 'Permissions';
	protected $name = 'permissions';

    public function index()
	{
        check_access($this->name, 'view');
        
		$data['title'] = "role";
        $data['name'] = $this->name;
        $data['url'] = $this->redirect;
        $data['operation'] = "select";
		
		return $this->template->load('template', "$this->redirect/home", $data);
	}

    public function add($role)
	{
        check_access($this->name, 'add');
		$role = str_replace('%20', ' ', $role);
		
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$id = $this->main->add_permissions();
			flashMsg($id, "$this->title updated.", "$this->title not updated. Try again.", "$this->redirect/add/$role");
		} else{
			$data['title'] = $this->title;
			$data['name'] = $this->name;
			$data['url'] = $this->redirect;
			$data['operation'] = "add";
			$data['navs'] = $this->main->navs($role);
			$data['role'] = $role;
			
			return $this->template->load('template', "$this->redirect/form", $data);
		}
	}
}