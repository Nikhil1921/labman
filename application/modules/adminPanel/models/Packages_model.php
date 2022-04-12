<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Packages_model extends MY_Model
{
	public $table = "packages p";
	public $select_column = ['p.id', 'l.name', 'p.p_name', 'p.price', 'p.image'];
	public $search_column = ['l.name', 'p.p_name', 'p.price'];
    public $order_column = [null, 'l.name', 'p.p_name', 'p.price', null, null];
	public $order = ['p.id' => 'ASC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where('p.is_deleted', 0)
				 ->join('logins l', 'l.id = p.lab_id');
		
		if($this->input->get('status'))
			$this->db->where('p.p_type', $this->input->get('status'));

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('p.id')
		         ->from($this->table)
				 ->where('p.is_deleted', 0)
				 ->join('logins l', 'l.id = p.lab_id');
		
		if($this->input->get('status'))
			$this->db->where('p.p_type', $this->input->get('status'));
		            	
		return $this->db->get()->num_rows();
	}
}