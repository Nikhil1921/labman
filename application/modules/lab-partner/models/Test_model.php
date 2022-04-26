<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Test_model extends MY_Model
{
	public $table = "tests t";
	public $select_column = ['t.id', 'c.cat_name', 't.t_name', 's.s_name', 'd.d_name', 'm.m_name', 'rt.re_time', 'lt.ltl_mrp', 'lt.ltl_price'];
	public $search_column = ['c.cat_name', 't.t_name', 's.s_name', 'd.d_name', 'm.m_name', 'rt.re_time', 'lt.ltl_mrp', 'lt.ltl_price'];
    public $order_column = [null, 'c.cat_name', 't.t_name', 's.s_name', 'd.d_name', 'm.m_name', 'rt.re_time', 'lt.ltl_mrp', 'lt.ltl_price', null];
	public $order = ['t.id' => 'ASC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where(['t.is_deleted' => 0])
                 ->where(['lt.lab_id' => $this->session->auth])
				 ->join('category c', 'c.id = t.cat_id')
				 ->join('department d', 'd.id = t.dep_id')
				 ->join('methods m', 'm.id = t.method_id')
				 ->join('samples s', 's.id = t.samp_id')
				 ->join('report_time rt', 'rt.id = t.re_time_id')
                 ->join('lab_tests lt', 'lt.test_id = t.id');

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('t.id')
		         ->from($this->table)
				 ->where(['t.is_deleted' => 0])
                 ->where(['lt.lab_id' => $this->session->auth])
				 ->join('category c', 'c.id = t.cat_id')
				 ->join('department d', 'd.id = t.dep_id')
				 ->join('methods m', 'm.id = t.method_id')
				 ->join('samples s', 's.id = t.samp_id')
				 ->join('report_time rt', 'rt.id = t.re_time_id')
                 ->join('lab_tests lt', 'lt.test_id = t.id');
		            	
		return $this->db->get()->num_rows();
	}
}