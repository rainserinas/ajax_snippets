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

define('FOLDER_CSS',			'css/');
define('FOLDER_JS',				'js/');
define('FOLDER_IMG',			'img/');
define('FOLDER_AUDIO',			'audio/');
define('FOLDER_ICON',			'img/icons/');
define('FOLDER_USERS',			'assets/images/users/');
define('FOLDER_GALLERY',			'assets/uploads/gallery/');

define('FOLDER_UPLOAD_PAGES', 'http://' . $_SERVER["SERVER_NAME"] . '/johann/asianland/img/uploads/site/pages/');
define('FOLDER_UPLOAD_ABOUT', 'http://' . $_SERVER["SERVER_NAME"] . '/johann/asianland/img/uploads/site/about/');
define('FOLDER_UPLOAD_COMMUNITY', 'http://' . $_SERVER["SERVER_NAME"] . '/johann/asianland/img/uploads/site/community/');
define('FOLDER_UPLOAD_COMMUNITY_HOUSES', 'http://' . $_SERVER["SERVER_NAME"] . '/johann/asianland/img/uploads/site/community/houses/');
define('FOLDER_UPLOAD_COMMUNITY_GALLERY', 'http://' . $_SERVER["SERVER_NAME"] . '/johann/asianland/img/uploads/site/community/gallery/');
define('FOLDER_UPLOAD_NEWS', 'http://' . $_SERVER["SERVER_NAME"] . '/johann/asianland/img/uploads/site/news/');

//CMS Plugins
define('CK_EDITOR', FOLDER_JS.'ckeditor/');
define('CK_FINDER', FOLDER_JS.'ckfinder/');
define('CUSTOM_FILEINPUT', FOLDER_JS.'customfileinput/');

/* LINKS */
define('EMAIL_CONTACT', 'johann.dbmanila@gmail.com');
define('EMAIL_PASSWORD', 'xdr5TGBhu8');

/* End of file constants.php */
/* Location: ./application/config/constants.php */