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