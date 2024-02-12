<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class product extends CI_Controller
{
	var $faIconClass;
	var $filename;
	var $defaultUrl;
	var $labelSingular;
	var $tablename;
	var $allowReorder;
	var $labelPlural;
	function __construct()
	{
		parent::__construct();
		$this->faIconClass = "fa-cubes";
		$this->filename = 'product';
		$this->defaultUrl = 'product';
		$this->labelSingular = 'product';
		$this->labelPlural = 'products';
		$this->tablename = "products";
		$this->allowReorder = false;
		$this->load->model(SITE_ADMIN_DIR_NAME . "/" . $this->filename . "_model", "objModel");
		$this->load->model(SITE_ADMIN_DIR_NAME . "/" . SITE_ADMIN_DIR_NAME . "_model", "admin_model");
	}

	public function index()
	{
		$pageData['title'] = "Manage " . ucfirst($this->labelPlural);;
		$pageData['faIconClass'] = $this->faIconClass;
		$this->load->view(SITE_ADMIN_DIR_NAME . DIRECTORY_SEPARATOR . $this->filename . "_manage", array("pageData" => $pageData));
	}
	public function add()
	{
		$pageData = [];
		$pageData['title'] = "Add " . ucfirst($this->labelPlural);;
		$pageData['faIconClass'] = $this->faIconClass;
		$pageData['data']['mode'] = "add";
		$pageData['data']['recordId'] = 0;
		$pageData['get_categories'] = $this->objModel->get_categories();
		$this->load->view(SITE_ADMIN_DIR_NAME . DIRECTORY_SEPARATOR . $this->filename, array("pageData" => $pageData));
	}

	public function edit($recordId)
	{
		if (trim($recordId) == "" || trim($recordId) <= 0) {
			redirect($this->defaultUrl);
		}
		$pageData = [];
		$pageData['title'] = "Edit " . ucfirst($this->labelPlural);
		$pageData['faIconClass'] = $this->faIconClass;
		$pageData['data']['mode'] = 'edit';
		$pageData['data']['recordId'] = $recordId;
		$pageData['data']['record'] = [];
		$records = $this->db->query("SELECT * FROM " . $this->tablename . " WHERE id = '" . $recordId . "'");
		if ($records->num_rows() > 0) {
			$pageData['data']['record'] = $records->row_array();
			$pageData['get_categories'] = $this->objModel->get_categories();
			$this->load->view(SITE_ADMIN_DIR_NAME . DIRECTORY_SEPARATOR . $this->filename, ['pageData' => $pageData]);
		} else {
			$this->load->view(SITE_ADMIN_DIR_NAME . DIRECTORY_SEPARATOR . $this->filename);
		}
	}

	public function save($recordId = 0)
	{
		$result = ["success" => 0, "error" => 0, "message" => "", "data" => []];
		if ($this->input->is_ajax_request()) {

			$this->form_validation->set_rules('pro_name', 'Product name', "trim|required");
			$this->form_validation->set_rules('pro_desc[]', 'Product description', 'required|trim');
			$this->form_validation->set_rules('pro_price', 'Pro price', "trim|required");
			$this->form_validation->set_rules('pro_availability', 'Product availability', 'required|trim|numeric');
			if ($this->form_validation->run() == TRUE) {

				$record['name'] = $this->input->get_post('pro_name');
				$record['description'] = $this->input->get_post('pro_desc');
				$record['description'] =implode('<<>>',$record['description']);
			
				$record['price'] = $this->input->get_post('pro_price');
				$record['availability'] = $this->input->get_post('pro_availability');
				$record['status'] = $this->input->get_post('status');
				$checkbox = $this->input->get_post('checkbox');
				if (is_array($checkbox) && $checkbox <> "") {
					$record['functionality'] = implode(',', $checkbox);
				}
				$record['category_id'] = $this->input->get_post('pro_category');
				$record['category_id'] = $this->input->get_post('pro_category');
				$file_upload_config = array();
				$file_upload_config['field_name'] = 'pro_img';
				$file_upload_config['upload_path'] = './data/product_images/.';
				$currentFile = $this->ideate_model->get_row($this->tablename, 'img', "id='" . $recordId . "'");
				$file_upload_config['delete_file'] = $currentFile;
				$file_upload_config['file_name'] = $recordId . "_" . rand(0, 99) . "_" . time();
				$file_upload_config['allowed_types'] = 'gif|jpg|jpeg|png';
				$file_upload_config['max_size'] = 10024;
				$file_upload_config['upload_result'] = $this->ideate_model->file_upload($file_upload_config);

				if ($file_upload_config['upload_result']['success'] == 1 || $file_upload_config['upload_result']['no_file_selected'] == 1) {
					if ($file_upload_config['upload_result']['success'] == 1) {
						$record['img'] = $file_upload_config['upload_result']['data']['file_name'];
					}
					if ($file_upload_config['upload_result']['success'] <> 1 && $recordId == 0) {

						$record['img'] = '0_44_1696238771.png';
					}
					if ($record['category_id'] <> "" && $record['category_id'] <> 0) {
						$result = $this->objModel->save($recordId, $record);
					} else {
						$result['error'] = 1;
						$result['message'] = "Category not exists";
					}
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
			} else {
				$result['error'] = 1;
				$result['data'] = ['pro_name' => form_error('pro_name'),
				 'pro_desc' => form_error('pro_desc[]'),
				 'pro_price' => form_error('pro_price'),
				 'pro_availability' => form_error('pro_availability'),
				 'pro_img' => form_error('pro_img')];
			}
		} else {
			$result['error'] = 1;
			$result['message'] = "Invalid Request";
		}

		echo json_encode($result);
	}


	public function delete($recordId)
	{
		$result = array('success' => 0, 'error' => 0, 'message' => '', 'data' => array());
		if ($this->input->is_ajax_request()) {
			$result = $this->objModel->delete($recordId);
			if ($result['success'] == 1) {
				$this->ideate_model->set_message("succ", $result['message'], "admin");
			} else {
				$this->ideate_model->set_message("err", $result['message'], "admin");
			}
		} else {
			$result['error'] = 1;
			$result['message'] = "Invalid Request";
		}
		echo json_encode($result);
	}

	public function get()
	{
		$selectCols = "*";
		$searchableCols = array("id", "name", "price", "category_id", "description", 'img', 'functionality', 'availability');
		$sortableCols = array(null,"id", "name", "price", "category_id", "description", 'img', 'functionality', 'availability', null);
		$response = array("draw" => 0, "recordsTotal" => 0, "recordsFiltered" => 0, "data" => array());
		$response['draw'] = $this->input->post("draw");
		$search = $this->input->post("search")["value"];
		$order = is_array($this->input->post("order")) ? $this->input->post("order")[0] : [];
		$start = $this->input->post("start");
		$length = $this->input->post("length");
		$qry = "SELECT {columns} FROM " . $this->tablename . " WHERE status != 'trash'";
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
			$qry .= " id DESC";
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
				$actionButtons .= ' <a href="javascript:void(0);" onclick="deleteConfirm(\'' . $row['id'] . '\');" class="btn btn-danger btn-label-left icon-btn">
						<span><i class="fa fa-trash-o"></i></span>
					</a>';


				$status = ($row['status'] == 'active') ? 'checked="checked"' : "";


				$record = array('DT_RowId' => $row['id']);
				if ($this->allowReorder) {
					$record[] = $row['display_order'];
				}

				$record[] = '<div class="dataTable-checkbox checkbox-inline">
										<label>
										<input type="checkbox" class="inputBatchOperations" name="recordIds[]" value="' . $row['id'] . '">
										</label>
										</div>';

				$record[] = $row['id'];
				$record[] = $row['name'];
				$record[] = "$" . $row['price'] . ".00";
				$category_name = $this->ideate_model->get_row('categories', 'name', "id=$row[category_id]");
				$record[] = $category_name;
				$record[] = "<img src=" . base_url() . "data/product_images/$row[img] width='70px' height='70px' style='border-radius:50%'>";

				$record[] = '<div class="toggle-switch toggle-switch-success" style="width:87px;">
								<label>
									<input type="checkbox" name="toggleSwitch[]" id="toggleSwitch' . $row['id'] . '" value="' . $row['id'] . '" ' . $status . ' onClick="toggleSwitch(this);">
									<div class="toggle-switch-inner toggle-switch-actin-inner"></div>
									<div class="toggle-switch-switch toggle-switch-switch-dangeroff"><i class="fa fa-check"></i></div>
								</label>
							</div>';
				$record[] = $actionButtons;

				$response["data"][] = $record;
			}
		}
		// echo $this->db->last_query();
		echo json_encode($response);
	}

	public function batchOperations()
	{
		$result = array('success' => 0, 'error' => 0, 'message' => '', 'data' => array());

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
					$this->ideate_model->set_message("succ", $this->labelSingular . " deleted suucessfully.", "admin");
					$result['success'] = 1;
				} else {
					$this->ideate_model->set_message("err", "One or more " . $this->labelSingular . " can not be deleted.", "admin");
					$result['error'] = 1;
				}
			} else {
				$this->ideate_model->set_message("err", "No " . $this->labelSingular . " selected.", "admin");
				$result['error'] = 1;
			}
		}

		echo json_encode($result);
	}

	public function changeStatus(){
		$result = array('success' => 0, 'error' => 0, 'message' => '', 'data' => array());
		$recordId = $this->input->get_post('recordId');
		$status = ($this->input->get_post('status') == "true") ? "active" : "inactive";
		$updateRecordQuery = "UPDATE " . $this->tablename . " SET status='" . $status . "', updated_by=" . $this->admin_model->loggedInAdminId . ", updated_at=NOW() WHERE id='" . $recordId . "'";
		if ($this->db->query($updateRecordQuery)) {
			$result['success'] = 1;
			$result['message'] = $this->labelSingular . " status changed successfully.";
		} else {
			$result['error'] = 1;
			$result['message'] = "Failed to change status of the " . $this->labelSingular . ".";
		}
		echo json_encode($result);
	}
}
