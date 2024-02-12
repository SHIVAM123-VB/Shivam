<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
|--------------------------------------------------------------------------
| General Site Settings
|--------------------------------------------------------------------------
*/

$settings=array();

require_once( BASEPATH .'database/DB.php');
$db =& DB();

$websiteSettingsQuery="SELECT * FROM settings ORDER BY name";
$resultSettings = $db->query($websiteSettingsQuery);
if($resultSettings->num_rows()>=1)
{
	foreach($resultSettings->result_array() as $resultSetting)
	{
		$settings[$resultSetting['name']]=$resultSetting['value'];
	}
}

define('SITE_NAME',$settings['site_name']);
define('SITE_NAME_SLUG',str_replace(" ","_",strtolower(SITE_NAME)));
define('SITE_TAGLINE',$settings['site_tagline']);
define('SITE_LOGO',$settings['site_logo']);
define('SITE_ADMIN_DIR_NAME','admin');
define('SITE_ADMIN_EMAIL',$settings['site_admin_email']);
define('SITE_OUTGOING_EMAIL',$settings['site_outgoing_email']);

/*
|--------------------------------------------------------------------------
| Date Time Format
|--------------------------------------------------------------------------
*/

define('ADMIN_DATE_FORMAT',				'd-m-Y');
define('ADMIN_TIME_FORMAT',				'h:i A');
define('ADMIN_DATE_TIME_FORMAT',		'd-m-Y h:i A');
define('ADMIN_SQL_DATE_FORMAT',			'%d-%m-%Y');
define('ADMIN_SQL_TIME_FORMAT',			'%h:%i%p');
define('ADMIN_SQL_DATE_TIME_FORMAT',	'%d-%m-%Y %h:%i%p');

define('SITE_DATE_FORMAT',				'd-m-Y');
define('SITE_TIME_FORMAT',				'h:i A');
define('SITE_DATE_TIME_FORMAT',			'd-m-Y  h:i A');
define('SITE_SQL_DATE_FORMAT',			'%d-%m-%Y');
define('SITE_SQL_TIME_FORMAT',			'%h:%i%p');
define('SITE_SQL_DATE_TIME_FORMAT',		'%d-%m-%Y %h:%i%p');



/* End of file constants.php */
/* Location: ./application/config/constants.php */