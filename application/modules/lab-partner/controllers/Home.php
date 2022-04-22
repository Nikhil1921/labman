<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_controller  {

	private $table = 'logins';
	protected $redirect = 'dashboard';

	public function index()
	{
		$data['title'] = 'dashboard';
        $data['name'] = 'dashboard';
        $data['url'] = $this->redirect;
        
        return $this->template->load('template', 'home', $data);
	}
	
	public function getOrderDetails()
    {
        $this->load->model('Order_model', 'order');
        $data['order'] = $this->order->getOrder(d_id($this->input->get('id')));
        
        return $this->load->view('order', $data);
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