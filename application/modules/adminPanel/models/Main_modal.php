<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Main_modal extends MY_Model
{
    public function bulk_upload($post, $table)
    {
        return $this->db->insert_batch($table, $post);
    }
    
    public function navs($role)
    {
        $navs = [
            [
                'name' => 'banners',
                'title' => 'Banner',
                'permissions' => ['view', 'add', 'delete'],
                'added' => array_map(function($arr){
                    return $arr['operation'];
                }, $this->getall('permissions', 'operation', ['role' => $role, 'nav' => 'banners']))
            ],
            [
                'name' => 'users',
                'title' => 'Users',
                'permissions' => ['view', 'status', 'update'],
                'added' => array_map(function($arr){
                    return $arr['operation'];
                }, $this->getall('permissions', 'operation', ['role' => $role, 'nav' => 'users']))
            ],
            [
                'name' => 'category',
                'title' => 'Category',
                'permissions' => ['view', 'add', 'update', 'delete'],
                'added' => array_map(function($arr){
                    return $arr['operation'];
                }, $this->getall('permissions', 'operation', ['role' => $role, 'nav' => 'category']))
            ],
            [
                'name' => 'city',
                'title' => 'City',
                'permissions' => ['view', 'add', 'update', 'delete'],
                'added' => array_map(function($arr){
                    return $arr['operation'];
                }, $this->getall('permissions', 'operation', ['role' => $role, 'nav' => 'city']))
            ],
            [
                'name' => 'department',
                'title' => 'Test Department',
                'permissions' => ['view', 'add', 'update', 'delete'],
                'added' => array_map(function($arr){
                    return $arr['operation'];
                }, $this->getall('permissions', 'operation', ['role' => $role, 'nav' => 'department']))
            ],
            [
                'name' => 'gallery',
                'title' => 'Gallery',
                'permissions' => ['view', 'add', 'update', 'delete'],
                'added' => array_map(function($arr){
                    return $arr['operation'];
                }, $this->getall('permissions', 'operation', ['role' => $role, 'nav' => 'gallery']))
            ],
            [
                'name' => 'lab_test',
                'title' => 'Test by lab',
                'permissions' => ['view'],
                'added' => array_map(function($arr){
                    return $arr['operation'];
                }, $this->getall('permissions', 'operation', ['role' => $role, 'nav' => 'lab_test']))
            ],
            [
                'name' => 'labs',
                'title' => 'Lab partners',
                'permissions' => ['view', 'status', 'add', 'update', 'delete'],
                'added' => array_map(function($arr){
                    return $arr['operation'];
                }, $this->getall('permissions', 'operation', ['role' => $role, 'nav' => 'labs']))
            ],
            [
                'name' => 'methods',
                'title' => 'Test methods',
                'permissions' => ['view', 'add', 'update', 'delete'],
                'added' => array_map(function($arr){
                    return $arr['operation'];
                }, $this->getall('permissions', 'operation', ['role' => $role, 'nav' => 'methods']))
            ],
            [
                'name' => 'orders',
                'title' => 'Orders',
                'permissions' => ['view'],
                'added' => array_map(function($arr){
                    return $arr['operation'];
                }, $this->getall('permissions', 'operation', ['role' => $role, 'nav' => 'orders']))
            ],
            [
                'name' => 'packages',
                'title' => 'Packages',
                'permissions' => ['view', 'add', 'update', 'delete'],
                'added' => array_map(function($arr){
                    return $arr['operation'];
                }, $this->getall('permissions', 'operation', ['role' => $role, 'nav' => 'packages']))
            ],
            [
                'name' => 'report_time',
                'title' => 'Report time',
                'permissions' => ['view', 'add', 'update', 'delete'],
                'added' => array_map(function($arr){
                    return $arr['operation'];
                }, $this->getall('permissions', 'operation', ['role' => $role, 'nav' => 'report_time']))
            ],
            [
                'name' => 'samples',
                'title' => 'Test samples',
                'permissions' => ['view', 'add', 'update', 'delete'],
                'added' => array_map(function($arr){
                    return $arr['operation'];
                }, $this->getall('permissions', 'operation', ['role' => $role, 'nav' => 'samples']))
            ],
            [
                'name' => 'test_details',
                'title' => 'Test details',
                'permissions' => ['view', 'update'],
                'added' => array_map(function($arr){
                    return $arr['operation'];
                }, $this->getall('permissions', 'operation', ['role' => $role, 'nav' => 'test_details']))
            ],
            [
                'name' => 'tests',
                'title' => 'Tests',
                'permissions' => ['view', 'add', 'update', 'delete'],
                'added' => array_map(function($arr){
                    return $arr['operation'];
                }, $this->getall('permissions', 'operation', ['role' => $role, 'nav' => 'tests']))
            ],
            [
                'name' => 'transactions',
                'title' => 'Transactions',
                'permissions' => ['view', 'add'],
                'added' => array_map(function($arr){
                    return $arr['operation'];
                }, $this->getall('permissions', 'operation', ['role' => $role, 'nav' => 'transactions']))
            ]
        ];
        
        return $navs;
    }

    public function add_permissions()
    {
        $this->db->trans_start();
        $this->db->delete('permissions', ['role' => $this->input->post('role')]);
        if ($this->input->post('permissions')) {
            $data = [];
            foreach ($this->input->post('permissions') as $k => $v){
                if (!in_array('view', $v)) array_push($v, 'view');
                foreach ($v as $p) 
                    $data[] = ['nav' => $k, 'operation' => $p, 'role' => $this->input->post('role')];
            }
            $this->db->insert_batch('permissions', $data);
        }
        $this->db->trans_complete();
        
		return $this->db->trans_status();
    }

    public function getCities()
    {
        return $this->getAll('cities', "id, c_name", ['is_deleted' => 0]);
    }

    public function searchLab($tests_in=[])
    {
        $city = $this->db->select('lab_ids')
                         ->from('cities')
                         ->where('c_name', $this->input->get('city'))
                         ->where('is_deleted', 0)
                         ->get()->row();

        if($city)
        {
            $this->db->select("lab_id, SUM(lt.ltl_mrp) AS mrp, SUM(lt.ltl_price + t.t_price) as total, l.name, rt.re_time, CONCAT('".base_url($this->config->item('lab-partner'))."', lp.logo) logo, lp.certificate")
                     ->from('lab_tests lt');
                     
            $ts = [0];
            if($tests_in){
                $ts = array_map(function($arr){
                    return d_id($arr);
                }, $tests_in);
            }

            $return = $this->db->where_in('test_id', $ts)
                     ->join('logins l', 'l.id = lt.lab_id')
                     ->where('l.is_blocked', 0)
                     ->join('lab_partners lp', 'lp.id = lt.lab_id')
                     ->join('tests t', 't.id = lt.test_id')
                     ->join('report_time rt', 'rt.id = lp.del_time')
                     ->order_by('total ASC')->group_by('lab_id')->get()->result_array();
            
            return $return ? $return : [];
        }else
            return [];
    }
}