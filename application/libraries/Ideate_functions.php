<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Encryption Class
 *
 * Provides two-way keyed encoding using Mcrypt
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/encryption.html
 */
class ideate_functions {
	
	public $CI;
	
	function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->helper('url');
		$this->CI->load->library('session');
	}
	

}

// END CI_Encrypt class

/* End of file Encrypt.php */
/* Location: ./system/libraries/Encrypt.php */
