<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Orders_model extends MY_Model
{
	public $table = "orders o";
	public $select_column = ['o.id', 'o.name', 'l.name AS lab', 'o.collection_date', 'o.pay_type', 'o.coll_otp', 'o.status', '(SUM(ot.price + ot.margin) - o.discount + IF(SUM(ot.price + ot.margin) <= o.fix_price, o.home_visit, 0) + o.hardcopy) total'];
	public $search_column = ['o.name', 'l.name', 'o.collection_date', 'o.pay_type', 'o.coll_otp', 'o.status'];
    public $order_column = [null, 'o.name', 'l.name', null, 'o.collection_date', null, 'o.pay_type', 'o.coll_otp', 'o.status', null];
	public $order = ['o.id' => 'DESC'];
	
	public function make_query()
	{  
		
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where('o.is_deleted', 0)
				 ->where('o.u_id', $this->session->userId)
                 ->join('logins l', 'l.id = o.lab_id')
                 ->join('orders_tests ot', 'ot.o_id = o.id')
                 ->group_by('ot.o_id');

		if($this->uri->segment(2) === 'history')
			$this->db->where_in('o.status', ['Completed']);
		else
			$this->db->where_in('o.status', ['Pending','Ongoing','Collect Sample','In Process']);

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('o.id')
		         ->from($this->table)
				 ->where('o.is_deleted', 0)
				 ->where('o.u_id', $this->session->userId)
                 ->join('addresses a', 'a.id = o.add_id')
                 ->join('orders_tests ot', 'ot.o_id = o.id')
                 ->group_by('ot.o_id');
		
		if($this->uri->segment(2) === 'history')
			$this->db->where_in('o.status', ['Completed']);
		else
			$this->db->where_in('o.status', ['Pending','Ongoing','Collect Sample','In Process']);
			
		return $this->db->get()->num_rows();
	}

	public function getOrder($id)
    {
        return $this->db->select('t_name')
						->from('orders_tests')
						->where('o_id', $id)
						->get()->result_array();
    }
}