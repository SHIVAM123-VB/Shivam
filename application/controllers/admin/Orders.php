<?php

class orders extends CI_Controller
{

	var $faIconClass;
	var $filename;
	var $defaultUrl;
	var $labelSingular;
	var $tablename;
	var $allowReorder;

	function __construct()
	{
		parent::__construct();
		$this->faIconClass = "fas fa-shopping-cart";
		$this->filename = 'orders';
		$this->defaultUrl = 'orders';
		$this->labelSingular = 'order';
		$this->tablename = 'orders';
		$this->load->model(SITE_ADMIN_DIR_NAME . "/" . $this->filename . "_model", "objModel");
		$this->load->model(SITE_ADMIN_DIR_NAME . "/" . SITE_ADMIN_DIR_NAME . "_model", "admin_model");
	}

	public function index()
	{
		$pageData = [];
		$pageData['title'] = "Manage " . $this->filename;
		$pageData['faIconClass'] = $this->faIconClass;
		$orderItems = $this->objModel->get();
		if ($orderItems['success'] == 1) {
			$pageData['data']['orderItems'] = $orderItems['data'];
		}
		$this->load->view(SITE_ADMIN_DIR_NAME . "/" . $this->filename . "_manage", ['pageData' => $pageData]);
	}

	public function edit($recordId)
	{
		if (trim($recordId) == "" || trim($recordId) <= 0) {
			redirect($this->defaultUrl);
		}
		$pageData = [];
		$pageData['title'] = "Edit User";
		$pageData['faIconClass'] = $this->faIconClass;
		$pageData['data']['mode'] = 'edit';
		$pageData['data']['recordId'] = $recordId;
		$pageData['data']['record'] = [];
		$records = $this->db->query("SELECT * FROM " . $this->tablename . " WHERE id = '" . $recordId . "'");
		if ($records->num_rows() > 0) {
			$pageData['data']['record'] = $records->row_array();
			$this->load->view(SITE_ADMIN_DIR_NAME . DIRECTORY_SEPARATOR . $this->filename, ['pageData' => $pageData]);
		} else {
			$this->load->view(SITE_ADMIN_DIR_NAME . DIRECTORY_SEPARATOR . $this->filename);
		}
	}

	public function save($recordId = 0)
	{
		$result = ["success" => 0, "error" => 0, "message" => "", "data" => []];
		if ($this->input->is_ajax_request()) {
			if ($recordId == 0 || $recordId == "") {
				if (!$this->objModel->is_unique_field($this->tablename, $field = "name", $value = $this->input->get_post('cname'))) {
					$result['error'] = 1;
					$result['message'] = $this->labelSingular . "already exists";
				}
			}
			$this->form_validation->set_rules('cname', 'Category Name', "trim|required|max_length[50]");
			$this->form_validation->set_rules('c_icon', 'Category Icon', 'required|trim|max_length[50]');

			if ($this->form_validation->run() == TRUE) {
				$record['name'] = $this->input->get_post('cname');
				$record['icon'] = $this->input->get_post('c_icon');
				$record['status'] = $this->input->get_post('status');

				$result = $this->objModel->save($recordId, $record);
				if ($result['success'] == 1) {
					$this->ideate_model->set_message("succ", $result['message'], "admin");
				}
			} else {
				$result['error'] = 1;
				$result['data'] = ['cname' => form_error('cname'), 'c_icon' => form_error('c_icon')];
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

			if (!$this->admin_model->has_user_access(array('superadmin'))) {
				$this->ideate_model->set_message("err", 'Sorry, You don\'t have an access to this page/action.', "admin");
			} else {
				$result = $this->objModel->delete($recordId);
				if ($result['success'] == 1) {
					$this->ideate_model->set_message("succ", $result['message'], "admin");
				} else {
					$this->ideate_model->set_message("err", $result['message'], "admin");
				}
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
		$searchableCols = array("id", "grand_total_price", "status", "address");
		$sortableCols = array(null,"id", "grand_total_price", "status", "address", null);
		$response = array("draw" => 0, "recordsTotal" => 0, "recordsFiltered" => 0, "data" => array());
		$response['draw'] = $this->input->post("draw");
		$search = $this->input->post("search")["value"];
		$order = is_array($this->input->post("order")) ? $this->input->post("order")[0] : [];
		$start = $this->input->post("start");
		$length = $this->input->post("length");
		$qry = "SELECT {columns} FROM " . $this->tablename . " WHERE status != 'cancelled'";
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
				$actionButtons = '<a href="javascript:void(0);" onclick="view(\'' . $row['id'] . '\');" class="btn btn-warning btn-label-left icon-btn" >
									<span><i class="fa fa-eye"></i></span>
								</a>';
				$actionButtons .= '<a class="ajax-page-link btn btn-success btn-label-left icon-btn" href="' . $this->defaultUrl . '/edit/' . $row['id'] . '">
									<span><i class="fa fa-pencil"></i></span>
								</a>';
				$actionButtons .= ' <a href="javascript:void(0);" onclick="deleteConfirm(\'' . $row['id'] . '\');" class="btn btn-danger btn-label-left icon-btn">
						<span><i class="fa fa-trash-o"></i></span>
					</a>';


				$status = ($row['status'] == 'confirm') ? 'checked="checked"' : "";

				$record = array('DT_RowId' => $row['id']);
				if ($this->allowReorder) {
					$record[] = $row['display_order'];
				}

				$record[] = '<div class="dataTable-checkbox checkbox-inline">
									<label>
										<input type="checkbox" class="inputBatchOperations" name="recordIds[]" value="' . $row['id'] . '">
									</label>
								</div>';

				$sql = $this->db->query("SELECT COUNT(order_id) FROM orders_items WHERE order_id = '" . $row['id'] . "'");
				$record[] = $row['id'];
				if ($sql->num_rows() > 0) {
					$count = $sql->row_array();
					$record[] = $count['COUNT(order_id)'];
				}
				$record[] = date(ADMIN_DATE_TIME_FORMAT,strtotime($row['created_at']));
				$record[] = $row['grand_total_price'];
				$record[] = '<div class="toggle-switch toggle-switch-success" style="width:87px;">
											<label>
												<input type="checkbox" name="toggleSwitch[]" id="toggleSwitch' . $row['id'] . '" value="' . $row['id'] . '" ' . $status . ' onClick="toggleSwitch(this);">
												<div class="toggle-switch-inner toggle-switch-actin-inner"></div>
												<div class="toggle-switch-switch toggle-switch-switch-dangeroff">
													<i class="fa fa-check"></i>
												</div>
										</label>
									</div>';
				$record[] = $actionButtons;

				$response["data"][] = $record;
			}
		}
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

	public function view($orderId = 0)
	{
		$result = array('success' => 0, 'error' => 0, 'message' => '', 'data' => array());
		if($this->input->is_ajax_request()){
			$orderId = intval($orderId);
			if ($orderId > 0) {
				$orderItems = $this->objModel->get($orderId);
				if ($orderItems['success'] == 1) {
					$result['data']['order_items'] = $orderItems['data'];
				}else{
					$result['message'] = 'No data found';
				}
			}
		}else{
			$result['error'] = 1;
			$result['message'] = 'Invalid Request';
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
