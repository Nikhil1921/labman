<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends Admin_controller  {

	private $table = 'orders';
	protected $redirect = 'orders';
	protected $title = 'Order';
	protected $name = 'orders';
	
	public function index()
	{
		$data['title'] = $this->title;
        $data['name'] = $this->name;
        $data['url'] = $this->redirect;
        $data['operation'] = "List";
        $data['datatable'] = "$this->redirect/get";
		
		return $this->template->load('template', "$this->redirect/home", $data);
	}

    public function get()
    {
        check_ajax();
        $this->load->model('Orders_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $sr = $this->input->get('start') + 1;
        $data = [];

        foreach($fetch_data as $row)
        {
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->name;
            $sub_array[] = $row->mobile;
            $sub_array[] = $row->total_amount - ($row->total_amount * $row->discount / 100) + $row->shipping;
            $sub_array[] = $row->pay_staus;
            $sub_array[] = $row->pay_type;
            $sub_array[] = $row->payment_id;

            switch ($row->status) {
                case 'Shipping':
                    $status = 'Delivered';
                    break;
                case 'Delivered':
                    $status = 'Returned';
                    break;
                case 'Returned':
                case 'Canceled':
                    $status = '';
                    break;
                case 'Packing':
                    $status = 'Shipping';
                    break;
                
                default:
                    $status = 'Packing';
                    break;
            }

            if($status)
                $sub_array[] = form_open($this->redirect.'/status', 'id="status_'.e_id($row->id).'"', ['id' => e_id($row->id), 'status' => $status]).
                    '<a onclick="changeStatus('.e_id($row->id).'); return false;" class="btn btn-outline-secondary-2x" href="">'.$status.'</a>'.
                    form_close();
            else
                $sub_array[] = 'NA';
            
            $action = '<div class="btn-group" role="group"><button class="btn btn-success dropdown-toggle" id="btnGroupVerticalDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="icon-settings"></span></button><div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start">';
            
            $action .= anchor($this->redirect."/view/".e_id($row->id), '<i class="fa fa-eye"></i> View</a>', 'class="dropdown-item"');
            $action .= '<a href="javascript:;" class="dropdown-item" onclick="changeStatus('.e_id($row->id).', '."'".''.$row->status.''."'".')"><i class="fa fa-file-text-o"></i> Change status</a></a>';
        
            /* $action .= form_open($this->redirect.'/delete', 'id="'.e_id($row->id).'"', ['id' => e_id($row->id)]).
                '<a class="dropdown-item" onclick="script.delete('.e_id($row->id).'); return false;" href=""><i class="fa fa-trash"></i> Delete</a>'.
                form_close(); */

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

    public function view($id)
    {
        $data['title'] = $this->title;
        $data['name'] = $this->name;
        $data['operation'] = "View";
        $data['url'] = $this->redirect;
        $data['order'] = $this->main->get($this->table, '*', ['id' => d_id($id)]);
        
        return $this->template->load('template', "$this->redirect/view", $data);
    }

    public function status()
    {
        $this->form_validation->set_rules('id', 'id', 'required|numeric');
        $this->form_validation->set_rules('status', 'status', 'required');
        
        if ($this->form_validation->run() == FALSE)
            flashMsg(0, "", "Some required fields are missing.", $this->redirect);
        else{
            $id = $this->main->update(['id' => d_id($this->input->post('id'))], ['status' => $this->input->post('status')], $this->table);
            flashMsg($id, "$this->title updated.", "$this->title not updated.", $this->redirect);
        }
    }
}