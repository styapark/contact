var base = window.location.protocol + '//' + window.location.host + window.location.pathname;
var path = base.replace(root, '');
var surl = path.split('/');

if ($ !== undefined){
    // click delay effect
    $(document).ready(function(){
        $('a[href]').on('click', function(e){
            e.preventDefault();
            var href = $(this).attr('href');
            if ( href !== '#' && href !== 'javascript:void(0);' ) {
                setTimeout(function(){
                    window.location.href = href;
                },500);
            }
        });
    });

    // sidebar navigation
    $(document).ready(function(){
        // set kondisi #sidebar
        if ( $('#sidebar:not(.show)')[0] !== undefined ) {
            $('#content').addClass('full');
            $('[data-toggle=sidebar]').removeClass('active');
        }
        else if ( $('#sidebar.show')[0] !== undefined ) {
            $('#content').removeClass('full');
            $('[data-toggle=sidebar]').addClass('active');
        }

        $('[data-toggle=sidebar]').on('click', function(){
            if ( $('#sidebar:not(.show)')[0] !== undefined ) {
                $('#sidebar').addClass('show');
                $(this).addClass('active');
                $('#content').removeClass('full');
            }
            else if ( $('#sidebar.show')[0] !== undefined ) {
                $('#sidebar').removeClass('show');
                $(this).removeClass('active');
                $('#content').addClass('full');
            }
        });
        if ( $('#sidebar').is('.white') ) {
            $('#sidebar').find('a.waves-light').addClass('waves-effect');
            $('#sidebar').find('a.waves-light').removeClass('waves-light');
        }
    });

    // accordion / side-dropdown navigation
    $(document).ready(function(){
        $('#sidebar .side-dropdown a').on('click', function(){
            var parent = $(this).parent('.side-dropdown');
            $('.list-group li').each(function(){
                if ( $(this).is('.show') && !parent.is('.show')) {
                    $(this).removeClass('show');
                    $(this).find('.dropdown-menu').slideUp();
                }
            });
            if ( parent.attr('class').indexOf('show') === -1 ) {
                parent.addClass('show');
                parent.find('.dropdown-menu').slideDown();
            }
            else if ( parent.attr('class').indexOf('show') !== -1 ) {
                parent.removeClass('show');
                parent.find('.dropdown-menu').slideUp();
            }
        });

        console.log( path );
        $('#sidebar li').each(function(){
            var href = $(this).find('a.list-group-item').attr('href');
            var sub = $(this).attr('data-sub');
            if ( path === '' && href == root ){
                $(this).addClass('active');
            }
            if ( path.indexOf(href) == 0 ){
                $(this).addClass('active');
            }
            if ( href == 'javascript:void(0);' && $(this).is('.side-dropdown') && sub == surl[0] ){
                $(this).addClass('show');
                $(this).find('.dropdown-menu').slideDown();
                $(this).find('.dropdown-menu a').each(function(){
                    if ( $(this).attr('href') == path ){
                        $(this).addClass('active');
                    }
                });
            }
        });
    });

    // login and logout ajax
    $(document).ready(function(){
        $('#login').submit(function(e){
            e.preventDefault();
            var data = $(this).serialize();
            var url = root + 'service/auth/login';
            var error = 0;

            $(this).serializeArray().forEach(function(e){
                if ( !e.value ) {
                    snarlWarning({
                        title: 'Form Kosong',
                        text: 'Kolom "' + e.name + '" tidak boleh kosong',
                        icon: '<i class="fa fa-warning"></i>',
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
                            icon: '<i class="fa fa-check"></i>',
                            timeout: 1500
                        });
                        setTimeout(function(){
                            window.location.href = root;
                        }, 1600);
                    }
                    else {
                        snarlDanger({
                            title: 'Failed',
                            text: 'Username dan Password anda tidak ditemukan',
                            icon: '<i class="fa fa-warning"></i>',
                            timeout: 3000
                        });
                    }
                }, 'json');
            }
        });
        $('#logout').on('click', function(e){
            e.preventDefault();
            if ( $('.alert-login')[0] == undefined ) {
                var notification = snarlInfo({
                    title: 'Are you sure ?',
                    text: 'Ya, klik disini. Tidak, silakan klik silang',
                    icon: '<i class="fa fa-question-circle-o"></i>',
                    timeout: null,
                    action: function(notification) {
                        Snarl.removeNotification(notification);
                        var url = root + 'service/auth/logout';
                        $.get(url, function(e){
                            if ( e.status ) {
                                setTimeout(function(){
                                    window.location.href = root;
                                }, 500);
                            }
                        }, 'json');
                    }
                }, 'alert-login');
            }
        });
    });
    
    // TABLE START
    $(document).ready(function(){
        $('.table').bootstrapTable('destroy').bootstrapTable({
            locale: 'id-ID',
            height: '500',
            toolbar: '#toolbar',
            search: true,
            showColumns: true,
            showRefresh: true,
            pagination: true,
            paginationFirstText: 'Pertama',
            paginationPreText: 'Sebelum',
            paginationNextText: 'Berikut',
            paginationLastText: 'Terakhir'
        });
        if ( $('#table-report')[0] !== undefined ) {
            $('.table').bootstrapTable('destroy');
        }
        
        var data = [];
        if ( checkCookie( 'GPID-cart' ) ) {
            data = JSON.parse( getCookie( 'GPID-cart' ) );
        }
        $('.table-cart').bootstrapTable({
            locale: 'id-ID',
            height: '450',
            toolbar: '#toolbar',
            search: false,
            showColumns: false,
            showRefresh: true,
            pagination: true,
            paginationFirstText: 'Pertama',
            paginationPreText: 'Sebelum',
            paginationNextText: 'Berikut',
            paginationLastText: 'Terakhir',
            data: data
        });
    });
    
    /* start ajax action table cart */
    window.tableCart = {
        'click span[title=Delete]': function (e, value, row, index) {
            var parent = $('[data-token]'), name = parent.attr('name'), value = parent.attr('value');
            //var data = { [name]: value, 'id': row.id_cart };
            var cart = [], data = [];
            
            if ( $('.delete-' + row.id_cart)[0] == undefined ) {
                snarlWarning({
                    title: 'are you sure delete "' + row.item + '"?',
                    text: 'Ya, klik disini. Tidak, silakan klik silang',
                    icon: '<i class="fa fa-warning"></i>',
                    timeout: null,
                    action: function(notification) {
                        Snarl.removeNotification(notification);
                        
                        if ( checkCookie( 'GPID-cart' ) ) {
                            data = JSON.parse( getCookie( 'GPID-cart' ) );
                            data.forEach(function(z) {
                                if ( z.id_cart != row.id_cart ) {
                                    cart.push(z);
                                }
                            });
                            setCookie( 'GPID-cart', JSON.stringify( cart ) );
                            $('.table-cart').bootstrapTable('refreshOptions',{ data: cart });
                        }
                    }
                }, 'delete-' + row.id_cart );
            }
        }
    };
    /* end ajax action table cart */
    /* start ajax action table transaction */
    
    function actionReceiptship(value, row, index) {
        return '<div class="text-center"><span class="badge info-color" title="Resi"><i class="fa fa-edit fa-1x"></i></span>';
    }
    window.transactionReceiptship = {
        'click span[title=Resi]': function (e, value, row, index) {
            var main = $('#receiptship');
            if ( row.receiptship ) {
                main.find('[name=receiptship]').val( row.receiptship );
            }
            main.find('[name=id]').val( row.id );
            main.modal('show');
        }
    };
    window.transactionList = {
        'click span[title=Print]': function (e, value, row, index) {
            window.open(root + 'transaction/print/' + row.invoice, '_blank');
        },
        'click span[title=Delete]': function (e, value, row, index) {
            var parent = $('[data-token]'), name = parent.attr('name'), value = parent.attr('value');
            var data = { [name]: value, 'id': row.id };
            if ( $('.delete-' + row.id)[0] == undefined && row.receiptship ) {
                snarlWarning({
                    title: 'are you sure delete Invoice : ' + row.invoice + '?',
                    text: 'Ya, klik disini. Tidak, silakan klik silang',
                    icon: '<i class="fa fa-warning"></i>',
                    timeout: null,
                    action: function(notification) {
                        Snarl.removeNotification(notification);
                        var url = root + 'service/post/delete/transaction';
                        $.post(url, data, function(e){
                            if ( e.status ) {
                                $('#table-transaction-list').bootstrapTable('refresh');
                            }
                        }, 'json');
                    }
                }, 'delete-' + row.id );
            }
            else {
                snarlWarning({
                    title: 'Maaf, resi masih kosong',
                    text: 'Ya, klik disini. Tidak, silakan klik silang',
                    icon: '<i class="fa fa-warning"></i>',
                    timeout: 3000
                });
            }
        }
    };
    /* end ajax action table transaction */
    /* start ajax action table product list */
    window.productList = {
        'click span[title=Edit]': function (e, value, row, index) {
            window.location = root + 'product/edit/' + row.id;
        },
        'click span[title=Delete]': function (e, value, row, index) {
            var parent = $('[data-token]'), name = parent.attr('name'), value = parent.attr('value');
            var data = { [name]: value, 'id': row.id };
            if ( $('.delete-' + row.id)[0] == undefined ) {
                snarlWarning({
                    title: 'are you sure delete "' + row.name + '"?',
                    text: 'Ya, klik disini. Tidak, silakan klik silang',
                    icon: '<i class="fa fa-warning"></i>',
                    timeout: null,
                    action: function(notification) {
                        Snarl.removeNotification(notification);
                        var url = root + 'service/post/delete/product';
                        $.post(url, data, function(e){
                            if ( e.status ) {
                                $('#table-product-list').bootstrapTable('refresh');
                            }
                        }, 'json');
                    }
                }, 'delete-' + row.id );
            }
        }
    };
    /* end ajax action table product list */
    /* start ajax action table shipment list */
    window.shipmentList = {
        'click span[title=Edit]': function (e, value, row, index) {
            window.location = root + 'shipment/edit/' + row.id;
        },
        'click span[title=Delete]': function (e, value, row, index) {
            var parent = $('[data-token]'), name = parent.attr('name'), value = parent.attr('value');
            var data = { [name]: value, 'id': row.id };
            if ( $('.delete-' + row.id)[0] == undefined ) {
                snarlWarning({
                    title: 'are you sure delete "' + row.name + '"?',
                    text: 'Ya, klik disini. Tidak, silakan klik silang',
                    icon: '<i class="fa fa-warning"></i>',
                    timeout: null,
                    action: function(notification) {
                        Snarl.removeNotification(notification);
                        var url = root + 'service/post/delete/shipment';
                        $.post(url, data, function(e){
                            if ( e.status ) {
                                $('#table-shipment-list').bootstrapTable('refresh');
                            }
                        }, 'json');
                    }
                }, 'delete-' + row.id );
            }
        }
    };
    /* end ajax action table product list */
    // TABLE END
    
    // DATE START
    $(document).ready(function(){
        setInterval(function(){
            var date = new Date();
            var ms = date.getTime() / 1000;
            $('#date-1').val( timestamp_datetime( ms ) );
            $('#date-2').val( ms );
        }, 1000);
    });
    // DATE END
    
    // TYPEHEAD START
    $(document).ready(function(){
        
        // transaction
        if ( ( $('#add-form')[0] || $('#edit-form')[0] ) && path.search('transaction') !== -1 ) {
            console.log('transaction');
            $.get( root + 'service/tables/product/skuname', function(e){
                $('#search').typeahead({ source: e });
            }, 'json');
            $('#search').change(function() {
                var select = $(this).typeahead("getActive");
                if ( select ) {
                    if ( select.name == $(this).val() ) {
                        var data;
                        $.get(root + 'service/tables/product', function(e){
                            e.forEach(function(z){
                                if ( z.id == select.id ){
                                    data = z;
                                }
                            });
                            
                            $('[name=id_cart]').val(data.id);
                            $('[name=item]').val(data.name);
                            $('[name=sku]').val(data.sku);
                            $('[name=price]').val(data.priceout).trigger('input');
                            $('[name=qty]').val(1);
                        }, 'json');
                    }
                }
            });
            $.get( root + 'service/tables/transaction/destination', function(e){
                $('[name=destination]').typeahead({ source: e });
            }, 'json');
            $('[name=destination]').change(function() {
                $(this).typeahead("getActive");
            });
            $.get( root + 'service/tables/shipment/nametype', function(e){
                $('#nametype').typeahead({ source: e });
            }, 'json');
            $('#nametype').change(function() {
                var select = $(this).typeahead("getActive");
                if ( select ) {
                    if ( select.name == $(this).val() ) {
                        $('[name=id_shipment]').val(select.id);
                    }
                }
            });
        }
        
        // product
        if ( ( $('#add-form')[0] || $('#edit-form')[0] ) && path.search('product') !== -1 ) {
            console.log('product');
            $.get( root + 'service/tables/product/category', function(e){
                $('[name=category]').typeahead({ source: e });
            }, 'json');
            $('[name=category]').change(function() {
                $(this).typeahead("getActive");
            });
            $.get( root + 'service/tables/product/type', function(e){
                $('[name=type]').typeahead({ source: e });
            }, 'json');
            $('[name=type]').change(function() {
                $(this).typeahead("getActive");
            });
            $.get( root + 'service/tables/product/color', function(e){
                $('[name=color]').typeahead({ source: e });
            }, 'json');
            $('[name=color]').change(function() {
                $(this).typeahead("getActive");
            });
            $.get( root + 'service/tables/product/sku', function(e){
                $('#sku').typeahead({ source: e });
            }, 'json');
            $('#sku').change(function() {
                var select = $(this).typeahead("getActive");
                if ( select ) {
                    if ( select.name == $(this).val() ) {
                        var data;
                        $.get(root + 'service/tables/product', function(e){
                            e.forEach(function(z){
                                if ( z.sku == select.name ){
                                    data = z;
                                }
                            });
                            
                            $('[name=id_product]').val(data.id);
                            $('[name=name]').val(data.name);
                            $('[name=category]').val(data.category_text);
                            $('[name=type]').val(data.type_text);
                            
                            $.get(root + 'service/tables/product/stock', function(f){
                                if ( f.status ) {
                                    $('[name=total]').val(0);
                                }
                                else {
                                    f.forEach(function(x){
                                        if ( x.id_product == data.id ){
                                            $('[name=total]').val(x.total);
                                        }
                                    });
                                }
                            },'json');
                        },'json');
                    }
                }
                else {
                    $(this).val('');
                }
            });
            if ( $('#edit-form')[0] ) {
                var val = $('[name=priceout]').val();
                var id  = $('[name=id]').val();
                if ( val == '' || val == 0 ) {
                    $.get( root + 'service/tables/product/min_price', function(e){
                        if ( e.status ) {}
                        else {
                            e.forEach(function(x){
                                if ( x.id_product == id ){
                                    $('[name=priceout]').val(x.price).trigger('input');
                                }
                            });
                        }
                    }, 'json');
                }
            }
        }
        
        
    });
    // TYPEHEAD END
    
    // FORM START
    $(document).ready(function(){
        if ( $('#add-form')[0] ) {
            var fx = '#add-form';
            var form = $(fx);
            console.log(fx);
            form.find('button[type=submit]').on('click',function(e){
                e.preventDefault();
                var formdata = {}, parent = $(this).parents('form'), modal = $('#add'), start, end, d = new Date();
                var param = parent.attr('name'), action = parent.attr('action'), length = 0, count = 0;

                parent.serializeArray().forEach(function(z) {
                    if ( (z.value == '' || z.value == null) && $('[name=' + z.name + ']').is('[required]') ){
                        snarlWarning({
                            title: 'Form Kosong',
                            text: 'Kolom tidak boleh kosong',
                            icon: '<i class="fa fa-warning"></i>',
                            timeout: 2000
                        });
                    }
                    else {
                        formdata[ z.name ] = z.value;
                        count++;
                    }
                    length++;
                });
                
                
                if ( checkCookie( 'GPID-cart' ) && $('#cart-form')[0] ) {
                    formdata['cart'] = getCookie( 'GPID-cart' );
                }
                if ( count == length ) {
                    formdata = serialize( formdata );
                    $.ajax({
                        xhr: function() {
                            var xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener("progress", function(evt) {
                                modal.modal();
                                    if (evt.lengthComputable) {
                                        var percentComplete = evt.loaded / evt.total;
                                        percentComplete = parseInt(percentComplete * 100);
                                        start = d.getMilliseconds();
                                        modal.find('.progress-bar').width(percentComplete + '%');
                                        modal.find('h4').text(percentComplete + ' %');
                                        if (percentComplete === 100) {
                                            end = d.getMilliseconds();
                                            modal.find('.progress-bar').addClass('bg-success');
                                        }
                                    }
                            }, false);
                            return xhr;
                        },
                        url: root + 'service/post/add/' + param,
                        type: 'POST',
                        data: formdata,
                        dataType: 'json',
                        processData: false,
                        success: function (e) {
                            console.log(e);
                            if (e.status){
                                if ((end - start) < 100){
                                    window.setTimeout(function(){
                                        modal.modal('hide');
                                        window.location = action;
                                    },2000);
                                }
                                else{
                                    modal.modal('hide');
                                    window.location = action;
                                }
                                snarlSuccess({
                                    title: 'Success',
                                    text: 'Data tersimpan',
                                    icon: '<i class="fa fa-check"></i>',
                                    timeout: 3000
                                });
                            }
                            else{
                                snarlWarning({
                                    title: 'Failed',
                                    text: 'Data gagal tersimpan',
                                    icon: '<i class="fa fa-warning"></i>',
                                    timeout: 3000
                                });
                            }
                        }
                    });
                }
            });
        }
    });
    $(document).ready(function(){
        if ( $('#edit-form')[0] ) {
            var fx = '#edit-form';
            var form = $(fx);
            console.log(fx);
            form.find('button[type=submit]').on('click',function(e){
                e.preventDefault();
                var formdata = {}, parent = $(this).parents('form'), modal = $('#edit'), start, end, d = new Date();
                var param = parent.attr('name'), action = parent.attr('action'), length = 0, count = 0;

                parent.serializeArray().forEach(function(z) {
                    if ( (z.value == '' || z.value == null) && $('[name=' + z.name + ']').is('[required]') ){
                        snarlWarning({
                            title: 'Form Kosong',
                            text: 'Kolom tidak boleh kosong',
                            icon: '<i class="fa fa-warning"></i>',
                            timeout: 2000
                        });
                    }
                    else {
                        formdata[ z.name ] = z.value;
                        count++;
                    }
                    length++;
                });
                
                
                if ( checkCookie( 'GPID-cart' ) && $('#cart-form')[0] ) {
                    formdata['cart'] = getCookie( 'GPID-cart' );
                }
                if ( count == length ) {
                    formdata = serialize( formdata );
                    $.ajax({
                        xhr: function() {
                            var xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener("progress", function(evt) {
                                modal.modal();
                                    if (evt.lengthComputable) {
                                        var percentComplete = evt.loaded / evt.total;
                                        percentComplete = parseInt(percentComplete * 100);
                                        start = d.getMilliseconds();
                                        modal.find('.progress-bar').width(percentComplete + '%');
                                        modal.find('h4').text(percentComplete + ' %');
                                        if (percentComplete === 100) {
                                            end = d.getMilliseconds();
                                            modal.find('.progress-bar').addClass('bg-success');
                                        }
                                    }
                            }, false);
                            return xhr;
                        },
                        url: root + 'service/post/edit/' + param,
                        type: 'POST',
                        data: formdata,
                        dataType: 'json',
                        processData: false,
                        success: function (e) {
                            console.log(e);
                            if (e.status){
                                if ((end - start) < 100){
                                    window.setTimeout(function(){
                                        modal.modal('hide');
                                        window.location = action;
                                    },2000);
                                }
                                else{
                                    modal.modal('hide');
                                    window.location = action;
                                }
                                snarlSuccess({
                                    title: 'Success',
                                    text: 'Data tersimpan',
                                    icon: '<i class="fa fa-check"></i>',
                                    timeout: 3000
                                });
                            }
                            else{
                                snarlWarning({
                                    title: 'Failed',
                                    text: 'Data gagal tersimpan',
                                    icon: '<i class="fa fa-warning"></i>',
                                    timeout: 3000
                                });
                            }
                        }
                    });
                }
            });
        }
    });
    
    // CART START
    $(document).ready(function(){
        if ( $('#cart-form')[0] ) {
            var fx = '#cart-form', cookie = 'GPID-cart';
            var form = $(fx), data = {};
            
            console.log(fx);
            
            $('#empty-cart').on('click', function(){
                deleteCookie( cookie );
                $('.table-cart').bootstrapTable('refreshOptions',{ data: data });
            });
            
            form.find('button[type=submit]').on('click',function(e){
                e.preventDefault();
                var parent = $(this).parents('form'), d = new Date(), cart = [], total = 0;
                parent.serializeArray().forEach(function(y){
                    var nm = ['qty','price'];
                    if ( y.value !== '' && nm.indexOf(y.name) === -1 ) {
                        data[ y.name ] = y.value;
                    }
                    else if ( y.value !== '' && nm.indexOf(y.name) !== -1 ) {
                        data[ y.name ] = parseInt( y.value.replace('.','') );
                        data[ y.name + '_text' ] = y.value;
                    }
                    $('[name=' + y.name + ']').val('');
                });
                data['subtotal'] = data.qty * data.price;
                data['subtotal_text'] = numberFormat(data.qty * data.price,0);
                
                if ( data.length == {} ) {
                    snarlWarning({
                        title: 'Form Kosong',
                        text: 'Kolom tidak boleh kosong',
                        icon: '<i class="fa fa-warning"></i>',
                        timeout: 2000
                    });
                }
                else {
                    if ( checkCookie( cookie ) ) {
                         cart = JSON.parse( getCookie( cookie ) );
                    }
                    cart.push( data );
                    setCookie( cookie, JSON.stringify( cart ) );
                    $('.table-cart').bootstrapTable('refreshOptions',{ data: cart });
                }
            });
        }
    });
    // CART END
    
    // MODAL FORM START
    $(document).ready(function(){
        $('#receiptship').submit(function(e){
            e.preventDefault();
            var form = $(this).serialize();
            $.post(root + 'service/post/edit/transaction', form, function(e){
                if ( e.status ) {
                    $('#receiptship').modal('hide');
                    $('.table-cart').bootstrapTable('refresh');
                    snarlSuccess({
                        title: 'Success',
                        text: 'Data tersimpan',
                        icon: '<i class="fa fa-check"></i>',
                        timeout: 3000
                    });
                }
                else{
                    snarlWarning({
                        title: 'Failed',
                        text: 'Data gagal tersimpan',
                        icon: '<i class="fa fa-warning"></i>',
                        timeout: 3000
                    });
                }
            },'json');
        });
    });
    // MODAL FORM END
    // FORM END
}
else {
    alert('jQuery is not found.');
}