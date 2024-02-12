<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class product_model extends CI_Model
{


	public function get($pro_id = 0)
	{
		$response = ['success' => 0, "error" => 0, "message" => "", 'data' => []];

		$qry = "SELECT 
				p.id, p.name, p.category_id, p.img, p.price, p.functionality, p.description, p.availability, c.name AS category
			FROM products AS p
			JOIN categories AS c ON c.id = p.category_id
			WHERE p.status = 'active'
";

		if (intval($pro_id) > 0) {
			$qry .= " AND p.id=" . $pro_id . " ";
		}
		$sql = $this->db->query($qry);
		if ($sql->num_rows() > 0) {
			$response['success'] = 1;
			if (intval($pro_id) > 0) {
				$response['data'] = $sql->row_array();
			} else {
				$response['data'] = $sql->result_array();
			}
		} else {
			$response['error']  = 1;
			$response['message'] = "no data found";
		}
		return $response;
	}



	public function search($filter)
	{
		if (count($filter) > 0) {
			$search = strEscape($filter['search']);
			$response = ['success' => 0, "error" => 0, "message" => "", 'data' => []];
			$price = explode(':', $filter['price']);
			$minPrice = floatval($price[0]);
			$maxPrice = floatval($price[1]);
			$qry = "SELECT 
					p.id, p.name, p.description, p.img, p.price, p.availability, c.name AS category
				FROM 
					products AS p
        JOIN  
					categories AS c ON c.id = p.category_id
        WHERE 
					p.status = 'active'"; 
					if(!empty($search)){ 
							$qry .= "AND (p.name LIKE '%$search%' OR c.name LIKE '%$search%')";
					}

			if (is_float($maxPrice) && is_float($minPrice)) {
				$qry .= " AND (price BETWEEN $minPrice AND $maxPrice)";
			}

			if (isset($filter['category_id']) && is_array($filter['category_id']) && count($filter['category_id']) > 0) {
				$categoryIds = implode(',', $filter['category_id']);
				$qry .= " AND (c.id IN ($categoryIds))";
			}

			$qry .= " LIMIT " . $filter['limit'];
			$products_qry = $this->db->query($qry);

			$products = [];
			if ($products_qry->num_rows() > 0) {
				$products = $products_qry->result_array();
			}
			$response['success'] = 1;
			$response['data']['products'] = $products;
			return $response;
		}
	}
}
