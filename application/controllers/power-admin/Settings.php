<?php
/**
 * Settings class of Page Class
 * My Lite CMS v.3.0.0
 * copyright Styapark Dev 2016 - 2021
 * @author styapark
 * @email styapark@gmail.com
 * All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller {
    public $cname;
    public function __construct() {
        parent::__construct();
        $this->cname = $this->data['cname'] = strtolower(get_class($this));

        // model dependencies
        $this->load->model('m_accounts');
        $this->load->model('m_region');

        if ( $this->ion_auth->logged_in() ) {
            $this->data['user_info'] = $this->ion_auth->user()->row();
            $this->data['user_group'] = $this->ion_auth->get_users_groups()->row();
            $this->data['groups'] = $this->m_accounts->groups_dropdown();
            $this->data['login_identity'] = ['username' => 'Username', 'email' => 'Email'];
        }
        $this->data['dropdown_city'] = $this->m_region->get_dropdown(NULL, NULL, 2);
    }

    public function general() {
        $setup = $this->m_setup->system_dropdown();
        $this->data = array_merge($this->data, $setup);
        $this->data['__FUNCTION__'] = __FUNCTION__;

        $this->load->view( $this->theme.$this->dir_admin.$this->cname.'/'.__FUNCTION__, $this->data );
    }

    public function accounts() {
        $this->data['__FUNCTION__'] = __FUNCTION__;
        $this->load->view( $this->theme.$this->dir_admin.$this->cname.'/'.__FUNCTION__, $this->data );
    }

    public function profile() {
        $this->data['__FUNCTION__'] = __FUNCTION__;
        $this->load->view( $this->theme.$this->dir_admin.$this->cname.'/'.__FUNCTION__, $this->data );
    }

    public function change_password() {
        $this->data['__FUNCTION__'] = __FUNCTION__;
        $this->load->view( $this->theme.$this->dir_admin.$this->cname.'/'.__FUNCTION__, $this->data );
    }
}
