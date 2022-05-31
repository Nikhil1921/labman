<?php defined('BASEPATH') OR exit('No direct script access allowed');

function my_crypt($string, $action = 'e' )
{
    $secret_key = md5(APP_NAME).'_key';
    $secret_iv = md5(APP_NAME).'_iv';

    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }

    return $output;
}

function re($array='')
{
    $CI =& get_instance();
    echo "<pre>";
    print_r($array);
    echo "</pre>";
    exit;
}

function flashMsg($success,$succmsg,$failmsg,$redirect)
{
    $CI =& get_instance();
    if ( $success ){
        $CI->session->set_flashdata('success',$succmsg);
    }else{
        $CI->session->set_flashdata('error', $failmsg);
    }
    return redirect($redirect);
}

function e_id($id)
{
    return 41254 * $id;
}

function d_id($id)
{
    return $id / 41254;
}

function admin($uri='')
{
    return ADMIN.'/'.$uri;
}

if ( ! function_exists('convert_webp'))
{
    function convert_webp($path, $image, $name) {
        imagepalettetotruecolor($image);
        imagealphablending($image, true);
        imagesavealpha($image, true);
        imagewebp($image, "$path$name.webp", 100);
        imagedestroy($image);
    }
}

if ( ! function_exists('check_ajax'))
{
    function check_ajax()
    {
        $CI =& get_instance();
        if (!$CI->input->is_ajax_request())
            die;
    }
}

if ( ! function_exists('script'))
{
    function script($url='', $type='application/javascript')
    {
        return "\n<script src=\"".base_url($url)."\" type=\"$type\"></script>\n";
    }
}

if ( ! function_exists('send_sms'))
{
    function send_sms($contact, $sms, $template)
	{
        if($_SERVER['SERVER_NAME'] != 'localhost'){
            $from = 'LABMEN';
            $key = '360D9C8FC652FA';

            $url = "key=".$key."&campaign=11316&routeid=7&type=text&contacts=".$contact."&senderid=".$from."&msg=".urlencode($sms)."&template_id=".$template;

            $base_URL = 'http://densetek.tk/app/smsapi/index?'.$url;

            $curl_handle = curl_init();
            curl_setopt($curl_handle,CURLOPT_URL,$base_URL);
            curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
            curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
            $result = curl_exec($curl_handle);
            curl_close($curl_handle);
            return $result;
        }
	}
}

if ( ! function_exists('send_email'))
{
    function send_email($email, $message, $subject, $pdf=null)
	{
        $CI =& get_instance();
		$CI->load->library('email');
		$CI->email->clear(TRUE);
		$CI->email->set_newline("\r\n");
		$CI->email->from($CI->email->smtp_user, APP_NAME);
		$CI->email->to($email);
		$CI->email->subject($subject);
		$CI->email->message($message);
        
        if ($pdf && is_file($pdf))
            $CI->email->attach($_SERVER['DOCUMENT_ROOT'] . str_replace(basename($_SERVER["SCRIPT_NAME"]), "", $_SERVER["SCRIPT_NAME"]) . $pdf);
        
		$CI->email->send(FALSE);
        // echo $CI->email->print_debugger(array('headers'));
        return;
	}
}

if ( ! function_exists('send_notification'))
{
    function send_notification($title, $body, $token, $serverKey, $image='')
	{
        $url = "https://fcm.googleapis.com/fcm/send";

        $notification = array('title' => $title, 'body' => $body, 'sound' => 'default', 'badge' => '1', 'image' => base_url($image));
        $arrayToSend = array('to' => $token, 'notification' => $notification, 'priority'=>'high');
        $json = json_encode($arrayToSend);
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key='.$serverKey;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_exec($ch);
        curl_close($ch);
        
        return;
	}
}

if ( ! function_exists('check_access'))
{
    function check_access($name, $operation)
    {
        $CI =& get_instance();
        
        if ($CI->user->role === 'Admin')
            return true;
        else
            return $CI->main->check('permissions', ['nav' => $name, 'role' => $CI->user->role, 'operation' => $operation], 'operation') ? true : redirect(admin('forbidden'));
    }
}

if ( ! function_exists('verify_access'))
{
    function verify_access($name, $operation)
    {
        $CI =& get_instance();
        if ($CI->user->role === 'Admin')
            return true;
        else
            return $CI->main->check('permissions', ['nav' => $name, 'role' => $CI->user->role, 'operation' => $operation], 'operation');
    }
}

if ( ! function_exists('verify_nav'))
{
    function verify_nav($name, $pers)
    {
        $CI =& get_instance();
        if ($CI->user->role === 'Admin')
            return true;
        else
            return array_search($name, array_column($pers, 'nav')) !== false ? true : false;
    }
}