<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_controller {
	
	public function index()
	{
		return redirect(admin());
	}
	
	public function wishlist()
	{
		$data['title'] = 'Wishlist';
        $data['name'] = 'wishlist';
        $data['breadcrumb'] = $this->breadcrumb.'wishlist.jpg';

		return $this->template->load('template', 'wishlist', $data);
	}

	public function about_us()
	{
		$data['title'] = 'About Us';
        $data['name'] = 'about';
        $data['breadcrumb'] = $this->breadcrumb.'wishlist.jpg';

		return $this->template->load('template', 'about_us', $data);
	}
	
	public function cart()
	{
		$data['title'] = 'Cart';
        $data['name'] = 'cart';
        $data['breadcrumb'] = $this->breadcrumb.'cart.jpg';

		return $this->template->load('template', 'cart', $data);
	}

	public function product($cat, $sub_cat, $prod)
	{
		$data['prod'] = $this->main->getProd($cat, $sub_cat, $prod);
		if ($data['prod']) {
			$data['title'] = 'Product';
			$data['name'] = 'product';
			
			return $this->template->load('template', 'product', $data);
		}else{
			return $this->error_404();
		}
	}

	public function getProduct()
	{
		$data['prod'] = $this->main->getProdById(d_id($this->input->get('prod')));

		die($this->load->view('getProduct', $data, true));
	}

	public function getCart()
	{
		check_ajax();
		
		$total = '₹ '.array_sum(array_map(function($prod) {
			return $prod['qty'] * $prod['p_price'];
		}, $this->cart));

		die(json_encode(['cart' => $this->cart, 'total' => $total, 'counts' => count($this->cart)]));
	}

	public function addCart()
	{
		check_ajax();
		
		$id = $this->main->addCart($this->session->userId);

		die(json_encode(['success' => 1, 'message' => "Product added to cart."]));
	}

	public function addWish()
	{
		check_ajax();

		$id = $this->main->addWish($this->session->userId);

		die(json_encode(['success' => 1, 'message' => "Product added to cart."]));
	}
	
	public function shop($cat, $sub_cat='')
	{
		$url = $this->config->site_url($this->uri->uri_string());
		$q = '';
		
		foreach ($this->input->get() as $k => $v) {
			$q .= $k != 'per_page' && $k != array_key_first($this->input->get()) ? '&' : '';
			$q .= $k != 'per_page' ? $k."=".urlencode($v) : '';
		}
		
		$base = $_SERVER['QUERY_STRING'] ? $url.'?'.$q : $url;

		$where = $data['bread'] = [];

		if ($cat == 'all') {
			$data['bread'][] = ['name' => 'ALL', 'slug' => $cat];
		}else if($cat_check = $this->main->get('category', 'id, cat_name', ['cat_slug' => $cat, 'parent_id' => 0])){
			$where['c.cat_slug'] = $cat;
			$data['bread'][] = ['name' => $cat_check['cat_name'], 'slug' => $cat];
		}else{
			return $this->error_404();
		}
		
		if ($sub_cat != '') {
			$where['sc.cat_slug'] = $sub_cat;

			if($sub_check = $this->main->get('category', 'cat_name', ['parent_id' => $cat_check['id'], 'cat_slug' => $sub_cat]))
			{
				$data['bread'][] = ['name' => $sub_check['cat_name'], 'slug' => "$cat/$sub_cat"];
			}else{
				return $this->error_404();
			}
		}
		
		$this->load->library('pagination');
		
		$config = [
			'base_url' => $base,
			'total_rows' => $this->main->prodCount($where),
			'per_page' => $this->input->get('show') ? $this->input->get('show') : 4,
			'use_page_numbers' => TRUE,
			'page_query_string' => TRUE,
			'cur_tag_open' => '<li><a class="active" href="javascript:;">',
			'cur_tag_close' => '</a></li>',
			'first_link' => '<<',
			'first_tag_open' => '<li>',
			'first_tag_close' => '</li>',
			'last_link' => '>>',
			'last_tag_open' => '<li>',
			'last_tag_close' => '</li>',
			'next_link' => '>',
			'next_tag_open' => '<li>',
			'next_tag_close' => '</li>',
			'prev_link' => '<',
			'prev_tag_open' => '<li>',
			'prev_tag_close' => '</li>',
			'num_tag_open' => '<li>',
			'num_tag_close' => '</li>',
		];
		
		$this->pagination->initialize($config);
		$start = $this->input->get('per_page') ? ($this->input->get('per_page') - 1) * $config['per_page'] : 0;

        $data['title'] = 'Shop';
        $data['name'] = 'shop';
		
        $data['prods'] = $this->main->getProducts($start, $config['per_page'], $where);
        $data['total'] = $config['total_rows'];
        $data['start'] = $start + 1;
        $data['end'] = $start + count($data['prods']);
		
		return $this->template->load('template', 'shop', $data);
	}

	public function become_partner()
	{
		$validate = [
			[
				'field' => 'reg_mobile',
				'label' => 'Mobile No.',
				'rules' => 'required|exact_length[10]|integer|is_unique[become_partner.mobile]|trim',
				'errors' => [
					'required' => "%s is required",
					'exact_length' => "%s is invalid.",
					'is_unique' => "%s is already in use.",
					'integer' => "Only numbers are allowed.",
				],
			],
			[
				'field' => 'pincode',
				'label' => 'Pincode',
				'rules' => 'required|exact_length[6]|integer|trim',
				'errors' => [
					'required' => "%s is required",
					'exact_length' => "%s is invalid.",
					'integer' => "Only numbers are allowed.",
				],
			],
			[
				'field' => 'city',
				'label' => 'City',
				'rules' => 'required|max_length[50]|trim',
				'errors' => [
					'required' => "%s is required",
					'max_length' => "Max 50 characters allowed.",
				],
			],
			[
				'field' => 'state',
				'label' => 'State',
				'rules' => 'required|max_length[50]|trim',
				'errors' => [
					'required' => "%s is required",
					'max_length' => "Max 50 characters allowed.",
				],
			],
			[
				'field' => 'message',
				'label' => 'Message',
				'rules' => 'required|max_length[255]|trim',
				'errors' => [
					'required' => "%s is required",
					'max_length' => "Max 255 characters allowed.",
				],
			],
			[
				'field' => 'fullname',
				'label' => 'Contact Person Name',
				'rules' => 'required|max_length[100]|trim',
				'errors' => [
					'required' => "%s is required",
					'max_length' => "Max 100 characters allowed.",
				],
			],
		];

        $this->form_validation->set_rules($validate);
        
        $data['title'] = 'Become partner';
        $data['name'] = 'become_partner';

        if ($this->form_validation->run() == FALSE)
            return $this->template->load('template', "become_partner", $data);
        else{
            $post = [
                'mobile'     => $this->input->post('reg_mobile'),
                'name'       => $this->input->post('fullname'),
                'city'       => $this->input->post('city'),
                'state'      => $this->input->post('state'),
                'pincode'    => $this->input->post('pincode'),
                'message'    => $this->input->post('message'),
            ];
            
            $user = $this->main->add($post, 'become_partner');
            
			flashMsg($user, "Request saved success.", "Request not saved.", 'become-partner');
        }
	}

	public function terms()
	{
		$data['title'] = 'Terms & Conditions';
        $data['name'] = 'terms';
        $data['breadcrumb'] = $this->breadcrumb.'cart.jpg';

		return $this->template->load('template', 'terms', $data);
	}

	public function payment()
	{
		$data['title'] = 'Payment Protection';
        $data['name'] = 'payment';
        $data['breadcrumb'] = $this->breadcrumb.'cart.jpg';

		return $this->template->load('template', 'payment', $data);
	}

	public function refund()
	{
		$data['title'] = 'Refund policy';
        $data['name'] = 'refund';
        $data['breadcrumb'] = $this->breadcrumb.'cart.jpg';

		return $this->template->load('template', 'refund', $data);
	}

	public function delivery()
	{
		$data['title'] = 'Delivery Information';
        $data['name'] = 'delivery';
        $data['breadcrumb'] = $this->breadcrumb.'cart.jpg';

		return $this->template->load('template', 'delivery', $data);
	}
}