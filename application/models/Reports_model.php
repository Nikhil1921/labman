<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Reports_model extends MY_Model
{
	public $table = "orders_tests ot";
	public $select_column = ['o.name', 'ot.t_name', 'ot.upload_date', 'ot.test_report'];
	public $search_column = ['o.name', 'ot.t_name', 'ot.upload_date', 'ot.test_report'];
    public $order_column = [null, 'o.name', 'ot.t_name', 'ot.upload_date', 'ot.test_report', null];
	public $order = ['o.id' => 'DESC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
                 ->where('o.u_id', $this->session->userId)
                 ->join('orders o', 'o.id = ot.o_id');

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('ot.t_name')
		         ->from($this->table)
                 ->where('o.u_id', $this->session->userId)
                 ->join('orders o', 'o.id = ot.o_id');
		            	
		return $this->db->get()->num_rows();
	}
}