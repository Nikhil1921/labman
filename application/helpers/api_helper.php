<?php 
if ( ! function_exists('post'))
{
    function post()
    {
        $CI =& get_instance();
        if ($CI->input->server('REQUEST_METHOD') == "POST") {
            return TRUE;
        }else{
            die($CI->load->view('error_404', [], true));
        }
    }
}

if ( ! function_exists('get'))
{
    function get()
    {
        $CI =& get_instance();
        if ($CI->input->server('REQUEST_METHOD') == "GET") {
            return TRUE;
        }else{
            die($CI->load->view('error_404', [], true));
        }
    }
}

if ( ! function_exists('verifyRequiredParams'))
{
    function verifyRequiredParams($required_fields)
    {

        $CI =& get_instance();
        $error = false;
        $error_fields = "";
        $request_params = array();
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $request_params = $CI->input->post();
        }else{
            $request_params = $_REQUEST;
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'PUT') 
        {
            parse_str($_SERVER['QUERY_STRING'], $request_params);
        }
        
        foreach ($required_fields as $field) 
        {
            if (!isset($request_params[$field]) || strlen(trim($request_params[$field])) <= 0) 
            {
                $error = true;
                $error_fields .= $field . ', ';
            }
        }

        if ($error) 
        {
            $response = array();
            $response["error"] = true;
            $response["message"] = 'Required field(s) ' . substr($error_fields, 0, -2) . ' is missing or empty';
            
            echoRespnse(200, $response);
        }
    }
}

if ( ! function_exists('echoRespnse'))
{
    function echoRespnse($status_code, $response)
    {
        http_response_code ($status_code); 
        header('Content-Type: application/json');

        die(json_encode($response));
    }
}

if ( ! function_exists('authenticate'))
{
    function authenticate($table)
    {
        $headers = apache_request_headers();
        $response = array();
        
        if (isset($headers['Authorization'])) 
        {
            $key = str_replace('"', "", $headers['Authorization']);        
            
            if (! $k = isValidApiKey($key, $table)) 
            {            
                $response["error"] = true;
                $response["message"] = "Unauthorized User";
                echoRespnse(200, $response);
            } else {
                return $key;
            }
        } else {
            $response["error"] = true;
            $response["message"] = "Api key is misssing";
            echoRespnse(200, $response);
        }
    }
}

if ( ! function_exists('isValidApiKey'))
{
    function isValidApiKey($key, $table)
    {
        if (get_instance()->main->check($table, ['id' => $key, 'is_varified' => 1, 'is_deleted' => 0], 'id')) {
            return TRUE;
        }else{
            return FALSE;
        }
    }
}