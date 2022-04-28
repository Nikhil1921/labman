<?php defined('BASEPATH') OR exit('No direct script access allowed');
use Dompdf\Dompdf;
/**
 * 
 */
class Main_modal extends MY_Model
{
    public function __construct()
	{
		parent::__construct();
		$this->banners = $this->config->item('banners');
		$this->packages = $this->config->item('packages');
		$this->department = $this->config->item('department');
		$this->gallery = $this->config->item('gallery');
        $this->lab_partner = $this->config->item('lab-partner');
	}

    public function addOrder($userId)
    {
        $cart = $this->getCart($userId);

        if(!$cart['cart']) return ['error' => true, 'message' => 'Cart is empty.'];
        
        if($this->input->post('family') == 0)
            $user = $this->main->get('users', 'name, email, mobile', ['id' => $userId]);
        else
            $user = $this->main->get('user_members', 'name, email, mobile, relation', ['id' => d_id($this->input->post('family'))]);
        
        $order = [
            'name' => $user['name'],
            'or_id' => 'LABDIG'.rand(10000, 99999),
            'coll_otp' => rand(1000, 9999),
            'mobile' => $user['mobile'],
            'email' => $user['email'],
            'relation' => isset($user['relation']) ? $user['relation'] : 'Self',
            'city' => $cart['cart']->c_name,
            'lab_id' => $cart['cart']->lab_id,
            'package' => $cart['cart']->pack_id,
            'package_by' => $cart['cart']->package_by,
            'hardcopy' => $this->input->post('hardcopy') ? $cart['cart']->hard_copy : 0,
            'fix_price' => $cart['cart']->fix_price,
            'home_visit' => $cart['cart']->home_visit,
            'discount' => $cart['cart']->discount,
            'u_id' => $userId,
            'add_id' => d_id($this->input->post('address')),
            'collection_date' => date('Y-m-d', strtotime($this->input->post('collection_date'))),
            'collection_time' => date('H:i:s', strtotime($this->input->post('collection_time'))),
            'ref_doctor' => $this->input->post('ref_doctor') ? $this->input->post('ref_doctor') : 'NA',
            'doc_remarks' => $this->input->post('remarks') ? $this->input->post('remarks') : 'NA',
            'phlebotomist_id' => 0,
            'pay_type' => $this->input->post('pay_method'),
            'pay_id' => $this->input->post('pay_method') === 'Cash' ? 'Cash' : $this->input->post('payment_id'),
            'pay_status' => $this->input->post('payment_id') ? 'Paid' : 'Unpaid',
            'status' => 'Pending'
        ];
        
        $this->db->trans_start();
        $this->db->insert('orders', $order);
        $or_id = $this->db->insert_id();
        foreach ($cart['tests'] as $test)
            $or_test[] = [
                'test_id' => $test->test_id,
                'mrp'    => $test->ltl_mrp,
                'price'  => $test->ltl_price,
                'margin' => $test->t_price,
                'o_id'   => $or_id
            ];
        $this->db->insert_batch('orders_tests', $or_test);
        $this->db->delete('cart', ['user_id' => $userId]);
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE)
            return ['error' => true, 'message' => 'Order not placed.'];
        else{
            // send email start
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML('*{margin:0;padding:0}body{font-size:15px;color:#000;line-height:22px;font-weight:400;background:#fff;font-family:Rasa,serif}#page-wrap{width:800px;margin:0 auto}textarea{border:0;font:14px Georgia,Serif;overflow:hidden;resize:none}table{border-collapse:collapse}table td,table th{border:1px solid #000;padding:5px}#header{height:15px;width:100%;margin:20px 0;background:#222;text-align:center;color:#fff;font:bold 15px Sans-Serif;text-decoration:uppercase;letter-spacing:20px;padding:8px 0}#address{width:220px;height:150px;float:left;text-align:justify}#customer{overflow:hidden}#logo{text-align:right;float:right;position:relative;margin-top:25px;border:1px solid #fff;max-width:540px;max-height:100px;overflow:hidden}#logo.edit,#logo:hover{border:1px solid #000;margin-top:0;max-height:125px}#logoctr{display:none}#logo.edit #logoctr,#logo:hover #logoctr{display:block;text-align:right;line-height:25px;background:#eee;padding:0 5px}#logohelp{text-align:left;display:none;font-style:italic;padding:10px 5px}#logohelp input{margin-bottom:5px}.edit #logohelp{display:block}.edit #cancel-logo,.edit #save-logo{display:inline}#cancel-logo,#save-logo,.edit #change-logo,.edit #delete-logo,.edit #image{display:none}#customer-title{font-size:20px;font-weight:700;float:left;border:1px solid #000}.meta-width{width:49%}.mr-r{margin:0 2% 0 0}.mr-b-p{margin-bottom:20px}#meta{float:left; width:100%}#meta td.meta-head{text-align:left;background:#eee}#meta td textarea{width:100%;height:20px;text-align:right}#items{clear:both;width:100%;margin:30px 0 0 0}#items th{background:#eee}#items textarea{width:80px;height:50px}#items tr.item-row td{border:0;vertical-align:top;border:1px solid #000}#items td.description{width:300px}#items td.item-name{width:175px}#items td.description textarea,#items td.item-name textarea{width:100%}#items td.total-line{border-right:0;text-align:right}#items td.total-value{border-left:0;padding:10px;border:1px solid #000}#items td.total-value textarea{height:20px;background:0 0}#items td.balance{background:#eee}#items td.blank{border:0}#terms{text-align:center;margin:20px 0 0 0}#terms h5{text-transform:uppercase;font:13px Sans-Serif;letter-spacing:10px;border-bottom:1px solid #000;padding:0 0 8px 0;margin:0 0 8px 0}#terms textarea{width:100%;text-align:center}#items td.total-value textarea:focus,#items td.total-value textarea:hover,.delete:hover,textarea:focus,textarea:hover{background-color:#ef8}.delete-wpr{position:relative}.delete{display:block;color:#000;text-decoration:none;position:absolute;background:#eee;font-weight:700;padding:0 3px;border:1px solid;top:-6px;left:-22px;font-family:sans-serif;font-size:12px}#address1{width:325px;float:right;margin-top:15px}#logo{text-align:right;position:relative;margin-top:0;border:1px solid #fff;max-width:540px;max-height:130px;overflow:hidden}.im{width:225px;display:block;padding-right:35px}', \Mpdf\HTMLParserMode::HEADER_CSS);
            $message = $this->load->view('send-order-mail', compact('cart', 'user', 'order'), true);
            $mpdf->WriteHTML($message, \Mpdf\HTMLParserMode::HTML_BODY);
            $message = 'Your order is successful.';
            $pdf = $this->config->item('invoices').e_id($or_id).".pdf";
            $mpdf->Output($pdf, "F");
            $subject = "Your Test Request Is Successfull.";
            send_email($user['email'], $message, $subject, $pdf);
            // send email end
            
            // send notification start
            $title = APP_NAME;
            $body = "Your New Test Request";
            $tokens = $this->db->select('token')
                                ->from('logins l')
                                ->where('l.role', 'Phlebetomist')
                                ->where('l.on_off', 1)
                                ->where('token != ', '')
                                ->where('c_name', $order['city'])
                                ->join('employees e', 'e.id = l.id')
                                ->join('cities c', 'e.city = c.id')
                                ->get()->result_array();

            foreach ($tokens as $token) send_notification($title, $body, $token['token']);
            // send notification end

            return ['error' => false, 'message' => 'Order placed successfully.', 'redirect' => 'thankyou.html'];
        }
    }

    public function getCart($userId)
    {
        $cart = $this->db->select('c.lab_id, ci.c_name, l.name AS lab_name, IF(pack_id > 0, p.tests, c.test_id) AS test_ids, IF(pack_id > 0, p.package_by, "Admin") AS package_by, IF(pack_id > 0, p.price, 0) AS discount, c.pack_id, fix_price, home_visit, hard_copy')
                         ->from('cart c')
                         ->where('c.user_id', $userId)
                         ->join('logins l', 'l.id = c.lab_id')
                         ->join('cities ci', 'ci.id = c.city')
                         ->join('packages p', 'p.id = c.pack_id', 'left')
                         ->get()->row();
        if($cart)
            $tests = $this->db->select('(t_price + ltl_price) AS total, t_name, ltl_mrp, t_price, ltl_price, t.id AS test_id')
                                ->from('lab_tests lt')
                                ->where_in('t.id', explode(',', $cart->test_ids))
                                ->where('lt.lab_id', $cart->lab_id)
                                ->join('tests t', 't.id = lt.test_id')
                                ->get()->result();

        return ['cart' => $cart ? $cart : [], 'tests' => isset($tests) ? $tests : []];
    }

    public function cart_count()
	{
        if($this->session->userId)
            $cart = $this->getAll('cart', 'user_id', ['user_id' => $this->session->userId]);
        else
            $cart = $this->getAll('cart', 'session_id', ['session_id' => $this->session->session_id]);

        return $cart ? count($cart) : 0;
	}

	public function getBanners()
    {
        return $this->getAll('banners', "CONCAT('".base_url($this->banners)."', banner) banner", []);
    }

	public function getGallery()
    {
        return $this->getAll('gallery', "g_name, CONCAT('".base_url($this->gallery)."', image) image", []);
    }

	public function getCities()
    {
        return $this->getAll('cities', "id, c_name", ['is_deleted' => 0]);
    }

	public function searchLab($tests_in=[])
    {
        $city = $this->db->select('lab_ids')
                         ->from('cities')
                         ->where('c_name', $this->input->get('city'))
                         ->where('is_deleted', 0)
                         ->get()->row();

        if($city)
        {
            $this->db->select("lab_id, SUM(lt.ltl_mrp) AS mrp, SUM(lt.ltl_price + t.t_price) as total, l.name, rt.re_time, CONCAT('".base_url($this->lab_partner)."', lp.logo) logo, lp.certificate")
                     ->from('lab_tests lt');
                     
            $ts = [0];
            if($tests_in){
                $ts = array_map(function($arr){
                    return d_id($arr);
                }, $tests_in);
            }

            $this->db->where_in('test_id', $ts)
                     ->join('logins l', 'l.id = lt.lab_id')
                     ->where('l.is_blocked', 0)
                     ->join('lab_partners lp', 'lp.id = lt.lab_id')
                     ->join('tests t', 't.id = lt.test_id')
                     ->join('report_time rt', 'rt.id = lp.del_time');
            
            return $this->db->order_by('total ASC')->group_by('lab_id')->get()->result_array();
        }else
            return false;
    }

	public function getTests($tests_in=[])
    {
        $select = ['t.id', 't.t_name'];
        $tests = $this->db->select($select)
                            ->from('tests t')
                            ->where('is_deleted', 0);

        if($tests_in){
            $ts = array_map(function($arr){
                return d_id($arr);
            }, $tests_in);

            $this->db->where_in('id', $ts);
        }

        return $this->db->get()->result_array();
    }

	public function getPopularTests()
    {
        return $this->getAll('tests', "id, t_name", ['popular' => 1, 'is_deleted' => 0]);
    }

    public function packages($arr)
    {
        return $this->db->select('SUM(lt.ltl_mrp) AS mrp, SUM(lt.ltl_price + t.t_price) AS total')->from('lab_tests lt')
                        ->where('lab_id', $arr['lab_id'])
                        ->where_in('test_id', explode(',', $arr['tests']))
                        ->join('tests t', 't.id = lt.test_id')
                        ->get()->row_array();
    }

	public function getPackages()
    {
        $return = array_map(function($arr){
            $price = $this->packages($arr);
            return [
                'id' => e_id($arr['id']),
                'mrp'   => $price['mrp'],
                'price' => $price['total'] - $arr['price'],
                'p_type' => $arr['p_type'],
                'p_name' => $arr['p_name'],
                'image' => $arr['image'],
                'description' => $arr['description'],
            ];
        }, $this->getAll('packages', "id, description, lab_id, price, p_type, p_name, tests, CONCAT('".base_url($this->packages)."', image) image", ['is_deleted' => 0], 'p_type ASC'));
        return $return;
    }

	public function getDeps()
    {
        return $this->getAll('department', "id, d_name, CONCAT('".base_url($this->department)."', image) image", ['is_deleted' => 0]);
    }

	public function getLabs()
    {
        return $this->db->select("lp.id, l.name, CONCAT('".base_url($this->lab_partner)."', lp.logo) logo")->from('lab_partners lp')
                                ->where('is_blocked', 0)
                                ->where('is_deleted', 0)
                                ->join('logins l', 'l.id = lp.id')
                                ->get()->result_array();
    }

	public function verifyCart($userId)
    {
        $cart = $this->get('cart', 'session_id', ['session_id' => $this->session->session_id]);
        
        if($cart) {
            $this->db->trans_start();
            $this->db->delete('cart', ['user_id' => $userId, 'session_id != ' => $this->session->session_id]);
            $this->db->where($cart)->update('cart', ['user_id' => $userId]);
            $this->db->trans_complete();
        }
        
        return $cart;
    }

	public function getTest($id)
    {
            $this->db->select('t.t_name, t.details, s.s_name, rt.re_time')
                    ->from('tests t')
                     ->where(['t.id' => $id])
                     ->join('samples s', 's.id = t.samp_id')
                     ->join('report_time rt', 'rt.id = t.re_time_id');
        
        return $this->db->get()->row_array();
    }

	public function getLab($id)
    {
        $lab = $this->db->select('l.name, lp.details')
                    ->from('logins l')
                    ->where(['l.id' => $id])
                    ->join('lab_partners lp', 'lp.id = l.id')
                    ->get()->row_array();
        
        $lab['gallery'] = $this->getAll('lab_gallery', 'CONCAT("'.$this->config->item('gallery').'", image) image', ['lab_id' => $id]);
        $lab['doctors'] = $this->getAll('doctors', 'name, quilification, CONCAT("'.$this->config->item('lab-partner').'", image) image', ['lab_id' => $id]);
        
        return $lab;
    }
}