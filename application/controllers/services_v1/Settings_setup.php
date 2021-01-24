<?php
/**
 * Auth class of Api Services Class
 * My Lite CMS v.3.0.0
 * copyright Styapark Dev 2016 - 2021
 * @author styapark
 * @email styapark@gmail.com
 * All rights reserved.
 */
require APPPATH . '/libraries/Format.php';
require APPPATH . '/libraries/RestController.php';
use chriskacerguis\RestServer\RestController as REST_Controller;

class Settings_setup extends REST_Controller{
    protected $data;
    public function __construct() {
        parent::__construct();

        $this->data = [
            'status' => FALSE,
            'data' => [],
            'message' => 'None',
            'csrf' => [
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            ]
        ];
    }

    public function index_post() {
        $this->data['data'] = $this->m_setup->update_mass( $this->post() );
        $this->data['status'] = (bool) $this->data['data'];
        
        $this->response($this->data, $this->data['status'] ? 200: 406);
    }
}
