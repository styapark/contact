<?php
/**
 * My Lite CMS v.3.0.0
 * copyright Styapark Dev 2016 - 2021
 * @author styapark
 * @email styapark@gmail.com
 * All rights reserved.
 */


defined('BASEPATH') or exit('No direct script access allowed');
$config['force_https']              = FALSE;
$config['rest_default_format']      = 'json';
$config['rest_supported_formats']   = [
    'json',
    'array',
    'csv',
    'html',
    'jsonp',
    'php',
    'serialized',
    'xml',
];
$config['rest_status_field_name']   = 'status';
$config['rest_message_field_name']  = 'error';
$config['enable_emulate_request']   = true;
$config['rest_realm']               = 'REST API';
$config['rest_auth']                = false;
$config['auth_source']              = 'ldap';
$config['allow_auth_and_keys']      = true;
$config['strict_api_and_auth']      = true; // force the use of both api and auth before a valid api request is made
$config['auth_library_class']       = '';
$config['auth_library_function']    = '';
$config['rest_valid_logins']        = ['admin' => '1234'];
$config['rest_ip_whitelist_enabled'] = false;
$config['rest_handle_exceptions']   = true;
$config['rest_ip_whitelist']        = '';
$config['rest_ip_blacklist_enabled'] = false;
$config['rest_ip_blacklist']        = '';
$config['rest_database_group']      = 'default';
$config['rest_keys_table']          = 'keys';
$config['rest_enable_keys']         = false;
$config['rest_key_column']          = 'key';
$config['rest_limits_method']       = 'ROUTED_URL';
$config['rest_key_length']          = 40;
$config['rest_key_name']            = 'X-API-KEY';
$config['rest_enable_logging']      = false;
$config['rest_logs_table']          = 'logs';
$config['rest_enable_access']       = false;
$config['rest_access_table']        = 'access';
$config['rest_logs_json_params']    = false;
$config['rest_enable_limits']       = false;
$config['rest_limits_table']        = 'limits';
$config['rest_ignore_http_accept']  = false;
$config['rest_ajax_only']           = @$_SERVER['CI_ENV'] == 'development' ? FALSE: TRUE;
$config['rest_language']            = 'english';
$config['check_cors']               = false;
$config['allowed_cors_headers']     = [
    'Origin',
    'X-Requested-With',
    'Content-Type',
    'Accept',
    'Access-Control-Request-Method',
];
$config['allowed_cors_methods']     = [
    'GET',
    'POST',
    'OPTIONS',
    'PUT',
    'PATCH',
    'DELETE',
];
$config['allow_any_cors_domain']    = false;
$config['allowed_cors_origins']     = [];
$config['forced_cors_headers']      = [];
