<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends API_controller {

    public function change_status()
	{
		post();
        $this->form_validation->set_rules('status', 'Status', 'required', ['required' => "%s is required"]);
        $this->form_validation->set_rules('id', 'Order id', 'required|is_numeric', ['required' => "%s is required", 'is_numeric' => "%s is invalid"]);
		verifyRequiredParams();

        if($this->input->post('status') === 'Collect Sample'){
            $this->form_validation->set_rules('otp', 'OTP', 'required', ['required' => "%s is required"]);
            verifyRequiredParams();
            $check = $this->api_model->get($this->orders, 'id', ['id' => $this->input->post('id'), 'otp' => $this->input->post('otp')]);
            if(!$check){
                $response['error'] = true;
		        $response['message'] = "Invalid otp.";
                echoRespnse(200, $response);
            }
        }

        $post = [
            'phlebotomist_id' => $this->api,
            'status' => $this->input->post('status')
        ];
        
		$id = $this->api_model->update(['id' => $this->input->post('id')], $post, $this->orders);

		$response['error'] = $id ? false : true;
		$response['message'] = $id ? "Status change success." : "Status change not success.";

		echoRespnse(200, $response);
	}

    public function __construct()
    {
        parent::__construct($this->table);
        $this->load->model('api_model');
        $this->api = $this->verify_api_key();
        $this->city = $this->api_model->getCity();
    }

    protected $table = 'logins';
    protected $orders = 'orders';
}