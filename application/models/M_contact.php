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
    public $table_details;

    public function __construct() {
        $this->table = get_nametable($this);
        $this->table_details = 'details';
    }

    public function fetch( $id = NULL, $hash = NULL, $name = NULL, $company = NULL, $address = NULL, $address_company = NULL, $not_deleted = NULL, $created = NULL, $modified = NULL, $order_by = NULL ) {
        $this->db->select('*');
        $this->db->from($this->table);

        // where
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
        if ( empty($not_deleted) ){
            $this->db->where( 'delete_'.$this->table, 0 );
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

        if ( is_string($order_by) ) {
            $this->db->order_by($order_by);
        }
        elseif ( $order_by === FALSE ) {
            
        }
        else {
            $this->db->order_by('name_'.$this->table, 'ASC');
        }
        return $this->db;
    }

    public function like_custom( $field = 'value', $match = '' ) {
        $this->db->like( $field.'_'.$this->m_contact->table, force_alphanum_freetext($match) );

        return $this->db;
    }

    public function get_data( $id = NULL, $hash = NULL, $name = NULL, $company = NULL, $address = NULL, $address_company = NULL, $not_deleted = NULL, $created = NULL, $modified = NULL, $callback = NULL, $array_return = FALSE ) {
        $query = $this->fetch($id, $hash, $name, $company, $address, $address_company, $not_deleted, $created, $modified)->get();
        $fields = $query->list_fields();

        if ( $query->num_rows() > 0 ) {
            $temp = [];
            if ( !empty($id) ) {
                $row = $query->row();
                $a = rm_tableresult($fields, $row, $this->table);

                if ( is_callable($callback) ) {
                    $a = $callback( $a, 0 );
                }

                return !$array_return ? (object) $a: $a;
            }
            else {
                foreach ($query->result() as $key=>$row) {
                    $a = rm_tableresult($fields, $row, $this->table);

                    if ( is_callable($callback) ) {
                        $a = $callback( $a, $key, @$temp[$key-1] );
                    }

                    $temp[$key] = !$array_return ? (object) $a: $a;
                }
                return $temp;
            }
        }
        return $query->num_rows();
    }

    public function get_data_global( $table = NULL, $callback = NULL, $single_row = FALSE, $array_return = FALSE ) {
        if ( empty($table) ) $table = $this->table;
        $query = $this->db->get();
        $fields = $query->list_fields();

        if ( $query->num_rows() > 0 ) {
            $temp = [];
            if ( !empty($single_row) ) {
                $row = $query->row();
                $a = rm_tableresult($fields, $row, $table);

                if ( is_callable($callback) ) {
                    $a = $callback( $a, 0 );
                }

                return !$array_return ? (object) $a: $a;
            }
            else {
                foreach ($query->result() as $key=>$row) {
                    $a = rm_tableresult($fields, $row, $table);

                    if ( is_callable($callback) ) {
                        $a = $callback( $a, $key, @$temp[$key-1] );
                    }

                    $temp[$key] = !$array_return ? (object) $a: $a;
                }
                return $temp;
            }
        }
        return FALSE;
    }

    public function fetch_detail( $id = NULL, $hash = NULL, $id_contact = NULL, $type = NULL, $title = NULL, $value = NULL, $not_deleted = NULL, $created = NULL, $modified = NULL, $order_by = NULL ) {
        $tmp = clone $this->db;
        $table = get_table( $tmp->get_compiled_select() );
        if ( !empty($table) ) {
            $this->db->join($this->table_details, $this->table_details.'.id_contact='.$this->table.'.id_'. $this->table);
        }
        else {
            $this->db->from($this->table_details);
        }

        // where
        if ( !empty($id) ){
            if ( is_array($id) ) {
                $this->db->where_in( 'id_'.$this->table_details, force_intval($id) );
            }
            else {
                $this->db->where( 'id_'.$this->table_details, force_intval($id) );
            }
        }
        if ( !empty($hash) ){
            $this->db->where( 'hash_'.$this->table_details, force_alphanum($hash) );
        }
        if ( !empty($id_contact) ){
            $this->db->where( 'id_'.$this->table, force_intval($id_contact) );
        }
        if ( !empty($type) ){
            $this->db->where( 'type_'.$this->table_details, force_alphanum($type) );
        }
        if ( !empty($title) ){
            $this->db->where( 'title_'.$this->table_details, force_alphanum($title) );
        }
        if ( !empty($value) ){
            $this->db->where( 'value_'.$this->table_details, force_alphanum($value) );
        }
        if ( empty($not_deleted) ){
            $this->db->where( 'delete_'.$this->table_details, 0 );
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
            $this->db->where( 'created_'.$this->table_details.' >=', $create[0] );
            $this->db->where( 'created_'.$this->table_details.' <=', $create[1] );
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
            $this->db->where( 'modified_'.$this->table_details.' >=', $modify[0] );
            $this->db->where( 'modified_'.$this->table_details.' <=', $modify[1] );
        }


        if ( is_string($order_by) ) {
            $this->db->order_by($order_by);
        }
        elseif ( $order_by === FALSE ) {
            
        }
        else {
            $this->db->order_by('type_'.$this->table_details, 'ASC');
            $this->db->order_by('title_'.$this->table_details, 'ASC');
            $this->db->order_by('value_'.$this->table_details, 'ASC');
        }
        return $this->db;
    }

    public function like_custom_details( $field = 'value', $match = '' ) {
        $this->db->like( $field.'_'.$this->m_contact->table_details, force_alphanum_freetext($match) );

        return $this->db;
    }

    public function set_data( $option = [], $filter = TRUE, $unset = FALSE, $system = FALSE ) {
        if ( !empty($option) ) {
            $id = !empty($option['id']) ? intval($option['id']): NULL;

            $details = !empty($option['detail']) ? $option['detail']: NULL;
            $secure = array_concat_values($option, ['name','company','address','address_company'], '', TRUE);
            $option['hash'] = $hash = md5(md5($secure));
            if ( $id ) {
                $hash = NULL;
            }

            // check
            $check = $this->fetch($id, $hash)->get();

            // filter
            $a = [];
            if ( $filter ) {
                foreach ( $check->list_fields() as $field) {
                    $sub = str_replace('_'.$this->table,'',$field);
                    if ( (!empty($id) && $sub == 'id') || is_empty(@$option[$sub]) ) continue;

                    $a[$field] = DB_escape_filter($option[$sub]);
                }
            }
            else {
                foreach ( $option as $key=>$val) {
                    $a[$key.'_'.$this->table] = DB_escape_filter($val);
                }
            }

            // insert or update
            if ( $check->num_rows() && !empty($id) ) {
                unset($a['id']);

                if ( $this->db->set($a)->where('id_'.$this->table,$id)->update($this->table) ) {
                    if ( is_array($details) ) {
                        $ids = [];
                        foreach ($details as $row) {
                            $row['id_contact'] = $id;
                            $ids[] = $this->set_details($row, $filter, $unset, $system);
                        }
                        $this->db->set([
                            'delete_'.$this->table_details => 1
                        ])->where('id_'. $this->table,$id)
                          ->where_not_in('id_'. $this->table_details, $ids)
                          ->update($this->table_details);
                    }
                    return $id;
                }
            }
            else {
                if ( $this->db->set($a)->insert($this->table) ) {
                    $id = $this->db->insert_id();
                    if ( is_array($details) ) {
                        foreach ($details as $row) {
                            $row['id_contact'] = $id;
                            $this->set_details($row, $filter, $unset, $system);
                        }
                    }
                    return $id;
                }
            }
        }
        return FALSE;
    }

    public function set_details( $option = [], $filter = TRUE, $unset = FALSE, $system = FALSE ) {
        if ( !empty($option) ) {
            $id = !empty($option['id']) ? intval($option['id']): NULL;

            if ( $option['type'] == 'phone' ) {
                $option['value'] = force_numeric($option['value']);
            }
            $secure = array_concat_values($option, ['type','title','value'], '', TRUE);
            if ( $option['type'] == 'tags' ) {
                $secure = array_concat_values($option, ['id_contact','type','title','value'], '', TRUE);
            }
            $option['hash'] = $hash = md5(md5($secure));
            if ( $id ) {
                $hash = NULL;
            }

            // check
            $check = $this->fetch_detail($id, $hash)->get();

            // filter
            $a = [];
            if ( $filter ) {
                foreach ( $check->list_fields() as $field) {
                    $sub = str_replace('_'.$this->table_details,'',$field);
                    if ( (!empty($id) && $sub == 'id') || is_empty(@$option[$sub]) ) continue;

                    $a[$field] = DB_escape_filter($option[$sub]);
                }
            }
            else {
                foreach ( $option as $key=>$val) {
                    $a[$key.'_'.$this->table_details] = DB_escape_filter($val);
                }
            }

            // insert or update
            if ( $check->num_rows() && !empty($id) ) {
                unset($a['id']);

                if ( $this->db->set($a)->where('id_'.$this->table_details,$id)->update($this->table_details) ) {
                    return $id;
                }
            }
            else {
                if ( $this->db->set($a)->insert($this->table_details) ) {
                    return $this->db->insert_id();
                }
            }
            
        }
        return FALSE;
    }

    public function delete( $id ) {
        $deleted = $this->db->set([
            'delete_'.$this->table => 1
        ])->where('id_'. $this->table,$id)->update($this->table);
        if ( $deleted ) {
            $this->db->set([
                'delete_'.$this->table_details => 1
            ])->where('id_'. $this->table,$id)->update($this->table_details);
            return TRUE;
        }
        return FALSE;
    }

    public function hard_delete( $id ) {
        $deleted = $this->db->where('id_'. $this->table,$id)->delete($this->table);
        if ( $deleted ) {
            $this->db->where('id_'. $this->table,$id)->delete($this->table_details);
            return TRUE;
        }
        return FALSE;
    }
}
