<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Admin_controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->auth) 
			return redirect(admin('login'));

        $this->user = (object) $this->main->get("logins", 'name, mobile, email, role', ['id' => $this->session->auth]);
		$this->redirect = admin($this->redirect);
	}

    public function getOrderDetails()
    {
        $this->load->model('Order_model', 'order');
        $data['order'] = $this->order->getOrder(d_id($this->input->get('id')));
        
        return $this->load->view('order', $data);
    }

    /* public function getSubCats()
    {
        check_ajax();
        
        $return = array_map(function($ins){
            return ['val' => e_id($ins['id']), 'cat_name' => $ins['cat_name']];
        }, $this->main->getall("category", 'id, cat_name', ['is_deleted' => 0, 'parent_id' => d_id($this->input->get('cat_id'))]));
        
        die(json_encode($return));
    } */
}