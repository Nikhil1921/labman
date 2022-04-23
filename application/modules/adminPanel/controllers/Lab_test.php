<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lab_test extends Admin_controller  {

	private $table = 'lab_tests';
	protected $redirect = 'lab_test';
	protected $title = 'Lab test';
	protected $name = 'lab_test';
	
	public function index()
	{
        check_access($this->name, 'view');
        
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
        $this->load->model('Lab_test_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $sr = $this->input->get('start') + 1;
        $data = [];

        foreach($fetch_data as $row)
        {
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->cat_name;
            $sub_array[] = $row->t_name;
            $sub_array[] = $row->ltl_price;
            $sub_array[] = $row->t_price;
            $sub_array[] = $row->total;

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
}