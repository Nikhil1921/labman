<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Orders_model extends MY_Model
{
	public $table = "orders o";
	public $select_column = ['o.id', 'o.name', 'o.mobile', 'o.total_amount', 'o.discount', 'o.shipping', 'o.pay_staus', 'o.pay_type', 'o.payment_id', 'o.status'];
	public $search_column = ['o.id', 'o.name', 'o.mobile', 'o.total_amount'];
    public $order_column = [null, 'o.name', 'o.mobile', 'o.total_amount', 'o.pay_staus', 'o.pay_type', 'o.payment_id', null];
	public $order = ['o.id' => 'DESC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where('o.is_deleted', 0);
		if($this->input->get('status')) $this->db->where(['o.status' => $this->input->get('status')]);

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('o.id')
		         ->from($this->table)
				 ->where('o.is_deleted', 0);
		
		if($this->input->get('status')) $this->db->where(['o.status' => $this->input->get('status')]);

		return $this->db->get()->num_rows();
	}
}