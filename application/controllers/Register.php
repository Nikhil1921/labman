<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends Public_controller {
    public function __construct()
	{
		parent::__construct();
        if ($this->session->userId)
            return redirect('');
    }

    private $table = 'users';

    public function index()
	{
		$this->form_validation->set_rules('reg_mobile', 'Mobile No.', 'required|is_unique[users.mobile]|exact_length[10]|integer', [
                'required'      => '%s is required.',
                'exact_length'  => '%s is invalid.',
                'integer'       => '%s is invalid.',
                'is_unique'     => 'This %s already in use.']);

        $data['title'] = 'Register';
        $data['name'] = 'register';

        if ($this->form_validation->run() == FALSE)
            return $this->template->load('template', "login", $data);
        else{
            $otp = rand(1000, 9999);
            $post = [
                'mobile'   => $this->input->post('reg_mobile'),
                'otp'      => $otp,
                'expiry'   => date('Y-m-d H:i:s', strtotime('+5 minutes'))
            ];
            
            $this->main->delete('check_otp', ['mobile' => $post['mobile']]);
            $id = $this->main->add($post, "check_otp");
            
            if ($id) {
                $this->session->set_flashdata('reg_mobile', $post['mobile']);
                $this->session->mark_as_temp('reg_mobile', 300);
            }

            flashMsg($id, "OTP send success.", "OTP send not success. Try again.", 'register/check');
        }
    }

    public function check()
	{
        if (!$this->session->reg_mobile) return redirect('register');
        
		$this->form_validation->set_rules('otp', 'OTP', 'required|exact_length[4]|integer', [
                'required'      => '%s is required.',
                'exact_length'  => '%s is invalid.',
                'integer'       => '%s is invalid.']);

        $data['title'] = 'Verify otp';
        $data['name'] = 'register';

        if ($this->form_validation->run() == FALSE)
            return $this->template->load('template', "login", $data);
        else{
            $post = [
                'mobile'     => $this->session->reg_mobile,
                'otp'        => $this->input->post('otp'),
                'expiry >= ' => date('Y-m-d H:i:s')
            ];

            $id = $this->main->check("check_otp", $post, "mobile");
            
            if ($id) {
                $this->main->delete('check_otp', $post);
                $this->session->unset_userdata('reg_mobile');
                $this->session->set_flashdata('verified', $post['mobile']);
                $this->session->mark_as_temp('verified', 300);
                flashMsg($id, "OTP check success.", "", 'register/register');
            }else{
                flashMsg($id, "", "Invalid OTP. OR OTP expired.", 'register/check');
            }
        }
    }

    public function register()
	{
        if (!$this->session->verified) return redirect('register');
        
		$this->form_validation->set_rules('fullname', 'Fullname.', 'required|max_length[100]', [
                'required'      => '%s is required.',
                'max_length'    => 'Max 100 chars allowed.']);
		$this->form_validation->set_rules('password', 'Password.', 'required|max_length[100]', [
                'required'      => '%s is required.',
                'max_length'    => 'Max 100 chars allowed.']);
		/* $this->form_validation->set_rules('address', 'Address.', 'required|max_length[255]', [
                'required'      => '%s is required.',
                'max_length'    => 'Max 255 chars allowed.']); */

        $data['title'] = 'Register';
        $data['name'] = 'register';
        if ($this->form_validation->run() == FALSE)
            return $this->template->load('template', "login", $data);
        else{
            $post = [
                'mobile'   => $this->session->verified,
                'fullname' => $this->input->post('fullname'),
                'password' => my_crypt($this->input->post('password')),
                /* 'address'  => $this->input->post('address') */
            ];

            $id = $this->main->add($post, $this->table);

            if ($id) {
                $this->session->unset_userdata('verified');
                $this->session->set_userdata('userId', $id);
                flashMsg($id, "Signup success.", "Signup not success. Try again.", '');
            }else{
                flashMsg($id, "Signup success.", "Signup not success. Try again.", 'register/register');
            }
        }
    }
}