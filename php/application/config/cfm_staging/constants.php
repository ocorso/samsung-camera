<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//oc: sitewide constants since environment switching isn't setup right

define('EMAIL_SUBJECT',							"Share the world the way you see it.");
define('SAMSUNG_ALBUM_NAME',					"Samsung Smart Camera Experience");
define('GALLERY_PANELS_PER_PAGE',				12);
define('GOOGLE_ANALYTICS_ID',					'UA-XXXXX-X9');
										//		 http://www.facebook.com/SamsungStaging/app_400246196682777
define('INSTALLED_PAGE_URL',					'http://www.facebook.com/SamsungStaging/app_400246196682777'); // This is a fallback value. The installed page url will be set by the facebook signed request when available.
define('ABSOLUTE_URL',							"http://staging.click3x.com/bigfuel/samsungcamera/");
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

/* End of file constants.php */
/* Location: ./application/config/constants.php */