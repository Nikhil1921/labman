<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Samples_model extends MY_Model
{
	public $table = "samples s";
	public $select_column = ['s.id', 's.s_name'];
	public $search_column = ['s.id', 's.s_name'];
    public $order_column = [null, 's.s_name', null];
	public $order = ['s.id' => 'ASC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where(['s.is_deleted' => 0]);

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('s.id')
		         ->from($this->table)
				 ->where(['s.is_deleted' => 0]);
		            	
		return $this->db->get()->num_rows();
	}
}