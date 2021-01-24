<?php
/**
 * Main class of Page Class
 * My Lite CMS v.3.0.0
 * copyright Styapark Dev 2016 - 2021
 * @author styapark
 * @email styapark@gmail.com
 * All rights reserved.
 */

class Main extends CI_Controller {
    public $title;
    public $theme;
    public $cms_name;
    public $cms_motto;
    public $cms_themes;
    public $cms_version;
    public $dir_page = 'pages/';
    public $dir_admin = 'power-admin/';
    public $control_admin;
    public $data;
    public function __construct() {
        parent::__construct();
        $this->config->load('mylite');

        // mengambil nama config dari mylite [title]
        $this->cms_name = $this->title = $this->config->item('title');
        // mengambil nama config dari mylite [motto]
        $this->cms_motto = $this->config->item('motto');
        // mengambil nama config dari mylite [themes]
        $this->cms_themes = $this->config->item('themes');
        $this->theme = 'themes/'.$this->cms_themes;
        // mengambil nama config dari mylite [version]
        $this->cms_version = $this->config->item('version');
        
        $this->control_admin = str_replace(array('/','\\','"','\'','&','?'), '', str_replace(array('-','_'), ' ', $this->dir_admin) );

        $this->data['print'] = FALSE;
        $this->data['title'] = $this->title.' - v'.$this->cms_version;
        $this->data['preloader'] = FALSE;
    }

    public function index(){
//        $this->load->view( $this->theme.$this->dir_page.'home', $this->data );
        redirect($this->dir_admin);
    }

    public function about(){
        phpinfo();
    }

    public function token() {
        $this->output->set_status_header(500,'Internal Server Error');
    }
}