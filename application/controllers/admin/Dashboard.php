<?php

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model(SITE_ADMIN_DIR_NAME . "/" . SITE_ADMIN_DIR_NAME . "_model", "admin_model");
    }

	public function index()
	{
        $pageData = array();
		$this->load->view(SITE_ADMIN_DIR_NAME . "/dashboard",['pageData'=>$pageData]);
	}

}   
?>