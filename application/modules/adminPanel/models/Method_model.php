<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Method_model extends MY_Model
{
	public $table = "methods m";
	public $select_column = ['m.id', 'm.m_name'];
	public $search_column = ['m.id', 'm.m_name'];
    public $order_column = [null, 'm.m_name', null];
	public $order = ['m.id' => 'ASC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where(['m.is_deleted' => 0]);

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('m.id')
		         ->from($this->table)
				 ->where(['m.is_deleted' => 0]);
		            	
		return $this->db->get()->num_rows();
	}
}