<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Reports_model extends MY_Model
{
	public $table = "orders_tests ot";
	public $select_column = ['ot.id', 'o.or_id', 'o.name', 't.t_name', 'ot.upload_date', 'ot.test_report'];
	public $search_column = ['ot.id', 'o.or_id', 'o.name', 't.t_name', 'ot.upload_date', 'ot.test_report'];
    public $order_column = [null, 'o.or_id', 'o.name', 't.t_name', 'ot.upload_date', 'ot.test_report', null];
	public $order = ['ot.id' => 'ASC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
                 ->where('o.u_id', $this->session->userId)
                 ->join('tests t', 't.id = ot.test_id')
                 ->join('orders o', 'o.id = ot.o_id');

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('ot.id')
		         ->from($this->table)
                 ->where('o.u_id', $this->session->userId)
				 ->join('tests t', 't.id = ot.test_id')
                 ->join('orders o', 'o.id = ot.o_id');
		            	
		return $this->db->get()->num_rows();
	}
}