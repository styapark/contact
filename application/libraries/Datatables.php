<?php
/**
 * Datatable Codeigniter Server Side
 * My Lite CMS v.3.0.0
 * copyright Styapark Dev 2016 - 2021
 * @author styapark
 * @email styapark@gmail.com
 * All rights reserved.
 */


/**
 * @property CI_DB_query_builder $db
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
    public $force_new_count = FALSE;

    public function __construct( $option = NULL ) {
        $this->CI =& get_instance();
        $this->db = $this->CI->db;

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

        if ( !empty($this->columns) ) {
            foreach (array_values($this->columns) as $index=>$column) {
                $_column = $column;
                if ( strpos($column, ' as') != FALSE ) {
                    $_column = strstr($column, ' as', TRUE);
                }
                if( !empty($this->option['search']['value']) ) {
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
                if( !empty($this->option['columns'][$index]['search']['value']) ) {
                    $this->db->like( $_column, $this->option['columns'][$index]['search']['value'] );
                }
            }
            $this->db->select(implode(',', array_values($this->columns)));
        }
//        print_json($this->db->get_compiled_select());
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
        if ( !empty($this->option['search']['value']) || $this->force_new_count ) {
            $this->count_filtered = $this->tmp->get()->num_rows();
        }
        if ( $get->num_rows() > 0 ) {
            $this->data = $get->result();
        }

        return $this;
    }

    public function render( $function = NULL ) {
        $query = $this->db->last_query();
        $where = $query;
        $trim = strstr($query, 'FROM');
        if ( strpos($trim, 'ORDER') !== FALSE ) {
            $trim = strstr( $trim, "\nORDER", TRUE);
            $where = $trim;
        }
        if ( strpos($trim, 'GROUP') !== FALSE ) {
            $trim = strstr( $trim, "\nGROUP", TRUE);
            $where = $trim;
        }
        if ( strpos($trim, 'WHERE') !== FALSE ) {
            if ( strpos($trim, 'JOIN') == FALSE ) {
                $where = strstr( $trim, "\nWHERE");
            }
            $trim = strstr( $trim, "\nWHERE", TRUE);
        }
        if ( strpos($trim, 'LEFT JOIN') !== FALSE ) {
            $trim = strstr( $trim, "\nLEFT JOIN", TRUE);
        }
        if ( strpos($trim, 'RIGHT JOIN') !== FALSE ) {
            $trim = strstr( $trim, "\nRIGHT JOIN", TRUE);
        }
        if ( strpos($trim, 'JOIN') !== FALSE ) {
            $where = strstr( $trim, "\nJOIN" );
            $trim = strstr( $trim, "\nJOIN", TRUE);
        }

        $table = str_replace([' ','FROM','`'], '', $trim);

        $tmp = [];
        if (count($this->data) > 0 ) {
            foreach ($this->data as $index=>$row) {
                if ( is_callable($function) ) {
                    $row = $function( $row, $index, $table, @$tmp[$index - 1] );
                }
                $tmp[] = $row;
            }
        }

        $total = $this->count_all( $table, $where );
        if ( empty($this->option['search']['value']) && empty($this->force_new_count) ) {
            $this->count_filtered = $total;
        }
        return [
            'draw' => @$this->option['draw'],
            'recordsTotal' => $total,
            'recordsFiltered' => $this->count_filtered,
            'data' => $tmp,
        ];
    }

    private function count_all( $table, $where = NULL ) {
        $get = $this->db->get( $table );
        if ( !empty($where) ) {
            $get = $this->db->query('SELECT id_'.str_replace('my_','',$table).' FROM '.$table.' '.$where);
        }
        return $get->num_rows();
    }
}
