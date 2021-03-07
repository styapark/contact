<?php
/**
 * Contact class of Page Class
 * My Lite CMS v.3.0.0
 * copyright Styapark Dev 2016 - 2021
 * @author styapark
 * @email styapark@gmail.com
 * All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_Controller {
    public $cname;
    public function __construct() {
        parent::__construct();
        $this->cname = $this->data['cname'] = strtolower(get_class($this));

        if ( $this->ion_auth->logged_in() ) {
            $this->data['user_info'] = $this->ion_auth->user()->row();
            $this->data['user_group'] = $this->ion_auth->get_users_groups()->row();
        }
        if ( $this->uri->uri_string == 'power-admin' ) {
            $this->data['preloader'] = FALSE;
        }
        if ( $this->uri->uri_string == 'power-admin' && $this->ion_auth->logged_in() ) {
            redirect($this->dir_admin.'dashboard');
            die();
        }
        if ( $this->uri->uri_string != 'power-admin' && !$this->ion_auth->logged_in() ) {
            redirect($this->dir_admin);
            die();
        }
    }

    public function index() {
//        print_json( APPPATH.$this->dir_admin );
//        print_json($this->theme.$this->dir_admin);
        $this->load->view( $this->theme.$this->dir_admin.$this->cname.'/'.__FUNCTION__, $this->data );
    }
}
