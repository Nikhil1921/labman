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
}