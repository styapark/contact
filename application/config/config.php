<?php
/**
 * My Lite CMS v.3.0.0
 * copyright Styapark Dev 2016 - 2021
 * @author styapark
 * @email styapark@gmail.com
 * All rights reserved.
 */

defined('BASEPATH') OR exit('No direct script access allowed');
$config['base_url']             = MyLite_base;
$config['index_page']           = '';
$config['uri_protocol']	        = 'REQUEST_URI';
$config['url_suffix']           = '';
$config['language']	        = 'english';
$config['charset']              = 'UTF-8';
$config['enable_hooks']         = FALSE;
$config['subclass_prefix']      = 'MY_';
$config['composer_autoload']    = FALSE;
$config['permitted_uri_chars']  = 'a-z 0-9~%.:_\-';
$config['enable_query_strings'] = FALSE;
$config['controller_trigger']   = 'c';
$config['function_trigger']     = 'm';
$config['directory_trigger']    = 'd';
$config['allow_get_array']      = TRUE;
$config['log_threshold']        = 0;
$config['log_path']             = '';
$config['log_file_extension']   = '';
$config['log_file_permissions'] = 0644;
$config['log_date_format']      = 'Y-m-d H:i:s';
$config['error_views_path']     = '';
$config['cache_path']           = '';
$config['cache_query_string']   = FALSE;
$config['encryption_key']       = hex2bin('4B6250655368566D5971337436773979');
$config['sess_driver']          = 'database';
$config['sess_cookie_name']     = 'mylite_session';
$config['sess_expiration']      = 60 * 60 * 24 * 7;
$config['sess_save_path']       = 'ct_sessions';
$config['sess_match_ip']        = FALSE;
$config['sess_time_to_update']  = 64000;
$config['sess_regenerate_destroy'] = FALSE;
$config['cookie_prefix']	= '';
$config['cookie_domain']	= '';
$config['cookie_path']		= '/';
$config['cookie_secure']	= FALSE;
$config['cookie_httponly'] 	= FALSE;
$config['standardize_newlines'] = FALSE;
$config['global_xss_filtering'] = FALSE;
$config['csrf_protection']      = TRUE;
$config['csrf_token_name']      = 'csrf_form_name';
$config['csrf_cookie_name']     = 'csrf_cookie_name';
$config['csrf_expire']          = 7200;
$config['csrf_regenerate']      = TRUE;
$config['csrf_exclude_uris']    = [
    'token'
];
$config['compress_output']      = TRUE;
$config['time_reference']       = 'UTC';
$config['rewrite_short_tags']   = FALSE;
$config['proxy_ips']            = '';
