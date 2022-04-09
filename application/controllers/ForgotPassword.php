<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ForgotPassword extends Public_controller {
    
    public function __construct()
	{
		parent::__construct();
        if ($this->session->userId)
            return redirect('');
    }

    private $table = 'users';

    public function index()
	{
		$this->form_validation->set_rules('reg_mobile', 'Mobile No.', 'required|exact_length[10]|integer', [
                'required'      => '%s is required.',
                'exact_length'  => '%s is invalid.',
                'integer'       => '%s is invalid.']);
        
        $data['title'] = 'Forgot Password';
        $data['name'] = 'forgot_password';

        if ($this->form_validation->run() == FALSE)
            return $this->template->load('template', "forgot_password", $data);
        else{
            $post = [
                'mobile'     => $this->input->post('reg_mobile'),
                'is_deleted' => 0
            ];
            
            $user = $this->main->get($this->table, 'id userId, fullname', $post);
            
            if ($user) {
                $otp = rand(1000, 9999);
                $post = [
                    'mobile'   => $post['mobile'],
                    'otp'      => $otp,
                    'expiry'   => date('Y-m-d H:i:s', strtotime('+5 minutes'))
                ];
                $this->main->delete('check_otp', ['mobile' => $post['mobile']]);
                $id = $this->main->add($post, "check_otp");
                $this->session->set_flashdata('for_mobile', $post['mobile']);
                $this->session->mark_as_temp('for_mobile', 300);
                flashMsg($user, "OTP send success.", "", 'forgotPassword/check');
            }else
                flashMsg($user, "", "Mobile not registered.", 'forgotPassword');
        }
    }

    public function check()
	{
        if (!$this->session->for_mobile) return redirect('forgotPassword');
        
		$this->form_validation->set_rules('otp', 'OTP', 'required|exact_length[4]|integer', [
                'required'      => '%s is required.',
                'exact_length'  => '%s is invalid.',
                'integer'       => '%s is invalid.']);

        $data['title'] = 'Verify otp';
        $data['name'] = 'forgot_password';

        if ($this->form_validation->run() == FALSE)
            return $this->template->load('template', "forgot_password", $data);
        else{
            $post = [
                'mobile'     => $this->session->for_mobile,
                'otp'        => $this->input->post('otp'),
                'expiry >= ' => date('Y-m-d H:i:s')
            ];

            $id = $this->main->check("check_otp", $post, "mobile");
            
            if ($id) {
                $this->main->delete('check_otp', $post);
                $this->session->unset_userdata('for_mobile');
                $this->session->set_flashdata('for_verified', $post['mobile']);
                $this->session->mark_as_temp('for_verified', 300);
                flashMsg($id, "OTP check success.", "", 'forgotPassword/change-password');
            }else{
                flashMsg($id, "", "Invalid OTP. OR OTP expired.", 'forgotPassword/check');
            }
        }
    }

    public function change_password()
	{
        if (!$this->session->for_verified) return redirect('forgotPassword');
        
		$this->form_validation->set_rules('password', 'Password.', 'required|max_length[100]', [
                'required'      => '%s is required.',
                'max_length'    => 'Max 100 chars allowed.']);

        $data['title'] = 'change password';
        $data['name'] = 'forgot_password';
        if ($this->form_validation->run() == FALSE)
            return $this->template->load('template', "forgot_password", $data);
        else{
            $post = [
                'password' => my_crypt($this->input->post('password'))
            ];
            
            $id = $this->main->update(['mobile' => $this->session->for_verified], $post, $this->table);

            if ($id) {
                $this->session->unset_userdata('for_verified');
                flashMsg($id, "Password changed. Login with new password.", "Password not changed. Try again.", 'login');
            }else{
                flashMsg($id, "Password changed. Login with new password.", "Password not changed. Try again.", 'forgotPassword/change-password');
            }
        }
    }
}