<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Transactions_model extends MY_Model
{
	public $table = "transactions t";
	public $select_column = ['t.id', 't.amount', 't.tr_date', 't.tr_time', 't.pay_mod'];
	public $search_column = ['t.amount', 't.tr_date', 't.tr_time', 't.pay_mod'];
    public $order_column = [null, 't.amount', 't.tr_date', 't.tr_time', 't.pay_mod', null];
	public $order = ['t.id' => 'DESC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where('t.lab_id', d_id($this->input->get('status')));

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('t.id')
		         ->from($this->table)
				 ->where('t.lab_id', d_id($this->input->get('status')));
		            	
		return $this->db->get()->num_rows();
	}
}