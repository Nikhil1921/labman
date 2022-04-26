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

        $this->load->model('Order_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $sr = $this->input->get('start') + 1;
        $data = [];

        foreach($fetch_data as $row)
        {
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->name;
            $sub_array[] = $row->mobile;
            $sub_array[] = $row->collection_date;
            $sub_array[] = $row->collection_time;
            $sub_array[] = $row->total;
            $sub_array[] = $row->labman;

            $action = '<div class="btn-group" role="group"><button class="btn btn-success dropdown-toggle" id="btnGroupVerticalDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="icon-settings"></span></button><div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start">';
            
            $action .= '<a class="dropdown-item" onclick="getOrderDetails('.e_id($row->id).')" href="javascript:;"><i class="fa fa-flask"></i> Tests</a>';
            
            $action .= '</div></div>';
            $sub_array[] = $action;

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