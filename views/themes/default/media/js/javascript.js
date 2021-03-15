/**
 * Custom Javascript
 * My Lite CMS v.3.0.0
 * copyright Styapark Dev 2016 - 2021
 * @author styapark
 * @email styapark@gmail.com
 * All rights reserved.
 */

var base = window.location.protocol + '//' + window.location.host + window.location.pathname;
var path = base.replace(root, '');
var surl = path.split('/');

if ( $ !== undefined ) {
    // pick color of colors theme
    var colorDarkGreen = $('.themes .btn-dark-green').css('background-color');
    //########################################################################//
    /// START FUNCTION #########################################################
    function notif_empty(ini) {
        var error = 0;
        var arr = $(ini).serializeArray();
        var regex = new RegExp(/<\/?[^>]+(>|$)/g);
        for (var i=0; i < arr.length; i++){
            var e = arr[i];
            var parent = $(ini).find('[name="'+e.name+'"]').parents('.form-group');
            var label = $(ini).find('[name="'+e.name+'"]').attr('placeholder');
            var dataRequired = $(ini).find('[name="'+e.name+'"]').attr('data-required');
            var minLength = parseInt( $(ini).find('[name="'+e.name+'"]').attr('minlength') );
            if ( label == undefined ) {
                label = parent.find('label').html();
                if ( regex.test(label) ) {
                    label = label.replace(/<\/?[^>]+(>|$)/g, "");
                }
            }
            console.log(e,dataRequired);
            if ( (e.value == "" || e.value == null) && dataRequired !== undefined ) {
                snarlWarning({
                    title: 'Form Kosong',
                    text: 'Kolom "' + label + '" tidak boleh kosong',
                    icon: '<i class="zmdi zmdi-alert-triangle"></i>',
                    timeout: 3000
                });
                error++;
            }
            if ( e.value != "" && dataRequired !== undefined && minLength !== undefined && e.value.length < minLength ) {
                snarlWarning({
                    title: 'Minimal Karakter',
                    text: 'Kolom "' + label + '" kurang dari ' + minLength + ' karakter',
                    icon: '<i class="zmdi zmdi-alert-triangle"></i>',
                    timeout: 3000
                });
                error++;
            }
        }
        return error;
    }
    function notif_delete(title, url, api, ajax) {
        var notification = snarlDanger({
            title: 'Are you sure ? ' + title,
            text: 'Ya, klik disini. Tidak, silakan klik silang',
            icon: '<i class="zmdi zmdi-help-outline"></i>',
            timeout: null,
            action: function(notification) {
                Snarl.removeNotification(notification);
                var urls = root + 'services/v1/' + url;
                $.get(urls, function(e){
                    if ( e.status ) {
                        snarlSuccess({
                            title: e.message,
                            text: 'Berhasil menghapus ' + title + ' dari database',
                            icon: '<i class="zmdi zmdi-shield-check"></i>',
                            timeout: 1500
                        });
                        if ( typeof ajax !== 'object' ) {
                            api.remove().draw(false);
                        }
                        ajax.reload();
                    }
                    else {
                        snarlDanger({
                            title: e.message,
                            text: 'Gagal menghapus,silakan ulangi',
                            icon: '<i class="zmdi zmdi-alert-triangle"></i>',
                            timeout: 3000
                        });
                    }
                },'json');
            }
        }, 'delete');
    }
    function response_save(e,url = null) {
        if ( e.csrf ) {
            $('[name='+e.csrf.name+']').val(e.csrf.hash);
        }
        if ( e.status ) {
            snarlSuccess({
                title: 'Success',
                text: 'Berhasil menyimpan ke database',
                icon: '<i class="zmdi zmdi-shield-check"></i>',
                timeout: 1500
            });
            setTimeout(function(){
                if ( url != null ) {
                    window.location.href = url;
                }
            }, 1600);
        }
        else {
            snarlDanger({
                title: 'Failed',
                text: 'Gagal menyimpan ke database. Ulangi kembali',
                icon: '<i class="zmdi zmdi-alert-triangle"></i>',
                timeout: 3000
            });
        }
    }
    function btn_slidedown($p,$q) {
        var $main = $('#'+$p);
        $main.find('#'+$q+' button').on('click', function(){
            $main.find('#'+$q+' .collapse').collapse('toggle');
            var attr = $(this).attr('type');
            if ( attr == 'button' ) {
                setTimeout(function(){
                    $main.find('#'+$q+' [type=button]').attr('type','submit');
                },500);
            }
            if ( attr == 'submit' ) {
                if ( ['realisasi'].indexOf($p) !== -1 ) {
                    $('#'+$q).submit();
                }
                setTimeout(function(){
                    $main.find('#'+$q+' [type=submit]').attr('type','button');
                }, 500);
            }
        });
    }
    function add_dropup($p, $q, $dataType = 'text', $services = false) {
        var $main = $('#'+$p);
        var isSubmit = false;
        $main.find('#'+$q).submit(function(e){
            e.preventDefault();
            var data = $(this).serialize(), name = false, files = false;
            var formdata = new FormData(this);
            var url = root + 'services/v1/'+ ( $services ? $services: $p+'/'+$q);
            if ( $(this).find('[type=file]').length > 0 ) {
                name = $(this).find('[type=file]').attr('name');
                files = $(this).find('[type=file]').prop('files');
                console.log(files[0]);
                formdata.append(name, files[0]);
            }

            var error = notif_empty(this);
            console.log(url);

            isSubmit = true;
            if ( error == 0 ) {
                // reset
                $(this).trigger('reset');
                
                $.ajax({
                    url: url,
                    data: formdata,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function(e) {
                        console.log(e);
                        if ( e.data == false ) {
                            snarlDanger({
                                title: 'Duplikat',
                                text: 'Periode Duplikat',
                                icon: '<i class="zmdi zmdi-alert-triangle"></i>',
                                timeout: 3000
                            });
                        }
                        response_save(e, base);
                        isSubmit = false;
                    }
                });
            }
        });
    }
    function edit_popup($p, $q, $dataType = 'html', $services = false){
        var $main = $('#'+$p);
        $main.find('#'+$q).submit(function(e){
            e.preventDefault();
            var data = $(this).serialize();
            $q = $q.replace('edit[name=','').replace(']','');
            var url = root + 'services/v1/'+( $services ? $services: $p+'/'+$q )+'/' + data.split('&')[1].split('=')[1];
            console.log(url);

            var error = notif_empty(this);

            // reset
            $(this).trigger('reset');
            // close modal
            $(this).modal('toggle');

            if ( error == 0 ) {
                $.post(url, data, function(e){
                    console.log(e);
                    response_save(e, base);
                },$dataType);
            }
        });
    }
    function create_popup($p, $q, $dataType = 'html', $services = false){
        var $main = $('#'+$p);
        $main.find('#create').submit(function(e){
            e.preventDefault();
            var data = $(this).serialize();
            var url = root + 'services/v1/'+( $services ? $services: $p+'/'+$q )+'/' + data.split('&')[1].split('=')[1];

            var error = notif_empty(this);
            
            // reset
            $(this).trigger('reset');
            // close modal
            $(this).modal('toggle');

            if ( error == 0 ) {
                $.post(url, data, function(e){
                    console.log(e);
                    response_save(e, base);
                },$dataType);
            }
        });
    }
    function module_add_edit($p,$q) {
        btn_slidedown($p,$q);
        add_dropup($p,$q,'json');
        edit_popup($p,'edit[name='+$q+']','json');
    }
    function last(array, n) {
        if (array == null) return void 0;
        if (n == null) return array[array.length - 1];
        return array.slice(Math.max(array.length - n, 0));
    };
    /// END FUNCTION ###########################################################
    //########################################################################//
    
    
    // click delay effect ######################################################
    $(document).ready(function(){
        $('a').on('click', function(e){
            e.preventDefault();
            var href = $(this).attr('href');
            if ( href !== undefined ) {
                if ( href.indexOf('#') === -1 && href !== 'javascript:void(0);' ) {
                    setTimeout(function(){
                        window.open( href, '_self');
                    },500);
                }
            }
        });
    });
    
    
    // Preloader ###############################################################
    $(document).ready(function(){
        setTimeout(function(){
            $('.preloader-cycle').fadeOut(500);
        },1500);
    });
    
    
    // LOGIN ###################################################################
    $(document).ready(function(){
        $('.login-box').submit(function(e){
            e.preventDefault();
            var parent = $(this);
            var data = $(this).serialize();
            var url = root + 'services/v1/auth/login';
            var redirect = $(this).data('redirect');
            var error = 0;
            parent.find('[type=submit]').prop('disabled', true);
            parent.find('[type=submit]').html('<img src="' + root + 'media/images/svg/fading lines transparent.svg" title="Loading" style="height: 16.8px; width: 16.8px">');

            $(this).serializeArray().forEach(function(e){
                var parent = $('[name='+e.name+']').parent();
                var label = parent.find('label').html();
                if ( !e.value ) {
                    snarlWarning({
                        title: 'Form Kosong',
                        text: 'Kolom "' + label + '" tidak boleh kosong',
                        icon: '<i class="zmdi zmdi-alert-triangle"></i>',
                        timeout: 3000
                    });
                    error++;
                }
            });

            if ( error == 0 ) {
                $.post(url, data, function(e){
                    if ( e.status ) {
                        snarlSuccess({
                            title: 'Success',
                            text: 'Tunggu.. Sedang mengarahkan',
                            icon: '<i class="zmdi zmdi-shield-check"></i>',
                            timeout: 1500
                        });
                        setTimeout(function(){
                            window.location.href = redirect != undefined ? redirect: root;
                        }, 1600);
                    }
                    else {
                        parent.find('[type=submit]').prop('disabled', false);
                        parent.find('[type=submit]').html('Login');
                        snarlDanger({
                            title: 'Failed',
                            text: 'Username dan Password anda tidak ditemukan',
                            icon: '<i class="zmdi zmdi-alert-triangle"></i>',
                            timeout: 3000
                        });
                    }
                },'json').fail(function(e,status) {
                    if ( e.hasOwnProperty('responseJSON') && e.status == 406 ) {
                        if ( typeof e.responseJSON == 'object' ) {
                            $('[name='+e.responseJSON.csrf.name+']').val(e.responseJSON.csrf.hash);
                        }
                    }
                    parent.find('[type=submit]').prop('disabled', false);
                    parent.find('[type=submit]').html('Login');
                    snarlDanger({
                        title: 'Failed',
                        text: e.responseJSON.message,
                        icon: '<i class="zmdi zmdi-alert-triangle"></i>',
                        timeout: 3000
                    });
                });
            }
            else {
                parent.find('[type=submit]').prop('disabled', false);
                parent.find('[type=submit]').html('Login');
            }
        });
        $('#logout').on('click', function(e){
            e.preventDefault();
            var redirect = $(this).data('redirect');
            if ( $('.alert-login')[0] == undefined ) {
                var notification = snarlInfo({
                    title: 'Are you sure ?',
                    text: 'Ya, klik disini. Tidak, silakan klik silang',
                    icon: '<i class="zmdi zmdi-help-outline"></i>',
                    timeout: null,
                    action: function(notification) {
                        Snarl.removeNotification(notification);
                        var url = root + 'services/v1/auth/logout';
                        $.get(url, function(e){
                            if ( e.status ) {
                                setTimeout(function(){
                                    window.location.href = redirect != undefined ? redirect: root;
                                }, 500);
                            }
                        }, 'json');
                    }
                }, 'alert-login');
            }
        });
        $('.login-box').find('.zmdi').on('click', function(){
            var ini = $(this), parent = ini.parents('.input-group');
            if ( ini.is('.zmdi-eye') ) {
                ini.removeClass('zmdi-eye');
                ini.addClass('zmdi-eye-off');
                ini.css('color','red');
                parent.find('input').attr('type','text');
            }
            else if ( ini.is('.zmdi-eye-off') ) {
                ini.addClass('zmdi-eye');
                ini.removeClass('zmdi-eye-off');
                ini.css('color','inherit');
                parent.find('input').attr('type','password');
            }
        });
        if ( path !== 'power-admin/' && path !== 'monitoring/' ) {
            setInterval( function() {
                $.get(root+'services/v1/auth/checking', function(e) {
                    if (!e.status) {
                        window.location = root;
                    }
                });
            }, 190000);
        }
    });
    
    
    // Skin Color Selection ####################################################
    $(document).ready(function(){
        var skin = 'themes';
        $('.themes .btn').on('click', function(){
            $('.themes .btn').each(function(i,e){
                if ( $(e).attr('class').indexOf('set') !== -1 ) {
                    $(e).removeClass('set');
                    var x = $(e).attr('class').replace(/btn|set|waves-effect|waves-light| /gi,'');
                    $('body > .container-fluid').removeClass(function (index, className) {
                        return (className.match (/(^|\s)color-\S+/g) || []).join(' ');
                    });
                    if ( x !== 'dark-mood' ) {
                        $('body').removeClass( 'color' + x );
                    }
                }
            });
            $(this).addClass('set');
            var c = $(this).attr('class').replace(/btn|set|waves-effect|waves-light| /gi,'');
            setCookie(skin, 'color' + c, 365);
            $('body > .container-fluid').addClass( 'color' + c );
            if ( c === '-dark-mood' ) {
                $('body').addClass( 'color' + c );
            }
        });
    });
    
    
    // Scrollbar ###############################################################
    $(document).ready(function(){
        if ( $('.scrollbar')[0] ) {
            SimpleScrollbar.initEl( document.querySelector('.scrollbar') );
        }
    });
    
    
    // accordion / side-dropdown navigation ####################################
    $(document).ready(function(){
        $('.sidebar .side-dropdown a').on('click', function(){
            var parent = $(this).parent('.side-dropdown');
            $('ul li').each(function(){
                if ( $(this).is('.show') && !parent.is('.show')) {
                    $(this).removeClass('show');
                    $(this).find('.nav-link').removeClass('active');
                    $(this).find('.dropdown-menu').slideUp();
                }
            });
            if ( parent.attr('class') != '' ) {
                if ( parent.attr('class').indexOf('show') === -1 ) {
                    parent.addClass('show');
                    parent.find('.nav-link').addClass('active');
                    parent.find('.dropdown-menu').slideDown();
                }
                else if ( parent.attr('class').indexOf('show') !== -1 ) {
                    parent.removeClass('show');
                    parent.find('.nav-link').removeClass('active');
                    parent.find('.dropdown-menu').slideUp();
                }
            }
        });

        $('.sidebar ul.nav li').each(function(){
            var href = $(this).find('a.nav-link').attr('href');
            var sub = $(this).attr('data-sub');
            if ( path === '' && href == root ){
                $(this).find('.nav-link').addClass('active');
            }
            if ( [path,base].indexOf(href) !== -1 ){
                $(this).find('.nav-link').addClass('active');
            }
            if ( ['javascript:void(0);','#'].indexOf(href) !== -1 && $(this).is('.side-dropdown') && sub == surl[1] ){
                $(this).addClass('show');
                $(this).find('.nav-link').addClass('active');
                $(this).find('.dropdown-menu').slideDown();
                $(this).find('.dropdown-menu a').each(function(){
                    if ( base.indexOf( $(this).attr('href') ) == 0 ){
                        $(this).addClass('active');
                    }
                });
            }
        });
    });
    
    
    // Nav-pills ###############################################################
    $(document).ready(function(){
        $('.nav-pills .nav-link').each(function(){
            var href = $(this).attr('href');
            if ( [path,base].indexOf(href) !== -1 ){
                $(this).addClass('active');
            }
        });
    });


    // DASHBOARD ###############################################################
    $(document).ready(function(){
        // cube
        var d = $('#dashboard');
        if ( d.length > 0 ) {
        }
    });


    // MASTER ##################################################################
    
    // SETTINGS ################################################################
    // Setting > general
    $(document).ready(function(){
        $('[id*="settings-"]').find('form').submit(function(e){
            e.preventDefault();
            var data = $(this).serialize();
            var url = root + 'services/v1/settings/setup';

            $.post(url, data, function(e){
                console.log(e);
                response_save(e);
            }, 'json');
        });
    });

    // Setting > account
    $(document).ready(function(){
        var $p = 'accounts';
        var main = $('#'+$p);
        btn_slidedown($p,'add');
        add_dropup($p,'add','json','settings/'+$p);
        edit_popup($p,'edit','json','settings/'+$p);
        
        // confirm password
        $('#profile #update [name=confirm_password]').on('keyup', function() {
            var parent = $(this).parents('#update');
            var pass = parent.find('[name=password]').val();
            var val = $(this).val();
            if ( pass !== val ) {
                parent.find('.form-bar').addClass('bg-danger');
            }
            if ( pass === val ) {
                parent.find('.form-bar').removeClass('bg-danger');
            }
        });
        $('#profile #update').on('submit', function(e) {
            e.preventDefault();
            
            var parent = $(this);
            var data = $(this).serialize(), name = false, files = false;
            var formdata = new FormData(this);
            var url = root + 'services/v1/settings/profile';

            var error = notif_empty(this);
            
            var pass = parent.find('[name=password]').val();
            var val = parent.find('[name=confirm_password]').val();
            if ( pass !== val ) {
                error = 1;
                snarlWarning({
                    title: 'Tidak Cocok',
                    text: 'Konfirmasi password tidak sesuai',
                    icon: '<i class="zmdi zmdi-alert-triangle"></i>',
                    timeout: 3000
                });
            }

            if ( error == 0 ) {
                // reset
                $(this).trigger('reset');
                
                $.ajax({
                    url: url,
                    data: formdata,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function(e) {
                        console.log(e);
                        if ( e.data == false ) {
                            snarlDanger({
                                title: 'Duplikat',
                                text: 'Periode Duplikat',
                                icon: '<i class="zmdi zmdi-alert-triangle"></i>',
                                timeout: 3000
                            });
                        }
                        response_save(e, base);
                    }
                });
            }
        });
    });

    $(document).ready(function(){
        $('[required]').each(function(index, row){
            var parent = $(row).parents('.form-group.md');

            if ( parent.find('label').length > 0 ) {
                parent.find('label').append( $('<span>').addClass('text-danger').text(' *)') );
            }
        });
    });
}