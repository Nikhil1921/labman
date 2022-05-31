<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Prescription_model extends MY_Model
{
	public $table = "prescription p";
	public $select_column = ['p.id', 'u.name', 'u.mobile', 'u.email', 'DATE_FORMAT(p.created_date, "%d-%m-%Y") date'];
	public $search_column = ['p.id', 'u.name', 'u.mobile', 'u.email', 'p.created_date'];
    public $order_column = [null, 'u.name', 'u.mobile', 'u.email', 'p.created_date', null];
	public $order = ['p.id' => 'DESC'];

	public function make_query()
	{
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where(['p.is_booked' => 0])
				 ->join('users u', 'u.id = p.u_id');

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('p.id')
		         ->from($this->table)
				 ->where(['p.is_booked' => 0])
				 ->join('users u', 'u.id = p.u_id');
		            	
		return $this->db->get()->num_rows();
	}

	public function addOrder($post, $id=0)
	{
		if($post['family'] == 0)
            $user = $this->main->get('users', 'name, email, mobile', ['id' => d_id($post['u_id'])]);
        else
            $user = $this->main->get('user_members', 'name, email, mobile, relation', ['id' => d_id($post['family']), 'is_deleted' => 0]);
        
        $charges = $this->get('cities', 'fix_price, home_visit, hard_copy', ['c_name' => $post['city']]);

		$order = [
            'name' => $user['name'],
            'or_id' => 'LABDIG'.rand(10000, 99999),
            'coll_otp' => rand(1000, 9999),
            'mobile' => $user['mobile'],
            'email' => $user['email'],
            'relation' => isset($user['relation']) ? $user['relation'] : 'Self',
            'city' => $post['city'],
            'lab_id' => d_id($post['lab_id']),
            'package' => 0,
            'package_by' => '',
            'hardcopy' => isset($post['hardcopy']) ? $charges['hard_copy'] : 0,
            'fix_price' => $charges['fix_price'],
            'home_visit' => $charges['home_visit'],
            'discount' => 0,
            'u_id' => d_id($post['u_id']),
            'add_id' => d_id($post['address']),
            'collection_date' => date('Y-m-d', strtotime($post['collection_date'])),
            'collection_time' => date('H:i:s', strtotime($post['collection_time'])),
            'ref_doctor' => $post['ref_doctor'] ? $post['ref_doctor'] : 'NA',
            'doc_remarks' => $post['remarks'] ? $post['remarks'] : 'NA',
            'phlebotomist_id' => 0,
            'pay_type' => 'Cash',
            'pay_id' => 'Cash',
            'pay_status' => 'Unpaid',
            'status' => 'Pending'
        ];

        $this->db->trans_start();
        $this->db->insert('orders', $order);
        $or_id = $this->db->insert_id();
        foreach ($post['tests'] as $t_id){
            $test = $this->db->select('lt.ltl_mrp, lt.ltl_price, t.t_price')
                                ->from('lab_tests lt')
                                ->where(['test_id' => d_id($t_id), 'lab_id' => d_id($post['lab_id'])])
                                ->join('tests t', 't.id = lt.test_id')
                                ->get()->row();
            $or_test[] = [
                'test_id' => d_id($t_id),
                'mrp'    => $test->ltl_mrp,
                'price'  => $test->ltl_price,
                'margin' => $test->t_price,
                'o_id'   => $or_id
            ];
        }

        $this->db->insert_batch('orders_tests', $or_test);
        if($id !== 0) $this->db->update('prescription', ['is_booked' => 1], ['id' => $id]);
        $this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
            return ['error' => true, 'message' => 'Order not placed.'];
        else{
            $ts = array_map(function($id){ return d_id($id); }, $post['tests']);
            $cart['tests'] = $this->db->select('(t_price + ltl_price) AS total, t_name, ltl_mrp, t_price, ltl_price, t.id AS test_id')
                                ->from('lab_tests lt')
                                ->where_in('t.id', $ts)
                                ->where('lt.lab_id', d_id($post['lab_id']))
                                ->join('tests t', 't.id = lt.test_id')
                                ->get()->result();
            $cart['cart'] = (object) ['home_visit' => $order['home_visit'], 'discount' => $order['discount']];
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

            foreach ($tokens as $token) send_notification($title, $body, $token['token'], $this->config->item('phleb-token'));
            // send notification end
            return ['error' => false, 'message' => 'Order placed successfully.', 'redirect' => 'thankyou.html'];
        }
	}
}