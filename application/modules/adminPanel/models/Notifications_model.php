<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Notifications_model extends MY_Model
{
	public $table = "notifications n";
	public $select_column = ['n.id', 'n.n_name', 'image'];
	public $search_column = ['n.n_name'];
    public $order_column = [null, 'n.n_name', null];
	public $order = ['n.id' => 'DESC'];

	public function make_query()
	{
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where('n.is_deleted', 0);

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('n.id')
		         ->from($this->table)
				 ->where('n.is_deleted', 0);
		            	
		return $this->db->get()->num_rows();
	}
}