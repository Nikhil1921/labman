<?php                                                                                                                                                                                           
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Session extends CI_Session {

    public function sess_regenerate($destroy = FALSE)
    {   
        $old = session_id();
        $_SESSION['__ci_last_regenerate'] = time();
		session_regenerate_id($destroy);

        $CI =& get_instance();
        if($CI->db->where(['session_id' => $old])->get('cart')->row())
        {
            $CI->db->where('session_id', $old)->update('cart', ['session_id' => session_id()]);
        }
    }
}