<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Department_model extends MY_Model
{
	public $table = "department d";
	public $select_column = ['d.id', 'd.d_name', 'image'];
	public $search_column = ['d.d_name'];
    public $order_column = [null, 'd.d_name', null];
	public $order = ['d.id' => 'DESC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where('d.is_deleted', 0);

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('d.id')
		         ->from($this->table)
				 ->where('d.is_deleted', 0);
		            	
		return $this->db->get()->num_rows();
	}
}