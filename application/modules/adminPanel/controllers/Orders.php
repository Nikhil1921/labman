<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends Admin_controller  {

	private $table = 'orders';
	protected $redirect = 'orders';
	protected $title = 'Completed order';
	protected $name = 'orders';
	
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
        // $delete = verify_access($this->name, 'delete');
        $output = [
            "draw"              => intval($this->input->get('draw')),  
            "recordsTotal"      => 0,
            "recordsFiltered"   => 0,
            "data"              => []
        ];
        /* $this->load->model('Users_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $sr = $this->input->get('start') + 1;
        $data = [];

        foreach($fetch_data as $row)
        {
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->name;
            $sub_array[] = $row->mobile;
            $sub_array[] = $row->email;
            $sub_array[] = $row->create_date;
            $sub_array[] = $row->create_time;
            $sub_array[] = date_diff(date_create(date('Y-m-d')), date_create($row->dob))->format('%y');

            $data[] = $sub_array;  
            $sr++;
        }

        $output = [
            "draw"              => intval($this->input->get('draw')),  
            "recordsTotal"      => $this->data->count(),
            "recordsFiltered"   => $this->data->get_filtered_data(),
            "data"              => $data
        ]; */
        
        die(json_encode($output));
    }
}