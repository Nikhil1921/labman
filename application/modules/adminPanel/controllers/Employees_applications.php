<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Employees_applications extends Admin_controller  {

    public function __construct()
	{
		parent::__construct();
		$this->path = $this->config->item('employee');
	}

	private $table = 'employees';
	protected $redirect = 'employees_applications';
	protected $title = 'Employee applications';
	protected $name = 'employees_applications';
	
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
        $this->load->model('Employee_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $status = verify_access($this->name, 'status');
        $sr = $this->input->get('start') + 1;
        $data = [];

        foreach($fetch_data as $row)
        {
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->name;
            $sub_array[] = $row->mobile;
            $sub_array[] = "<p style='white-space: normal;'>$row->address</p>";
            $sub_array[] = $row->qulification;

            $action = '<div class="btn-group" role="group"><button class="btn btn-success dropdown-toggle" id="btnGroupVerticalDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="icon-settings"></span></button><div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start">';
            if($status)
                $action .= anchor($this->redirect."/status/".e_id($row->id), '<i class="fa fa-thumbs-up"></i> Approve', 'class="dropdown-item"');
            
            
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

    public function status($id)
    {
        check_access($this->name, 'status');
        
        $this->form_validation->set_rules('interview', 'Interview By', 'required|max_length[100]|alpha_numeric_spaces|trim', [
                'required' => "%s is required",
                'max_length' => "Max 100 characters allowed",
                'alpha_numeric_spaces' => "%s is invalid"]);
        $this->form_validation->set_rules('interview', 'Date Of Joining', 'required|trim', [
                'required' => "%s is required"]);
        $this->form_validation->set_rules('approval', 'Approval', 'required|trim', [
                'required' => "%s is required"]);

        $this->load->model('Employee_model', 'employee');

        if ($this->form_validation->run() == FALSE)
        {
            $data['title'] = $this->title;
            $data['name'] = $this->name;
            $data['operation'] = "Status";
            $data['url'] = $this->redirect;
            $data['data'] = $this->employee->getEmployee(d_id($id));
            
            return $this->template->load('template', "$this->redirect/status", $data);
        }else{
            $post = [
                'interview' => $this->input->post('interview'),
                'joining' => $this->input->post('joining'),
                'approval' => $this->input->post('approval')
            ];

            $uid = $this->main->update(['id' => d_id($id)], $post, $this->table);

            flashMsg($uid, "$this->title updated.", "$this->title not updated. Try again.", $this->redirect);
        }
    }
}