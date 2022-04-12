<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class City_model extends MY_Model
{
	public $table = "cities c";
	public $select_column = ['c.id', 'c.c_name', 'c.hard_copy', 'c.home_visit', 'c.fix_price'];
	public $search_column = ['c.id', 'c.c_name', 'c.hard_copy', 'c.home_visit', 'c.fix_price'];
    public $order_column = [null, 'c.c_name', 'c.hard_copy', 'c.home_visit', 'c.fix_price', null];
	public $order = ['c.id' => 'DESC'];

	public function make_query()
	{
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where(['c.is_deleted' => 0]);

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('c.id')
		         ->from($this->table)
				 ->where(['c.is_deleted' => 0]);
		            	
		return $this->db->get()->num_rows();
	}
}