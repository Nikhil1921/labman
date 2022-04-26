<?php defined('BASEPATH') OR exit('No direct script access allowed');

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
		$data['title'] = 'Dashboard';
        $data['name'] = 'dashboard';
        
        return $this->template->load('template', 'dashboard', $data);
	}

	public function test_report()
	{
		$data['title'] = 'Test report';
        $data['name'] = 'test_report';
        
        return $this->template->load('template', 'test-report', $data);
	}

	public function orders()
	{
		check_ajax();

        $this->load->model('Orders_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $sr = $this->input->get('start') + 1;

        $data = [];
		
        foreach($fetch_data as $row)
        {
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->or_id;
            $sub_array[] = $row->name;
            $sub_array[] = $row->lab;
			$ts = '';
			foreach ($this->data->getOrder($row->id) as $k => $v)
				$ts .= ($k+1).'. '.$v['t_name'].'<br />';
            $sub_array[] = $ts;
            $sub_array[] = date('d-m-Y', strtotime($row->collection_date));
            $sub_array[] = $row->total;
            $sub_array[] = $row->pay_type;
            $sub_array[] = $row->coll_otp;
            $sub_array[] = $row->status;

            $data[] = $sub_array;
            $sr++;
        }

        $output = [
            "draw"              => intval($this->input->get('draw')),  
            "recordsTotal"      => $this->data->count(),
            "recordsFiltered"   => $this->data->get_filtered_data(),
            "data"              => $data
        ];
        
        die(json_encode($output));
	}

	public function booking_history()
	{
		$data['title'] = 'Booking history';
        $data['name'] = 'booking_history';
        
        return $this->template->load('template', 'booking-history', $data);
	}

	public function history()
	{
		check_ajax();

        $this->load->model('Orders_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $sr = $this->input->get('start') + 1;

        $data = [];
		
        foreach($fetch_data as $row)
        {
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->or_id;
            $sub_array[] = $row->name;
            $sub_array[] = $row->lab;
			$ts = '';
			foreach ($this->data->getOrder($row->id) as $k => $v)
				$ts .= ($k+1).'. '.$v['t_name'].'<br />';
            $sub_array[] = $ts;
            $sub_array[] = date('d-m-Y', strtotime($row->collection_date));
            $sub_array[] = $row->total;
            $sub_array[] = $row->pay_type;

            $data[] = $sub_array;
            $sr++;
        }

        $output = [
            "draw"              => intval($this->input->get('draw')),  
            "recordsTotal"      => $this->data->count(),
            "recordsFiltered"   => $this->data->get_filtered_data(),
            "data"              => $data
        ];
        
        die(json_encode($output));
	}

	public function test_reports()
	{
		check_ajax();

        $this->load->model('Reports_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $sr = $this->input->get('start') + 1;

        $data = [];

        foreach($fetch_data as $row)
        {
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->or_id;
            $sub_array[] = $row->name;
            $sub_array[] = $row->t_name;
            $sub_array[] = $row->upload_date ? $row->upload_date : "Report Not Uploaded";
            $sub_array[] = $row->test_report ? anchor($this->config->item('test-reports').$row->test_report, '', 'target="_blank" class="btn btn-default btn-sm"') : "Report Not Uploaded";

            $data[] = $sub_array;
            $sr++;
        }

        $output = [
            "draw"              => intval($this->input->get('draw')),  
            "recordsTotal"      => $this->data->count(),
            "recordsFiltered"   => $this->data->get_filtered_data(),
            "data"              => $data
        ];
        
        die(json_encode($output));
	}

	public function profile()
	{
		$this->form_validation->set_rules($this->profile);

		if($this->form_validation->run() == FALSE){
			$data['title'] = 'Profile';
			$data['name'] = 'profile';
			
			return $this->template->load('template', 'profile', $data);
		}else{
			$post = [
				'name'   => $this->input->post('name'),
				'mobile' => $this->input->post('mobile'),
				'email'  => $this->input->post('email')
			];

			if(! empty($_FILES['image']['name']))
			{
				$unlink = $this->user['image'];
				$this->path = $this->config->item('users');
				$img = $this->uploadImage('image');
				
				if($img['error']) flashMsg(0, "", $img['message'], 'user/profile');
				$post['image'] = $img['message'];
			}

			$id = $this->main->update(['id' => $this->session->userId], $post, $this->table);
			if($id && ! empty($_FILES['image']['name']) && $unlink != 'user.png' && is_file($this->config->item('users').$unlink))
				unlink($this->config->item('users').$unlink);
			flashMsg($id, "Profile updated.", "Profile not updated.", 'user/profile');
		}
	}

	public function clear_cart()
	{
		flashMsg($this->main->delete('cart', ['user_id' => $this->session->userId]), "Cart clear", "Cart not clear.", 'cart');
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
			'ad_city' 	  => $this->input->post('city'),
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

	public function mobile_check($str)
    {   
        $where = ['mobile' => $str, 'id != ' => $this->session->userId];
        
        if ($this->main->check($this->table, $where, 'id'))
        {
            $this->form_validation->set_message('mobile_check', 'The %s is already in use');
            return FALSE;
        } else
            return TRUE;
    }

    public function email_check($str)
    {   
        $where = ['email' => $str, 'id != ' => $this->session->userId];
        
        if ($this->main->check($this->table, $where, 'id'))
        {
            $this->form_validation->set_message('email_check', 'The %s is already in use');
            return FALSE;
        } else
            return TRUE;
    }

	private $table = 'users';

	public $profile = [
		[
            'field' => 'name',
            'label' => 'Full name',
            'rules' => 'required|max_length[100]|alpha_numeric_spaces|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 100 chars allowed.",
                'alpha_numeric_spaces' => "Only characters and numbers are allowed.",
            ],
        ],
        [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|max_length[100]|valid_email|callback_email_check|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 100 chars allowed.",
                'valid_email' => "%s is invalid"
            ],
        ],
        [
            'field' => 'mobile',
            'label' => 'Mobile',
            'rules' => 'required|exact_length[10]|is_numeric|callback_mobile_check|trim',
            'errors' => [
                'required' => "%s is required",
                'exact_length' => "%s is invalid",
                'is_numeric' => "%s is invalid"
            ],
        ],
	];
}