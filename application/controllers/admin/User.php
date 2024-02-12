<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class user extends CI_Controller
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
		$this->faIconClass = "fa-users";
		$this->filename = 'user';
		$this->defaultUrl = 'user';
		$this->labelSingular = 'user';
		$this->tablename = "users";
		$this->allowReorder = false;
		$this->load->model(SITE_ADMIN_DIR_NAME . "/" . $this->filename . "_model", "objModel");
		$this->load->model(SITE_ADMIN_DIR_NAME . "/admin_model");
	}

	public function index()
	{
		$pageData['title'] = "Manage Users";
		$pageData['faIconClass'] = $this->faIconClass;
		$this->load->view(SITE_ADMIN_DIR_NAME . DIRECTORY_SEPARATOR . $this->filename . "_manage", array("pageData" => $pageData));
	}
	public function add()
	{
		$pageData['title'] = "Add User";
		$pageData['faIconClass'] = $this->faIconClass;
		$pageData['data']['mode'] = "add";
		$pageData['data']['recordId'] = 0;
		$this->load->view(SITE_ADMIN_DIR_NAME . DIRECTORY_SEPARATOR . $this->filename, array("pageData" => $pageData));
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
		$records = $this->db->query("SELECT * FROM ".$this->tablename." WHERE id = '" . $recordId . "'");
		if ($records->num_rows() > 0) {
			$pageData['data']['record'] = $records->row_array();
			$this->load->view(SITE_ADMIN_DIR_NAME . DIRECTORY_SEPARATOR . $this->filename, ['pageData' => $pageData]);
		} else {
			$this->load->view(SITE_ADMIN_DIR_NAME . DIRECTORY_SEPARATOR . $this->filename);
		}
	}


	public function delete($recordId = 0)
	{
		$result = array('success' => 0, 'error' => 0, 'message' => '', 'data' => array());
		$result = $this->objModel->delete($recordId);
		if ($result['success'] == 1) {
			$this->ideate_model->set_message('succ', $result['message'], 'admin');
		} else {
			$this->ideate_model->set_message('succ', $result['message'], 'admin');
		}
		echo json_encode($result);
	}

	public function save($recordId = 0)
	{
		$result = array('success' => 0, 'error' => 1, 'message' => '', 'data' => array());
		if ($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('fname', 'First Name', 'required|trim|max_length[40]|alpha', [
				'alpha' => "First name contains only characters."
			]);
			$this->form_validation->set_rules('lname', 'Last Name', 'required|trim|max_length[40]|alpha', [
				'alpha' => "Last name contains only characters."
			]);
			$this->form_validation->set_rules('phone', 'Phone Number', 'required|trim|exact_length[10]|numeric');
			if ($recordId == 0 || $recordId == "") {
				$this->form_validation->set_rules('email', 'Email', array(
					'required', 'trim', 'min_length[6]', "max_length[50]", 'valid_email', 'regex_match[/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/]',
					array(
						'is_unique_field',
						function ($value) use ($recordId) {
							$this->form_validation->set_message('is_unique_field', 'Entered email already exists.');
							return $this->ideate_model->is_unique_field($this->tablename, $columnName = 'email', $value, $recordId);
						}
					)
				));
				$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|max_length[20]');
			} else {
				$this->form_validation->set_rules('email', 'Email', 'required|trim|min_length[6]|max_length[50]|valid_email|regex_match[/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/]');
				$this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]|max_length[20]');
			}



			if ($this->form_validation->run() == TRUE) {
				$record = [];
				$record['fname'] = $this->input->get_post("fname");
				$record['lname'] = $this->input->get_post("lname");
				$record['phone'] = $this->input->get_post("phone");
				$record['email'] = $this->input->get_post("email");
				$record['status'] = $this->input->get_post("status");
				if ($this->input->get_post("password") <> "") {
					$record['password'] = md5(trim($this->input->get_post("password")));
				}
				$result = $this->objModel->save($recordId, $record);
				if ($result['success'] == 1) {
					$this->ideate_model->set_message("succ", $result['message'], "admin");
				} else {
					$this->ideate_model->set_message("err", $result['message'], "admin");
				}
			} else {
				$result['error'] = 1;
				$result['message'] = "Something Went Wrong";
				$result['data'] = ['fname' => form_error('fname'), 'lname' => form_error('lname'), 'email' => form_error('email'), 'phone' => form_error('phone'), 'password' => form_error('password')];
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
		$searchableCols = array("id", "fname", "lname", "email", "phone", "status");
		$sortableCols = array(null,"id",null,"email", "phone", "status");

		$response = array("draw" => 0, "recordsTotal" => 0, "recordsFiltered" => 0, "data" => array());
		$response['draw'] = $this->input->post("draw");
		$search = $this->input->post("search")["value"];
		$order = is_array($this->input->post("order")) ? $this->input->post("order")[0] : [];
		$start = $this->input->post("start");
		$length = $this->input->post("length");
		$qry = "SELECT {columns} FROM users WHERE status != 'trash'";
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
				// $record[] = '';
				$record[] = '<div class="dataTable-checkbox checkbox-inline">
									<label>
										<input type="checkbox" class="inputBatchOperations" name="recordIds[]" value="' . $row['id'] . '">
									</label>
								</div>';

				$record[] = $row['id'];
				$record[] = $row['fname'] . " " . $row['lname'];
				$record[] = $row['email'];
				$record[] = $row['phone'];
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


	public function batchOperations(){
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