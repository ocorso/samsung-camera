<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//oc: environment config, will be overwritten in specific domain folders.
$config['facebook_app_id'] 		= '414203225287393'; 
$config['facebook_app_secret'] 	= '7f8c35b31236ea4c15343f2d6847bac8'; 
$config['carbon_email'] 		= 'owen@click3x.com';
$config['photobucket_app_id'] 	= '149832927'; 
$config['photobucket_app_secret'] = 'bab9cfe3bfa94ed18b5f070ccaff1fff'; 
$config['app_short_url']		= "http://on.fb.me/SQn7Zm";

//oc: system config, these probably won't change.
$config['base_url']				= '';
$config['index_page'] 			= 'index.php';
$config['uri_protocol']			= 'AUTO';
$config['url_suffix'] 			= '';
$config['language']				= 'english';
$config['charset'] 				= 'UTF-8';
$config['enable_hooks'] 		= FALSE;
$config['subclass_prefix'] 		= 'MY_';
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';
$config['allow_get_array']		= TRUE;
$config['enable_query_strings'] = FALSE;
$config['controller_trigger']	= 'c';
$config['function_trigger']		= 'm';
$config['directory_trigger']	= 'd'; // experimental not currently in use
$config['log_threshold'] 		= 4;
$config['log_path'] 			= '../../../source/';
$config['log_date_format'] 		= 'Y-m-d H:i:s';
$config['cache_path'] 			= '';
$config['encryption_key'] 		= 'h@ckp40FowenLovE$CODEandkfld;agj';
$config['sess_cookie_name']		= 'ci_session';
$config['sess_expiration']		= 7200;
$config['sess_expire_on_close']	= FALSE;
$config['sess_encrypt_cookie']	= FALSE;
$config['sess_use_database']	= FALSE;
$config['sess_table_name']		= 'ci_sessions';
$config['sess_match_ip']		= FALSE;
$config['sess_match_useragent']	= TRUE;
$config['sess_time_to_update']	= 300;
$config['cookie_prefix']		= "";
$config['cookie_domain']		= "";
$config['cookie_path']			= "/";
$config['cookie_secure']		= FALSE;
$config['global_xss_filtering'] = FALSE;
$config['csrf_protection'] 		= FALSE;
$config['csrf_token_name'] 		= 'csrf_test_name';
$config['csrf_cookie_name'] 	= 'csrf_cookie_name';
$config['csrf_expire'] 			= 7200;
$config['compress_output'] 		= FALSE;
$config['time_reference'] 		= 'local';
$config['rewrite_short_tags'] 	= FALSE;
$config['proxy_ips'] 			= '';


/* End of file config.php */
/* Location: ./application/config/config.php */
