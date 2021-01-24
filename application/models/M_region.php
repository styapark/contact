<?php
/**
 * M_region class of Model Class
 * My Lite CMS v.3.0.0
 * copyright Styapark Dev 2016 - 2021
 * @author styapark
 * @email styapark@gmail.com
 * All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class M_region extends CI_Model {
    public $table;

    public function __construct() {
        parent::__construct();

        $this->table = get_nametable( $this );
    }

    public function fetch( $id = NULL, $id_parent = NULL, $name = NULL, $level = NULL, $code_province = NULL, $code_city = NULL, $code_state = NULL, $code_village = NULL, $order_by = NULL ) {
        $this->db->select('*');
        $this->db->from($this->table);

        if ( !empty($id) ) {
            $this->db->where( 'id_'.$this->table, intval($id) );
        }
        if ( !empty($id_parent) ){
            if ( is_array($id_parent) ) {
                $this->db->where_in( 'id_parent_'.$this->table, force_intval($id_parent) );
            }
            else {
                $this->db->where( 'id_parent_'.$this->table, intval($id_parent) );
            }
        }
        if ( !empty($name) ){
            if ( is_array($name) ) {
                $this->db->where_in( 'name_'.$this->table, force_alphanum($name) );
            }
            else {
                $this->db->where( 'name_'.$this->table, $this->db->escape_str($name) );
            }
        }
        if ( !empty($level) ){
            if ( is_array($level) ) {
                $this->db->where_in( 'level_'.$this->table, force_intval($level) );
            }
            else {
                $this->db->where( 'level_'.$this->table, intval($level) );
            }
        }
        if ( !empty($code_province) ) {
            $this->db->where( 'code_prov_'.$this->table, intval($code_province) );
        }
        if ( !empty($code_city) ) {
            $this->db->where( 'code_city_'.$this->table, intval($code_city) );
        }
        if ( !empty($code_state) ) {
            $this->db->where( 'code_state_'.$this->table, intval($code_state) );
        }
        if ( !empty($code_village) ) {
            $this->db->where( 'code_vill_'.$this->table, intval($code_village) );
        }

        if ( !empty($order_by) ) {
            if ( is_bool($order_by) ) {
                $this->db->order_by( 'name_'.$this->table, 'ASC' );
            }
            else {
                $this->db->order_by( $this->db->escape_str($order_by) );
            }
        }
        return $this->db;
    }

    public function get_data( $id = NULL, $id_parent = NULL, $name = NULL, $level = NULL, $code_province = NULL, $code_city = NULL, $code_state = NULL, $code_village = NULL, $order_by = NULL, $full = FALSE ) {
        $query = $this->fetch($id, $id_parent, $name, $level, $code_province, $code_city, $code_state, $code_village, $order_by)->get();
        $fields = $query->list_fields();

        $temp = [];
        if ( $query->num_rows() > 0 ) {
            foreach ($query->result() as $key=>$row) {
                $a = rm_tableresult( $fields, $row, $this->table );

                $temp[$key] = (object)$a;
            }
            return $temp;
        }
        return $query->num_rows();
    }

    public function get_dropdown( $id = NULL, $id_parent = NULL, $level = NULL ) {
        $query = $this->fetch( $id, $id_parent, NULL, $level )->get();

        $temp = [];
        if ( $query->num_rows() > 0 ) {
            foreach ($query->result() as $row) {
                $temp[ $row->{'id_'.$this->table} ] = ucwords(strtolower($row->{'name_'.$this->table}));
            }
            return $temp;
        }
        return $query->num_rows();
    }

    public function get_parents( $id = NULL, $parents = array(), $first = TRUE ) {
        $check = $this->fetch( $id )->get();

        if ( $check->num_rows() > 0 ) {
            $row = $check->row();
            $fields = array_keys((array) $row);

            $row = rm_tableresult( $fields, $row, $this->table, TRUE );

            if ( !in_array( $row->level, [1,5] ) ) {
                $result = $this->get_parents( $row->id_parent, $parents, FALSE );
                if ( !empty($result->parents) && count($result->parents) > 0 ) {
                    $parents = $result->parents;
                    unset($result->parents);

                    $parents[ $result->level ] = $result;
                }
                else {
                    $parents[ $result->level ] = $result;
                }
            }

            if ( !empty($parents) ) {
                krsort($parents);
                if ( $first ) {
                    $parents = array_values($parents);
                }
                $row->parents = $parents;
            }

            if ( $first && !empty($parents) ) {
                foreach ($parents as $r) {
                    $row->{'id_'.$r->level_label} = $r->id;
                    $row->{'name_'.$r->level_label} = $r->name;
                }
            }
            return $row;
        }
        return FALSE;
    }
}
