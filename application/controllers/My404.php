<?php
class my404 extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model("pages_model");
	}

	public function index($errorData=''){
		$pageData = base64_decode($errorData);
		$this->load->view('errors/html/error_404', array('pageData'=>$pageData)); //loading in custom error view
	}

	public function other($errorData=''){
		$pageData = base64_decode($errorData);
		$this->load->view('errors/html/error_php', array('pageData'=>$pageData)); //loading in custom error view
	}
}