<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class pages extends CI_Controller{

	var $faIconClass;
	var $fileName;
	var $defaultUrl;
	var $allowReorder;

	function __construct(){
		parent::__construct();
		$this->faIconClass = "fa-files-o";
		$this->fileName = "pages";
		$this->defaultUrl = "pages";
		$this->allowReorder = true;

		$this->load->model(SITE_ADMIN_DIR_NAME . "/admin_model");
		$this->load->model(SITE_ADMIN_DIR_NAME . "/" . $this->fileName . "_model", "objModel");
		$this->load->helper('directory');
		
		if ($this->admin_model->loggedInAdminId == "" || $this->admin_model->loggedInAdminId <= 0) {
			redirect(base_url(SITE_ADMIN_DIR_NAME . '/login'));
		}
	}

	public function index(){
		$pageData['title'] = "Manage " . $this->objModel->labelPlural;
		$pageData['faIconClass'] = $this->faIconClass;

		$this->load->view(SITE_ADMIN_DIR_NAME . '/common/' . $this->fileName . "_manage", array("pageData" => $pageData));
	}

	public function get(){
		$selectCols = "*";
		$searchableCols = array("id", "heading", "slug", "page_content");
		$sortableCols = array("id", "heading", "slug", null, null);
		if ($this->allowReorder) {
			array_unshift($sortableCols, null);
		}
		if ($this->admin_model->has_user_access(array('superadmin', 'admin'))) {
			array_unshift($sortableCols, null);
		}

		$response = array("draw" => 0, "recordsTotal" => 0, "recordsFiltered" => 0, "data" => array());

		$response['draw'] = $this->input->post("draw");
		$search = $this->input->post("search")["value"];
		$order = is_array($this->input->post("order")) ? $this->input->post("order")[0] : [];
		$start = $this->input->post("start");
		$length = $this->input->post("length");

		$qry = "SELECT {columns} FROM " . $this->objModel->tableName . " WHERE status='active' ";
		if ($search != "") {
			$qry .= ' AND ( 1=0 ';
			foreach ($searchableCols as $col) {
				$qry .= ' OR ' . $col . ' LIKE "%' . $search . '%"';
			}
			$qry .= ')';
		}

		$totalCounts = $this->db->query(str_replace("{columns}", "count(id) as counts", $qry))->row_array();
		$response["recordsFiltered"] = $response["recordsTotal"] = $totalCounts['counts'];

		$qry .= " ORDER BY ";
		if (count($order) > 0 && $sortableCols[$order["column"]] != null) {
			$qry .= " " . $sortableCols[$order["column"]] . " " . $order["dir"];
		} else {
			$qry .= ($this->allowReorder) ? " display_order ASC" : " id DESC";
		}
		$qry .= " LIMIT " . $start . "," . $length;
		$qry = str_replace("{columns}", $selectCols, $qry);
		$records = $this->db->query($qry);

		if ($records->num_rows() > 0) {
			$count = 0;
			foreach ($records->result_array() as $row) {
				$count++;
				$actionButtons = '<a class="ajax-page-link btn btn-success btn-label-left icon-btn" href="' . $this->defaultUrl . '/edit/' . $row['id'] . '">
									<span><i class="fa fa-pencil"></i></span>
								</a>';
				if ($this->admin_model->has_user_access(array('superadmin'))) {
					$actionButtons .= ' <a href="javascript:void(0);" onclick="deleteConfirm(\'' . $row['id'] . '\');" class="btn btn-danger btn-label-left icon-btn">
						<span><i class="fa fa-trash-o"></i></span>
					</a>';
				}

				$record = array('DT_RowId' => $row['id']);
				if ($this->allowReorder) {
					$record[] = $row['display_order'];
				}
				if ($this->admin_model->has_user_access(array('superadmin'))) {
					$record[] = '<div class="dataTable-checkbox checkbox-inline">
									<label>
										<input type="checkbox" class="inputBatchOperations" name="recordIds[]" value="' . $row['id'] . '">
									</label>
								</div>';
				}
				$record[] = $row['id'];
				$record[] = $row['heading'];
				$record[] = $row['slug'];
				$record[] = getExcerpt(strip_tags($row['page_content']), 215);
				$record[] = $actionButtons;

				$response["data"][] = $record;
			}
		}
		echo json_encode($response);
	}

	public function add(){
		if (!$this->admin_model->has_user_access(array('superadmin', 'admin'))) {
			$this->ideate_model->set_message("err", 'Sorry, You don\'t have an access to this page/action.', "admin");
			redirect(SITE_ADMIN_DIR_NAME . '/dashboard');
		}
		$pageData['title'] = "Add " . $this->objModel->labelSingular;
		$pageData['faIconClass'] = $this->faIconClass;
		$pageData['data']['mode'] = "add";
		$pageData['data']['record'] = array();
		$pageData['data']['recordId'] = 0;
		$this->load->view(SITE_ADMIN_DIR_NAME . '/common/' . $this->fileName . "_entry", array("pageData" => $pageData));
	}

	public function edit($recordId){
		if (trim($recordId) == "" || trim($recordId) <= 0) {
			redirect($this->defaultUrl);
		}
		$pageData['title'] = "Edit " . $this->objModel->labelSingular;
		$pageData['faIconClass'] = $this->faIconClass;
		$pageData['data']['mode'] = "edit";
		$pageData['data']['recordId'] = $recordId;

		$pageData['data']['record'] = array();
		$records = $this->db->query("SELECT * FROM " . $this->objModel->tableName . " WHERE id='" . $recordId . "'");
		if ($records->num_rows() >= 1) {
			$pageData['data']['record'] = $records->row_array();
		}
		$this->load->view(SITE_ADMIN_DIR_NAME . '/common/' . $this->fileName . "_entry", array("pageData" => $pageData));
	}

	public function save($recordId = 0){
		if ($recordId <= 0 && !$this->admin_model->has_user_access(array('superadmin', 'admin'))) {
			$result = array('success' => 0, 'error' => 1, 'message' => 'Sorry, You don\'t have an access to this page/action.', 'data' => array());
		} else {
			$this->form_validation->set_error_delimiters('', '');
			$this->form_validation->set_rules('heading', 'Heading', 'trim|required');
			$this->form_validation->set_rules('slug', 'Slug', array("trim","required","max_length[30]", 
								"regex_match[/^[a-z0-9_-]+$/]",
								array(
										'is_unique_field',
										function($value) use ($recordId){
											$this->form_validation->set_message('is_unique_field', 'Entered slug already exists.');
											return $this->ideate_model->is_unique_field($this->objModel->tableName, $columnName='slug', $value, $recordId);
										}
									)
								));

			if ($this->form_validation->run() == TRUE) {
				$record['browser_title'] = $this->input->get_post("browser_title");
				$record['meta_keywords'] = $this->input->get_post("meta_keywords");
				$record['meta_description'] = $this->input->get_post("meta_description");
				if ($this->admin_model->has_user_access(array('superadmin', 'admin'))) {
					$record['slug'] = $this->input->get_post("slug");
					$record['template'] = $this->input->get_post("template");
				}
				$record['heading'] = $this->input->get_post("heading");
				$record['sub_heading'] = quotes_to_entities($this->input->get_post("sub_heading"));
				$record['page_content'] = quotes_to_entities($this->input->get_post("page_content"));
				$record['secondary_page_content'] = $this->input->get_post("secondary_page_content");

				$file_upload_config = array();
				$file_upload_config['field_name'] = 'primary_image';
				$file_upload_config['upload_path'] = './data/page_images';
				$currentFile = $this->ideate_model->get_row($this->objModel->tableName, $file_upload_config['field_name'], "id='" . $recordId . "'");
				$file_upload_config['delete_file'] = $currentFile;
				$file_upload_config['file_name'] = $this->admin_model->loggedInAdminId . "_" . rand(0, 99) . "_" . time();
				$file_upload_config['allowed_types'] = 'gif|jpg|png|jpeg';
				$file_upload_config['max_size'] = '1024';
				$file_upload_config['upload_result'] = $this->ideate_model->file_upload($file_upload_config);
				if ($file_upload_config['upload_result']['success'] == 1 || $file_upload_config['upload_result']['no_file_selected'] == 1) {
					if ($file_upload_config['upload_result']['success'] == 1) {
						$record[$file_upload_config['field_name']] = $file_upload_config['upload_result']['data']['file_name'];
					}
					$result = $this->objModel->save($recordId, $record);
					if ($result['success'] == 1) {
						$this->ideate_model->set_message("succ", $result['message'], "admin");
					} else {
						if ($file_upload_config['upload_result']['success'] == 1) {
							deleteFile($file_upload_config['upload_path'] . '/' . $file_upload_config['upload_result']['data']['file_name']);
						}
					}
				} else {
					$result['error'] = 1;
					$result['message'] = $file_upload_config['upload_result']['message'];
				}
			}else {
				$result['error'] = 1;
				$errors = $this->form_validation->error_array();
				$fields = array_keys($errors);
				$result['message'] = $errors[$fields[0]];
				//$result['message'] = validation_errors();
				//$this->form_validation->error_array();
			}
		}
		echo json_encode($result);
	}

	public function delete($recordId){
		if (!$this->admin_model->has_user_access(array('superadmin'))) {
			$this->ideate_model->set_message("err", 'Sorry, You don\'t have an access to this page/action.', "admin");
			$result = array('success' => 0, 'error' => 0, 'message' => '', 'data' => array());
		} else {
			$result = $this->objModel->delete($recordId);
			if ($result['success'] == 1) {
				$this->ideate_model->set_message("succ", $result['message'], "admin");
			} else {
				$this->ideate_model->set_message("err", $result['message'], "admin");
			}
		}
		echo json_encode($result);
	}

	public function batchOperations(){
		$result = array('success' => 0, 'error' => 0, 'message' => '', 'data' => array());
		if (!$this->admin_model->has_user_access(array('superadmin'))) {
			$this->ideate_model->set_message("err", 'Sorry, You don\'t have an access to this page/action.', "admin");
			$result['error'] = 1;
		} else {
			$action = $this->input->get_post('action');
			if ($action == "delete") {
				$recordIds = $this->input->get_post('recordIds');
				$cntSuccess = 0;

				if (is_array($recordIds) && count($recordIds) > 0) {
					foreach ($recordIds as $recordId) {
						$result1 = $this->objModel->delete($recordId);
						if ($result1['success'] == 1) {
							$cntSuccess++;
						}
					}
					if (count($recordIds) == $cntSuccess) {
						$this->ideate_model->set_message("succ", $this->objModel->labelPlural . " deleted suucessfully.", "admin");
						$result['success'] = 1;
					} else {
						$this->ideate_model->set_message("err", "One or more " . $this->objModel->labelSingular . " can not be deleted.", "admin");
						$result['error'] = 1;
					}
				} else {
					$this->ideate_model->set_message("err", "No " . $this->objModel->labelSingular . " selected.", "admin");
					$result['error'] = 1;
				}
			}
		}
		echo json_encode($result);
	}

	public function reorder(){
		$recordId = $this->input->get_post('id');
		$fromDisplayOrder = $this->input->get_post('fromPosition');
		$toDisplayOrder = $this->input->get_post('toPosition');
		$result = $this->ideate_model->set_display_order($this->objModel->tableName, $recordId, $fromDisplayOrder, $toDisplayOrder);
	}

	public function chk_duplicate_slug(){
		$pageSlug = $this->input->get_post('pageSlug');
		$pageId = $this->input->get_post('pageId');
		if ($this->ideate_model->is_unique_field($this->objModel->tableName, "slug", $pageSlug, $pageId)) {
			echo "true";
		} else {
			echo "false";
		}
	}

}
