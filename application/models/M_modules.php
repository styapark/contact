<?php
/**
 * M_setup class of Model Class
 * My Lite CMS v.3.0.0
 * copyright Styapark Dev 2016 - 2021
 * @author styapark
 * @email styapark@gmail.com
 * All rights reserved.
 */

class M_modules extends CI_Model {
    protected $list = [];
    public function __construct() {
        if ( !class_exists('M_setup') ) {
            die('File M_setup is not found');
        }

        $list = $this->m_setup->system('modules');
        if ( is_json($list) ) {
            $this->list = json_decode($list);
        }
    }

    public function load( $name_modules = NULL ) {
        if ( !empty($name_modules) && in_array($name_modules, $this->list) ) {
            return $this->load->model($name_modules);
        }
        return FALSE;
    }
}
