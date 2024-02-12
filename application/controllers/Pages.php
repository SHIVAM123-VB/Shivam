<?php

class pages extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('category_model');
		$this->load->model("site_model");
		$this->load->model("pages_model");
		$this->load->model("product_model");
		$this->load->model("cart_model");
	}

	public function view($slug = 'home', $param1 = "", $param2 = ""){
		$pageResult = $this->db->query("SELECT * FROM pages WHERE slug='" . trim($slug) . "' AND status='active' ");
		if ($pageResult->num_rows() <= 0) {
			// Whoops, we don't have a page for that!
			show_404();
		}
		$page = $pageResult->row_array();
		$pageData=[];
		$pageData['browserTitle'] = "SmartTech";
		$pageData['metaKey'] = $page['meta_keywords'];
		$pageData['metaDescription'] = $page['meta_description'];
		$pageData['arrCSS'][] = "";
		$pageData['arrJS'][] = "";
		$cartDetails = $this->cart_model->cartDetails(2);
		$pageData['data']['cartDetails']  = $cartDetails['data'];
		$category =  $this->category_model->categories();
		$pageData['data']['categories'] = $category['data'];
		shuffle($category['data']);
		for ($i = 0; $i < 6; $i++) {
			$pageData['data']['categories']['random'][] = $category['data'][$i];
		}
		$products_result = $this->product_model->get();
	
		$products = array();
		if($products_result['success'] == 1){
			$products = $products_result['data'];
		}
		
		$pageData['data']['products'] = $products;
		
		if ($page['slug'] == "home") {
			//Add pagedata exclusively for the home page.
		}
		$pageData['data']['page'] = $page;

		if (file_exists(APPPATH . '/views/' . $page['template'] . '.tpl.php') && trim($page['template']) <> "") {
			$this->load->view("home.tpl.php",array('pageData'=>$pageData));
		} else {
			$this->load->view("home.tpl.php");
		}
	}
}
