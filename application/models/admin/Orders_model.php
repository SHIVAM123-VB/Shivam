<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class orders_model extends CI_Model
{

	public function save($recordId, $record)
	{
		$result = array('success' => 0, 'error' => 1, 'message' => '', 'data' => array());
		$arrSaveRecordFields = [];
		foreach ($record as $fields => $value) {
			$arrSaveRecordFields[] = "`" . $fields . "`='" . strEscape($value) . "'";
		}
		$strSaveRecordFields = implode(',', $arrSaveRecordFields);
		if ($recordId <> 0 && $recordId <> "") {
			$sql = "UPDATE " . $this->tablename . " SET $strSaveRecordFields,updated_at = NOW(),updated_by=" . $this->admin_model->loggedInAdminId . " WHERE id='" . $recordId . "'";
		} else {
			$sql = "INSERT INTO " . $this->tablename . " SET $strSaveRecordFields,created_at = NOW(),created_by=" . $this->admin_model->loggedInAdminId . "";
		}
		if ($this->db->query($sql)) {
			$result['success'] = 1;
			if ($recordId <> "" && $recordId > 0) {
				$result['data']['recordId'] = $recordId;
			} else {
				$result['data']['recordId'] = $this->db->insert_id();
			}
			$result['message'] = "orders saved successfully.";
		} else {
			$result['error'] = 1;
			$result['message'] = "Failed to save orders.";
		}

		return $result;
	}

	function delete($recordId)
	{
		$result = array('success' => 0, 'error' => 0, 'message' => '', 'data' => array());
		$deleteRecordQuery = "UPDATE " . $this->tablename . " SET status='cancelled', updated_at=NOW(), updated_by='" . $this->admin_model->loggedInAdminId . "' WHERE id='" . $recordId . "'";
		if ($this->db->query($deleteRecordQuery)) {
			$result['success'] = 1;
			$result['message'] = $this->labelSingular . " deleted successfully.";
		} else {
			$result['error'] = 1;
			$result['message'] = "Failed to delete " . $this->labelSingular . ".";
		}
		return $result;
	}

	public function get($recordId = 0)
	{
		$result = array('success' => 0, 'error' => 0, 'message' => '', 'data' => array());
		if($recordId > 0){
			$qry = "SELECT 
				o.order_id,o.price,o.qty,o.total_price,o.status,p.name,p.img ,orders.address
			FROM
				orders_items AS o
			JOIN 
				products AS p on p.id = o.product_id
			JOIN 
				orders on orders.id = o.order_id
			WHERE
				o.order_id = '" . $recordId . "' AND o.status = 'active' 
			";
		$runQry = $this->db->query($qry);
		if ($runQry) {
			$result['success'] = 1;
			$result['data'] = $runQry->result_array();
		} else {
			$result['error'] = 1;
			$result['message'] = "Failed to fetching data";
		}
	}
		return $result;
	}
}
