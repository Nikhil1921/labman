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
		$this->gallery = $this->config->item('gallery');
        $this->lab_partner = $this->config->item('lab-partner');
	}

    public function cart_count()
	{
		if($this->session->userId)
            $cart = $this->get('cart', 'user_id', ['user_id' => $this->session->userId]);
        else
            $cart = $this->get('cart', 'session_id', ['session_id' => $this->session->session_id]);

        return $cart ? count($cart) : 0;
	}

	public function getBanners()
    {
        return $this->getAll('banners', "CONCAT('".base_url($this->banners)."', banner) banner", []);
    }

	public function getGallery()
    {
        return $this->getAll('gallery', "g_name, CONCAT('".base_url($this->gallery)."', image) image", []);
    }

	public function getCities()
    {
        return $this->getAll('cities', "c_name", ['is_deleted' => 0]);
    }

	public function searchLab()
    {
        $city = $this->db->select('lab_ids')
                         ->from('cities')
                         ->where('c_name', $this->input->get('city'))
                         ->where('is_deleted', 0)
                         ->get()->row();

        if($city)
        {
            $this->db->select("lab_id, SUM(lt.ltl_mrp) AS mrp, SUM(lt.ltl_price + t.t_price) as total, l.name, rt.re_time, CONCAT('".base_url($this->lab_partner)."', lp.logo) logo, lp.certificate")
                     ->from('lab_tests lt');
                     
            $ts = [0];

            if($this->input->get('tests')){
                $ts = array_map(function($arr){
                    return d_id($arr);
                }, $this->input->get('tests'));
            }

            $this->db->where_in('test_id', $ts)
                     ->join('logins l', 'l.id = lt.lab_id')
                    //  ->where('is_blocked', 0)
                     ->join('lab_partners lp', 'lp.id = lt.lab_id')
                     ->join('tests t', 't.id = lt.test_id')
                     ->join('report_time rt', 'rt.id = lp.del_time');
            
            return $this->db->order_by('total ASC')->group_by('lab_id')->get()->result_array();
        }else
            return false;
    }

	public function getTests($tests_in=[])
    {
        $select = ['t.id', 't.t_name'];
        $tests = $this->db->select($select)
                            ->from('tests t')
                            ->where('is_deleted', 0);

        if($tests_in){
            $ts = array_map(function($arr){
                return d_id($arr);
            }, $tests_in);

            $this->db->where_in('id', $ts);
        }

        return $this->db->get()->result_array();
    }

	public function getPopularTests()
    {
        return $this->getAll('tests', "id, t_name", ['popular' => 1, 'is_deleted' => 0]);
    }

    public function packages($arr)
    {
        return $this->db->select('SUM(lt.ltl_mrp) AS mrp, SUM(lt.ltl_price + t.t_price) AS total')->from('lab_tests lt')
                        ->where('lab_id', $arr['lab_id'])
                        ->where_in('test_id', explode(',', $arr['tests']))
                        ->join('tests t', 't.id = lt.test_id')
                        ->get()->row_array();
    }

	public function getPackages()
    {
        $return = array_map(function($arr){
            $price = $this->packages($arr);
            return [
                'id' => e_id($arr['id']),
                'mrp'   => $price['mrp'],
                'price' => $price['total'] - $arr['price'],
                'p_type' => $arr['p_type'],
                'p_name' => $arr['p_name'],
                'image' => $arr['image'],
                'description' => $arr['description'],
            ];
        }, $this->getAll('packages', "id, description, lab_id, price, p_type, p_name, tests, CONCAT('".base_url($this->packages)."', image) image", ['is_deleted' => 0], 'p_type ASC'));
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