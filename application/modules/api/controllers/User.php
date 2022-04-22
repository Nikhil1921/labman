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

    public function __construct()
    {
        parent::__construct();
        $this->api = $this->verify_api_key();
    }

    private $table = 'users';
}