<?php
/**
 * Contact class of Api Services Class
 * My Lite CMS v.3.0.0
 * copyright Styapark Dev 2016 - 2021
 * @author styapark
 * @email styapark@gmail.com
 * All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends API_Controller{
    public function __construct() {
        parent::__construct(TRUE);

        $this->load->library('datatables');
    }

    public function index_post() {
        $this->data['status'] = (bool) $this->data['data'];

        $this->responses($this->data, $this->data['status'] ? 200: 406);
    }

    public function table_get() {
        $id = $hash = $name = $company = $address = $address_company = $created = $modified = NULL;
        $created = date('Y-m-d H:i:s');
        $db = $this->m_contact->fetch($id, $hash, $name, $company, $address, $address_company, $created, $modified);

        $columns = [
            
        ];

        $this->datatables->set_column($columns)->exec($db);
        $this->data = $this->datatables->render(function( $row, $index, $table, $prev_row ){
            

            return $row;
        });

        $this->responses($this->data, 200);
    }
}
