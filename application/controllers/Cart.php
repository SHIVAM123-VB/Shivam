<?php

class cart extends CI_Controller
{
	var $filename = 'cart';
	public function __construct()
	{
		parent::__construct();
		$this->load->model('category_model');
		$this->load->model($this->filename . '_model', 'cart_model');
	}

	public function index()
	{

		if ($this->session->has_userdata('sessUserId') == FALSE) {
			redirect(base_url() . 'account/login');
		}
		$pageData = [];
		$pageData['browserTitle'] = 'Shopping Cart';
		$cartDetails = $this->cart_model->cartDetails(2);
		$pageData['data']['cartDetails']  = $cartDetails['data'];
		$category =  $this->category_model->categories();
		$pageData['data']['categories'] = $category['data'];
		$product =  $this->cart_model->cartDetails();
		if ($product['success'] == 1) {
			$pageData['data']['products'] = $product['data'];
		}
		$this->load->view('cart', ['pageData' => $pageData]);
	}

	public function save()
	{
		$result = ['success' => 0, "error" => 0, "message" => "", 'data' => []];
		if ($this->input->is_ajax_request()) {
			if ($this->session->has_userdata('sessUserId') == FALSE) {
				$result['error'] = 1;
				$result['errorCode'] = 909;
			} else {
				$record = [];
				$record['product_id'] = $this->input->post('product_id');
				$record['user_id'] = $this->session->userdata('sessUserId');
				$record['product_price'] = $this->input->post('product_price');
				if ($record['product_id'] == 0 || $record['product_id'] == '') {
					$result['error'] = 1;
					$result['errorCode'] = 102;
				}
				$record['qty'] = $this->input->post('qty');
				$record['total_amount'] = $this->input->post('total_amount');
				$checkProduct = [];
				if ($record['total_amount'] <> '' && $record['total_amount'] > 0) {
					$checkProduct = $this->cart_model->isDuplicateInCart($record['product_id']);
					if ($checkProduct['success'] == 1) {
						$response = $this->cart_model->save(0,$record);
						if ($response['success'] == 1) {
							$result['success'] = 1;
							$result['data'] = $this->cart_model->cartDetails(2);
						} else {
							$result['error'] = 1;
							$result['message'] = "Some thing Went Wrong";
						}
					} else {
						$result['error'] = 1;
						$result['errorCode'] = 505;
						$result['message'] = "Product Already Available in cart";
					}
				} else {
					$response = $this->cart_model->save(1, $record);
					if ($response['success'] == 1) {
						$result['success'] = 1;
					} else {
						$result['error'] = 1;
						$result['message'] = "Some thing Went Wrong";
					}
				}
			}
		} else {
			$result['error'] = 1;
			$result['message'] = "Invalid Request";
		}
		echo json_encode($result);
	}
	
}
