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
        $data['family'] = $this->main->getAll('user_members', 'id, name', ['u_id' => $this->api]);
        $data['address'] = $this->main->getAll('addresses', 'id, ad_location', ['user_id' => $this->api, 'is_deleted' => 0]);

        $response['row'] = $data;
        $response['error'] = false;
        $response['message'] = "Get cart success.";

        echoRespnse(200, $response);
    }

    public function getMembers()
    {
        get();
        
        $data['family'] = $this->main->getAll('user_members', 'id, name', ['u_id' => $this->api]);
        
        $response['row'] = $data;
        $response['error'] = false;
        $response['message'] = "Get members success.";

        echoRespnse(200, $response);
    }

    public function getAddress()
    {
        get();
        
        $data['address'] = $this->main->getAll('addresses', 'id, ad_location', ['user_id' => $this->api, 'is_deleted' => 0]);

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

		$response['row'] = $this->main->getAll('addresses', 'id, ad_location', ['user_id' => $this->api, 'is_deleted' => 0]);
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
        $this->form_validation->set_rules('gender', 'Gender', 'required|max_length[5]', ['required' => "%s is required", 'max_length' => 'Max 5 chars allowed.']);
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

		$response['row'] = $this->main->getAll('user_members', 'id, name', ['u_id' => $this->api]);
        $response['error'] = $id ? false : true;
        $response['message'] = $id ? 'Member added successfully.' : 'Member not added.';

        echoRespnse(200, $response);
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

    public function __construct()
    {
        parent::__construct();
        $this->api = $this->verify_api_key();
    }

    private $table = 'users';

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
            'rules' => 'required|max_length[5]|alpha|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 5 chars allowed.",
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