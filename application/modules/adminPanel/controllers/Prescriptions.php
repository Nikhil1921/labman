<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Prescriptions extends Admin_controller  {

    public function __construct()
	{
		parent::__construct();
		$this->path = $this->config->item('prescription');
	}

	private $table = 'prescription';
	protected $redirect = 'prescriptions';
	protected $title = 'Prescription';
	protected $name = 'prescriptions';
	
	public function index()
	{
        check_access($this->name, 'view');

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

        $this->load->model('Prescription_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $update = verify_access($this->name, 'update');
        $delete = verify_access($this->name, 'delete');
        $sr = $this->input->get('start') + 1;
        $data = [];

        foreach($fetch_data as $row)
        {
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->name;
            $sub_array[] = $row->mobile;
            $sub_array[] = $row->email;
            $sub_array[] = $row->date;

            $action = '<div class="btn-group" role="group"><button class="btn btn-success dropdown-toggle" id="btnGroupVerticalDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="icon-settings"></span></button><div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start">';
            
            if($update)
                $action .= anchor($this->redirect."/add/".e_id($row->id), '<i class="fa fa-file-text"></i> Add</a>', 'class="dropdown-item"');
            if($delete)
                $action .= form_open($this->redirect.'/delete', 'id="'.e_id($row->id).'"', ['id' => e_id($row->id)]).
                    '<a class="dropdown-item" onclick="script.delete('.e_id($row->id).'); return false;" href=""><i class="fa fa-trash"></i> Delete</a>'.
                    form_close();
            
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

    public function add($id)
    {
        check_access($this->name, 'update');
        
        $this->form_validation->set_rules('address', 'Address', 'required|is_natural', ['required' => "%s is required", 'is_natural' => "%s is invalid"]);
        $this->form_validation->set_rules('family', 'Family', 'required|is_natural', ['required' => "%s is required", 'is_natural' => "%s is invalid"]);
        $this->form_validation->set_rules('ref_doctor', 'Ref doctor', 'max_length[100]', ['max_length' => "Max 100 chars allowed."]);
        $this->form_validation->set_rules('remarks', 'Doctor Remarks', 'max_length[100]', ['max_length' => "Max 100 chars allowed."]);
        $this->form_validation->set_rules('pay_method', 'Payment method', 'required|max_length[10]', ['required' => "%s is required", 'max_length' => "Max 10 chars allowed."]);
        $this->form_validation->set_rules('collection_date', 'Collection date', 'required', ['required' => "%s is required"]);
        $this->form_validation->set_rules('collection_time', 'Collection time', 'required', ['required' => "%s is required"]);
        $this->form_validation->set_rules('payment_id', 'Payment id', 'max_length[255]', ['max_length' => "Max 255 chars allowed."]);
        
        $data['title'] = $this->title;
        $data['name'] = $this->name;
        $data['operation'] = "Add";
        $data['url'] = $this->redirect;
        $data['data'] = $this->main->get($this->table, 'u_id, CONCAT("'.$this->path.'", prescription) prescription', ['id' => d_id($id)]);
        /* if($data['data'])
        re($data['data']); */
        if ($this->form_validation->run() == FALSE){
            return $this->template->load('template', "$this->redirect/form", $data);
        }else{
            
        }
    }

    public function delete()
    {
        check_access($this->name, 'delete');
        
        $this->form_validation->set_rules('id', 'id', 'required|is_natural');
        
        if ($this->form_validation->run() == FALSE)
            flashMsg(0, "", "Some required fields are missing.", $this->redirect);
        else{
            $id = $this->main->update(['id' => d_id($this->input->post('id'))], ['is_booked' => 1], $this->table);
            flashMsg($id, "$this->title deleted.", "$this->title not deleted.", $this->redirect);
        }
    }
}