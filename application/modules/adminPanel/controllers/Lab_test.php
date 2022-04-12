<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lab_test extends Admin_controller  {

	private $table = 'lab_tests';
	protected $redirect = 'lab_test';
	protected $title = 'Lab test';
	protected $name = 'lab_test';
	
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

            /* $sub_array[] = form_open($this->redirect.'/change-status', 'id="status_'.e_id($row->id).'"', ['id' => e_id($row->id), 'status' => $row->is_blocked ? 0 : 1]).
                '<a class="btn btn-pill btn-outline-'.($row->is_blocked ? 'success' : 'danger').' btn-air-'.($row->is_blocked ? 'success' : 'danger').' btn-xs" onclick=\'script.delete("status_'.e_id($row->id).'"); return false;\' href="javascript:;">'.($row->is_blocked ? 'Unblock' : 'Block').'</a>'.
                form_close();
            
            $action = '<div class="btn-group" role="group"><button class="btn btn-success dropdown-toggle" id="btnGroupVerticalDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="icon-settings"></span></button><div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start">';
            
            $action .= anchor($this->redirect."/update/".e_id($row->id), '<i class="fa fa-edit"></i> Edit</a>', 'class="dropdown-item"');
        
            $action .= form_open($this->redirect.'/delete', 'id="'.e_id($row->id).'"', ['id' => e_id($row->id)]).
                '<a class="dropdown-item" onclick="script.delete('.e_id($row->id).'); return false;" href=""><i class="fa fa-trash"></i> Delete</a>'.
                form_close();

            $action .= '</div></div>';
            $sub_array[] = $action; */

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