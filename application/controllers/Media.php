<?php
/**
 * Media class of Page Class
 * My Lite CMS v.3.0.0
 * copyright Styapark Dev 2016 - 2021
 * @author styapark
 * @email styapark@gmail.com
 * All rights reserved.
 */

class Media extends CI_Controller {
    public $dir_page = 'pages/';
    public $dir_admin = 'power-admin/';
    public function __construct() {
        parent::__construct();
        $this->config->load('mylite');
        
        // mengambil nama config dari mylite [title]
        $this->cms_name = $this->title = $this->config->item('title');
        // mengambil nama config dari mylite [motto]
        $this->cms_motto = $this->config->item('motto');
        // mengambil nama config dari mylite [themes]
        $this->cms_themes = $this->config->item('themes');
        $this->theme = 'themes/'.$this->cms_themes;
        // mengambil nama config dari mylite [version]
        $this->cms_version = $this->config->item('version');
        
        $this->control_admin = str_replace(['/','\\','"','\'','&','?'], '', str_replace(['-','_'], ' ', $this->dir_admin) );
        
        $this->type_mime = [
            'css' => 'text/css',
            'eot' => 'application/vnd.ms-fontobject',
            'jpg' => 'image/jpg',
            'jpeg' => 'image/jpeg',
            'js' => 'text/javascript',
            'gif' => 'image/gif',
            'map' => 'application/json',
            'lang' => 'application/json',
            'otf' => 'application/x-font-opentype',
            'png' => 'image/png',
            'svg' => 'image/svg+xml',
            'ttf' => 'application/x-font-truetype',
            'woff' => 'application/x-font-woff',
            'woff2' => 'application/x-font-woff',
            'txt' => 'text/plain',
        ];
        $this->ui_encrypt = [
            '579fb8da391e2a50d92e94b2a2d9b8aa' => 'bootstrap-table.css',
            'e3202aea761d3d587dfcfc43c6982565' => 'bootstrap.css',
            '6f78778ce94f0b7fe5fa9c0a91670aef' => 'dataTables.bootstrap4.min.css',
            'ec27c1a64f2fcd456b6d2e4b33ac6df1' => 'font-awesome.css',
            '35758a6caebb0670421de627f3e9dd96' => 'mdb.css',
            '79311511d9bab485bab928309ba5c8da' => 'snarl.css',
            '50f66c9d98e3555ff8ba6eba727f2e5c' => 'stylesheet.css',
            'c9ae1c6f18e3be61fc0b4d5e4f722373' => 'Chart.bundle.min.js',
            '59efdafb76a2419c4d3ec3034910ddeb' => 'angular.min.js',
            '448d6edb4390f543924013ce5c0e0098' => 'bootstrap-table-locale-all.min.js',
            '431660bf4edca4bd17bbcbff33ac7996' => 'bootstrap-table.js',
            '4033a28e2ce91066840378763993abc1' => 'bootstrap.bundle.js',
            'd50dde41ea672c745d83e03b84f76404' => 'bootstrap3-typeahead.min.js',
            '21f41763a357b84bc69127e385b373b6' => 'dataTables.bootstrap4.min.js',
            '37d130f57c6b594011739b65f2758653' => 'dataTables.indonesian.lang',
            '573fba7315e0423cce17cb649db3e70b' => 'datatables.min.js',
            'dee1eb0a17b89ee10e8277a3fdd706da' => 'javascript.js',
            'd958c283e70811506bbc470025689935' => 'jquery-3.3.1.min.js',
            'ae3f72f3ce1111f56d82c6f006862583' => 'jquery.dataTables.min.js',
            'e03c806f727374e1b4b6a138e6efa804' => 'jquery.mask.min.js',
            'b9001da555982cfcfb014fce77adf98f' => 'mdb.js',
            '7099861fba18a87d52d6cf9a9c993379' => 'mylite.init.js',
            '4de7b0e34761aed54e4d1d98396c1535' => 'mylite.init.native.js',
            '2249c9744084d294bb65a7ce31a73d6b' => 'mylite.init.jquery.js',
            '4d93f5a82d0f3ff7a38cdac3044bda64' => 'snarl.js',
            'd270611c1b6918f75024f19b996ccf87' => 'global.datatables.js',
        ];
    }

