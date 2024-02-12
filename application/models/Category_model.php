<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class category_model extends CI_Model{

	public function categories(){
		$response = ['success'=>0,"error"=>0,"message"=>"",'data'=>[]];
		$sql = $this->db->query("SELECT 
								categories.name, categories.icon, categories.id, COUNT(products.id) AS product_count
								FROM categories  
								JOIN products ON categories.id = products.category_id  
								GROUP BY categories.id 
								ORDER BY categories.name
								
								");
		if($sql->num_rows()>0){
			$response['data'] = $sql->result_array();
			$response['success'] = 1;
		}else{
			$response['error'] = 1;
		}
		return $response;
	}
	

}




?>