<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Banner_model extends MY_Model
{
	public $table = "banners b";
	public $select_column = ['b.id', 'b.title', 'b.sub_title', 'b.banner'];
	public $search_column = ['b.title', 'b.sub_title'];
    public $order_column = [null, 'b.title', 'b.sub_title', 'b.banner', null];
	public $order = ['b.id' => 'DESC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where('b.is_deleted', 0);

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('b.id')
		         ->from($this->table)
				 ->where('b.is_deleted', 0);
		            	
		return $this->db->get()->num_rows();
	}
}