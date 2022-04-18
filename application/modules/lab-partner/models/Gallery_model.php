<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Gallery_model extends MY_Model
{
	public $table = "lab_gallery g";
	public $select_column = ['g.id', 'g.image'];
	public $search_column = [];
    public $order_column = [null, null, null];
	public $order = ['g.id' => 'DESC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table);

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('g.id')
		         ->from($this->table);
		            	
		return $this->db->get()->num_rows();
	}
}