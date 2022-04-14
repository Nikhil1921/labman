<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Main_modal extends MY_Model
{
    public function __construct()
	{
		parent::__construct();
		$this->banners = $this->config->item('banners');
		$this->packages = $this->config->item('packages');
		$this->department = $this->config->item('department');
        $this->lab_partner = $this->config->item('lab-partner');
	}

	public function getBanners()
    {
        return $this->getAll('banners', "CONCAT('".base_url($this->banners)."', banner) banner", []);
    }

	public function getTests()
    {
        return $this->getAll('tests', "id, t_name", ['is_deleted' => 0]);
    }

	public function getPopularTests()
    {
        return $this->getAll('tests', "id, t_name", ['popular' => 1, 'is_deleted' => 0]);
    }

	public function getPackages()
    {
        $return = array_map(function($arr){
            $price = $this->db->select('SUM(lt.ltl_mrp) AS mrp, SUM(lt.ltl_price + t.t_price) AS total')->from('lab_tests lt')
                                ->where('lab_id', $arr['lab_id'])
                                ->where_in('test_id', explode(',', $arr['tests']))
                                ->join('tests t', 't.id = lt.test_id')
                                ->get()->row();
            return [
                'id' => e_id($arr['id']),
                'mrp'   => $price->mrp,
                'price' => $price->total - $arr['price'],
                'p_type' => $arr['p_type'],
                'p_name' => $arr['p_name'],
                'image' => $arr['image'],
            ];
        }, $this->getAll('packages', "id, lab_id, price, p_type, p_name, tests, CONCAT('".base_url($this->packages)."', image) image", ['is_deleted' => 0], 'p_type ASC'));
        return $return;
    }

	public function getDeps()
    {
        return $this->getAll('department', "id, d_name, CONCAT('".base_url($this->department)."', image) image", ['is_deleted' => 0]);
    }

	public function getLabs()
    {
        return $this->db->select("lp.id, l.name, CONCAT('".base_url($this->lab_partner)."', lp.logo) logo")->from('lab_partners lp')
                                ->where('is_blocked', 0)
                                ->where('is_deleted', 0)
                                ->join('logins l', 'l.id = lp.id')
                                ->get()->result_array();
    }
}