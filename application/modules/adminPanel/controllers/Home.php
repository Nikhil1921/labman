<?php defined('BASEPATH') OR exit('No direct script access allowed');
use setasign\Fpdi\Fpdi;

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

    public function getPendingTests()
    {
        $return = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"></path></svg>';
        $tests = $this->main->getAll('orders', 'name, DATE_FORMAT(collection_date, "%d-%m-%Y") date, DATE_FORMAT(collection_time, "%I:%i %p") time', ['status' => 'Pending']);
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
            $sub_array[] = "<p style='white-space: normal;'>$row->address</p>";
            $sub_array[] = "<p style='white-space: normal;'>$row->lab</p>";
            $sub_array[] = "<p style='white-space: normal;'>$row->ref_doctor</p>";
            $sub_array[] = "<p style='white-space: normal;'>$row->doc_remarks</p>";
            $sub_array[] = $row->phlebetomist ? "<p style='white-space: normal;'>$row->phlebetomist</p>" : "NA";

            $action = '<div class="btn-group" role="group"><button class="btn btn-success dropdown-toggle" id="btnGroupVerticalDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="icon-settings"></span></button><div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1" x-placement="bottom-start">';
            
            $action .= '<a class="dropdown-item" onclick="getOrderDetails('.e_id($row->id).')" href="javascript:;"><i class="fa fa-flask"></i> Tests</a>';
            
            $action .= anchor(admin("/invoice/".e_id($row->id)), '<i class="fa fa-file-text-o"></i> Invoice', 'class="dropdown-item"');
            
            switch ($row->status) {
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

	public function invoice($or_id)
    {
        $data = $this->main->getOrder(d_id($or_id));
        
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML('*{margin:0;padding:0}body{font-size:15px;color:#000;line-height:22px;font-weight:400;background:#fff;font-family:Rasa,serif}#page-wrap{width:800px;margin:0 auto}textarea{border:0;font:14px Georgia,Serif;overflow:hidden;resize:none}table{border-collapse:collapse}table td,table th{border:1px solid #000;padding:5px}#header{height:15px;width:100%;margin:20px 0;background:#222;text-align:center;color:#fff;font:bold 15px Sans-Serif;text-decoration:uppercase;letter-spacing:20px;padding:8px 0}#address{width:220px;height:150px;float:left;text-align:justify}#customer{overflow:hidden}#logo{text-align:right;float:right;position:relative;margin-top:25px;border:1px solid #fff;max-width:540px;max-height:100px;overflow:hidden}#logo.edit,#logo:hover{border:1px solid #000;margin-top:0;max-height:125px}#logoctr{display:none}#logo.edit #logoctr,#logo:hover #logoctr{display:block;text-align:right;line-height:25px;background:#eee;padding:0 5px}#logohelp{text-align:left;display:none;font-style:italic;padding:10px 5px}#logohelp input{margin-bottom:5px}.edit #logohelp{display:block}.edit #cancel-logo,.edit #save-logo{display:inline}#cancel-logo,#save-logo,.edit #change-logo,.edit #delete-logo,.edit #image{display:none}#customer-title{font-size:20px;font-weight:700;float:left;border:1px solid #000}.meta-width{width:49%}.mr-r{margin:0 2% 0 0}.mr-b-p{margin-bottom:20px}#meta{float:left; width:100%}#meta td.meta-head{text-align:left;background:#eee}#meta td textarea{width:100%;height:20px;text-align:right}#items{clear:both;width:100%;margin:30px 0 0 0}#items th{background:#eee}#items textarea{width:80px;height:50px}#items tr.item-row td{border:0;vertical-align:top;border:1px solid #000}#items td.description{width:300px}#items td.item-name{width:175px}#items td.description textarea,#items td.item-name textarea{width:100%}#items td.total-line{border-right:0;text-align:right}#items td.total-value{border-left:0;padding:10px;border:1px solid #000}#items td.total-value textarea{height:20px;background:0 0}#items td.balance{background:#eee}#items td.blank{border:0}#terms{text-align:center;margin:20px 0 0 0}#terms h5{text-transform:uppercase;font:13px Sans-Serif;letter-spacing:10px;border-bottom:1px solid #000;padding:0 0 8px 0;margin:0 0 8px 0}#terms textarea{width:100%;text-align:center}#items td.total-value textarea:focus,#items td.total-value textarea:hover,.delete:hover,textarea:focus,textarea:hover{background-color:#ef8}.delete-wpr{position:relative}.delete{display:block;color:#000;text-decoration:none;position:absolute;background:#eee;font-weight:700;padding:0 3px;border:1px solid;top:-6px;left:-22px;font-family:sans-serif;font-size:12px}#address1{width:325px;float:right;margin-top:15px}#logo{text-align:right;position:relative;margin-top:0;border:1px solid #fff;max-width:540px;max-height:130px;overflow:hidden}.im{width:225px;display:block;padding-right:35px}', \Mpdf\HTMLParserMode::HEADER_CSS);
        $message = $this->load->view('send-order-mail', $data, true);
        $mpdf->WriteHTML($message, \Mpdf\HTMLParserMode::HTML_BODY);
        $mpdf->Output();
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

    public function view_reports($id)
    {
        $data['title'] = "View reports";
        $data['name'] = "dashboard";
        $data['operation'] = "View reports";
        $data['url'] = $this->redirect;
        $this->load->model('order_model');
        $data['data'] = $this->order_model->getOrder(d_id($id));
        
        return $this->template->load('template', "view_reports", $data);
    }

    public function report($id)
    {
        $this->load->model('orders_model');
        $data = $this->orders_model->getPdf(d_id($id));
        if($data && is_file($this->config->item('test-reports').$data['test_report'])){
            $this->load->library('make_pdf');
    
            $this->make_pdf->setLab($data['name']);
            $this->make_pdf->setCity($data['city']);
    
            $path = $this->config->item('test-reports').$data['test_report'];
            
            $pageCount = $this->make_pdf->setSourceFile($path);
            
            for ($i=1; $i <= $pageCount; $i++) { 
                $this->make_pdf->AddPage();
                $this->make_pdf->AliasNbPages();
                $tplIdx = $this->make_pdf->importPage($i);
                $this->make_pdf->useTemplate($tplIdx);
            }
            return $this->make_pdf->Output();
        }else{
            return $this->error_404();
        }
    }

	/* public function charges()
    {
        $this->form_validation->set_rules('hard_copy', 'Hard Copy', 'required|max_length[6]|is_natural|trim', ['is_natural' => '%s is required.', 'is_natural' => '%s is invalid.', 'max_length' => 'Max 6 characterd are allowed.']);
        $this->form_validation->set_rules('home_visit', 'Home Visit', 'required|max_length[6]|is_natural|trim', ['is_natural' => '%s is required.', 'is_natural' => '%s is invalid.', 'max_length' => 'Max 6 characterd are allowed.']);
        $this->form_validation->set_rules('fix_price', 'Fix To Price', 'required|max_length[6]|is_natural|trim', ['is_natural' => '%s is required.', 'is_natural' => '%s is invalid.', 'max_length' => 'Max 6 characterd are allowed.']);

        if ($this->form_validation->run() == FALSE){
            $data['title'] = 'Report & Delivery Charges';
            $data['name'] = 'charges';
            $data['operation'] = "Update";
            $data['url'] = $this->redirect;
            $data['data'] = $this->main->get('charges', 'hard_copy, home_visit, fix_price', []);
            if(!$data['data'])
            {
                $this->main->add(['hard_copy' => 30, 'home_visit' => 50, 'fix_price' => 300], 'charges');
                $data['data'] = $this->main->get('charges', 'hard_copy, home_visit, fix_price', []);
            }

            return $this->template->load('template', "charges", $data);
        }
        else{
            $post = [
                'hard_copy'  => $this->input->post('hard_copy'),
                'home_visit' => $this->input->post('home_visit'),
                'fix_price'  => $this->input->post('fix_price')
            ];

            $id = $this->main->update([], $post, 'charges');

            flashMsg($id, "Charges updated.", "Charges not updated. Try again.", admin('charges'));
            
        }
    } */

	public function forbidden()
    {
        $data['title'] = 'Forbidden';
        $data['name'] = 'forbidden';

		return $this->template->load('template', 'forbidden', $data);
    }

	public function logout()
    {
        $this->session->sess_destroy();
        return redirect(admin('login'));
    }

	public function makepdf()
    {
        $lab = "DENSETEK INFOTECH";
        $city = "Palanpur";

        $this->load->library('make_pdf');

        $this->make_pdf->setLab($lab);
        $this->make_pdf->setCity($city);

        $path = 'assets/test.pdf';
        $totoalPages = $this->make_pdf->countPages($path);
        
        $this->make_pdf->setSourceFile($path);

        for ($i=1; $i <= $totoalPages; $i++) { 
            $this->make_pdf->AddPage(); 
            $this->make_pdf->AliasNbPages();
            $tplIdx = $this->make_pdf->importPage($i); 
            $this->make_pdf->useTemplate($tplIdx); 
        }
        $this->make_pdf->Output();
        // $this->make_pdf->Output('assets/images/test.pdf', "F");
    }

	public function backup()
    {
        // Load the DB utility class
        $this->load->dbutil();
        
        // Backup your entire database and assign it to a variable
        $backup = $this->dbutil->backup();

        // Load the download helper and send the file to your desktop
        $this->load->helper('download');
        force_download(APP_NAME.'.zip', $backup);
        return redirect(admin());
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