<?php
/**
 * M_accounts class of Model Class
 * My Lite CMS v.3.0.0
 * copyright Styapark Dev 2016 - 2021
 * @author styapark
 * @email styapark@gmail.com
 * All rights reserved.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class M_accounts extends Ion_auth_model {
    public $select = NULL;
    public $columns;
    public $order;
    public $option;
    private $tmp;
    private $count_filtered = 0;

    public function __construct() {
        parent::__construct();

        $this->order = [$this->tables['users'].'.id' => 'desc'];
    }

    public function set_method( $method = NULL ) {
        $this->option = !empty($method) ? $method: @$_GET;
        return $this;
    }

    public function select( $columns ) {
        $this->select = force_alphanum( $columns );
        return $this;
    }

    public function set_column( $columns = array() ) {
        $this->columns = force_alphanum( $columns );
        return $this;
    }

    public function fields( $with_groups = FALSE ) {
        $fields = [];
        $res = $this->db->query('SHOW columns FROM '.$this->db->dbprefix.$this->tables['users']);
        if ( $res->num_rows() > 0 ) {
            foreach ($res->result() as $index=>$row) {
                $fields[$index] = $this->tables['users'].'.'.$row->Field;
                if ( $row->Field == 'id' ) {
                    $fields[$index] .= ' as user_id';
                }
            }
        }
        if ( !empty($with_groups) ) {
            $res = $this->db->query('SHOW columns FROM '.$this->db->dbprefix.$this->tables['groups']);
            if ( $res->num_rows() > 0 ) {
                $tmp = [];
                foreach ($res->result() as $index=>$row) {
                    $tmp[$index] = $this->tables['groups'].'.'.$row->Field;
                    if ( $row->Field == 'id' ) {
                        $tmp[$index] .= ' as group_id';
                    }
                }
                $fields = array_merge($fields,$tmp);
            }
        }
        return $fields;
    }

    public function fetch( $id = NULL, $id_group = NULL, $username = NULL ) {
        if ( !empty($id) ){
            if ( !empty($this->select) ) {
                $this->_ion_select = $this->select;
            }
            $this->user($id);
        }
        if ( empty($id) && empty($username) ){
            if ( empty($id_group) ) $id_group = ['members','admin','superadmin'];
            if ( !empty($this->select) ) {
                $this->_ion_select = $this->select;
            } else {
                $this->_ion_select = [$this->tables['users'].'.*', $this->tables['users'].'.id as user_id', 'concat(first_name,\' \',last_name) as full_name', $this->tables['groups'].'.*', $this->tables['groups'].'.id as group_id' ];
            }
            $this->users($id_group);
        }
        if ( !empty($username) ){
            if ( !empty($this->select) ) {
                $this->_ion_select = $this->select;
            }
            $this->trigger_events( 'username_check' );
            $this->limit( 1 );
            $order = $this->order;
            $this->order_by( key($order), $order[key($order)] );
            $this->where( $this->tables['users'].'.username', $username );
            $this->users();
        }

        return $this;
    }

    public function fetch_datatables( $id_group = NULL ) {
        if ( empty($id_group) ) $id_group = ['members','admin','superadmin'];

        $this->_ion_select = [$this->tables['users'].'.*', $this->tables['users'].'.id as user_id', 'concat(first_name,\' \',last_name) as full_name', $this->tables['groups'].'.*', $this->tables['groups'].'.id as group_id' ];
        if ( !empty($this->select) ) {
            $this->_ion_select = $this->select;
        }
        if ( empty($this->columns) ) {
            $this->columns = $this->fields(TRUE);
        }


        $tmp_init_columns = [];
        foreach (array_values($this->columns) as $index=>$column) {
            // skip
            if (preg_grep('/.id|.password/', [$column]) ) continue;
            $tmp_init_columns[] = $column;

            if( isset($this->option['search']['value']) ) {
                $_column = $column;
                if ( strpos($column, ' as') != FALSE ) {
                    $_column = strstr($column, ' as', TRUE);
                }
                if( count($tmp_init_columns) == 1 ) {
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
        $this->users($id_group);

        return $this;
    }

    public function count_all() {
        $get = $this->db->get( $this->tables['users'] );
        return $get->num_rows();
    }

    public function get_data( $id = NULL, $id_group = NULL, $username = NULL, $full = FALSE, $datatables = FALSE, $callback = NULL ) {
        if ( !empty($datatables) ) {
            $query = $this->fetch_datatables($id_group);
        }
        else {
            $query = $this->fetch($id, $id_group, $username);
        }

        if ( !empty($this->option['search']['value']) ) {
            $this->count_filtered = $this->tmp->get()->num_rows();
        }
        if ( $query->num_rows() > 0 ) {
            $temp = [];
            foreach ($query->result() as $index=>$row) {
                if ( $full === TRUE ) {

                    $row->id = $row->user_id;
                    $row->fullname = $row->first_name.' '.$row->last_name;
                    $row->last_login_text = !empty($row->last_login) ? date('d-m-Y H:i:s', $row->last_login): 'Belum pernah login';
                    if ( !empty($row->active) && empty($row->activation_code) ) {
                        $row->status_text = 'Active';
                    }
                    if ( empty($row->active) && !empty($row->activation_code) ) {
                        $row->status_text = 'Suspend';
                    }
                    $row->group_text = $row->description;
                    unset($row->password);
                    unset($row->salt);
                    unset($row->remember_code);
                    unset($row->name);
                    unset($row->description);
                }
                if ( is_callable($callback) ) {
                    $row = $callback( $row, $index );
                }
                $temp[] = $row;
            }


            $total = $this->count_all();
            if ( empty($this->option['search']['value']) ) {
                $this->count_filtered = $total;
            }
            if ( !empty($datatables) ) {
                return [
                    'draw' => @$this->option['draw'],
                    'recordsTotal' => $total,
                    'recordsFiltered' => $this->count_filtered,
                    'data' => $temp,
                ];
            }
            return $temp;
        }
        return $query->num_rows();
    }

    public function set_data( $option = [] ) {
        if ( !empty($option) ) {

            $id = !empty($option['id']) ? sprintf('%d',$option['id']): NULL;
            unset($option['id']);
            $query = $this->fetch($id);
            $a = [];
            foreach ( $option as $key=>$val) {
                if ( (in_array($key, ['username','password','first_name','last_name','email']) && empty($id)) || (in_array($key, ['password','first_name','last_name','email']) && !empty($id)) ) {
                    if ( empty($option[$key]) ) continue;
                    $a[$key] = $this->db->escape_str($val);
                }
            }
            if ( !empty($option['password']) ) {
                $a['password'] = str_replace( ['\\','\'','`','@','!','='], '', $option['password'] );
            }
            if ( $query->num_rows() > 0 && !empty($id) ) {
                return $this->update($id, $a);
            }
            else {
                $additional = $a;
                unset($additional['username']);
                unset($additional['password']);
                unset($additional['email']);
                unset($additional['group']);
                return $this->register($a['username'], $a['password'], $a['email'], $additional, [ intval($option['group']) ] );
            }
            return $a;
        }
        return FALSE;
    }

    public function delete( $id = NULL ) {
        if ( !empty($id) ) {
            return $this->delete_user($id);
        }
        return FALSE;
    }

    public function groups_dropdown() {
        $result = $this->groups()->result();
        $temp = [];
        if ( $result ) {
            $temp = _dropdown_value($result, 'description', NULL, 'id');
            unset($temp[10]);
        }
        return $temp;
    }

    public function suspend($id = NULL) {
        $result = $this->user($id);
        if ( $result->num_rows() > 0 ) {
            if ( $result->row()->active ) {
                return $this->deactivate($id);
            }
            else {
                return $this->activate($id);
            }
        }
        return FALSE;
    }

    public function Mchange_password( $data = NULL ) {
        if ( is_array($data) ) {
            $identity = $this->session->userdata('identity');
            return $this->change_password($identity, $data['old_password'], $data['confirm_password']);
        }
        return FALSE;
    }
}
