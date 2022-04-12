<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Lab_test_model extends MY_Model
{
	public $table = "lab_tests lt";
	public $select_column = ['c.cat_name', 't.t_name', 'lt.ltl_price', 't.t_price', '(t.t_price + lt.ltl_price) AS total'];
	public $search_column = ['c.cat_name', 't.t_name', 'lt.ltl_price', 't.t_price'];
    public $order_column = [null, 'c.cat_name', 't.t_name', 'lt.ltl_price', 't.t_price', null, null];
	public $order = ['t.id' => 'ASC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where('lt.lab_id', d_id($this->input->get('status')))
				 ->join('tests t', 't.id = lt.test_id')
				 ->join('category c', 'c.id = t.cat_id');

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('t.id')
		         ->from($this->table)
				 ->where('lt.lab_id', d_id($this->input->get('status')))
				 ->join('tests t', 't.id = lt.test_id')
				 ->join('category c', 'c.id = t.cat_id');
		            	
		return $this->db->get()->num_rows();
	}
}