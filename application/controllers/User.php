<?php defined('BASEPATH') OR exit('No direct script access allowed');
// use Razorpay\Api\Api;

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
		
	}

	public function cart()
	{
		$data = $this->main->getCart($this->session->userId);
		$data['title'] = 'Cart';
        $data['name'] = 'cart';
		if($data['cart']){
			$data['family'] = $this->main->getAll('user_members', 'id, name', ['u_id' => $this->session->userId]);
			$data['address'] = $this->main->getAll('addresses', 'id, ad_location', ['user_id' => $this->session->userId, 'is_deleted' => 0]);
		}
		
		return $this->template->load('template', 'cart', $data);
	}

	public function logout()
    {
        $this->session->sess_destroy();
        return redirect('login');
    }

	public function add_address()
    {
		check_ajax();

        $post = [
			'user_id'	  => $this->session->userId,
			'faddress' 	  => $this->input->post('faddress'),
			'ad_location' => $this->input->post('address'),
			'ad_city' 	  => $this->main->getCart($this->session->userId)['cart']->c_name,
			'latitude' 	  => $this->input->post('lat'),
			'longitude'	  => $this->input->post('lng')
		];

		$id = $this->main->add($post, 'addresses');
		
		$msg = $id ? 'Address added successfully.' : 'Address not added.';

		$return = '<option value="">Select address</option>';
		
		foreach ($this->main->getAll('addresses', 'id, ad_location', ['user_id' => $this->session->userId, 'is_deleted' => 0]) as $v)
			$return .= '<option '.($id == $v['id'] ? 'selected' : '').' value="'.e_id($v['id']).'">'.$v['ad_location'].'</option>';

		die(json_encode(['message' => $msg, 'address' => $return]));
    }

	public function add_member()
    {
		check_ajax();

        $post = [
			'u_id'     => $this->session->userId,
			'relation' => $this->input->post('relation'),
			'name'     => $this->input->post('name'),
			'email'    => $this->input->post('email'),
			'gender'   => $this->input->post('gender'),
			'dob'      => date('Y-m-d', strtotime($this->input->post('dob'))),
			'mobile'   => $this->input->post('mobile'),
		];

		$id = $this->main->add($post, 'user_members');
		
		$msg = $id ? 'Member added successfully.' : 'Member not added.';

		$return = '<option value="0">'.$this->user['name'].'</option>';
		
		foreach ($this->main->getAll('user_members', 'id, name', ['u_id' => $this->session->userId]) as $v)
			$return .= '<option '.($id == $v['id'] ? 'selected' : '').' value="'.e_id($v['id']).'">'.$v['name'].'</option>';

		die(json_encode(['message' => $msg, 'address' => $return]));
    }

	public function add_order()
    {
		check_ajax();
		
		die(json_encode($this->main->addOrder($this->session->userId)));
    }

	public function getTotal()
    {
		check_ajax();

		$cart = $this->main->getCart($this->session->userId);
		$total = 0;
		
		foreach ($cart['tests'] as $v)
			$total += $v->total;

		if($total < $cart['cart']->fix_price)
			$total += $cart['cart']->home_visit;

		if($this->input->get('hardcopy') === 'true')
			$total += $cart['cart']->hard_copy;
		
		if($this->input->get('family') == 0)
            $user = $this->main->get('users', 'name, email, mobile', ['id' => $this->session->userId]);
        else
            $user = $this->main->get('user_members', 'name, email, mobile', ['id' => d_id($this->input->get('family'))]);
		
		$response = [
			'name'		=> isset($user['name']) ? $user['name'] : '',
			'email'		=> isset($user['email']) ? $user['email'] : '',
			'mobile'	=> isset($user['mobile']) ? $user['mobile'] : '',
			'total'		=> $total
		];

		die(json_encode($response));
    }

	public function thankyou()
    {
		$data['title'] = 'Thank you';
        $data['name'] = 'thankyou';
        
        return $this->template->load('template', 'thankyou', $data);
    }
}