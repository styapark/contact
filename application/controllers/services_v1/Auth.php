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

class Auth extends REST_Controller{
    protected $data;
    public function __construct() {
        parent::__construct();

        $this->data = [
            'status' => FALSE,
            'message' => 'None',
            'csrf' => [
                'name' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            ]
        ];
    }

    public function index_get() {
//        $this->config->load('ion_auth');
//        $this->data['data'] = $this->config->item('ion_auth');
        
        $this->response($this->data, $this->data['status'] ? 200: 406);
    }

    public function login_post() {
        // check to see if the user is logging in
        // check for "remember me"
        $remember = (bool) $this->input->post('remember');

        $this->data['status'] = $this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember);
        if ( $this->data['status'] ) {
            $this->data['message'] = strip_tags($this->ion_auth->messages());
        }
        else {
            $this->data['message'] = strip_tags($this->ion_auth->errors());
        }

        $this->response($this->data, $this->data['status'] ? 200: 406);
    }

    public function logout_get() {
        $this->data['status'] = $this->ion_auth->logout();

        $this->response($this->data, $this->data['status'] ? 200: 406);
    }

    public function checking_get() {
        $this->data['status'] = $this->ion_auth->logged_in();

        $this->response($this->data, $this->data['status'] ? 200: 406);
    }
}
