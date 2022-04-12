<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Transactions extends Admin_controller  {

	private $table = 'transactions';
	protected $redirect = 'transactions';
	protected $title = 'Transactions';
	protected $name = 'transactions';
	
	public function index()
	{
		$data['title'] = $this->title;
        $data['name'] = $this->name;
        $data['url'] = $this->redirect;
        $data['operation'] = "List";
        $data['datatable'] = "$this->redirect/get";
        $data['labs'] = $this->main->getAll('logins', 'id, name', ['role' => 'Lab partner', 'is_deleted' => 0]);
		
		return $this->template->load('template', "$this->redirect/home", $data);
	}

    public function get()
    {
        check_ajax();
        
        $this->load->model('Transactions_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $sr = $this->input->get('start') + 1;
        $data = [];

        foreach($fetch_data as $row)
        {
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->amount;
            $sub_array[] = date('d-m-Y', strtotime($row->tr_date));
            $sub_array[] = date('h:i A', strtotime($row->tr_time));
            $sub_array[] = $row->pay_mod;

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

    public function add()
	{
        $this->form_validation->set_rules($this->validate);

        $data['title'] = $this->title;
        $data['name'] = $this->name;
        $data['operation'] = "Add";
        $data['url'] = $this->redirect;
        $data['labs'] = $this->main->getAll('logins', 'id, name', ['is_deleted' => 0, 'role' => 'Lab partner']);
        
        if ($this->form_validation->run() == FALSE)
            return $this->template->load('template', "$this->redirect/form", $data);
        else{
            $post = [
                'lab_id'  => d_id($this->input->post('lab_id')),
                'amount'  => $this->input->post('amount'),
                'tr_date' => date('Y-m-d'),
                'tr_time' => date('H:i:s'),
                'pay_mod' => $this->input->post('pay_mod')
            ];
            
            $id = $this->main->add($post, $this->table);

            flashMsg($id, "$this->title added.", "$this->title not added. Try again.", $this->redirect);
        }
	}

    protected $validate = [
        [
            'field' => 'pay_mod',
            'label' => 'Payment mode',
            'rules' => 'required|max_length[100]|alpha_numeric_spaces|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 100 chars allowed.",
                'alpha_numeric_spaces' => "Only characters and numbers are allowed.",
            ],
        ],
        [
            'field' => 'amount',
            'label' => 'Amount',
            'rules' => 'required|max_length[10]|is_natural|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 10 chars allowed.",
                'is_natural' => "%s is invalid",
            ],
        ],
        [
            'field' => 'lab_id',
            'label' => 'Lab name',
            'rules' => 'required|is_natural|trim',
            'errors' => [
                'required' => "%s is required",
                'is_natural' => "%s is invalid",
            ],
        ],
    ];
}