<?php

class product extends CI_Controller
{
	var $filename = 'product';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('category_model');
		$this->load->model('cart_model');
		$this->load->model($this->filename . '_model', 'product_model');
	}

	public function detail($pro_id = 0)
	{
		$result = ['success' => 0, "error" => 0, "message" => "", 'data' => []];
		if ($pro_id == 0 || $pro_id == '') {
			$result['error'] = 1;
			redirect(base_url());
		}
		$pageData = [];
		$products_result = $this->product_model->get($pro_id);
		$products = array();
		if ($products_result['success'] == 1) {
			$products = $products_result['data'];
		}
		$pageData['data']['products'] = $products;

		$allProducts = $this->product_model->get();
		if ($allProducts['success'] == 1) {
			$randomProducts = [];
			shuffle($allProducts['data']);
			for ($i = 0; $i <= 9; $i++) {
				$randomProducts = $allProducts['data'];
			}
			$pageData['data']['random_products'] = $randomProducts;
		}
		$pageData['browserTitle'] = $pageData['data']['products']['name'];
		$category =  $this->category_model->categories();
		$pageData['data']['categories'] = $category['data'];
		$cartDetails = $this->cart_model->cartDetails(2);
		if ($cartDetails['success'] == 1) {
			$pageData['data']['cartDetails']  = $cartDetails['data'];
		}
		$this->load->view($this->filename . '_details', ['pageData' => $pageData]);
	}



	function listing()
	{
		$pageData = [];
		$pageData['browserTitle'] = 'Product List';
		$category =  $this->category_model->categories();
		if ($category['success'] == 1) {
			$pageData['data']['categories'] = $category['data'];
		}
		$allProducts = $this->product_model->get();
		$cartDetails = $this->cart_model->cartDetails(2);
		if ($cartDetails['success'] == 1) {
			$pageData['data']['cartDetails']  = $cartDetails['data'];
		}
		if ($allProducts['success'] == 1) {
			$randomProducts = [];
			shuffle($allProducts['data']);
			for ($i = 0; $i <= 9; $i++) {
				$randomProducts = $allProducts['data'];
			}
			$pageData['data']['random_products'] = $randomProducts;
		}
		$this->load->view('product_list', ['pageData' => $pageData]);
	}

	public function search()
	{
		$result = ['success' => 0, "error" => 0, "message" => "", 'data' => []];
		if ($this->input->is_ajax_request()) {
			$filter_record = [];
			$filter_record['category_id'] = $this->input->post('categories');
			$filter_record['price'] = $this->input->post('price');
			$filter_record['search'] = $this->input->post('search');
			$filter_record['limit'] = $this->input->post('limit');
			$filter_record['page'] = $this->input->post('page');
			$products_result = $this->product_model->search($filter_record);

			if ($products_result['success'] == 1) {
				$result['success'] = 1;
				if (count($products_result['data']['products']) > 0) {
					foreach ($products_result['data']['products'] as $index => $product) {
						$products_result['data']['products'][$index]['img'] = getImage(base_url() . 'data/product_images/' . trim($product['img']), 600, 600);
						$products_result['data']['products'][$index]['description'] = explode('<<>>', $product['description']);
					}
					$result['data']['products'] = $products_result['data']['products'];
				} else {
					$result['message'] = 'No result found.';
					$result['data']['products'] = [];
				}
			}
		} else {
			$result['error'] = 1;
			$result['message'] = "invalid request";
		}
		echo json_encode($result);
	}
}
