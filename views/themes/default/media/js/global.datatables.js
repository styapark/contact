/**
 * Custom Datatables using Server Side for process
 * My Lite CMS v.3.0.0
 * copyright Styapark Dev 2016 - 2021
 * @author styapark
 * @email styapark@gmail.com
 * All rights reserved.
 */

window.global_datatables = [];
if ( $ !== undefined ) {
    $(document).ready(function(){
        var setup = {
            lang: root + 'media/js/37d130f57c6b594011739b65f2758653',
            id: '.table-server-side',
            mapping: { _table: {}, url: '', data: [], id: '' }
        };

        // looping
        $(setup.id).each(function( index ){
            setup.mapping.id = setup.id;
            window.global_datatables.push( setup.mapping );

            var column = [], lengthMenu = [], order = [];
            var src = $(this).attr('data-src');
            var callback = $(this).find('th[data-callback]').attr('data-callback');
            var ordering = $(this).attr('data-ordering') !== undefined ? $(this).attr('data-ordering'): true;
            var lengthMenus = $(this).attr('data-lengthmenu') !== undefined ? $(this).attr('data-lengthmenu').split(','): [ 10, 25, 50, 100 ];
            lengthMenus.forEach(function(value,index){
                lengthMenu[index] = parseInt(value);
            });
            $(this).find('th[data-field]').each(function(i,e){
                var a = {};
                a['data'] = $(this).attr('data-field');
                a['orderable'] = $(this).attr('data-order') == 'false' ? false: true;
                column.push(a);
            });
            $(this).find('th').each(function(i,e){
                var a = [];
                a[0] = i;
                a[1] = $(this).attr('data-order');
                if ( $(this).attr('data-order') != undefined ) {
                    order.push(a);
                }
            });

            if ( src !== undefined ) {
                var options = {
                    processing: true, // Feature control the processing indicator.
                    serverSide: true, // Feature control DataTables' server-side processing mode.
                    lengthMenu: lengthMenu,
                    ordering: ordering,
                    ajax: {
                        url: src
                    },
                    order: order,
                    columns: column,
                    columnDefs: [
                        {
                            orderable: false,
                            targets: 0,
                            className: "text-nowrap"
                        },
                        {
                            targets: -1,
                            className: "text-nowrap",
                            data: "__callback",
                            defaultContent: eval( callback )
                        }
                    ],
                    createdRow: function( row, data, dataIndex){
                        window.global_datatables[ index ].data.push(data);
                        if ( data.status == 1 ) {
                            $(row).addClass('light-green lighten-5');
                        }
                    }
                };
                if ( base.search('settings/accounts') === -1 ) {
                    options['language'] = {
                        url: setup.lang
                    };
                }
                window.global_datatables[ index ]._table = $(this).dataTable( options );
                window.global_datatables[ index ].url = window.global_datatables[ index ]._table.api().ajax.url();
            }
        });

        /* action */
        if ( window.global_datatables.length > 0 ) {
            /* ON COMPLETE */
            if ( base.search('settings/accounts') !== -1 ) {
                window.global_datatables[0]._table.on('xhr.dt', function ( e, settings, json, xhr ) {
                    xhr.done(function(result) {
                        $(window.global_datatables[0].id).find('tbody tr').each(function() {
                            var row = window.global_datatables[0]._table.api().row(this).data();

                            if ( [undefined,'0',null].indexOf(row.active) !== -1 ) {
                                $(this).find('[title=Power] i').removeClass('zmdi-power green-text');
                                $(this).find('[title=Power] i').addClass('zmdi-power-setting red-text');
                            }
                        });
                    });
                });

                /* IN ACTIVE */
                $(window.global_datatables[0].id).find('tbody').on('click', 'label[title=Inactive]', function(){
                    var row = window.global_datatables[0]._table.api().row( $(this).parents('tr') ).data();

                    window.location = base + ( base.search('set') === -1 ? '/set/' + row.id: '');
                });

                /* POWER */
                $(window.global_datatables[0].id).find('tbody').on('click', 'span[title=Power]', function(){
                    var row = window.global_datatables[0]._table.api().row( $(this).parents('tr') ).data();

                    window.location = base + ( base.search('suspend') === -1 ? '/suspend/' + row.id: '');
                });

                /* EDIT */
                $(window.global_datatables[0].id).find('tbody').on('click', 'span[title=Edit]', function(){
                    var row = window.global_datatables[0]._table.api().row( $(this).parents('tr') ).data();
                    var m = $('#edit');

                    if ( row.id !== undefined ) {
                        m.modal();
                        m.find('[name=id]').val( row.id );
                        m.find('[name=first_name]').val( row.first_name );
                        m.find('[name=last_name]').val( row.last_name );
                        m.find('[name=username]').val( row.username );
                        m.find('[name=email]').val( row.email );
                    }
                    else {
                        alert('Tidak dapat dimanipulasi');
                    }
                });

                /* DELETE */
                $(window.global_datatables[0].id).find('tbody').on('click', 'span[title=Delete]', function(){
                    var parent = $(this).parents('tr');
                    var api = window.global_datatables[0]._table.api().row( parent );
                    var ajaxs = window.global_datatables[0]._table.api().ajax;
                    var row = api.data();
                    var name = $(this).parents('table').attr('name') + '/delete/';

                    if ( row.id !== undefined && row.group_id < 9 ) {
                        notif_delete('"' + row.fullname + '"', name + row.id, api, ajaxs);
                    }
                    else {
                        alert('Tidak dapat dimanipulasi');
                    }
                });
            }
        }
    });
}