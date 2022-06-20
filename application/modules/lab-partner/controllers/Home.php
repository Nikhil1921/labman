<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_controller  {

	private $table = 'logins';
	protected $redirect = 'dashboard';

	public function index()
	{
		$data['title'] = 'dashboard';
        $data['name'] = 'dashboard';
        $data['url'] = $this->redirect;
        $data['datatable'] = admin("get");
        
        return $this->template->load('template', 'home', $data);
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
            $sub_array[] = "<p style='white-space: normal;'>$row->ref_doctor</p>";
            $sub_array[] = "<p style='white-space: normal;'>$row->doc_remarks</p>";
            $sub_array[] = $row->phlebetomist ? "<p style='white-space: normal;'>$row->phlebetomist</p>" : "NA";

            $action = '<div class="btn-group" role="group"><button class="btn btn-success dropdown-toggle" id="btnGroupVerticalDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="icon-settings"></span></button><div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start">';
            
            $action .= '<a class="dropdown-item" onclick="getOrderDetails('.e_id($row->id).')" href="javascript:;"><i class="fa fa-flask"></i> Tests</a>';
            
            switch ($row->status) {
                case 'Collect Sample':
                    $action .= form_open(admin('change-status'), 'id="change_'.e_id($row->id).'"', ['id' => e_id($row->id), 'status' => 'In Process']).
                                '<a class="dropdown-item" onclick="script.delete(\'change_'.e_id($row->id).'\'); return false;" href=""><i class="fa fa-spinner"></i> In Process</a>'.
                                form_close();
                    break;
                case 'In process':
                case 'In Process':
                    // if($this->main->check('orders_tests', ['o_id' => $row->id, 'test_report' => null], 'o_id'))
                        $action .= anchor(admin('upload-reports/'.e_id($row->id)), '<i class="fa fa-upload"></i> Upload reports', 'class="dropdown-item"');
                    // else
                        $action .= form_open(admin('change-status'), 'id="change_'.e_id($row->id).'"', ['id' => e_id($row->id), 'status' => 'Completed']).
                                    '<a class="dropdown-item" onclick="script.delete(\'change_'.e_id($row->id).'\'); return false;" href=""><i class="fa fa-thumbs-up"></i> Completed</a>'.
                                    form_close();
                    break;
                case 'Completed':
                    $action .= anchor(admin('view-reports/'.e_id($row->id)), '<i class="fa fa-eye"></i> View reports', 'class="dropdown-item"');
                    break;
                
                default:
                    
                    break;
            }

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

	public function getPendingTests()
    {
        $return = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"></path></svg>';
        $tests = $this->main->getAll('orders', 'name, DATE_FORMAT(collection_date, "%d-%m-%Y") date, DATE_FORMAT(collection_time, "%I:%i %p") time', ['lab_id' => $this->session->auth, 'status' => 'Pending']);
        if($tests){
            $return .= '<span class="dot"></span><ul class="notification-dropdown onhover-show-div">';
            $return .= '<li>New Test Request <span class="badge badge-pill badge-primary pull-right">'.count($tests).'</span></li>';

            foreach ($tests as $v)
                $return .= '<li><div class="media">
                                <div class="media-body">
                                    <small class="pull-right">'.$v['date'].' '.$v['time'].'</small>
                                    <p class="mb-0">'.$v['name'].'</p>
                                </div>
                            </div></li>';

            $return .= '</ul>';
        }

        die($return);
    }

	public function view_reports($id)
    {
        $data['title'] = "View reports";
        $data['name'] = "dashboard";
        $data['operation'] = "View reports";
        $data['url'] = $this->redirect;
        $this->load->model('order_model');
        $data['data'] = $this->order_model->getOrder(d_id($id));
        $data['path'] = $this->config->item('test-reports');
        
        return $this->template->load('template', "view_reports", $data);
    }

	public function upload_reports($id)
    {
        $data['title'] = "Upload reports";
        $data['name'] = "dashboard";
        $data['operation'] = "Upload reports";
        $data['url'] = $this->redirect;
        $data['report_error'] = '';
        $this->load->model('order_model');
        $data['data'] = $this->order_model->getOrder(d_id($id));
        
        $this->path = $this->config->item('test-reports');
        $this->form_validation->set_rules('reports[]', 'Reports', 'required', ['required' => "%s are required"]);
        
        if ($this->form_validation->run() == FALSE)
            return $this->template->load('template', "upload_reports", $data);
        else{
            $report = $this->uploadImage('test_report', 'pdf');
            if ($report['error'] == TRUE){
                $data['report_error'] = $report["message"];
                return $this->template->load('template', "upload_reports", $data);
            }else{
                foreach ($this->input->post('reports') as $r)
                    $post[] = [
                        'id'          => d_id($r),
                        'upload_date' => date('Y-m-d'),
                        'test_report' => $report["message"]
                    ];

                $uid = $this->order_model->upload_reports($post);
                
                if($uid){
                    send_notification("Test update", 'Your test report is uploaded.', $data['data']['token'], $this->config->item('user-token'));
                }
                
                if(!$uid && is_file($this->path.$report["message"]))
                    unlink($this->path.$report["message"]);
                
                flashMsg($uid, "Reports uploaded.", "Reports not uploaded. Try again.", admin("upload_reports/$id"));
            }
        }
    }

	public function change_status()
    {
        $this->form_validation->set_rules('id', 'id', 'required|is_natural');
        $this->form_validation->set_rules('status', 'status', 'required');
        
        if ($this->form_validation->run() == FALSE)
            flashMsg(0, "", "Some required fields are missing.", $this->redirect);
        else{
            $id = $this->main->update(['id' => d_id($this->input->post('id'))], ['status' => $this->input->post('status')], 'orders');
            
            if($id){
                $this->load->model('phlebetomist/api_model');
                $token = $this->api_model->getUserToken(d_id($this->input->post('id')));
                
                send_notification("Test update", 'Your test is in : '.$this->input->post('status'), $token['token'], $this->config->item('user-token'));
            }
            flashMsg($id, "Status changed success.", "Status not changed.", $this->redirect);
        }
    }

	public function profile()
    {
        $this->form_validation->set_rules($this->profile);

        if ($this->form_validation->run() == FALSE)
        {
            $data['title'] = 'profile';
            $data['name'] = 'dashboard';
            $data['operation'] = 'update';
            $data['url'] = $this->redirect;

            return $this->template->load('template', 'profile', $data);
        }
        else
        {
            $post = [
    			'mobile'   	 => $this->input->post('mobile'),
    			'email'   	 => $this->input->post('email'),
    			'name'   	 => $this->input->post('name')
    		];

            if ($this->input->post('password'))
                $post['password'] = my_crypt($this->input->post('password'));

            $id = $this->main->update(['id' => $this->session->auth], $post, $this->table);

            flashMsg($id, "Profile updated.", "Profile not updated. Try again.", admin("profile"));
        }
    }

	public function logout()
    {
        $this->session->sess_destroy();
        return redirect(admin('login'));
    }

    public function mobile_check($str)
    {   
        $where = ['mobile' => $str, 'id != ' => $this->session->auth, 'role' => $this->user->role, 'is_deleted' => 0];
        
        if ($this->main->check($this->table, $where, 'id'))
        {
            $this->form_validation->set_message('mobile_check', 'The %s is already in use');
            return FALSE;
        } else
            return TRUE;
    }

    public function email_check($str)
    {   
        $where = ['email' => $str, 'id != ' => $this->session->auth, 'role' => $this->user->role, 'is_deleted' => 0];
        
        if ($this->main->check($this->table, $where, 'id'))
        {
            $this->form_validation->set_message('email_check', 'The %s is already in use');
            return FALSE;
        } else
            return TRUE;
    }

    protected $profile = [
        [
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required|max_length[100]',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 100 chars allowed"
            ],
        ],
        [
            'field' => 'mobile',
            'label' => 'Mobile',
            'rules' => 'required|is_natural|exact_length[10]|callback_mobile_check',
            'errors' => [
                'required' => "%s is required",
                'is_natural' => "%s is invalid",
                'exact_length' => "%s is invalid",
            ],
        ],
        [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|max_length[100]|callback_email_check|valid_email',
            'errors' => [
                'required' => "%s is required",
                'valid_email' => "%s is invalid",
                'max_length' => "Max 100 chars allowed"
            ],
        ],
        [
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'max_length[100]',
            'errors' => [
                'max_length' => "Max 100 chars allowed"
            ],
        ]
    ];
}