<?php
/**
 * My Lite CMS v.3.0.0
 * copyright Styapark Dev 2016 - 2021
 * @author styapark
 * @email styapark@gmail.com
 * All rights reserved.
 */

defined('BASEPATH') OR exit('No direct script access allowed');
$autoload['packages'] = [];
$autoload['libraries'] = [
    'database',
    'session',
    'encryption',
    'ion_auth',
    'datatables'
];
$autoload['drivers'] = [];
$autoload['helper'] = [
    'url',
    'cookie',
    'form',
    'file',
    'common',
];
$autoload['config'] = [];
$autoload['language'] = [];
$autoload['model'] = [
    'ion_auth_model',
    'm_setup',
    'm_modules'
];
