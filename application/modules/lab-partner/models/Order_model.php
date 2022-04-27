<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Order_model extends MY_Model
{
	public $table = "orders o";
	public $select_column = ['o.id', 'o.name', 'o.mobile', 'DATE_FORMAT(o.collection_date, "%d-%m-%Y") collection_date', 'DATE_FORMAT(o.collection_time, "%I:%i %p") collection_time', 'CONCAT(faddress, ", ", ad_location, ", ", ad_city) address', '(SUM(ot.price) - IF(package_by = "Lab", o.discount, 0)) total', 'o.ref_doctor', 'o.doc_remarks', 'ph.name AS phlebetomist', 'o.status'];
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
                 ->join('logins ph', 'ph.id = o.phlebotomist_id', 'left')
                 ->group_by('ot.o_id');

        if($this->input->get('approval'))
            $this->db->where('o.status', $this->input->get('approval'));

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
                 ->join('logins ph', 'ph.id = o.phlebotomist_id', 'left')
                 ->group_by('ot.o_id');
                 
        if($this->input->get('approval'))
            $this->db->where('o.status', $this->input->get('approval'));
		            	
		return $this->db->get()->num_rows();
	}

    public function getOrder($id)
    {
        $order = $this->db->select('o.name, o.mobile, o.collection_date, o.collection_time, ref_doctor, doc_remarks')
                        ->from($this->table)
                        ->where('o.id', $id)
                        ->get()->row_array();

        $order['tests'] = $this->db->select('id, t_name, price, test_report, DATE_FORMAT(upload_date, "%d-%m-%Y %I:%i %p") AS date')
                                    ->from('orders_tests')
                                    ->where('o_id', $id)
                                    ->get()->result_array();
        return $order;
    }

    public function upload_reports($post)
    {
        return $this->db->update_batch('orders_tests', $post, 'id');
    }
}