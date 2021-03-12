<?php
/**
 * Auth class of Api Services Class
 * My Lite CMS v.3.0.0
 * copyright Styapark Dev 2016 - 2021
 * @author styapark
 * @email styapark@gmail.com
 * All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_accounts extends API_Controller{
    public function __construct() {
        parent::__construct(TRUE);

        $this->load->model('m_accounts');
    }

    public function get_get() {
        $this->m_accounts->set_method();
        $this->data = $this->m_accounts->get_data( NULL, NULL, NULL, TRUE, TRUE);
        
        $this->response($this->data, $this->data ? 200: 406);
    }

    public function index_post() {
        $this->data['data'] = $this->m_accounts->set_data($this->post());
        $this->data['status'] = (bool) $this->data['data'];
        
        $this->response($this->data, $this->data['status'] ? 200: 406);
    }

    public function delete_get( $id ) {
        $this->data['data'] = $this->m_accounts->delete($id);
        $this->data['status'] = (bool) $this->data['data'];
        
        $this->response($this->data, $this->data['status'] ? 200: 406);
    }
}
