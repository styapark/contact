<?php
/**
 * M_setup class of Model Class
 * My Lite CMS v.3.0.0
 * copyright Styapark Dev 2016 - 2021
 * @author styapark
 * @email styapark@gmail.com
 * All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class M_setup extends CI_Model {
    public $table;
    public $uuid;


    public function __construct() {
        parent::__construct();
        $this->table = get_nametable($this);
        $code_activation = $this->system('activation');
        $this->uuid = $this->get_uuid();
        if ($this->uuid != $code_activation ) {
            $this->session->activation = 'TRIAL';
        }
        else {
            $this->session->activation = TRUE;
        }
    }

    public function fetch( $name = NULL, $note = NULL ) {
        $this->db->select('*');
        if ( !empty($name) ){
            if ( is_array($name) ) {
                $this->db->where_in('name_'.$this->table, $name);
            }
            else {
                $this->db->where('name_'.$this->table, $this->db->escape_str($name));
            }
        }
        if ( !empty($note) ){
            $sign = '';
            if ( strpos($note, '>') !== FALSE ) {
                $sign = ' >';
            }
            elseif ( strpos($note, '>=') !== FALSE ) {
                $sign = ' >=';
            }
            elseif ( strpos($note, '<') !== FALSE ) {
                $sign = ' <';
            }
            elseif ( strpos($note, '<=') !== FALSE ) {
                $sign = ' <=';
            }
            $this->db->where('note_'.$this->table, $this->db->escape_str($note));
        }
        $this->db->order_by('name_'.$this->table, 'ASC');
        return $this->db;
    }

    public function get_data( $name = NULL, $note = NULL, $full = FALSE, $array_return = FALSE ) {
        $query = $this->fetch($name, $note)->get($this->table);
        $fields = $query->list_fields();

        if ( $query->num_rows() > 0 ) {
            $temp = [];
            if ( !empty($name) && $full == FALSE ) {
                return $query->row()->{'value_'.$this->table};
            }
            else if ( !empty($name) && $full == TRUE ) {
                $row = $query->row();
                return (object) rm_tableresult($fields, $row, $this->table);
            }
            else {
                foreach ($query->result() as $key=>$row) {
                    $a = rm_tableresult($fields, $row, $this->table);
                
                    $temp[$key] = (object)$a;
                }
                return $temp;
            }
        }
        return $query->num_rows();
    }

    public function get_data_dropdown( $name = NULL, $note = NULL ) {
        $query = $this->fetch($name, $note)->get($this->table);

        if ( $query->num_rows() > 0 ) {
            $temp = [];
            if ( !empty($name) ) {
                return [ $name => $query->row()->{'value_'.$this->table} ];
            }
            else {
                foreach ($query->result() as $row) {
                    $temp[ $row->{'name_'.$this->table} ] = $row->{'value_'.$this->table};
                }
                return $temp;
            }
        }
        return $query->num_rows();
    }

    public function set_data( $option = [] ) {
        if ( !empty($option) ) {
            $name  = !empty($option['name']) ? $this->db->escape_str($option['name']): exit();
            $value = !empty($option['value']) ? $this->db->escape_str($option['value']): '';
            $note  = !empty($option['note']) ? $this->db->escape_like_str($option['note']): '';
            $query = $this->fetch($name)->get($this->table);
            if ( $query->num_rows() > 0 && !empty($name) ) {
                $set = [
                    'value_'.$this->table => $value,
                    'note_'.$this->table => $note
                ];
                return $this->db->set($set)->where('name_'.$this->table,$name)->update($this->table);
            }
            else {
                $set = [
                    'name_'.$this->table => $name,
                    'value_'.$this->table => $value,
                    'note_'.$this->table => $note
                ];
                return $this->db->set($set)->insert($this->table);
            }
        }
        return FALSE;
    }

    public function update_mass( $options = [] ) {
        if ( !empty($options) && is_array($options) ) {
            foreach ($options as $name=>$value) {
                $query = $this->fetch($name)->get($this->table);
                if ( $query->num_rows() > 0 && !empty($name) ) {
                    $this->set_data(['name' => $name, 'value' => $value]);
                }
            }
        }
        return TRUE;
    }

    public function _dropdown() {
        $result = $this->get_data();
        if ( $result ) {
            $temp = [];
            foreach ($result as $row){
                $temp[$row->id] = $row->name;
            }
            return $temp;
        }
        return FALSE;
    }

    public function system($name = NULL, $array_return = FALSE) {
        $result = $this->get_data(!empty($name) ? 'system_'.$name: NULL, NULL, FALSE, $array_return);
        if ( $result ) {
            return $result;
        }
        return FALSE;
    }

    public function system_dropdown($name = NULL) {
        $result = $this->get_data_dropdown(!empty($name) ? 'system_'.$name: NULL);
        if ( $result ) {
            return $result;
        }
        return FALSE;
    }
    
    public function default($name = NULL, $array_return = FALSE) {
        $result = $this->get_data(!empty($name) ? 'default_'.$name: NULL, NULL, FALSE, $array_return);
        if ( $result ) {
            return $result;
        }
        return FALSE;
    }

    public function get_uuid() {
        $sh = "lsblk -f | grep 'ext3\|ext4' | grep -v '\/home' | awk '{print $3}' | sha1sum | awk '{print $1}'";
        if (strtoupper(substr(php_uname(), 0, 3)) === 'WIN') {
            $sh = "mountvol C:\ /L";
            preg_match('/\{(.*)\}/', shell_exec($sh), $output);
            return sha1(@$output[1]);
        }
        return str_replace("\n", '', shell_exec($sh));
    }
}
