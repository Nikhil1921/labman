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

	public function addOrder($post, $id)
	{
		if($post['family'] == 0)
            $user = $this->main->get('users', 'name, email, mobile', ['id' => d_id($post['u_id'])]);
        else
            $user = $this->main->get('user_members', 'name, email, mobile, relation', ['id' => d_id($post['family'])]);
        
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
        $this->db->update('prescription', ['is_booked' => 1], ['id' => $id]);
        $this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
            return ['error' => true, 'message' => 'Order not placed.'];
        else{
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