<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends API_controller {

    public function update_token()
	{
		post();

		$this->form_validation->set_rules('token', 'Token', 'required', ['required' => "%s is required"]);
		verifyRequiredParams();
		
		$post = [
			'token'   => $this->input->post('token')
		];

		if($this->main->update(['id' => $this->api], $post, $this->table))
        {
            $response['error'] = false;
            $response['message'] = "Token updated.";
        }else{
            $response['error'] = false;
            $response['message'] = "Token not updated.";
        }


		echoRespnse(200, $response);
	}

    public function add_to_cart()
	{  
        post();

        $this->form_validation->set_rules('city', 'City', 'required|max_length[100]', ['required' => "%s is required", 'max_length' => 'Max 100 chars allowed.']);
        $this->form_validation->set_rules('lab_id', 'Lab', 'required|is_natural', ['required' => "%s is required", 'is_natural' => "%s is invalid"]);
        
        if(!$this->input->post('pack_id'))
            $this->form_validation->set_rules('tests', 'Tests', 'required', ['required' => "%s is required"]);
        
        verifyRequiredParams();
        $city = $this->main->check('cities', ['c_name' => $this->input->post('city')], 'id');
        
        if(!$city)
        {
            $response['error'] = true;
            $response['message'] = "City not available.";
        }else{
            $post = [
                'session_id' => $this->api,
                'city'       => $city,
                'lab_id'     => $this->input->post('lab_id'),
                'test_id'    => $this->input->post('tests'),
                'pack_id'    => $this->input->post('pack_id') ? d_id($this->input->post('pack_id')) : 0,
                'user_id'    => $this->api
            ];
            
            if($this->main->delete('cart', ['user_id' => $this->api]) && $this->main->add($post, 'cart'))
            {
                $response['error'] = false;
                $response['message'] = "Add to cart success.";
            }
            else
            {
                $response['error'] = true;
                $response['message'] = "Add to cart not success.";
            }
        }

		echoRespnse(200, $response);
	}

    public function getCart()
    {
        get();
        
        $data = $this->main->getCart($this->api);
        
        $data['family'] = $this->members();

        $data['address'] = array_map(function($add){
            return ['id' => e_id($add['id']), 'ad_location' => $add['ad_location']];
        }, $this->main->getAll('addresses', 'id, ad_location', ['user_id' => $this->api, 'is_deleted' => 0]));

        $response['row'] = $data;
        $response['error'] = false;
        $response['message'] = "Get cart success.";

        echoRespnse(200, $response);
    }

    public function getMembers()
    {
        get();
        
        $data['family'] = $this->members();
        
        $response['row'] = $data;
        $response['error'] = false;
        $response['message'] = "Get members success.";

        echoRespnse(200, $response);
    }

    public function getAddress()
    {
        get();
        
        $data['address'] = array_map(function($add){
            return ['id' => e_id($add['id']), 'ad_location' => $add['ad_location']];
        }, $this->main->getAll('addresses', 'id, ad_location', ['user_id' => $this->api, 'is_deleted' => 0]));

        $response['row'] = $data;
        $response['error'] = false;
        $response['message'] = "Get address success.";

        echoRespnse(200, $response);
    }

    public function add_address()
    {
        post();
        $this->form_validation->set_rules('faddress', 'Full Address (With landmark)', 'required|max_length[100]', ['required' => "%s is required", 'max_length' => 'Max 100 chars allowed.']);
        $this->form_validation->set_rules('address', 'Location', 'required|max_length[100]', ['required' => "%s is required", 'max_length' => 'Max 100 chars allowed.']);
        $this->form_validation->set_rules('city', 'City', 'required|max_length[100]', ['required' => "%s is required", 'max_length' => 'Max 100 chars allowed.']);
        $this->form_validation->set_rules('lat', 'Lat', 'required|decimal|max_length[100]', ['required' => "%s is required", 'max_length' => 'Max 100 chars allowed.', 'decimal' => '%s is invalid.']);
        $this->form_validation->set_rules('lng', 'Lng', 'required|decimal|max_length[100]', ['required' => "%s is required", 'max_length' => 'Max 100 chars allowed.', 'decimal' => '%s is invalid.']);
        verifyRequiredParams();
        
        $post = [
			'user_id'	  => $this->api,
			'faddress' 	  => $this->input->post('faddress'),
			'ad_location' => $this->input->post('address'),
			'ad_city' 	  => $this->input->post('city'),
			'latitude' 	  => $this->input->post('lat'),
			'longitude'	  => $this->input->post('lng')
		];

		$id = $this->main->add($post, 'addresses');

		$response['row'] = array_map(function($add){
            return ['id' => e_id($add['id']), 'ad_location' => $add['ad_location']];
        }, $this->main->getAll('addresses', 'id, ad_location', ['user_id' => $this->api, 'is_deleted' => 0]));

        $response['error'] = $id ? false : true;
        $response['message'] = $id ? 'Address added successfully.' : 'Address not added.';

        echoRespnse(200, $response);
    }

	public function add_member()
    {
		post();

        $this->form_validation->set_rules('relation', 'Relation', 'required|max_length[15]', ['required' => "%s is required", 'max_length' => 'Max 15 chars allowed.']);
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[100]', ['required' => "%s is required", 'max_length' => 'Max 100 chars allowed.']);
        $this->form_validation->set_rules('email', 'Email', 'required|max_length[100]|valid_email', ['required' => "%s is required", 'valid_email' => "%s is invalid", 'max_length' => "Max 100 chars allowed"]);
        $this->form_validation->set_rules('gender', 'Gender', 'required|max_length[6]', ['required' => "%s is required", 'max_length' => 'Max 6 chars allowed.']);
        $this->form_validation->set_rules('dob', 'Date of birth', 'required', ['required' => "%s is required"]);
        $this->form_validation->set_rules('mobile', 'Mobile', 'required|is_natural|exact_length[10]', ['required' => "%s is required", 'is_natural' => "%s is invalid", 'exact_length' => "%s is invalid",]);
        
        verifyRequiredParams();

        $post = [
			'u_id'     => $this->api,
			'relation' => $this->input->post('relation'),
			'name'     => $this->input->post('name'),
			'email'    => $this->input->post('email'),
			'gender'   => $this->input->post('gender'),
			'dob'      => date('Y-m-d', strtotime($this->input->post('dob'))),
			'mobile'   => $this->input->post('mobile'),
		];

		$id = $this->main->add($post, 'user_members');

		$response['row'] = $this->members();
        $response['error'] = $id ? false : true;
        $response['message'] = $id ? 'Member added successfully.' : 'Member not added.';

        echoRespnse(200, $response);
    }

    private function members()
    {
        return array_map(function($member){
            return ['id' => e_id($member['id']), 'name' => $member['name'], 'age' => $member['age'], 'gender' => $member['gender']];
        }, $this->main->getAll('user_members', 'id, name, DATE_FORMAT(FROM_DAYS(DATEDIFF(CURRENT_DATE, dob)), "%y") AS age, gender', ['u_id' => $this->api]));
    }

    public function profile()
    {
        get();

        $response['row'] = $this->main->get($this->table, 'name, mobile, email, gender, dob, CONCAT("'.base_url($this->config->item('users')).'", image) image', ['id' => $this->api]);
        $response['error'] = $response['row'] ? false : true;
        $response['message'] = $response['row'] ? 'Profile successful.' : 'Profile not successful.';

        echoRespnse(200, $response);
    }

    public function profile_update()
    {
        post();
        $this->form_validation->set_rules($this->profile);
        verifyRequiredParams();

        $post = [
            'name'   => $this->input->post('name'),
            'mobile' => $this->input->post('mobile'),
            'email'  => $this->input->post('email'),
            'gender' => $this->input->post('gender'),
            'dob'    => date('Y-m-d', strtotime($this->input->post('dob'))),
        ];

        if(! empty($_FILES['image']['name']))
        {
            $unlink = $this->main->check($this->table, ['id' => $this->api], 'image');
            $this->path = $this->config->item('users');
            $img = $this->uploadImage('image');
            
            if($img['error']) {
                $response['error'] = true;
                $response['message'] = $img['message'];
                echoRespnse(200, $response);
            }

            $post['image'] = $img['message'];
        }

        $id = $this->main->update(['id' => $this->api], $post, $this->table);

        $response['row'] = $this->main->get($this->table, 'name, mobile, email, gender, dob, CONCAT("'.base_url($this->config->item('users')).'", image) image', ['id' => $this->api]);
        $response['error'] = $id ? false : true;
        $response['message'] = $id ? 'Profile update successful.' : 'Profile update not successful.';
        
        if($id && ! empty($_FILES['image']['name']) && $unlink != 'user.png' && is_file($this->config->item('users').$unlink))
            unlink($this->config->item('users').$unlink);

        echoRespnse(200, $response);
    }

    public function clear_cart()
	{
        post();

        $id = $this->main->delete('cart', ['user_id' => $this->api]);
        
        $response['error'] = $id ? false : true;
        $response['message'] = $id ? "Cart clear" : "Cart not clear.";

        echoRespnse(200, $response);
	}

    public function add_order()
    {
		post();

        $this->form_validation->set_rules('address', 'Address', 'required|is_natural', ['required' => "%s is required", 'is_natural' => "%s is invalid"]);
        $this->form_validation->set_rules('family', 'Family', 'required|is_natural', ['required' => "%s is required", 'is_natural' => "%s is invalid"]);
        $this->form_validation->set_rules('ref_doctor', 'Ref doctor', 'max_length[100]', ['max_length' => "Max 100 chars allowed."]);
        $this->form_validation->set_rules('remarks', 'Doctor Remarks', 'max_length[100]', ['max_length' => "Max 100 chars allowed."]);
        $this->form_validation->set_rules('pay_method', 'Payment method', 'required|max_length[10]', ['required' => "%s is required", 'max_length' => "Max 10 chars allowed."]);
        $this->form_validation->set_rules('collection_date', 'Collection date', 'required', ['required' => "%s is required"]);
        $this->form_validation->set_rules('collection_time', 'Collection time', 'required', ['required' => "%s is required"]);
        $this->form_validation->set_rules('payment_id', 'Payment id', 'max_length[255]', ['max_length' => "Max 255 chars allowed."]);
        verifyRequiredParams();
        
		echoRespnse(200, $this->main->addOrder($this->api));
    }

    public function prescription()
	{
        post();
        
        $this->path = $this->config->item('prescription');

        if(empty($_FILES['prescription']['name'])) {
            $this->form_validation->set_rules('prescription', 'Prescription', 'required', ['required' => "%s is required"]);
            verifyRequiredParams();
        }

        $prescription = $this->uploadImage('prescription');
        
        if ($prescription['error'] == TRUE) echoRespnse(200, $prescription);

        $post = [
            'prescription' => $prescription['message'],
            'u_id'         => $this->api,
            'created_date' => date('Y-m-d'),
            'created_time' => date('H:i:s')
        ];
        
        if($this->main->add($post, 'prescription'))
            $res = ['error' => false, 'message' => 'Thank you. We will get back to you soon.'];
        else
            $res = ['error' => true, 'message' => 'Something is not going good.'];

		echoRespnse(200, $res);
	}

    public function __construct()
    {
        parent::__construct($this->table);
        $this->api = $this->verify_api_key();
    }

    protected $table = 'users';

	public function mobile_check($str)
    {   
        $where = ['mobile' => $str, 'id != ' => $this->api];
        
        if ($this->main->check($this->table, $where, 'id'))
        {
            $this->form_validation->set_message('mobile_check', 'The %s is already in use');
            return FALSE;
        } else
            return TRUE;
    }

    public function email_check($str)
    {   
        $where = ['email' => $str, 'id != ' => $this->api];
        
        if ($this->main->check($this->table, $where, 'id'))
        {
            $this->form_validation->set_message('email_check', 'The %s is already in use');
            return FALSE;
        } else
            return TRUE;
    }

    public $profile = [
		[
            'field' => 'dob',
            'label' => 'Date of birth',
            'rules' => 'required|trim',
            'errors' => [
                'required' => "%s is required",
            ],
        ],
		[
            'field' => 'gender',
            'label' => 'Gender',
            'rules' => 'required|max_length[6]|alpha|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 6 chars allowed.",
                'alpha' => "Only characters are allowed.",
            ],
        ],
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