    public function view( $base, $p, $q = NULL, $r = NULL, $s = NULL, $t = NULL ) {
        $array_base[1] = $this->_dir('views/media',1);
        $array_base[2] = $this->_dir( 'views/themes/'.$this->cms_themes.'media' ,1 );
        $map = $p.( !empty($q) ? '/'.$q: '' ).( !empty($r) ? '/'.$r: '' ).( !empty($s) ? '/'.$s: '' ).( !empty($t) ? '/'.$t: '' );
//        die(json_encode([VIEWPATH,$base,$array_base]));

        // check base path
        if ( !in_array( $base, $array_base[1] ) && !in_array( $base, $array_base[2] ) ) {
            show_404();
        }

        // check available map path
        /*if ( !file_exists( VIEWPATH.'media/'.$base.'/'.$map ) && !file_exists( VIEWPATH.'themes/'.$this->cms_themes.'media/'.$base.'/'.$map ) ) {
            show_404();
        }*/

        $basename = basename( $map );
        $basetype = pathinfo( $basename, 4 );
        $dirmap = str_replace( $basename, '', $base.'/'.$map );
        
        // with encrypt
        if ( in_array( $basename, array_keys($this->ui_encrypt) ) ) {
            $basename = $dirmap.$this->ui_encrypt[$basename];
            $basetype = pathinfo( $basename, 4 );
            if ( file_exists( VIEWPATH.'themes/'.$this->cms_themes.'media/'.$basename ) ) {
                $file = read_file( VIEWPATH.'themes/'.$this->cms_themes.'media/'.$basename );
            }
            elseif ( file_exists( VIEWPATH.'media/'.$basename ) ) {
                $file = read_file( VIEWPATH.'media/'.$basename );
            }

            $force_hash = [
                'd958c283e70811506bbc470025689935',
                'ae3f72f3ce1111f56d82c6f006862583',
                '59efdafb76a2419c4d3ec3034910ddeb',
                'c9ae1c6f18e3be61fc0b4d5e4f722373',
                '21f41763a357b84bc69127e385b373b6',
                '4d93f5a82d0f3ff7a38cdac3044bda64',
                'e03c806f727374e1b4b6a138e6efa804',
            ];

            if ( ( in_array( basename( $map ), $force_hash) || !in_array($basetype,['js']) ) && !in_array( $this->type_mime[$basetype], ['application/json'] ) ) {
                if ( $base !== 'images' ) {
                    $this->output->set_header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
                    $this->output->set_header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
                }
                if ( $base === 'images' ) {
                    $this->output->set_header('Access-Control-Allow-Headers: Origin, Accept');
                }
                $this->output->set_header('Access-Control-Allow-Origin: *');
                $this->output->set_header('Cache-Control: public, max-age='.(60*60*24*30).', immutable');
                $this->output->set_header('Expires: '.gmdate(DATE_RFC1123,time()+60*60*24*30));
                $this->output->set_header('Pragma: cache');
                $this->output->set_header('Connection: close');
            }
            $this->output->set_content_type( $this->type_mime[$basetype] );
            $this->output->set_output( $file );
        }

        // without encrypt
        elseif ( in_array( $basetype, array_keys($this->type_mime) ) ) {
//            die(VIEWPATH.'themes/'.$this->cms_themes.'media/'.$base.'/'.$map);
            if ( file_exists( VIEWPATH.'themes/'.$this->cms_themes.'media/'.$base.'/'.urldecode($map) ) ) {
                $file = read_file( VIEWPATH.'themes/'.$this->cms_themes.'media/'.$base.'/'.urldecode($map) );
            }
            elseif ( file_exists( VIEWPATH.'media/'.$base.'/'.urldecode($map) ) && !in_array( $basename, array_keys($this->ui_encrypt) ) ) {
                $file = read_file( VIEWPATH.'media/'.$base.'/'.urldecode($map) );
            }
            else {
                show_404();
            }

            if ( !in_array($basename,['style.css','javascript.js']) && !in_array( $basetype, ['application/json'] ) ) {
                if ( $base !== 'images' ) {
                    $this->output->set_header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
                    $this->output->set_header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
                }
                if ( $base === 'images' ) {
                    $this->output->set_header('Access-Control-Allow-Headers: Origin, Accept');
                }
                $this->output->set_header('Access-Control-Allow-Origin: *');
                $this->output->set_header('Cache-Control: public, max-age='.(60*60*24*30).', immutable');
                $this->output->set_header('Expires: '.gmdate(DATE_RFC1123,time()+60*60*24*30));
                $this->output->set_header('Pragma: cache');
            }
            if ( in_array($basetype,['png','woff','woff2']) ) {
                $this->output->set_header('Connection: close');
            }
            $this->output->set_content_type( $this->type_mime[$basetype] );
            $this->output->set_output( $file );
        }
        else {
            show_404();
        }
    }

    protected function _dir( $source, $depth = 0, $hidden = FALSE ) {
        if ( @dir($source) ) {
            return $this->_search($source, $depth, $hidden);
        }
        elseif ( @dir('../'.$source) ) {
            return $this->_search('../'.$source, $depth, $hidden);
        }
        return FALSE;
    }

    protected function _search( $source, $depth = 0, $hidden = FALSE ) {
        $fp = opendir($source);
        $filedata	= array();
        $new_depth	= $depth - 1;
        $source_dir	= rtrim($source, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;

        while (  $file = readdir($fp)  ) {
            if ( $file === '.' || $file === '..' || ($hidden === FALSE && $file[0] === '.') ) {
                continue;
            }

            if ( ($depth < 1 || $new_depth > 0) && is_dir($source_dir.$file) ) {
                $filedata[$file] = $this->_dir($source_dir.$file, $new_depth, $hidden);
            }
            else {
                $filedata[] = $file;
            }
        }
        closedir($fp);
        return $filedata;
    }
}