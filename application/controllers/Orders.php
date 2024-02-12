<?php

class orders extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('orders_model');
		$this->load->model('product_model');
		$this->load->model('category_model');
		$this->load->model('cart_model');
	}

	public function index()
	{
		if ($this->session->has_userdata('sessUserId') == FALSE) {
			redirect(base_url());
		}
		$pageData = [];
		$pageData['browserTitle'] = 'My Orders';

		$allProducts = $this->product_model->get();
		if ($allProducts['success'] == 1) {
			$randomProducts = [];
			shuffle($allProducts['data']);
			for ($i = 0; $i <= 9; $i++) {
				$randomProducts = $allProducts['data'];
			}
			$pageData['data']['random_products'] = $randomProducts;
		}

		$order_products = $this->orders_model->get();
		if ($order_products['success'] == 1) {
			$pageData['data']['orderProducts'] = $order_products['data'];
		}

		$cartDetails = $this->cart_model->cartDetails(2);
		if ($cartDetails['success'] == 1) {
			$pageData['data']['cartDetails']  = $cartDetails['data'];
		}

		$category =  $this->category_model->categories();
		if ($category['success'] == 1) {
			$pageData['data']['categories'] = $category['data'];
		}

		$this->load->view('orders', ['pageData' => $pageData]);
	}

	public function save()
	{
		if ($this->session->has_userdata('sessUserId')) {
			$result = ['success' => 0, "error" => 0, "message" => "", 'data' => []];
			if ($this->input->is_ajax_request()) {
				// order save process
				$userId = $this->session->userdata('sessUserId');
				$user_address = $this->input->post('user_address');
				$user_city = $this->input->post('user_city');
				$user_state = $this->input->post('user_state');
				$user_country = $this->input->post('user_country');
				$user_zipCode = $this->input->post('user_zipCode');
				$products = $this->input->post('products');
				$this->form_validation->set_rules('user_address', 'Address', 'required|trim');
				$this->form_validation->set_rules('user_city', 'City', 'required|trim');
				$this->form_validation->set_rules('user_state', 'State', 'required|trim');
				$this->form_validation->set_rules('user_country', 'Country', 'required|trim');
				$this->form_validation->set_rules('user_zipCode', 'Zipcode', 'required|trim|numeric|min_length[6]|max_length[6]');
				if ($this->form_validation->run() == TRUE) {
					if (count($products) > 0) {
						$address = $user_address . ' ,' . $user_city . ' ,' . $user_state . ' ,' . $user_country . ' ,' . $user_zipCode;
						$product_arr = [];
						$grand_total = 0;
						foreach ($products as $index => $order_product) {
							$qry = $this->db->query("SELECT id, price, name, availability FROM products WHERE id = '" . $order_product['product_id'] . "' AND 
							status = 'active'");
							if ($qry->num_rows() > 0) {
								$product = $qry->row_array();
								if ($product['availability'] >= $order_product['qty']) {
									$product_arr['user_id'] = $userId;
									$product_arr['address'] = $address;
									$product_arr['billing_type'] = 'COD';
									$product_arr['product_user_type'] = 'user';
									$product_arr['payment_status'] = 'pending';
									$product_arr['status'] = 'pending';
									$grand_total += ($order_product['qty'] * $product['price']);
									$product_arr['grand_total_price'] = $grand_total;
									$products[$index]['price'] = $product['price'];
								} else {
									$result['error'] = 1;
									$result['message'] = 'Product is out of stock: ' . $product['name'];
									$result['errorCode'] = 103;
									break;
								}
							} else {
								$result['error'] = 1;
								$result['message'] = 'Product not found';
								$result['errorCode'] = 104;
								break;
							}
						}
					} else {
						$result['error'] = 1;
						$result['message'] = 'something went wrong';
						$result['errorCode'] = 102;
					}
				} else {
					$result['error'] = 1;
					$result['message'] = 'Invalid address';
					$result['data'] = [
						'user_address' => form_error('user_address'),
						'user_city' => form_error('user_city'),
						'user_state' => form_error('user_state'),
						'user_country' => form_error('user_country'),
						'user_zipCode' => form_error('user_zipCode')
					];
					$result['errorCode'] = 105;
				}
				// getting values from top and save it
				if ($result['error'] == 0) {
					$order_result = $this->orders_model->save(0, $product_arr);
					if ($order_result['success'] == 1) {
						$result['success'] = 1;
						$result['data']['orderId'] = $order_result['data'];
						foreach ($products as $index => $product_item) {
							$order_items = [];
							$order_items['order_id'] = $result['data']['orderId'];
							$order_items['product_id'] = $product_item['product_id'];
							$order_items['price'] = $product_item['price'];
							$order_items['qty'] = $product_item['qty'];
							$order_items['total_price'] = ($product_item['qty'] * $product_item['price']);
							$order_items_result = $this->orders_model->save_order_items($order_items, false);
							if ($order_items_result['success'] == 1) {
								$result['success'] = 1;
								$qry = $this->db->query("SELECT product_id FROM cart WHERE product_id = '" . $order_items['product_id'] . "' AND user_id='" . $this->session->userdata('sessUserId') . "'");
								if ($qry->num_rows() == 1) {
									$this->db->query("DELETE FROM cart WHERE product_id = '" . $order_items['product_id'] . "' AND user_id='" . $this->session->userdata('sessUserId') . "'");
								}
							} else {
								$result['error'] = 1;
								$result['errorCode'] = 106;
							}
						}
					} else {
						$result['error'] = 1;
						$result['message'] = "some thing went wrong";
						$result['errorCode'] = 101;
					}
				}
			} else {
				$result['error'] = 1;
				$result['message'] = "Invalid Request";
			}
		}
		echo json_encode($result);
	}

	public function cancel_product()
	{
		// order cancel process
		if ($this->session->has_userdata('sessUserId')) {
			$result = ['success' => 0, "error" => 0, "message" => "", 'data' => []];
			if ($this->input->is_ajax_request()) {
				$cancel_orderId = $this->input->post('order_id');
				$cancel_orderItem_Id = $this->input->post('orderItem_id');
				if (!empty($cancel_orderId) && !empty($cancel_orderId)) {
					$order_items_result = $this->orders_model->save_order_items([], true, $cancel_orderItem_Id);
					if ($order_items_result['success'] == 1) {
						$qry = $this->db->query("SELECT total_price FROM orders_items WHERE order_id = '" . $cancel_orderId . "' AND status='active'");
						if ($qry) {
							$result['success'] = 1;
							$total_price = $qry->result_array();
							$grand_total = 0;
							foreach ($total_price as $price) {
								$grand_total += $price['total_price'];
							}
							if ($qry->num_rows() <= 0) {
								$cancelled_order = [];
								$cancelled_order['status'] = 'cancelled';
								$cancelled_order['grand_total_price'] = 0;
								$cancelled_order['cancelled_by'] = $this->session->userdata('sessUserId');
								$cancel_result = $this->orders_model->save($cancel_orderId, $cancelled_order);
								if ($cancel_result['error'] == 1) {
									$result['error'] = 1;
									$result['cart not cancelled'];
								}
							} else {
								$qry = $this->db->query("UPDATE orders SET grand_total_price = '" . $grand_total . "' WHERE id = '" . $cancel_orderId . "'");
							}
						}
						$result['data'] = $grand_total;
					}
				}
			} else {
				$result['error'] = 1;
				$result['message'] = "Invalid Request";
			}
			echo json_encode($result);
		}
	}
}
