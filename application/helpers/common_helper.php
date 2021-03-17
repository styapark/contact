<?php
/**
 * Common Helper of Helper Function
 * My Lite CMS v.3.0.0
 * copyright Styapark Dev 2016 - 2021
 * @author styapark
 * @email styapark@gmail.com
 * All rights reserved.
 */

if ( !function_exists('print_json') ) {
    function print_json( $array ) {
        if ( is_array($array) || is_object($array) ) {
            die( json_encode($array) );
        }
        var_dump($array);
        die();
    }
}

if ( !function_exists('get_setup') ) {
    function get_setup( $name ) {
        $CI =& get_instance();
        $CI->load->model('m_setup');
        return $CI->m_setup->get_data($name);
    }
}

if ( !function_exists('get_uuid') ) {
    function get_uuid() {
        $CI =& get_instance();
        $CI->load->model('m_setup');
        return $CI->m_setup->uuid;
    }
}

if ( !function_exists('func_path2title') ) {
    function func_path2title( $string = NULL ) {
        return str_replace('  ',' ', str_replace(['-','_'],' ',$string) );
    }
}

if ( !function_exists('power_admin') ) {
    function power_admin( $path = NULL ) {
        return MyLite_base.'power-admin/'.$path;
    }
}

if ( !function_exists('e_singlescape') ) {
    function e_singlespace( $string ) {
        if ( is_string($string) ) {
            return str_replace(' ','',$string);
        }
        return $string;
    }
}

if ( !function_exists('e_doublespace') ) {
    function e_doublespace( $string ) {
        if ( is_string($string) ) {
            return str_replace('  ',' ',$string);
        }
        return $string;
    }
}

if ( !function_exists('get_nametable') ) {
    function get_nametable( $instance, $escape = array() ) {
        $tmp = ['M_'];
        if ( !empty($escape) && is_array($escape) ) {
            $tmp = array_merge($tmp, $escape);
        }
        if ( is_object($instance) ) {
            $instance = str_replace($tmp,'',get_class($instance));
        }
        return $instance;
    }
}

if ( !function_exists('array_int') ) {
    function array_int( $array ) {
        if ( is_array($array) ) {
            $tmp = [];
            foreach ($array as $r) {
                $tmp[] = intval($r);
            }
            return $tmp;
        }
        return $array;
    }
}

if ( !function_exists('check_result') ) {
    function check_result( $query, $number = 0 ) {
        if ( is_object($query) ) {
            return $query->num_rows() > $number;
        }
        return FALSE;
    }
}

if ( !function_exists('_arr_success') ) {
    function _arr_success( $arr, $result, $select = FALSE ) {
        if ( $select ) {
            $arr['data'] = $result;
            if ( is_array($result) ) {
                $arr['count'] = count($result);
            }
            $arr['message'] = 'No Data';
        }
        if ( $result ) {
            $arr['status'] = TRUE;
            $arr['message'] = 'Success';
        }
        return $arr;
    }
}

if ( !function_exists('rm_tableprefix') ) {
    function rm_tableprefix( $string, $prefix ) {
        return str_replace('_'.$prefix,'',$string);
    }
}

if ( !function_exists('rm_tableresult') ) {
    function rm_tableresult( $fields, $row, $table = NULL, $return_object = FALSE ) {
        $tmp = [];
        if ( is_array($fields) && is_object($row) ) {
            foreach ($fields as $field) {
                $sub = $field;
                if ( !empty($table) ) {
                    $sub = rm_tableprefix($field, $table);
                }
                $tmp[$sub] = $row->{$field};
            }
        }
        return $return_object ? (object) $tmp: $tmp;
    }
}

if ( !function_exists('_dropdown_value') ) {
    function _dropdown_value( $result, $name_sub1 = '#', $name_sub2 = 'name', $id = 'id' ) {
        if ( !empty($result) && is_array($result) ) {
            $temp = [];
            foreach ($result as $row){
                $temp[$row->{$id}] = $row->{$name_sub1}.($name_sub2 ? ' '.$row->{$name_sub2}: '');
            }
            return $temp;
        }
        return FALSE;
    }
}

if ( !function_exists('_dropdown_group_value') ) {
    function _dropdown_group_value( $result, $name_sub1 = '#', $name_sub2 = 'name', $name_group = 'id_misi' ) {
        if ( $result ) {
            $temp = [];
            foreach ($result as $row){
                $temp[$row->{$name_group}][$row->id] = $row->{$name_sub1}.' '.$row->{$name_sub2};
            }
            return $temp;
        }
        return FALSE;
    }
}

