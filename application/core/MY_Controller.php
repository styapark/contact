<?php
/**
 * My Controller class of Core Class
 * My Lite CMS v.3.0.0
 * copyright Styapark Dev 2016 - 2021
 * @author styapark
 * @email styapark@gmail.com
 * All rights reserved.
 */

class MY_Controller extends CI_Controller {
    public $cms_name;
    public $cms_motto;
    public $cms_themes;
    public $cms_version;
    public $dir_page = 'pages/';
    public $dir_admin = 'power-admin/';
    public $theme;
    public $power_base;
    public $data;
    public $login_require;
    public $is_login;

    public function __construct() {
        parent::__construct();
        if ( IS_LOCAL ) {
            ini_set('opcache.enable', 0);
        }

        $this->lang->load('auth');
        $this->config->load('mylite');
        $this->power_base = MyLite_base.$this->dir_admin;
        
        // mengambil nama config dari mylite [title]
        $this->cms_name = $this->title = $this->config->item('title');
        // mengambil nama config dari mylite [motto]
        $this->cms_motto = $this->config->item('motto');
        // mengambil nama config dari mylite [themes]
        $this->cms_themes = $this->config->item('themes');
        $this->theme = 'themes/'.$this->cms_themes;
        // mengambil nama config dari mylite [version]
        $this->cms_version = $this->config->item('version');
        
        // memuat keamanan csrf
        $this->csrf = [ 'name' => $this->security->get_csrf_token_name(), 'hash' => $this->security->get_csrf_hash() ];
        
        $this->data['print'] = FALSE;
        $this->data['title'] = $this->title.' - v'.$this->cms_version;
        $this->data['csrf']  = $this->csrf;
        $this->data['cms_name'] = $this->cms_name;
        $this->data['cms_motto'] = $this->cms_motto;
        $this->data['cms_themes'] = $this->cms_themes;
        $this->data['cms_version'] = $this->cms_version;
        $this->data['dir_admin'] = $this->dir_admin;
        $this->data['dir_page'] = $this->dir_page = $this->theme.$this->dir_page;
        $this->data['preloader'] = FALSE;
        $this->data['__FUNCTION__'] = NULL;
        $this->data['identity'] = $this->config->item('identity', 'ion_auth');

        if ( !empty($this->m_setup->system('name')) ) {
            $this->data['title'] = $this->m_setup->system('name');
        }
        if ( !empty($this->m_setup->system('preloader')) ) {
            $this->data['preloader'] = $this->m_setup->system('preloader') == 'true' ? TRUE: FALSE;
        }
    }

    protected function require_login( $is_required = FALSE ) {
        if ( $is_required ) {
            $this->login_require = (bool) $is_required;
            if ( !$this->ion_auth->logged_in() ) {
                $this->is_login = FALSE;
            }
            if ( $this->ion_auth->logged_in() ) {
                $this->is_login = TRUE;
            }
        }
    }
}
