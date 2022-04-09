<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Public_controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->cats = array_map(function($cat){
			return [
				'cat_slug' => $cat['cat_slug'],
				'cat_name' => $cat['cat_name'],
				'sub_cats' => $this->main->getAll('category', 'cat_slug, cat_name', ['is_deleted' => 0, 'parent_id' => $cat['id']])
			];
		}, $this->main->getAll('category', 'id, cat_slug, cat_name', ['is_deleted' => 0, 'parent_id' => 0]));
		
		$this->cart = $this->main->getCart($this->session->userId);
		$this->wishlist = $this->main->getWishlist($this->session->userId);
		$this->show = ['Deals Of The Day', 'Top Featured', 'Top Selling'];
		$this->breadcrumb = 'assets/images/breadcrumb/';
	}
}