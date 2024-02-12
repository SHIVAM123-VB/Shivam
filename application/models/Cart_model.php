<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class cart_model extends CI_Model
{

	public function save($flag = 0,$record)
	{
		$response = ['success' => 0, "error" => 0, "message" => "", 'data' => []];
		foreach ($record as $fields => $value) {
			$arrSaveRecordFields[] = "`" . $fields . "`='" . strEscape($value) . "'";
		}
		$strSaveRecordFields = implode(',', $arrSaveRecordFields);
		if($flag == 0){
			$sql = "INSERT INTO cart SET $strSaveRecordFields,created_at = NOW(),created_by='" . $record['user_id'] . "'";
		}else{
			$sql = "DELETE FROM cart WHERE product_id = '".$record['product_id']."' AND user_id = $record[user_id]";
		}
		if ($this->db->query($sql)) {
			$response['success'] = 1;
			$response['message'] = $this->db->affected_rows();
		} else {
			$response['error'] = 1;
		}
		return $response;
	}

	public function isDuplicateInCart($product_id)
	{
		$response = ['success' => 0, "error" => 0, "message" => ""];
		$qry = $this->db->query("SELECT
						product_id 
						FROM cart 
						WHERE product_id ='" . $product_id . "' AND user_id = '" . $this->session->userdata('sessUserId') . "'");
		if ($qry->num_rows() >= 1) {
			$response['error'] = 1;
		} else {
			$response['success'] = 1;
		}
		return $response;
	}

	public function cartDetails($limit = 0)
	{
		$response = ['success' => 0, "error" => 0, "message" => "", 'data' => []];
		$qry = "SELECT 
    (SELECT SUM(total_amount) FROM cart WHERE user_id='" . $this->session->userdata('sessUserId') . "') as productsSum,
    (SELECT COUNT(*) FROM cart WHERE user_id='" . $this->session->userdata('sessUserId') . "') as total_Products,
					c.id AS cart_id,
					c.product_id,
					c.product_price,
					c.total_amount,
					c.qty,
					p.name,
					p.img
					FROM 
							cart c
					JOIN 
							products p
					ON 
							p.id = c.product_id
					WHERE
							c.user_id = '" . $this->session->userdata('sessUserId') . "'";
				if($limit > 0 && $limit <> ''){
					$qry.="	ORDER BY c.id DESC LIMIT $limit";
				}
		
		$sql = $this->db->query($qry);
		if ($sql->num_rows() > 0) {
			$response['success'] = 1;
			$response['data'] = $sql->result_array();
		} else {
			$response['error'] = 1;
			$response['message'] = "data not found";
		}
		return $response;
	}

	// public function get(){
	// 	$response = ['success' => 0, "error" => 0, "message" => "", 'data' => []];
	// 	$qry = "SELECT 
	// 		c.product_id, c.product_price, c.qty, c.total_amount,
	// 		p.name,p.img
	// 	FROM cart AS c
	// 		JOIN products p ON c.product_id = p.id 
	// 	WHERE 
	// 		c.user_id = '" . $this->session->userdata('sessUserId') . "'";
	// }
}
