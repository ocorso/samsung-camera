<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$route['default_controller'] 	= "home";
$route['404_override'] 			= '';

//config for flash
$route['xml/config.xml'] 		= "config";
$route['xml/phase2.xml'] 		= "config/phase2";
$route['xml/config'] 			= "config";

$route['learn/(:any)']			= "home/learn/$1";

//gallery
$route['gallery'] 				= "gallery";
$route['gallery/(:num)'] 		= "gallery/detail/$1";
$route['gallery/redirect(:num)']= "gallery/redirect/$1";
$route['gallery/config']		= "gallery/config";

//share
$route['share']					= "share";
$route['share/email']			= "email";
$route['share/reset']		 	= "share/reset";

//facebook
$route['share/facebook']		= "share/facebook";
$route['share/facebook/post']	= "share/postToFacebookAlbum";
$route['redirect/']				= "redirect";
$route['auth']					= "home/redirect";


//photobucket
$route['share/photobucket/auth']		= "share/photobucket";
$route['share/photobucket/callback'] 	= "share/photobucket/$1";
$route['share/photobucket']				= "share/postPhotoToPhotobucketAlbum";

//picasa
$route['share/picasa'] 				= "share/picasa";
$route['share/picasa/auth'] 		= "share/checkPicasaAuth";

//upload
$route['file/upload']			= "file/upload";

//admin cms
$route['share/email/list']		= "email/entries";
$route['admin']					= "admin";
$route['admin/flag']			= "admin/flag";

/* End of file routes.php */
/* Location: ./application/config/routes.php */