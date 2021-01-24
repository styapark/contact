<?php
/**
 * My Lite CMS v.3.0.0
 * copyright Styapark Dev 2016 - 2021
 * @author styapark
 * @email styapark@gmail.com
 * All rights reserved.
 */

defined('BASEPATH') OR exit('No direct script access allowed');
$active_group = IS_LOCAL ? 'local': 'hosting';
$query_builder = TRUE;

$db['hosting'] = [
	'dsn'		=> '',
	'hostname'	=> 'localhost',
	'username'	=> 'root',
	'password'	=> 'zombie',
	'database'	=> 'contact',
	'dbdriver'	=> 'mysqli',
	'dbprefix'	=> 'ct_',
	'pconnect'	=> FALSE,
	'db_debug'	=> (ENVIRONMENT !== 'production'),
	'cache_on'	=> FALSE,
	'cachedir'	=> '',
	'char_set'	=> 'utf8',
	'dbcollat'	=> 'utf8_general_ci',
	'swap_pre'	=> '',
	'encrypt'	=> FALSE,
	'compress'	=> FALSE,
	'stricton'	=> FALSE,
	'failover'	=> array(),
	'save_queries'	=> TRUE
];

$db['local'] = [
	'dsn'		=> '',
	'hostname'	=> 'localhost',
	'username'	=> '',
	'password'	=> '',
	'database'	=> 'contact',
	'dbdriver'	=> 'mysqli',
	'dbprefix'	=> 'ct_',
	'pconnect'	=> FALSE,
	'db_debug'	=> (ENVIRONMENT !== 'production'),
	'cache_on'	=> FALSE,
	'cachedir'	=> '',
	'char_set'	=> 'utf8',
	'dbcollat'	=> 'utf8_general_ci',
	'swap_pre'	=> '',
	'encrypt'	=> FALSE,
	'compress'	=> FALSE,
	'stricton'	=> FALSE,
	'failover'	=> array(),
	'save_queries'	=> TRUE
];

if ( stristr(MyLite_base,'mizombie') ) {
    $db['local']['hostname'] = 'localhost';
    $db['local']['username'] = 'root';
    $db['local']['password'] = 'zombie';
    $db['local']['database'] = 'contact';
}