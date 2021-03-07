<?php
/**
 * Contact class of Api Services Class
 * My Lite CMS v.3.0.0
 * copyright Styapark Dev 2016 - 2021
 * @author styapark
 * @email styapark@gmail.com
 * All rights reserved.
 */
require APPPATH . '/libraries/Format.php';
require APPPATH . '/libraries/RestController.php';
use chriskacerguis\RestServer\RestController as REST_Controller;

class Contact extends REST_Controller{
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
        $this->data['status'] = (bool) $this->data['data'];
        
        $this->response($this->data, $this->data['status'] ? 200: 406);
    }

    public function table_get() {
        $id = $hash = $name = $company = $address = $address_company = $created = $modified = NULL;
        $created = date('Y-m-d H:i:s');
        $this->m_contact->get_data($id, $hash, $name, $company, $address, $address_company, $created, $modified);
        $this->data['status'] = (bool) $this->data['data'];
        
        $this->response($this->data, $this->data['status'] ? 200: 406);
    }
}
