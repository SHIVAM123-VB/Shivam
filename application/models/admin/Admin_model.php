<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class admin_model extends CI_Model{

	public $loggedInAdminId;
	public $loggedInAdminFname;
	public $loggedInAdminLname;
	public $loggedInAdminProfilePicture;
	public $loggedInAdminUname;
	public $loggedInAdminEmail;
	public $loggedInAdminType;
	public $loggedInAdminCreatedAt;
	public $loggedInAdminUpdatedAt;
	public $loggedInAdminLastLoggedInAt;
	public $loggedInAdminFullName;

	public $adminTypes = array();
	public $dashboardLinks = array();
	public $leftSidebarLinks = array();

	function __construct(){
		parent::__construct();
		$this->loggedInAdminId = intval($this->session->userdata('sessAdminUserId'));
		if(!$this->loggedInAdminId){
			$this->loggedInAdminFname = trim($this->session->userdata('sessAdminUserFname'));
			$this->loggedInAdminLname = trim($this->session->userdata('sessAdminUserLname'));
			$this->loggedInAdminProfilePicture = trim($this->session->userdata('sessAdminProfilePicture'));
			$this->loggedInAdminUname = trim($this->session->userdata('sessAdminUserUname'));
			$this->loggedInAdminEmail = trim($this->session->userdata('sessAdminUserEmail'));
			$this->loggedInAdminType = trim($this->session->userdata('sessAdminUserType'));
			$this->loggedInAdminCreatedAt = trim($this->session->userdata('sessAdminUserCreatedAt'));
			$this->loggedInAdminUpdatedAt = trim($this->session->userdata('sessAdminUserUpdatedAt'));
			$this->loggedInAdminLastLoggedInAt = trim($this->session->userdata('sessAdminUserLastLoggedInAt'));
			$this->loggedInAdminFullName = trim($this->session->userdata('sessAdminUserFname')) . " " . trim($this->session->userdata('sessAdminUserLname'));

	
			$this->dashboardLinks[] = array(
				"title" => "Admin Users",
				"class" => "bg-blue",
				"faIconClass" => "fa-user-circle",
				"url" => "admin_users",
				"allowedUsers" => array("superadmin")
			);
			$this->dashboardLinks[] = array(
				"title" => "Users",
				"class" => "bg-blue",
				"faIconClass" => "fa-users",
				"url" => "user",
				"allowedUsers" => array("superadmin","admin")
			);
			$this->dashboardLinks[] = array(
				"title" => "Categories",
				"class" => "bg-blue",
				"faIconClass" => "fa-list-alt",
				"url" => "category",
				"allowedUsers" => array("superadmin","admin")
			);
			$this->dashboardLinks[] = array(
				"title" => "Products",
				"class" => "bg-blue",
				"faIconClass" => "fa-cubes",
				"url" => "product",
				"allowedUsers" => array("superadmin","admin")
			);
			$this->dashboardLinks[] = array(
				"title" => "Pages",
				"class" => "bg-blue",
				"faIconClass" => "fa-files-o",
				"url" => "pages",
				"allowedUsers" => array()
			);
			$this->dashboardLinks[] = array(
				"title" => "Orders",
				"class" => "bg-blue",
				"faIconClass" => "fas fa-shopping-cart",
				"url" => "orders",
				"allowedUsers" => array()
			);
	
	
			$this->leftSidebarLinks[] = array(
				"title" => "Dashboard",
				"faIconClass" => "fa-dashboard",
				"url" => "dashboard",
				"isActive" => "1",
				"allowedUsers" => array(),
				"childLinks" => array()
			);
			$this->leftSidebarLinks[] = array(
				"title" => "Admin Users",
				"faIconClass" => "fa-user-circle",
				"url" => "",
				"isActive" => "0",
				"allowedUsers" => array("superadmin"),
				"childLinks" => array(
					array(
						"title" => "Add Admin User",
						"url" => "admin_users/add",
						"isActive" => "0",
						"allowedUsers" => array("superadmin"),
					),
					array(
						"title" => "Manage Admin Users",
						"url" => "admin_users",
						"isActive" => "0",
						"allowedUsers" => array("superadmin"),
					),
				)
			);
			$this->leftSidebarLinks[] = array(
				"title" => "Users",
				"faIconClass"=>"fa-users",
				"url"=>"",
				"isActive" => "0",
				"allowedUsers" => array("superadmin","admin"),
				"childLinks" => array(
					array(
						"title" => "Add User",
						"url" => "user/add",
						"isActive" => "0",
						"allowedUsers" => array("superadmin","admin"),
					),
					array(
						"title" => "Manage Users",
						"url" => "user",
						"isActive" => "0",
						"allowedUsers" => array("superadmin","admin"),
					),
				)
			);
			$this->leftSidebarLinks[] = array(
				"title" => "Categories",
				"faIconClass"=>"fa-list-alt",
				"url"=>"",
				"isActive" => "0",
				"allowedUsers" => array("superadmin","admin"),
				"childLinks" => array(
					array(
						"title" => "Add Category",
						"url" => "category/add",
						"isActive" => "0",
						"allowedUsers" => array("superadmin","admin"),
					),
					array(
						"title" => "Manage Categories",
						"url" => "category",
						"isActive" => "0",
						"allowedUsers" => array("superadmin","admin"),
					),
				)
			);
			$this->leftSidebarLinks[] = array(
				"title" => "Products",
				"faIconClass"=>"fa-cubes",
				"url"=>"",
				"isActive" => "0",
				"allowedUsers" => array("superadmin","admin"),
				"childLinks" => array(
					array(
						"title" => "Add Product",
						"url" => "product/add",
						"isActive" => "0",
						"allowedUsers" => array("superadmin","admin"),
					),
					array(
						"title" => "Manage Products",
						"url" => "product",
						"isActive" => "0",
						"allowedUsers" => array("superadmin","admin"),
					),
				)
			);
			$this->leftSidebarLinks[] = array(
				"title" => "Orders",
				"faIconClass" => "fas fa-shopping-cart",
				"url" => "orders",
				"isActive" => "0",
				"allowedUsers" => array(),
				"childLinks" => array(
				)
			);
		}
	}

	function load_ajax_content($url, $useBaseUrl = TRUE){
		if ($useBaseUrl) {
			$url = base_url($url);
		} ?>
		<script>
			document.addEventListener("DOMContentLoaded", function(event) {
				LoadAjaxContent('<?= $url ?>');
			});
		</script>
		<?php
	}
	
}