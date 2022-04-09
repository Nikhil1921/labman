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
		$this->products = $this->config->item('products');
	}

    private $cart = 'cart';
    private $wish = 'wishlist';

	public function getBanners()
    {
        return $this->getAll('banners', "title, sub_title, CONCAT('".base_url($this->banners)."', banner) banner", ['is_deleted' => 0]);
    }

	public function getCart($u_id)
    {
        return [];
    }

	public function getWishlist($u_id)
    {
        return [];
    }

	public function getProds($show)
    {
        foreach ($show as $p_show) {
            $return[$p_show] = $this->db->select('p.id, p.p_title, p.p_price, CONCAT("'.$this->products.'", p.image) image, CONCAT(c.cat_slug, "/", sc.cat_slug, "/", p.p_slug) slug, p_show, LEFT(p.description, 230) description')
                                        ->from('products p')
                                        ->where(['p.p_show' => $p_show])
                                        ->where(['c.is_deleted' => 0, 'sc.is_deleted' => 0, 'p.is_deleted' => 0])
                                        ->join('category c', 'c.id = p.cat_id')
                                        ->join('category sc', 'sc.id = p.sub_cat_id')
                                        ->order_by('p.id DESC')
                                        ->limit(6)
                                        ->get()->result();
        }
        
        return $return;
    }

	public function makeQuery($where)
    {
        $this->db->select('p.id, p.p_title, p.p_price, CONCAT("'.$this->products.'", p.image) image, CONCAT(c.cat_slug, "/", sc.cat_slug, "/", p.p_slug) slug, LEFT(p.description, 230) description')
                ->from('products p')
                ->where($where)
                ->where(['c.is_deleted' => 0, 'sc.is_deleted' => 0, 'p.is_deleted' => 0])
                ->join('category c', 'c.id = p.cat_id')
                ->join('category sc', 'sc.id = p.sub_cat_id');
    }

	public function getProducts($start, $end, $where)
    {
        
        $this->makeQuery($where);
        
        return $this->db->limit($end, $start)->get()->result();
    }

	public function prodCount($where)
    {
        
        $this->makeQuery($where);
        return $this->db->get()->num_rows();
    }

    public function addCart($u_id)
    {
        $this->db->trans_start();
        $this->db->delete($this->cart, ['u_id'  => $u_id]);
        $post = $this->input->post('cart') ? $this->input->post('cart') : [];
        foreach ($post as $v) {
            $add[] = [
                'prod_id'  => d_id($v['prod']),
                'quantity'  => $v['qty'],
                'u_id'  => $u_id
            ];
        }
        if(isset($add)) $this->db->insert_batch($this->cart, $add);
        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function addWish($u_id)
    {
        $this->db->trans_start();
        $this->db->delete($this->wish, ['u_id'  => $u_id]);
        $post = $this->input->post('cart') ? $this->input->post('cart') : [];
        foreach ($post as $v) {
            $add[] = [
                'prod_id'  => d_id($v['prod']),
                'u_id'  => $u_id
            ];
        }
        if(isset($add)) $this->db->insert_batch($this->wish, $add);
        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function getVisitors()
    {
        $visitors = $this->db->select('value')
                ->from('app_configs')
                ->where(['cong_name' => 'visitors'])
                ->get()->row();

        $total = ($visitors) ? $visitors->value + 1 : 1;
        
        if ($visitors)
            $this->db->update('app_configs', ['value' => $total], ['cong_name' => 'visitors']);
        else
            $this->db->insert('app_configs', ['value' => $total, 'cong_name' => 'visitors']);
        
        return $total;
    }

    public function getProd($cat, $sub_cat, $prod)
    {
        $prod = $this->db->select('p.id, p.p_title, p.p_price, CONCAT("'.$this->products.'", p.image) image, c.cat_slug, sc.cat_slug sc_slug, p.p_slug, p.description, LEFT(p.description, 250) short_desc, p.multi_image, p.sku_code, c.cat_name, sc.cat_name sub_cat')
                                        ->from('products p')
                                        ->where(['p.p_slug' => $prod])
                                        ->where(['c.cat_slug' => $cat])
                                        ->where(['sc.cat_slug' => $sub_cat])
                                        ->where(['c.is_deleted' => 0, 'sc.is_deleted' => 0, 'p.is_deleted' => 0])
                                        ->join('category c', 'c.id = p.cat_id')
                                        ->join('category sc', 'sc.id = p.sub_cat_id')
                                        ->get()->row();
                                        
        if ($prod) $prod->base = $this->products;

        return $prod;
    }

    public function getProdById($id)
    {
        $prod = $this->db->select('p.id, p.p_title, p.p_price, CONCAT("'.$this->products.'", p.image) image, c.cat_slug, sc.cat_slug sc_slug, p.p_slug, p.description, LEFT(p.description, 250) short_desc, p.multi_image, p.sku_code, c.cat_name, sc.cat_name sub_cat')
                                        ->from('products p')
                                        ->where(['p.id' => $id])
                                        ->where(['c.is_deleted' => 0, 'sc.is_deleted' => 0, 'p.is_deleted' => 0])
                                        ->join('category c', 'c.id = p.cat_id')
                                        ->join('category sc', 'sc.id = p.sub_cat_id')
                                        ->get()->row();
                                        
        if ($prod) $prod->base = $this->products;

        return $prod;
    }

    public function saveOrder($del, $post)
    {
        $address = $this->db->select('a.address, a.pincode, s.s_gst')->from('addresses a')
                            ->where('a.id', d_id($this->input->post('add_id')))
                            ->join('pincodes p', 'p.pincode = a.pincode')
                            ->join('states s', 's.id = p.s_id')
                            ->get()
                            ->row();

        $cart = $this->db->select('c.prod_id, c.quantity, p.p_price, p.p_title, p.gst')->from('cart c')
                            ->where('u_id', $this->session->userId)
                            ->join('products p', 'c.prod_id = p.id')
                            ->get()
                            ->result();
                            
        $total = array_sum(array_map(function($c){ return $c->quantity * $c->p_price; }, $cart));
        
        $this->db->trans_start();

        $order = [
            'u_id'         => $this->session->userId,
            'details'      => json_encode($cart),
            'total_amount' => $total,
            'shipping'     => $del,
            'name'         => $this->input->post('fullname'),
            'mobile'       => $this->input->post('mobile'),
            'address'      => $address->address,
            'pincode'      => $address->pincode,
            'gst_slab'     => $address->s_gst,
            'pay_type'     => $this->input->post('pay_type'),
            'o_date'       => date('Y-m-d'),
            'o_time'       => date('H:i:s'),
            'status'       => 'New Order',
            'payment_id'   => $this->input->post('pay_type'),
            'coupon'       => $this->session->coupon_code ? $this->session->coupon_code : "NA",
            'discount'     => $this->session->coupon_discount ? $this->session->coupon_discount : 0,
        ];
        
        $this->db->insert('orders', $order);
        $or_id = $this->db->insert_id();
        $this->db->delete($this->cart, ['u_id'  => $this->session->userId]);
        $this->db->trans_complete();
        if($this->db->trans_status() === true) {
            $this->session->unset_userdata('coupon_code');
            $this->session->unset_userdata('coupon_discount');
            return e_id($or_id);
        }else
            return FALSE;
    }
}