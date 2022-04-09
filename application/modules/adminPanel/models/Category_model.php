<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Category_model extends MY_Model
{
	public $table = "category c";
	public $select_column = ['c.id', 'c.cat_name', 'c.cat_slug'];
	public $search_column = ['c.id', 'c.cat_name', 'c.cat_slug'];
    public $order_column = [null, 'c.cat_name', 'c.cat_slug', null];
	public $order = ['c.id' => 'DESC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where(['c.parent_id' => 0, 'c.is_deleted' => 0]);

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('c.id')
		         ->from($this->table)
				 ->where(['c.parent_id' => 0, 'c.is_deleted' => 0]);
		            	
		return $this->db->get()->num_rows();
	}
}