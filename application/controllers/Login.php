<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Public_controller {
    
    public function __construct()
	{
		parent::__construct();
        if ($this->session->userId)
            return redirect('');
    }

    private $table = 'users';

    public function index()
	{
		$this->form_validation->set_rules('mobile', 'Mobile No.', 'required|exact_length[10]|integer', [
                'required'      => '%s is required.',
                'exact_length'  => '%s is invalid.',
                'integer'       => '%s is invalid.']);

        $this->form_validation->set_rules('pass', 'Password.', 'required|max_length[100]', [
                'required'      => '%s is required.',
                'max_length'    => 'Max 100 chars allowed.']);
        
        $data['title'] = 'Login';
        $data['name'] = 'login';

        if ($this->form_validation->run() == FALSE)
            return $this->template->load('template', "login", $data);
        else{
            $post = [
                'mobile'     => $this->input->post('mobile'),
                'password'   => my_crypt($this->input->post('pass')),
                'is_deleted' => 0
            ];
            
            $user = $this->main->get($this->table, 'id userId, fullname, mobile', $post);

            if ($user) {
                $this->session->set_userdata($user);
                flashMsg($user, "Login success.", "", '');
            }else
                flashMsg($user, "", "Invalid credentials.", 'login');
        }
    }
}