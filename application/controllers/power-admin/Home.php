<?php
/**
 * Home class of Page Class
 * My Lite CMS v.3.0.0
 * copyright Styapark Dev 2016 - 2021
 * @author styapark
 * @email styapark@gmail.com
 * All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
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
        $this->load->view( $this->theme.$this->dir_admin.'login', $this->data );
    }

    public function dashboard() {
        $this->data['__FUNCTION__'] = __FUNCTION__;
        $this->load->view( $this->theme.$this->dir_admin.__FUNCTION__, $this->data );
    }

    public function view($p=NULL, $q=NULL, $r=NULL){
        $this->ion_auth->logged_in() && (empty($p) || ( !empty($p) && in_array($p, ['login']) ) ) ? redirect($this->power_base.'dashboard'): NULL;
        !$this->ion_auth->logged_in() && !in_array($p, ['login']) ? redirect($this->power_base.'login'): NULL;
        
        $file = !empty($p) ? $p: 'home';
        $map = $file.( !empty($q) ? '/'.$q: '' ).( !empty($r) ? '/'.$r: '' ).( !empty($s) ? '/'.$s: '' ).( !empty($t) ? '/'.$t: '' );
        $this->data['p'] = !empty($p) ? $p: 'home';
        $this->data['q'] = $q;
        
        //$this->output->set_output(VIEWPATH.$this->theme.$this->dir_admin.$file.'.php');
        if ( !file_exists( VIEWPATH.$this->theme.$this->dir_admin.$file.'.php' ) ) {
            show_404();
        }
        
        $this->load->view( $this->theme.$this->dir_admin.$map, $this->data );
    }
}
