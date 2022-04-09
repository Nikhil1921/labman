<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Pincode_model extends MY_Model
{
	public $table = "pincodes p";
	public $select_column = ['p.id', 'p.pincode', 'p.del_charge'];
	public $search_column = ['p.id', 'p.pincode', 'p.del_charge'];
    public $order_column = [null, 'p.pincode', 'p.del_charge', null];
	public $order = ['p.id' => 'DESC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where(['p.is_deleted' => 0]);
		
		if ($this->input->get('cat_id'))
			$this->db->where(['p.s_id' => d_id($this->input->get('cat_id'))]);

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('p.id')
		         ->from($this->table)
				 ->where(['p.is_deleted' => 0]);
		
		if ($this->input->get('cat_id'))
			$this->db->where(['p.s_id' => d_id($this->input->get('cat_id'))]);

		return $this->db->get()->num_rows();
	}
}