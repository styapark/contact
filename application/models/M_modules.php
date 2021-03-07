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
    public $list = [];
    public function __construct() {
        parent::__construct();
        if ( !class_exists('M_setup') ) {
            die('File M_setup is not found');
        }

        $list = $this->m_setup->system('modules');
        if ( is_json($list) ) {
            $list = json_decode($list);
            if ( !empty($list) ) {
                foreach ($list as $name_module) {
                    if ( !empty($name_module) && !$this->load->is_loaded($name_module) ) {
                        if ( file_exists(APPPATH.'models/'. ucfirst($name_module).'.php') ) {
                            $this->load->model($name_module);
                            $this->list[] = $name_module;
                        }
                    }
                }
            }
        }
    }
}
