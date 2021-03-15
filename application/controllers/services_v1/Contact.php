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

    // delete
    public function index_get( $id ) {
        $this->data['data'] = $id;
        $this->data['status'] = (bool) $this->data['data'];

        $this->responses($this->data, $this->data['status'] ? 200: 406);
    }

    // table
    public function table_get() {
//        $id = $hash = $name = $company = $address = $address_company = $created = $modified = NULL;
//        $type = $title = $value = NULL;
//        $created = date('Y-m-d H:i:s');$array
//        $db = $this->m_contact->fetch($id, $hash, $name, $company, $address, $address_company, $created, $modified);
        $db = $this->m_contact->fetch();

        $columns = [
            'name_'.$this->m_contact->table,
            'company_'.$this->m_contact->table,
            'address_'.$this->m_contact->table,
            'address_company_'.$this->m_contact->table,
        ];

        $this->datatables->set_column($columns)->exec($db);
        $this->data = $this->datatables->render(function( $row, $index, $table, $prev_row ){
            $fields = array_keys((array)$row);
            $row = (object) rm_tableresult($fields, $row, $this->m_contact->table);
            $row->{'#'} = @$_GET['start']+$index+1;

            $this->m_contact->fetch_detail(NULL, NULL, $row->id);
            $row->details = $this->m_contact->get_data_global( $this->m_contact->table_details );
            $row->tags = [];
            $row->tags_text = implode(', ', $row->tags);

            return $row;
        });

        $this->responses($this->data, 200);
    }

    // added
    public function add_post() {
        $this->data['data'] = $this->m_contact->set_data( $this->post() );
        $this->data['status'] = (bool) $this->data['data'];

        $this->responses($this->data, $this->data['status'] ? 201: 406);
    }

    // edited
    public function edit_post() {
        $this->data['data'] = $this->m_contact->set_data( $this->post() );
        $this->data['status'] = (bool) $this->data['data'];

        $this->responses($this->data, $this->data['status'] ? 200: 406);
    }
}
