<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class ideate_model extends CI_Model{
	public $settings;
	
	function __construct(){
		parent::__construct();
		$this->settings = $this->get_settings();
	}

	function get_settings($settings = ""){
		$arrSettings = array();
		$websiteSettings = array();

		$websiteSettingsQuery = "SELECT * FROM settings WHERE 1=1 ";
		if (trim($settings) <> "") {
			$arrSettings = explode(",", trim($settings));
			$websiteSettingsQuery .= " AND name IN ('" . implode("','", $arrSettings) . "')";
		}
		$websiteSettingsQuery .= " ORDER BY name";

		$resultSettings = $this->db->query($websiteSettingsQuery);
		if ($resultSettings->num_rows() >= 1) {
			foreach ($resultSettings->result_array() as $resultSetting) {
				$websiteSettings[$resultSetting['name']] = $resultSetting['value'];
			}
		}

		if (count($websiteSettings) == 0) {
			return false;
		} elseif (count($arrSettings) == 1) {
			return $websiteSettings[$arrSettings[0]];
		} else {
			return $websiteSettings;
		}
	}

	function set_message($key, $value, $bundled = "msg"){
		$messages = array();
		$bundled = (trim($bundled) == "") ? "msg" : $bundled;
		$messages = $this->session->userdata($bundled);
		$messages[$key][] = $value;
		$this->session->set_userdata($bundled, $messages);
	}

	function get_messages($key, $bundled = "msg"){
		$messages = array();
		$bundled = (trim($bundled) == "") ? "msg" : $bundled;
		$messagesArr = $this->session->userdata($bundled);
		if (is_array($messagesArr)) {
			if (array_key_exists($key, $messagesArr)) {
				$messages = $messagesArr[$key];
				unset($messagesArr[$key]);
				if (count($messagesArr) > 0) {
					$this->session->set_userdata($bundled, $messagesArr);
				} else {
					$this->session->unset_userdata($bundled);
				}
			}
		}
		return $messages;
	}

	function file_upload($uploadData){
		$result = array('success' => 0, 'error' => 0, 'no_file_selected' => 0, 'message' => '', 'data' => array());

		if (isset($_FILES[$uploadData['field_name']]) && is_uploaded_file($_FILES[$uploadData['field_name']]['tmp_name'])) {
			$this->upload->initialize($uploadData);
			$do_upload = $this->upload->do_upload($uploadData['field_name']);
			$result['data'] = $this->upload->data();
			if ($do_upload) {
				$result['success'] = 1;
				if ($uploadData['delete_file'] <> "") {
					deleteFile($uploadData['upload_path'] . DIRECTORY_SEPARATOR. $uploadData['delete_file']);
				}
			} else {
			
				$result['error'] = 1;
				$result['message'] = $this->upload->display_errors('', '');
			}
		} else {
			$result['error'] = 1;
			$result['no_file_selected'] = 1;
			$result['message'] = $this->upload->display_errors('', '');
		}

		return $result;
	}

	function file_upload_base64($uploadData){
		$result = array('success' => 0, 'error' => 0, 'no_file_selected' => 0, 'message' => '', 'data' => array());

		if (isset($uploadData['file_name']) && trim($uploadData['file_name']) && isset($uploadData['file_content']) && trim($uploadData['file_content'])) {
			$file_content = base64_decode(str_replace("[removed]", "", $uploadData['file_content']));
			$do_upload = file_put_contents($uploadData['upload_path'] . DIRECTORY_SEPARATOR . $uploadData['file_name'] . $uploadData['file_extension'], $file_content);
			if ($do_upload) {
				$result['success'] = 1;
				if ($uploadData['delete_file'] <> "") {
					deleteFile($uploadData['upload_path'] . DIRECTORY_SEPARATOR . $uploadData['delete_file']);
				}
			} else {
				$result['error'] = 1;
				$result['message'] = "Failed to upload the file";
			}
		} else {
			$result['error'] = 1;
			$result['message'] = "Empty file name/content.";
		}

		return $result;
	}

	function delete_uploaded_file($tableName, $fieldName, $recordId, $dirPath){
		$records = $this->db->query("SELECT " . $fieldName . " FROM " . $tableName . " WHERE id='" . $recordId . "'");
		if ($records->num_rows() >= 1) {
			$recordRow = $records->row_array();
			$fileName = $recordRow[$fieldName];
			$filePath = $dirPath . $fileName;
			if (trim($fileName) <> "") {
				deleteFile($filePath);
			}
		}
	}

	function is_unique_field($table, $fieldName, $fieldValue, $id = 0, $whereExtraCond = ''){
		$query = $this->db->query("SELECT id FROM " . $table . " WHERE " . $fieldName . "='" . $fieldValue . "' AND id!='" . $id . "' AND status != 'trash' " . $whereExtraCond . " ");
		if ($query->num_rows() >= 1) {
			return false;
		} else {
			return true;
		}
	}

	function get_row($table, $field, $where){
		$fieldStr = "";
		if (is_array($field)) {
			$fieldStr = implode(",", $field);
			$result = array();
		} else {
			$fieldStr = $field;
			$result = "";
		}

		$query = $this->db->query("SELECT " . $fieldStr . " from " . $table . " where " . $where);

		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			if (count($row) == 1) {
				$result = $row[$field];
			} else {
				$result = $row;
			}
		} else {
			$result = false;
		}

		return $result;
	}

	function getPaginationLinks($customConfig){
		$pagination['use_page_numbers'] = TRUE;
		$pagination['num_links'] = 2;
		$pagination['full_tag_open'] = '<p class="ci_pagination">';
		$pagination['full_tag_close'] = '</p>';
		$pagination['first_link'] = '&lt;&lt;';
		$pagination['last_link'] = '&gt;&gt;';
		$pagination['prev_link'] = '&lt;';
		$pagination['next_link'] = '&gt;';

		$pagination = array_merge($pagination, $customConfig);

		$this->pagination->initialize($pagination);
		return $this->pagination->create_links();
	}

	function set_display_order($table, $id, $fromDisplayOrder, $toDisplayOrder){
		$result = $this->db->query("UPDATE " . $table . " SET display_order='" . $toDisplayOrder . "' where id='" . $id . "'");
		if ($toDisplayOrder > $fromDisplayOrder) {
			$this->db->query("UPDATE " . $table . " SET display_order=display_order-1 where id!='" . $id . "' and display_order<='" . $toDisplayOrder . "' and display_order>='" . $fromDisplayOrder . "'");
		} else {
			$this->db->query("UPDATE " . $table . " SET display_order=display_order+1 where id!='" . $id . "' and display_order>='" . $toDisplayOrder . "' and display_order<='" . $fromDisplayOrder . "'");
		}

		if ($result) {
			return true;
		} else {
			return false;
		}
	}

	/*function set_display_order($table,$id,$displayOrder){
		$dupDispOrderQry = $this->db->query("SELECT id FROM ".$table." WHERE display_order='".$displayOrder."'");
		if($dupDispOrderQry->num_rows()>0)
		{
			$dupDispOrderQryRow=$dupDispOrderQry->row_array();
			$this->set_display_order($table,$dupDispOrderQryRow['id'],intval($displayOrder)+1);
		}
		
		$updDispOrderQry = $this->db->query("UPDATE ".$table." SET display_order='".$displayOrder."' where id='".$id."'");
		if($updDispOrderQry)
		{
			return true;
		}
		else
		{
			return false;
		}
	}*/

	function get_new_display_order($table){
		$displayOrder = 0;
		$query = $this->db->query("SELECT max(display_order) as maxDisplayOrder FROM " . $table);
		if ($query->num_rows() > 0) {
			$maxDisplayNumberRow = $query->row_array();
			$displayOrder = $maxDisplayNumberRow['maxDisplayOrder'];
		}
		$displayOrder++;
		return $displayOrder;
	}

	function re_array_files($file_post = array()){

		$file_ary = array();
		$file_count = count($file_post['name']);
		$file_keys = array_keys($file_post);

		for ($i = 0; $i < $file_count; $i++) {
			foreach ($file_keys as $key) {
				$file_ary[$i][$key] = $file_post[$key][$i];
			}
		}
		return $file_ary;
	}
}
