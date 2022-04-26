<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Doctor_model extends MY_Model
{
	public $table = "doctors d";
	public $select_column = ['d.id', 'd.name', 'd.quilification', 'd.remark', 'd.image'];
	public $search_column = ['d.name', 'd.quilification', 'd.remark'];
    public $order_column = [null, 'd.name', 'd.quilification', 'd.remark', null, null];
	public $order = ['d.id' => 'DESC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where('is_deleted', 0)
				 ->where('lab_id', $this->session->auth);

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('d.id')
		         ->from($this->table)
				 ->where('is_deleted', 0)
				 ->where('lab_id', $this->session->auth);
		            	
		return $this->db->get()->num_rows();
	}
}