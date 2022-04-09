<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Tests_model extends MY_Model
{
	public $table = "tests t";
	public $select_column = ['t.id', 't.t_code', 'c.cat_name', 't.t_name', 'd.d_name', 's.s_name', 'm.m_name', 'rt.re_time', 't.t_price'];
	public $search_column = ['t.t_code', 'c.cat_name', 't.t_name', 'd.d_name', 's.s_name', 'm.m_name', 'rt.re_time', 't.t_price'];
    public $order_column = [null, 't.t_code', 'c.cat_name', 't.t_name', 'd.d_name', 's.s_name', 'm.m_name', 'rt.re_time', 't.t_price', null];
	public $order = ['t.id' => 'ASC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where(['t.is_deleted' => 0])
				 ->join('category c', 'c.id = t.cat_id')
				 ->join('department d', 'd.id = t.dep_id')
				 ->join('methods m', 'm.id = t.method_id')
				 ->join('samples s', 's.id = t.samp_id')
				 ->join('report_time rt', 'rt.id = t.re_time_id');

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('t.id')
		         ->from($this->table)
				 ->where(['t.is_deleted' => 0])
				 ->join('category c', 'c.id = t.cat_id')
				 ->join('department d', 'd.id = t.dep_id')
				 ->join('methods m', 'm.id = t.method_id')
				 ->join('samples s', 's.id = t.samp_id')
				 ->join('report_time rt', 'rt.id = t.re_time_id');
		            	
		return $this->db->get()->num_rows();
	}
}