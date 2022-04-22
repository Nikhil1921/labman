<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Order_model extends MY_Model
{
	public $table = "orders o";
	public $select_column = ['o.id', 'o.name', 'o.mobile', 'o.collection_date', 'o.collection_time', 'CONCAT(faddress, ", ", ad_location, ", ", ad_city) address', '(SUM(ot.price) - IF(package_by = "Lab", o.discount, 0)) total'];
	public $search_column = ['o.name', 'o.mobile', 'o.collection_date', 'o.collection_time'];
    public $order_column = [null, 'o.name', 'o.mobile', 'o.collection_date', 'o.collection_time', null];
	public $order = ['o.id' => 'DESC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where('o.is_deleted', 0)
				 ->where('o.lab_id', $this->session->auth)
                 ->join('addresses a', 'a.id = o.add_id')
                 ->join('orders_tests ot', 'ot.o_id = o.id')
                 ->group_by('ot.o_id');

        if($this->input->get('status'))
            $this->db->where('o.status', $this->input->get('status'));

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('o.id')
		         ->from($this->table)
				 ->where('o.is_deleted', 0)
				 ->where('o.lab_id', $this->session->auth)
                 ->join('addresses a', 'a.id = o.add_id')
                 ->join('orders_tests ot', 'ot.o_id = o.id')
                 ->group_by('ot.o_id');
                 
        if($this->input->get('status'))
            $this->db->where('o.status', $this->input->get('status'));
		            	
		return $this->db->get()->num_rows();
	}

    public function getOrder($id)
    {
        $order = $this->db->select('o.name, o.mobile, o.collection_date, o.collection_time, ref_doctor, doc_remarks')
                        ->from($this->table)
                        ->where('o.id', $id)
                        ->get()->row_array();

        $order['tests'] = $this->db->select('t_name, price')
                                    ->from('orders_tests')
                                    ->where('o_id', $id)
                                    ->get()->result_array();
        return $order;
    }
}