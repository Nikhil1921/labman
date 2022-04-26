<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_controller {
	
	public function index()
	{
        $data['title'] = 'Home';
        $data['name'] = 'home';
        $data['banners'] = $this->main->getBanners();
        $data['tests'] = $this->main->getPopularTests();
        $data['packs'] = $this->main->getPackages();
        $data['deps'] = $this->main->getDeps();
        $data['labs'] = $this->main->getLabs();
        
		return $this->template->load('template', 'home', $data);
	}
    
	public function search()
	{
        $data['title'] = 'Tests';
        $data['name'] = 'tests';
        $data['labs'] = $this->main->searchLab($this->input->get('tests'));
        $data['tests'] = $data['labs'] ? $this->main->getTests($this->input->get('tests')) : [];
        
        return $this->template->load('template', 'search', $data);
	}
    
	public function test($id)
	{
        $data['title'] = 'Tests';
        $data['name'] = 'tests';
        $data['data'] = $this->main->getTest(d_id($id));
        
        return $this->template->load('template', 'test', $data);
	}
    
	public function tests($id)
	{
        $data['title'] = 'Tests';
        $data['name'] = 'tests';
        $data['tests'] = $this->main->getAll('tests', 'id, t_name', ['dep_id' => d_id($id)]);
        
        return $this->template->load('template', 'tests', $data);
	}
    
	public function lab($id)
	{
        $data['title'] = 'Lab';
        $data['name'] = 'lab';
        $data['lab'] = $this->main->getLab(d_id($id));
        
        return $this->template->load('template', 'lab', $data);
	}

	public function add_to_cart()
	{  
        if($this->input->post('tests'))
            $tests = implode(',', array_map(function($arr){
                        return d_id($arr);
                }, $this->input->post('tests')));
        else
            $tests = '';

        $post = [
            'session_id' => $this->session->session_id,
            'city' => $this->main->check('cities', ['c_name' => $this->input->post('city')], 'id'),
            'lab_id' => d_id($this->input->post('lab_id')),
            'test_id' => $tests,
            'pack_id' => $this->input->post('pack_id') ? d_id($this->input->post('pack_id')) : 0,
            'user_id' => $this->session->userId ? $this->session->userId : 0
        ];

        if($this->session->userId)
            $this->main->delete('cart', ['user_id' => $this->session->userId]);
        else
            $this->main->delete('cart', ['session_id' => $this->session->session_id]);
        
        $this->main->add($post, 'cart');
        
        if($this->input->post('redirect') && $this->input->post('redirect') === 'Book Now')
            return redirect('cart');
        else
            return redirect($this->input->server('HTTP_REFERER'));
	}
    
	public function getTests()
	{
        check_ajax();

        $return = '';

        foreach ($this->main->getTests() as $v)
            $return .= '<option value="'.e_id($v['id']).'">'.$v['t_name'].'</option>';
        
        die($return);
	}

	public function package(int $id)
	{
        $data['title'] = 'Package';
        $data['name'] = 'package';

        $data['pack'] = $this->main->get('packages', "id, description, lab_id, price AS discount, p_type, p_name, tests, CONCAT('".base_url($this->config->item('packages'))."', image) image", ['is_deleted' => 0, 'id' => d_id($id)]);
        
        if($data['pack'])
        {
            $price = $this->main->packages($data['pack']);
            $data['pack'] = array_merge($data['pack'], $price);
            $ts = array_map(function($t){
                return e_id($t);
            }, explode(',', $data['pack']['tests']));
            $data['pack']['tests'] = $this->main->getTests($ts);
        }
        
        return $this->template->load('template', 'package', $data);
	}

	public function callback()
	{
        check_ajax();

        $post = [
            'name'         => $this->input->post('name'),
            'email'        => $this->input->post('email'),
            'mobile'       => $this->input->post('mobile'),
            'created_date' => date('Y-m-d'),
            'created_time' => date('H:i:s')
        ];
        
        if($this->main->add($post, 'callback_form'))
            $res = ['error' => false, 'message' => 'Thank you. We will get back to you soon.'];
        else
            $res = ['error' => true, 'message' => 'Something is not going good.'];

		die(json_encode($res));
	}
    
	public function institutional()
	{
        check_ajax();

        $post = [
            'c_name'       => $this->input->post('c_name'),
            'total'        => $this->input->post('total'),
            'address'      => $this->input->post('address'),
            'requirement'  => $this->input->post('requirement'),
            'name'         => $this->input->post('name'),
            'email'        => $this->input->post('email'),
            'mobile'       => $this->input->post('mobile'),
            'created_date' => date('Y-m-d'),
            'created_time' => date('H:i:s')
        ];
        
        if($this->main->add($post, 'institutional_form'))
            $res = ['error' => false, 'message' => 'Thank you. We will get back to you soon.'];
        else
            $res = ['error' => true, 'message' => 'Something is not going good.'];

		die(json_encode($res));
	}

	public function prescription()
	{
        check_ajax();

        $this->path = $this->config->item('prescription');

        $prescription = $this->uploadImage('prescription');
        
        if ($prescription['error'] == TRUE) die(json_encode($prescription));

        $post = [
            'prescription' => $prescription['message'],
            'u_id'         => $this->session->userId,
            'created_date' => date('Y-m-d'),
            'created_time' => date('H:i:s')
        ];
        
        if($this->main->add($post, 'prescription'))
            $res = ['error' => false, 'message' => 'Thank you. We will get back to you soon.'];
        else
            $res = ['error' => true, 'message' => 'Something is not going good.'];

		die(json_encode($res));
	}

    public function contact()
	{
        check_ajax();

        $post = [
            'name'         => $this->input->post('name'),
            'email'        => $this->input->post('email'),
            'message'      => $this->input->post('message'),
            'created_date' => date('Y-m-d'),
            'created_time' => date('H:i:s')
        ];
        
        if($this->main->add($post, 'contact_form'))
            $res = ['error' => false, 'message' => 'Thank you. We will get back to you soon.'];
        else
            $res = ['error' => true, 'message' => 'Something is not going good.'];

		die(json_encode($res));
	}

    public function franchise()
	{
        check_ajax();

        $post = [
            'name'         => $this->input->post('name'),
            'email'        => $this->input->post('email'),
            'mobile'       => $this->input->post('mobile'),
            'c_name'       => $this->input->post('c_name'),
            'address'      => $this->input->post('address'),
            'created_date' => date('Y-m-d'),
            'created_time' => date('H:i:s')
        ];
        
        if($this->main->add($post, 'franchise_form'))
            $res = ['error' => false, 'message' => 'Thank you. We will get back to you soon.'];
        else
            $res = ['error' => true, 'message' => 'Something is not going good.'];

		die(json_encode($res));
	}

	public function error_404()
	{
		$data['title'] = 'Error 404';
        $data['name'] = 'error_404';
		
		return $this->template->load('template', 'error_404', $data);
	}
}