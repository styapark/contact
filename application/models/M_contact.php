<?php
/**
 * M_contact class of Model Class
 * My Lite CMS v.3.0.0
 * copyright Styapark Dev 2016 - 2021
 * @author styapark
 * @email styapark@gmail.com
 * All rights reserved.
 */

class M_contact extends CI_Model {
    public $table;

    public function __construct() {
        $this->table = get_nametable($this);
    }

    public function fetch( $id = NULL, $hash = NULL, $name = NULL, $company = NULL, $address = NULL, $address_company = NULL, $created = NULL, $modified = NULL ) {
        $this->db->select('*');
        if ( !empty($id) ){
            if ( is_array($id) ) {
                $this->db->where_in( 'id_'.$this->table, force_intval($id) );
            }
            else {
                $this->db->where( 'id_'.$this->table, force_intval($id) );
            }
        }
        if ( !empty($hash) ){
            $this->db->where( 'hash_'.$this->table, force_alphanum($hash) );
        }
        if ( !empty($name) ){
            $this->db->like( 'name_'.$this->table, force_alphanum($name) );
        }
        if ( !empty($company) ){
            $this->db->like( 'company_'.$this->table, force_alphanum($company) );
        }
        if ( !empty($address) ){
            $this->db->like( 'address_'.$this->table, force_alphanum($address) );
        }
        if ( !empty($address_company) ){
            $this->db->like( 'address_company_'.$this->table, force_alphanum($address_company) );
        }

        // filter date
        if ( !empty($created) ){
            $dt_create = @date( 'Y-m-d', @strtotime($created) );
            $create = [
                $dt_create.' 00:00:00',
                $dt_create.' 23:59:59'
            ];
            if ( is_array($created) ) {
                $create = [
                    @date( 'Y-m-d', @strtotime($created[0]) ).' 00:00:00',
                    @date( 'Y-m-d', @strtotime($created[1]) ).' 23:59:59'
                ];
            }
            $this->db->where( 'created_'.$this->table.' >=', $create[0] );
            $this->db->where( 'created_'.$this->table.' <=', $create[1] );
        }
        if ( !empty($modified) ){
            $dt_modify = @date( 'Y-m-d', @strtotime($modified) );
            $modify = [
                $dt_modify.' 00:00:00',
                $dt_modify.' 23:59:59'
            ];
            if ( is_array($modified) ) {
                $modify = [
                    @date( 'Y-m-d', @strtotime($modified[0]) ).' 00:00:00',
                    @date( 'Y-m-d', @strtotime($modified[1]) ).' 23:59:59'
                ];
            }
            $this->db->where( 'modified_'.$this->table.' >=', $modify[0] );
            $this->db->where( 'modified_'.$this->table.' <=', $modify[1] );
        }

        $this->db->order_by('name_'.$this->table, 'ASC');
        return $this->db;
    }

    public function get_data( $id = NULL, $hash = NULL, $name = NULL, $company = NULL, $address = NULL, $address_company = NULL, $created = NULL, $modified = NULL, $full = FALSE, $array_return = FALSE ) {
        $query = $this->fetch($id, $hash, $name, $company, $address, $address_company, $created, $modified)->get($this->table);
        $fields = $query->list_fields();

        if ( $query->num_rows() > 0 ) {
            $temp = [];
            if ( !empty($id) ) {
                $row = $query->row();
                $a = rm_tableresult($fields, $row, $this->table);

                

                return !$array_return ? (object) $a: $a;
            }
            else {
                foreach ($query->result() as $key=>$row) {
                    $a = rm_tableresult($fields, $row, $this->table);

                    

                    $temp[$key] = !$array_return ? (object) $a: $a;
                }
                return $temp;
            }
        }
        return $query->num_rows();
    }
}
