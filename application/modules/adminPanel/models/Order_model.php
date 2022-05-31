<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Order_model extends MY_Model
{
	public $table = "orders o";
	public $select_column = ['o.id', 'o.name', 'o.mobile', 'DATE_FORMAT(o.collection_date, "%d-%m-%Y") collection_date', 'DATE_FORMAT(o.collection_time, "%I:%i %p") collection_time', 'CONCAT(a.faddress, ", ", a.ad_location, ", ", ad_city) AS address', '(SUM(ot.price) - IF(package_by = "Lab", o.discount, 0)) total', '(SUM(ot.margin) - IF(package_by = "Admin", o.discount, 0)) labman', 'l.name AS lab', 'o.ref_doctor', 'o.doc_remarks', 'ph.name AS phlebetomist', 'o.status'];
	public $search_column = ['o.name', 'o.mobile', 'o.collection_date', 'o.collection_time'];
    public $order_column = [null, 'o.name', 'o.mobile', 'o.collection_date', 'o.collection_time', null, null, null, null, null, null, null, null, null];
	public $order = ['o.id' => 'DESC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where('o.is_deleted', 0)
				 ->join('orders_tests ot', 'ot.o_id = o.id')
				 ->join('logins l', 'l.id = o.lab_id')
				 ->join('logins ph', 'ph.id = o.phlebotomist_id', 'left')
				 ->join('addresses a', 'a.id = o.add_id', 'left')
                 ->group_by('ot.o_id');

        if($this->input->get('status'))
            $this->db->where('o.lab_id', d_id($this->input->get('status')));
        if($this->input->get('approval'))
            $this->db->where('o.status', $this->input->get('approval'));

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('o.id')
		         ->from($this->table)
				 ->where('o.is_deleted', 0)
				 ->join('orders_tests ot', 'ot.o_id = o.id')
				 ->join('logins l', 'l.id = o.lab_id')
				 ->join('logins ph', 'ph.id = o.phlebotomist_id', 'left')
                 ->join('addresses a', 'a.id = o.add_id', 'left')
                 ->group_by('ot.o_id');
                 
        if($this->input->get('status'))
            $this->db->where('o.lab_id', d_id($this->input->get('status')));
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

        $order['tests'] = $this->db->select('ot.id, t_name, price, test_report, DATE_FORMAT(upload_date, "%d-%m-%Y %I:%i %p") AS date')
                                    ->from('orders_tests ot')
                                    ->join('tests t', 'ot.test_id = t.id')
                                    ->where('ot.o_id', $id)
                                    ->get()->result_array();
        return $order;
    }

    public function getPdf($id)
    {
        return $this->db->select('test_report')
                        ->from('orders_tests ot')
                        ->where('ot.id', $id)
                        ->get()->row_array();
    }
}