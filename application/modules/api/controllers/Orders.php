<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends API_controller {

    public function index()
    {
        get();

        $this->load->model('Orders_model', 'data');

        $data = array_map(function($order){
            return [
                "id" => $order["id"],
                "or_id" => $order["or_id"],
                "name" => $order["name"],
                "lab" => $order["lab"],
                "collection_date" => $order["collection_date"],
                "pay_type" => $order["pay_type"],
                "coll_otp" => $order["coll_otp"],
                "status" => $order["status"],
                "total" => $order["total"],
                "phlebotomist" => $order["phlebotomist"],
                "ph_mobile" => $order["ph_mobile"],
                "longitude" => $order["longitude"],
                "lattitude" => $order["lattitude"],
                "p_type" => $order["p_type"],
                "tests" => $this->data->getOrder($order["id"])
            ];
        }, $this->main->getOrders($this->api, $this->input->get('status')));

        $response['row'] = $data ? $data : [];
        $response['error'] = false;
        $response['message'] = "Orders list success.";

        echoRespnse(200, $response);
    }

    public function reports()
    {
        get();

        $data = $this->main->getReports($this->api);

        $response['row'] = $data ? $data : [];
        $response['error'] = false;
        $response['message'] = "Reports list success.";

        echoRespnse(200, $response);
    }

    public function cancel_order()
	{
		post();
        $this->form_validation->set_rules('id', 'Order id', 'required|is_numeric', ['required' => "%s is required", 'is_numeric' => "%s is invalid"]);
        
		verifyRequiredParams();

        $post = [
            'status' => 'Canceled',
        ];
        
		$id = $this->main->update(['id' => $this->input->post('id')], $post, 'orders');

		$response['error'] = $id ? false : true;
		$response['message'] = $id ? "Order cancel success." : "Order cancel not success.";

		echoRespnse(200, $response);
	}

    public function rate_phlebelogist()
	{
		post();
        $this->form_validation->set_rules('id', 'Order id', 'required|is_numeric', ['required' => "%s is required", 'is_numeric' => "%s is invalid"]);
        $this->form_validation->set_rules('rating', 'Rating', 'required|is_numeric|less_than[6]', ['required' => "%s is required", 'is_numeric' => "%s is invalid", 'less_than' => "%s less than or equal to 5"]);
        $this->form_validation->set_rules('rating_type', 'Rating type', 'required', ['required' => "%s is required"]);
        
		verifyRequiredParams();

        $post = [
            $this->input->post('rating_type') => $this->input->post('rating')
        ];
        
		$id = $this->main->update(['id' => $this->input->post('id')], $post, 'orders');

		$response['error'] = $id ? false : true;
		$response['message'] = $id ? "Rating success." : "Rating not success.";

		echoRespnse(200, $response);
	}

    public function __construct()
    {
        parent::__construct($this->table);
        $this->api = $this->verify_api_key();
    }

    protected $table = 'users';
}