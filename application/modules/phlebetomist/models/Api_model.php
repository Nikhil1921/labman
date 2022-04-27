<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Api_model extends MY_Model
{
    protected $table = 'logins l';

    public function getProfile($where)
    {
        return $this->db->select('l.id, l.name, l.mobile, l.email, society, area')
                        ->from($this->table)
                        ->where($where)
                        ->where(['e.approval' => 'Yes', 'is_blocked' => 0, 'is_deleted' => 0])
                        ->where(['l.role' => 'Phlebetomist'])
                        ->join('employees e', 'e.id = l.id')
                        ->get()
                        ->row_array();
    }

    public function orders($where)
    {
        return $this->db->select('*')
                        ->from('orders o')
                        ->where($where)
                        ->where(['o.city' => $this->city])
                        ->get()
                        ->result_array();
    }

    public function getNewOrders()
    {
        $where = ['o.status' => 'Pending', 'o.city' => $this->city];
        return $this->orders($where);
    }

    public function getCity()
    {
        $city = $this->db->select('c.c_name')
                        ->from('employees e')
                        ->where(['e.id' => $this->api])
                        ->where(['c.is_deleted' => 0])
                        ->join('cities c', 'c.id = e.city')
                        ->get()
                        ->row_array();

        return $city ? $city['c_name'] : 'NA';
    }
}