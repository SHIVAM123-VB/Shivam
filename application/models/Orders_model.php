<?php

class orders_model extends CI_Model
{

	var $tableName = "orders";

	public function save($recordId, $record)
	{
		$response = ['success' => 0, "error" => 0, "message" => "", 'data' => []];
		foreach ($record as $fields => $value) {
			$arrSaveRecordFields[] = "`" . $fields . "`='" . strEscape($value) . "'";
		}
		$strSaveRecordFields = implode(',', $arrSaveRecordFields);
		if ($recordId == 0) {
			$qry = "INSERT INTO orders SET $strSaveRecordFields, created_at = NOW()";
		} else {
			$qry = "UPDATE orders SET $strSaveRecordFields,updated_at=NOW(),updated_by = '" .$recordId. "' WHERE id = '".$recordId."'";
		}
		if ($this->db->query($qry)) {
			$response['success'] = 1;
			$response['data'] = $this->db->insert_id();
		} else {
			$response['error'] = 1;
			$response['message'] = "something went wrong";
		}
		return $response;
	}


	public function save_order_items($record,$cancel_order = false,$recordId = 0)
	{
		$response = ['success' => 0, "error" => 0, "message" => "", 'data' => []];
		$arrSaveRecordFields = [];
		foreach ($record as $fields => $value) {
			$arrSaveRecordFields[] = "`" . $fields . "`='" . strEscape($value) . "'";
		}
		$strSaveRecordFields = implode(',', $arrSaveRecordFields);	
		if($cancel_order == false){
			$qry = "INSERT INTO orders_items SET $strSaveRecordFields";
		}else{
			$qry = "UPDATE orders_items SET status='trash' WHERE id = '".$recordId."'";
		}
		if ($this->db->query($qry)) {
			$response['success'] = 1;
			if($cancel_order == 0){
				$response['data'] = $this->db->insert_id();
			}
		} else {
			$response['error'] = 1;
			$response['message'] = "something went wrong";
		}
		return $response;
	}

	public function get()
	{
		$response = ['success' => 0, "error" => 0, "message" => "", 'data' => []];
		$qry = "SELECT
				ot.order_id, ot.id AS o_item_id, ot.price, ot.qty, ot.total_price,ot.status, p.id AS product_id, p.name, p.img, c.name AS category, o.grand_total_price AS grand_total
			FROM 
				orders_items AS ot
			JOIN 
				orders AS o ON o.id = ot.order_id
			JOIN 
				products AS p ON p.id = ot.product_id
			JOIN 
				categories AS c ON c.id = p.category_id
			WHERE
				o.user_id = '".$this->session->userdata('sessUserId')."'
		";

		

		$ordersQry = $this->db->query($qry);
		if ($ordersQry->num_rows() > 0) {
			$response['success'] = 1;
			$response['data'] = $ordersQry->result_array();
		} else {
			$response['error'] = 1;
			$response['message'] = "No Orders Found";
		}
		return $response;
	}
}
