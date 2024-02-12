<?php

	function log_queries() 
	{
		$CI =& get_instance();
		$times = $CI->db->query_times;

		// delete a week ago file
		$weekAgoDate = date('Y-m-d', strtotime("-7 days"));
		$fileLocation=FCPATH.'application'.DIRECTORY_SEPARATOR.'logs'.DIRECTORY_SEPARATOR.'sql'.DIRECTORY_SEPARATOR.$weekAgoDate.'.txt';
		if(file_exists($fileLocation)){
			unlink($fileLocation);
		}

		// save all query
		$CI->load->helper('file');
		$logFile = FCPATH.'application'.DIRECTORY_SEPARATOR.'logs'.DIRECTORY_SEPARATOR.'sql'.DIRECTORY_SEPARATOR.date('Y-m-d').'.txt';

		$fileContnet='';
		foreach ($CI->db->queries as $key=>$query) {
			$fileContnet.=date('Y-m-d H:i:s')." | ".$times[$key]." : ". $query . "\r\n";
		}
		write_file($logFile,$fileContnet,"a+");
	
		$CI->output->_display();
	}
