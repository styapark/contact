<?php
/**
 * My Lite CMS v.3.0.0
 * copyright Styapark Dev 2016 - 2021
 * @author styapark
 * @email styapark@gmail.com
 * All rights reserved.
 */

defined('BASEPATH') OR exit('No direct script access allowed');
$config['migration_enabled']        = FALSE;
$config['migration_type']           = 'timestamp';
$config['migration_table']          = 'migrations';
$config['migration_auto_latest']    = FALSE;
$config['migration_version']        = 0;
$config['migration_path']           = APPPATH.'migrations/';
