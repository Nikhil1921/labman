<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Public_controller {

	public function __construct()
	{
		parent::__construct();
        if($this->session->userId)
			return redirect('');
	}

	private $table = 'users';
	
	public function index()
	{
		$this->form_validation->set_rules('mobile', 'Mobile', 'required|is_natural|trim|exact_length[10]', [
			'required' => "%s is required",
			'is_natural' => "%s is invalid",
			'exact_length' => "%s is invalid",
		]);

		if($this->form_validation->run() == FALSE){
			$data['title'] = 'Login';
			$data['name'] = 'login';
			
			return $this->template->load('auth/template', 'auth/login', $data);
		}else{
			$post = [
				'mobile' => $this->input->post('mobile'),
				'otp' => rand(1000, 9999),
				'otp' => 9999,
				'validity' => date('Y-m-d H:i:s', strtotime('+15 minutes')),
			];

			$this->main->delete('check_otp', ['mobile' => $post['mobile']]);
			if($this->main->add($post, 'check_otp')) {
				$this->session->set_tempdata('login_check', $post['mobile'], 900);
				flashMsg(1, "OTP send success.", "", 'verify-otp');
			}else{
				flashMsg(0, "", "Something not going good. Try again", 'login');
			}
		}
	}

	public function verify_otp()
	{
		if(!$this->session->login_check) return redirect('login');

		$this->form_validation->set_rules('otp', 'OTP', 'required|is_natural|trim|exact_length[4]', [
			'required' => "%s is required",
			'is_natural' => "%s is invalid",
			'exact_length' => "%s is invalid",
		]);

		if($this->form_validation->run() == FALSE){
			$data['title'] = 'Verify OTP';
			$data['name'] = 'verify_otp';
			
			return $this->template->load('auth/template', 'auth/verify_otp', $data);
		}else{
			$post = [
				'otp' => $this->input->post('otp'),
				'mobile' => $this->session->login_check,
				'validity >= ' => date('Y-m-d H:i:s'),
			];
			
			if($this->main->get('check_otp', 'mobile', $post)) {
				$this->main->delete('check_otp', ['mobile' => $post['mobile']]);
				$verify = $this->main->get($this->table, 'id', ['mobile' => $post['mobile']]);
				$this->main->verifyCart($verify['id']);
				if($verify){
					$this->session->set_userdata('userId', $verify['id']);
					if($this->main->verifyCart($verify['id'])){
						flashMsg($id, "Login success.", "", 'cart');
					}else{
						flashMsg($id, "Login success.", "", '');
					}
				}else{
					flashMsg(1, "Complete signup to complete order", "", 'register');
				}
			}else{
				flashMsg(0, "", "OTP is not valid or expired.", 'verify-otp');
			}
		}
	}

	public function register()
	{
		if(!$this->session->login_check) return redirect('login');

		$this->form_validation->set_rules($this->register);

		if($this->form_validation->run() == FALSE){
			$data['title'] = 'Register';
			$data['name'] = 'register';
			
			return $this->template->load('auth/template', 'auth/register', $data);
		}else{
			$post = [
				'name' => $this->input->post('name'),
				'mobile' => $this->session->login_check,
				'email' => $this->input->post('email'),
				'dob' => $this->input->post('dob'),
				'gender' => $this->input->post('gender'),
				'wallet' => 0,
				'create_date' => date('Y-m-d'),
				'create_time' => date('H:i:s'),
			];

			if($id = $this->main->add($post, $this->table)) {
				$this->session->set_userdata('userId', $id);
				$cart = $this->main->get('cart', 'session_id', ['session_id' => $this->session->session_id]);
				if($cart){
					$this->main->update($cart, ['user_id' => $id], 'cart');
					flashMsg($id, "Registration success.", "", 'cart');
				}else{
					flashMsg($id, "Registration success.", "", '');
				}
			}else{
				flashMsg(0, "", "Something not going good. Try again", 'register');
			}
		}
	}

	protected $register = [
        [
            'field' => 'name',
            'label' => 'Full name',
            'rules' => 'required|max_length[100]|alpha_numeric_spaces|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 100 chars allowed.",
                'alpha_numeric_spaces' => "Only characters and numbers are allowed.",
            ],
        ],
        [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|max_length[100]|valid_email|is_unique[users.email]|trim',
            'errors' => [
                'required' => "%s is required",
                'max_length' => "Max 100 chars allowed.",
                'is_unique' => "%s already registered",
                'valid_email' => "%s is invalid"
            ],
        ],
        [
            'field' => 'dob',
            'label' => 'Date of birth',
            'rules' => 'required|trim',
            'errors' => [
                'required' => "%s is required",
            ],
        ],
        [
            'field' => 'gender',
            'label' => 'Gender',
            'rules' => 'required|trim',
            'errors' => [
                'required' => "%s is required",
            ],
        ],
    ];
}