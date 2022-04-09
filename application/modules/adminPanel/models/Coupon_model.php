<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Coupon_model extends MY_Model
{
	public $table = "coupon c";
	public $select_column = ['c.id', 'c.coupon_code', 'CONCAT(c.coupon_discount, "%") coupon_discount'];
	public $search_column = ['c.coupon_code', 'c.coupon_discount'];
    public $order_column = [null, 'c.coupon_code', 'c.coupon_discount', null];
	public $order = ['c.id' => 'DESC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where('c.is_deleted', 0);

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('c.id')
		         ->from($this->table)
				 ->where('c.is_deleted', 0);
		            	
		return $this->db->get()->num_rows();
	}
}