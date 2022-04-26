<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Employee_model extends MY_Model
{
	public $table = "employees e";
	public $select_column = ['e.id', 'l.name', 'l.mobile', 'CONCAT(e.society, ", ", e.area, " - ", e.pincode) AS address', 'e.qulification', 'l.is_blocked'];
	public $search_column = ['l.name', 'l.mobile', 'e.society', 'e.qulification'];
    public $order_column = [null, 'l.name', 'l.mobile', 'e.society', 'e.qulification', null, null];
	public $order = ['e.id' => 'ASC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
				 ->where('l.is_deleted', 0)
				 ->join('logins l', 'l.id = e.id');

		if($this->input->get('status'))
			$this->db->where('l.role', $this->input->get('status'));
		if($this->input->get('approval'))
			$this->db->where('e.approval', $this->input->get('approval'));

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('e.id')
		         ->from($this->table)
				 ->where('l.is_deleted', 0)
				 ->join('logins l', 'l.id = e.id');

		if($this->input->get('status'))
			$this->db->where('l.role', $this->input->get('status'));
		if($this->input->get('approval'))
			$this->db->where('e.approval', $this->input->get('approval'));
		            	
		return $this->db->get()->num_rows();
	}

	public function getEmployee($id)
	{
		return $this->db->select('l.name, l.mobile, l.email, l.role, e.gender, e.dob, e.society, e.area, e.pincode, e.city, e.marital, e.physical, e.qulification, e.licence, e.vehicle, e.office_time, e.aadhar, e.language, e.photo, e.qulimg, e.licence_img, e.computer, e.aadhar_img')
						->from($this->table)
						->where('l.id', $id)
						->join('logins l', 'l.id = e.id')
						->get()->row_array();
	}

	public function add_update($id = false, $imgs = null, $block=0)
	{
		$this->db->trans_start();

		$login = [
			'name'     	  => $this->input->post('name'),
			'mobile'   	  => $this->input->post('mobile'),
			'email'    	  => $this->input->post('email'),
			'is_blocked'  => $block,
			'role'     	  => $this->input->post('role'),
		];

		if($this->input->post('password')) $login['password'] = my_crypt($this->input->post('password'));
		
		$employee = [
			'gender' => $this->input->post('gender'),
			'dob' => date('Y-m-d', strtotime($this->input->post('dob'))),
			'society' => $this->input->post('society'),
			'area' => $this->input->post('area'),
			'pincode' => $this->input->post('pincode'),
			'city' => d_id($this->input->post('city')),
			'marital' => $this->input->post('marital'),
			'physical' => $this->input->post('physical'),
			'qulification' => $this->input->post('qulification'),
			'licence' => $this->input->post('licence'),
			'vehicle' => $this->input->post('vehicle'),
			'office_time' => $this->input->post('office-time'),
			'aadhar' => $this->input->post('aadhar'),
			'language' => implode(', ', $this->input->post('language')),
		];
		
		if (isset($imgs['photo'])) $employee['photo'] = $imgs['photo'];
		if (isset($imgs['qulimg'])) $employee['qulimg'] = $imgs['qulimg'];
		if (isset($imgs['licence'])) $employee['licence_img'] = $imgs['licence'];
		if (isset($imgs['computer'])) $employee['computer'] = $imgs['computer'];
		if (isset($imgs['aadhar'])) $employee['aadhar_img'] = $imgs['aadhar'];
		
		if ($id === false){
			$this->db->insert('logins', $login);
			$id = $this->db->insert_id();
			$employee['id'] = $id;
			$this->db->insert('employees', $employee);
		}else{
			$this->db->update('logins', $login, ['id' => $id]);
			$this->db->update('employees', $employee, ['id' => $id]);
		}

		$this->db->trans_complete();

		return $this->db->trans_status() === TRUE ? $id : false;
	}
}