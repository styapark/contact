<?php
/**
 * Datatable Codeigniter Server Side
 * My Lite CMS v.3.0.0
 * copyright Styapark Dev 2016 - 2021
 * @author styapark
 * @email styapark@gmail.com
 * All rights reserved.
 */

class Datatables {
    private $db;
    private $CI;
    private $table;
    private $columns;
    private $order;
    private $option;
    private $data = [];
    private $count_filtered = 0;
    private $tmp;

    public function __construct( $option = NULL ) {
        $this->CI =& get_instance();
        $this->db =& $this->CI->db;

        $this->option = !empty($option) ? $option: @$_GET;
    }

    public function set_table( $name ) {
        $this->table = force_alphanum( $name );
        return $this;
    }

    public function set_column( $columns = array() ) {
        $this->columns = force_alphanum( $columns );
        return $this;
    }

    public function set_order( $order = array() ) {
        $this->order = force_alphanum( $order );
        return $this;
    }

    public function set_method( $method = NULL ) {
        $this->option = $method ? $method: @$_GET;
        return $this;
    }

    public function exec( $db = NULL ) {
        if ( empty($db) ) {
            $this->db->from( $this->table );
        }
        else {
            $this->db = $db;
        }

        foreach (array_values($this->columns) as $index=>$column) {
            if( isset($this->option['search']['value']) ) {
                $_column = $column;
                if ( strpos($column, ' as') != FALSE ) {
                    $_column = strstr($column, ' as', TRUE);
                }
                if( $index == 0 ) {
                    $this->db->group_start();
                    $this->db->like( $_column, $this->option['search']['value'] );
                }
                else {
                    $this->db->or_like( $_column, $this->option['search']['value'] );
                }
 
                if( count($this->columns) - 1 == $index) {
                    $this->db->group_end();
                }
            }
        }
        $this->tmp = clone $this->db;

        if( !empty($this->option['order']) ) {
            $this->db->order_by( $this->columns[ $this->option['order']['0']['column'] ], $this->option['order']['0']['dir'] );
        }
        else if ( isset($this->order) ) {
            $order = $this->order;
            $this->db->order_by( key($order), $order[key($order)] );
        }

        if ( !empty($this->option['length']) && $this->option['length'] != -1 ) {
            $this->db->limit( $this->option['length'], intval(@$this->option['start']) );
        }

        $get = $this->db->get();
        if ( !empty($this->option['search']['value']) ) {
            $this->count_filtered = $this->tmp->get()->num_rows();
        }
        if ( $get->num_rows() > 0 ) {
            $this->data = $get->result();
        }

        return $this;
    }

    public function render( $function = NULL ) {
        $query = $this->db->last_query();
        $trim = strstr($query, 'FROM');
        if ( strpos($trim, 'JOIN') !== FALSE ) {
            $trim = strstr( $trim, "\nJOIN", TRUE);
        }
        if ( strpos($trim, 'ORDER') !== FALSE ) {
            $trim = strstr( $trim, "\nORDER", TRUE);
        }
        if ( strpos($trim, 'GROUP') !== FALSE ) {
            $trim = strstr( $trim, "\nGROUP", TRUE);
        }
        if ( strpos($trim, 'WHERE') !== FALSE ) {
            $trim = strstr( $trim, "\nWHERE", TRUE);
        }
        $table = str_replace([' ','FROM','`'], '', $trim);

        $tmp = [];
        if (count($this->data) > 0 ) {
            foreach ($this->data as $index=>$row) {
                if ( is_callable($function) ) {
                    $row = $function( $row, $index, $table );
                }
                $tmp[] = $row;
            }
        }

        $total = $this->count_all( $table );
        if ( empty($this->option['search']['value']) ) {
            $this->count_filtered = $total;
        }
        return [
            'draw' => @$this->option['draw'],
            'recordsTotal' => $total,
            'recordsFiltered' => $this->count_filtered,
            'data' => $tmp,
        ];
    }

    private function count_all( $table ) {
        $get = $this->db->get( $table );
        return $get->num_rows();
    }
}