<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Report_time_model extends MY_Model
{
	public $table = "report_time r";
	public $select_column = ['r.id', 'r.re_time'];
	public $search_column = ['r.id', 'r.re_time'];
    public $order_column = [null, 'r.re_time', null];
	public $order = ['r.id' => 'ASC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where(['r.is_deleted' => 0]);

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('r.id')
		         ->from($this->table)
				 ->where(['r.is_deleted' => 0]);
		            	
		return $this->db->get()->num_rows();
	}
}