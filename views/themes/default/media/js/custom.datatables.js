/**
 * Custom Action Datatables
 * My Lite CMS v.3.0.0
 * copyright Styapark Dev 2016 - 2021
 * @author styapark
 * @email styapark@gmail.com
 * All rights reserved.
 */

if ( $ !== undefined ) {
    var m = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    $(document).ready(function(){
        /* ON COMPLETE */
        window.global_datatables[0]._table.on('draw.dt', function ( e, settings, json, xhr ) {
            $('[title=Delete]').on('click',function(e){
                e.preventDefault();
                var tr = $(this).parents('tr');
                var api = window.global_datatables[0]._table.api();
                var ajaxs = api.ajax;
                var row = api.row(tr).data();
                var $title, $urlPath;
                console.log(row, row.id);

                if ( base.search('master/contact') !== -1 ) {
                    $title = row.name;
                    $urlPath = 'contact/' + row.id;
                }

                if ( row.id !== undefined ) {
                    notif_delete('"' + $title + '"', $urlPath, api.row(tr), ajaxs);
                }

            });
        });
        if ( base.search('master/contact') !== -1 ) {
            window.global_datatables[0]._table.on('draw.dt', function ( e, settings, json, xhr ) {
                $('[title=Edit]').on('click',function(e){
                    e.preventDefault();
                    var tr = $(this).parents('tr');
                    var api = window.global_datatables[0]._table.api();
                    var row = api.row(tr).data();
                    console.log(row);

                    // define
                    var scope = angular.element( $('#edit') ).scope();
                    scope.id = row.id;
                    scope.name = row.name;
                    scope.company = row.company;
                    scope.address = row.address;
                    scope.address_company = row.address_company;
                    scope.tableDetails = [];
                    if ( typeof row.details == 'object' ) {
                        row.details.forEach(function(v,i){
                            scope.editDetail( null, v.title, v.type, v.value );
                        });
                    }
                    else {
                        scope.addDetail();
                    }
                    // apply
                    scope.$apply();

                    // call modal
                    $('#edit').modal('show');
               });
            });
        }
    });
}