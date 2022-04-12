<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Labs_model extends MY_Model
{
	public $table = "lab_partners lp";
	public $select_column = ['lp.id', 'l.name AS l_name', 'lp.doc_name', 'l.mobile', 'lp.address', 'lp.certificate', 'l.is_blocked'];
	public $search_column = ['l.name', 'lp.doc_name', 'l.mobile', 'lp.address', 'lp.certificate'];
    public $order_column = [null, 'l.name', 'lp.doc_name', 'l.mobile', 'lp.address', 'lp.certificate', null, null];
	public $order = ['lp.id' => 'ASC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where('l.is_deleted', 0)
				 ->join('logins l', 'l.id = lp.id');

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('lp.id')
		         ->from($this->table)
				 ->where('l.is_deleted', 0)
				 ->join('logins l', 'l.id = lp.id');
		            	
		return $this->db->get()->num_rows();
	}

	public function getLab($id)
	{
		return $this->db->select('l.name AS l_name, lp.doc_name, l.mobile, l.email, lp.pincode, lp.address, lp.certificate, lp.cert_image, lp.logo, lp.del_time')
						->from($this->table)
						->where('l.id', $id)
						->join('logins l', 'l.id = lp.id')
						->get()->row_array();
	}

	public function add_update($id = false)
	{
		$this->db->trans_start();

		$login = [
			'name'      => $this->input->post('l_name'),
			'mobile'      => $this->input->post('mobile'),
			'email'       => $this->input->post('email'),
			'role'       => 'Lab partner',
		];

		if($this->input->post('password'))
			$login['password'] = my_crypt($this->input->post('password'));

		$lab = [
			'doc_name'    => $this->input->post('doc_name'),
			'pincode'     => $this->input->post('pincode'),
			'address'     => $this->input->post('address'),
			'certificate' => implode(', ', $this->input->post('certificate')),
			'del_time'    => d_id($this->input->post('del_time')),
		];

		if ($id === false){
			$this->db->insert('logins', $login);
			$id = $this->db->insert_id();
			$lab['id'] = $id;
			$this->db->insert('lab_partners', $lab);
		}else{
			$this->db->update('logins', $login, ['id' => $id]);
			$this->db->update('lab_partners', $lab, ['id' => $id]);
		}

		$this->db->trans_complete();

		return $this->db->trans_status() === TRUE ? $id : false;
	}
}