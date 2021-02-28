<?php
/**
 * M_search class of Model Class
 * My Lite CMS v.3.0.0
 * copyright Styapark Dev 2016 - 2021
 * @author styapark
 * @email styapark@gmail.com
 * All rights reserved.
 */

class M_search extends CI_Model {
    public $table;

    public function __construct() {
        $this->table = get_nametable($this);
        
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
}