if ( !function_exists('is_empty') ) {
    function is_empty( $string ) {
        return in_array( $string, [ '', NULL ] );
    }
}

if ( !function_exists('is_json') ) {
    function is_json( $string, $search_key = NULL ) {
        if ( is_string($string) ) {
            $result = is_array( json_decode($string, TRUE) );
            if ( $result ) {
                $keys = array_keys( json_decode($string, TRUE) );
                if ( !empty($search_key) ) {
                    return in_array($search_key, $keys);
                }
                return $result;
            }
        }
        return FALSE;
    }
}

if ( !function_exists('number_rupiah') ) {
    function number_rupiah( $int ) {
        if ( is_numeric($int) ) {
            return number_format($int, 0, ',', '.');
        }
        return $int;
    }
}

if ( !function_exists('str_trim') ) {
    function str_trim( $string, int $start, int $length = NULL ) {
        if ( empty($length) ) {
            $length = strlen($string);
        }
        return rtrim( ltrim( substr($string, $start, $length) , ' '), ' ');
    }
}

if ( !function_exists('month') ) {
    function month( $lang = 'en' ) {
        $month = MONTH_EN_ID;
        if ( $lang == 'id' ) {
            return array_keys($month);
        }
        return array_values($month);
    }
}

if ( !function_exists('month_dropdown') ) {
    function month_dropdown( $lang = 'en' ) {
        $month = [];
        foreach ( month($lang) as $key=>$value ) {
            $month[$key+1] = $value;
        }
        return $month;
    }
}

if ( !function_exists('array_key_first') ) {
    function array_key_first( array $array ) {
        $keys = array_keys($array);
        return $keys[0];
    }
}

if ( !function_exists('str_filter') ) {
    function str_filter( $string ) {
        if ( strpos($string, '\"') !== FALSE ) {
            return str_replace('\"', '', $string);
        }
        return $string;
    }
}

if ( !function_exists('str_replace_pattern') ) {
    function str_replace_pattern( $string, $replace_pattern = NULL ) {
        if ( !empty($string) && is_array($replace_pattern) ) {
            foreach ($replace_pattern as $key=>$value) {
                $string = preg_replace('/\{'.$key.'\}/', $value, $string);
            }
        }
        return $string;
    }
}

if ( !function_exists('code_filter') ) {
    function code_filter( $string ) {
        if ( !empty($string) ) {
            $string = str_trim( preg_filter('/[a-zA-Z`~!@#$%^&*()_\-+={}\[\]|\\\:;“"’\'<,>?๐฿\/]*/', '', $string), 0 );
        }
        return $string;
    }
}

if ( !function_exists('check_array') ) {
    function check_array( $needle = array(), $haystack = array() ) {
        if ( is_array($needle) ) {
            $tmp = [];
            foreach ($needle as $index=>$need) {
                $tmp[$index] = FALSE;
                foreach ($haystack as $indexs) {
                    if ( $need === $indexs ) {
                        $tmp[$index] = TRUE;
                    }
                }
            }
            return !in_array(FALSE, $tmp);
        }
        else {
            foreach ($haystack as $index) {
                if ( $needle === $index ) {
                    return TRUE;
                }
            }
        }
        return FALSE;
    }
}

if ( !function_exists('str_first_numeric') ) {
    function str_first_numeric( $string ) {
        $int = [];
        if ( is_string($string) ) {
            foreach (str_split($string) as $node) {
                if ( is_numeric($node) ) {
                    $int[] = $node;
                }
                if ( count($int) > 0 && $node === ' ' ) {
                    break;
                }
            }
            return implode('', $int);
        }
        return $string;
    }
}

if ( !function_exists('str_all_numeric') ) {
    function str_all_numeric( $string ) {
        $int = $tmp = [];
        $found = 0;
        if ( is_string($string) ) {
            preg_match_all('/<(.*)>/', $string, $out);
            if ( !empty( $out[0] ) ) {
                $dom = new DOMDocument();
                @$dom->loadHTML($string);
                $li = $dom->getElementsByTagName('li');
                if ( $li->length > 0 ) {
                    foreach ($li as $index=>$row) {
                        $int[$found][] = str_first_numeric($row->nodeValue);
                        $found++;
                    }
                }
            }
            else {
                foreach (str_split($string) as $node) {
                    if ( is_numeric($node) ) {
                        $int[$found][] = $node;
                    }
                    if ( $node === ' ' ) {
                        $found++;
                    }
                }
            }
            foreach ($int as $row) {
                $tmp[] = implode('', $row);
            }
            return $tmp;
        }
        return $string;
    }
}

