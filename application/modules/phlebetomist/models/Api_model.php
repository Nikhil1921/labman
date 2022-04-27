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
        $select = 'l.name AS lab, o.id, o.or_id, o.name, o.mobile, o.relation, a.faddress, a.ad_location, a.ad_city, a.latitude, a.longitude, DATE_FORMAT(o.collection_date, "%d-%m-%Y") collection_date, DATE_FORMAT(o.collection_time, "%I:%i %p") collection_time, o.pay_type, (SUM(ot.price + ot.margin) - o.discount + o.hardcopy + IF(SUM(ot.price + ot.margin) < o.fix_price, o.home_visit, 0)) total, o.status, o.coll_otp';
        
        return $this->db->select($select)
                        ->from('orders o')
                        ->where($where)
                        ->join('addresses a', 'a.id = o.add_id')
                        ->join('orders_tests ot', 'ot.o_id = o.id')
                        ->join('logins l', 'l.id = o.lab_id')
                        ->group_by('o.id')
                        ->get()
                        ->result_array();
    }

    public function getNewOrders()
    {
        $where = ['o.status' => 'Pending', 'o.city' => $this->city];
        
        return array_map(function($or){
            $or['tests'] = $this->db->select('t_name')
                                    ->from('orders_tests')
                                    ->where('o_id', $or['id'])
                                    ->get()
                                    ->result_array();
            return $or;
        }, $this->orders($where));
    }

    public function getOngoingOrders()
    {
        $where = ['o.status' => 'Ongoing', 'o.phlebotomist_id' => $this->api];
        
        return array_map(function($or){
            $or['tests'] = $this->db->select('t_name')
                                    ->from('orders_tests')
                                    ->where('o_id', $or['id'])
                                    ->get()
                                    ->result_array();
            return $or;
        }, $this->orders($where));
    }

    public function getCollectOrders()
    {
        $where = ['o.status' => 'Collect Sample', 'o.phlebotomist_id' => $this->api];
        
        return array_map(function($or){
            $or['tests'] = $this->db->select('t_name')
                                    ->from('orders_tests')
                                    ->where('o_id', $or['id'])
                                    ->get()
                                    ->result_array();
            return $or;
        }, $this->orders($where));
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