<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Prescription_model extends MY_Model
{
	public $table = "prescription p";
	public $select_column = ['p.id', 'u.name', 'u.mobile', 'u.email', 'DATE_FORMAT(p.created_date, "%d-%m-%Y") date'];
	public $search_column = ['p.id', 'u.name', 'u.mobile', 'u.email', 'p.created_date'];
    public $order_column = [null, 'u.name', 'u.mobile', 'u.email', 'p.created_date', null];
	public $order = ['p.id' => 'DESC'];

	public function make_query()
	{
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where(['p.is_booked' => 0])
				 ->join('users u', 'u.id = p.u_id');

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('p.id')
		         ->from($this->table)
				 ->where(['p.is_booked' => 0])
				 ->join('users u', 'u.id = p.u_id');
		            	
		return $this->db->get()->num_rows();
	}
}