if ( !function_exists('download_file') ) {
    function download_file( $fullpath = NULL ) {
        if ( file_exists($fullpath) ) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($fullpath) );
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: private');
            header('Pragma: private');
            header('Content-Length: ' . filesize($fullpath) );
            ob_clean();
            flush();
            readfile($fullpath);
            exit;
        }
    }
}

if ( !function_exists('get_git_version') ) {
    function get_git_version() {
        return shell_exec('git describe');
    }
}

if ( !function_exists('force_intval') ) {
    function force_intval( $option ) {
        $tmp = [];
        if ( !empty($option) && is_array($option) ) {
            foreach ($option as $key=>$row) {
                $tmp[$key] = intval($row);
            }
        }
        else {
            $tmp = intval($option);
        }
        return $tmp;
    }
}

if ( !function_exists('force_floatval') ) {
    function force_floatval( $option ) {
        $tmp = [];
        if ( !empty($option) && is_array($option) ) {
            foreach ($option as $key=>$row) {
                $tmp[$key] = floatval($row);
            }
        }
        else {
            $tmp = floatval($option);
        }
        return $tmp;
    }
}

if ( !function_exists('force_alphanum') ) {
    function force_alphanum( $option ) {
        $tmp = [];
        if ( !empty($option) && is_array($option) ) {
            foreach ($option as $key=>$row) {
                $tmp[$key] = preg_filter('/[`~!@#$%^&*()+={}\[\]|\\\:;“"’\'<,>?๐฿\/]*/', '', $row);
            }
        }
        else {
            $tmp = preg_filter('/[`~!@#$%^&*()_+={}\[\]|\\\:;“"’\'<,>?๐฿\/]*/', '', $option);
        }
        return $tmp;
    }
}

if ( !function_exists('format_date') ) {
    function format_date( $stamptime, $mode = 'ID' ) {
        $format = [
            'ID' => 'd-m-Y H:i:s',
            'DB' => 'Y-m-d H:i:s'
        ];
        return date( @$format[$mode], $stamptime);
    }
}

if ( !function_exists('get_table') ) {
    function get_table( $query ) {
        $trim = strstr($query, 'FROM');
        if ( strpos($trim, 'ORDER') !== FALSE ) {
            $trim = strstr( $trim, "\nORDER", TRUE);
        }
        if ( strpos($trim, 'GROUP') !== FALSE ) {
            $trim = strstr( $trim, "\nGROUP", TRUE);
        }
        if ( strpos($trim, 'WHERE') !== FALSE ) {
            $trim = strstr( $trim, "\nWHERE", TRUE);
        }
        if ( strpos($trim, 'LEFT JOIN') !== FALSE ) {
            $trim = strstr( $trim, "\nLEFT JOIN", TRUE);
        }
        if ( strpos($trim, 'RIGHT JOIN') !== FALSE ) {
            $trim = strstr( $trim, "\nRIGHT JOIN", TRUE);
        }
        if ( strpos($trim, 'JOIN') !== FALSE ) {
            $trim = strstr( $trim, "\nJOIN", TRUE);
        }

        return str_replace([' ','FROM','`'], '', $trim);
    }
}

if ( !function_exists('DB_escape_filter') ) {
    function DB_escape_filter( $value ) {
        $CI =& get_instance();
        if ( is_json($value) ) {
            return $value;
        }
        return $CI->db->escape_str($value);
    }
}

if ( !function_exists('array_concat_values') ) {
    function array_concat_values( $array, $index_concat = NULL, $glue = '', $force_lower = FALSE ) {
        if ( is_array($array) ) {
            if ( is_array($index_concat) ) {
                $tmp = [];
                foreach ($array as $key=>$value) {
                    if ( in_array($key, $index_concat) ) {
                        $tmp[] = $force_lower ? strtolower($value): $value;
                    }
                }
                $array = $tmp;
            }
            $array = implode($glue, $array);
        }
        return $array;
    }
}