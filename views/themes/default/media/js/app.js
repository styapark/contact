var gpid = angular.module('greenprojectid',['parsley']);
gpid.config(['$provide', function ($provide) {
    $provide.decorator('$controller', [ '$delegate', function ($delegate) {
        return function(constructor, locals) {
            if (typeof constructor == "string") {
                locals.$scope.controllerName =  constructor;
            }
            return $delegate.apply(this, [].slice.call(arguments));
        }
    }]);
}]);

gpid.directive('form', function( $rootScope, $http, $httpParamSerializerJQLike ){
    return {
        restrict: 'E',
        require: '^?form',
        link: function (scope, form, attrs) {
            $(form).submit(function(e){
                e.preventDefault();

                var url = $(this).data('action');
                var redirect = $(this).data('redirect');
                var data = $(this).serialize();

                if ( scope.parsley.isValid() && url != undefined ) {
                    $http({
                        url: url,
                        method: 'POST',
                        data: data,
                        headers: {
                            'content-type': 'application/x-www-form-urlencoded; charset=UTF-8'
                        }
                    }).then(function(res, a, b){
                        if ( typeof res.data == 'object' ) {
                            var data = res.data;
                            if ( data.hasOwnProperty('csrf') ) {
                                $('[name=' + data.csrf.name + ']').val( data.csrf.hash );
                            }
                        }

                        var text = 'Berhasil menyimpan ke database';
                        if ( [200,201].indexOf(res.status) !== -1 ) {
                            console.log(res);

                            snarlSuccess({
                                title: 'Success',
                                text: text,
                                icon: '<i class="zmdi zmdi-shield-check"></i>',
                                timeout: 1500
                            });
                            setTimeout(function(){
                                if ( redirect != undefined ) {
                                    location.href = redirect;
                                }
                            }, 1600);
                            if ( $(form).hasClass('modal') ) {
                                $(form).modal('hide');
                            }
                        }
                        else {
                            snarlDanger({
                                title: 'Failed',
                                text: 'Gagal menyimpan ke database. Ulangi kembali',
                                icon: '<i class="zmdi zmdi-alert-triangle"></i>',
                                timeout: 3000
                            });
                            
                        }
                    },function(err){
                        var text = 'Unknown error';
                        if ( typeof err.data == 'object' ) {
                            var data = err.data;
                            if ( data.hasOwnProperty('csrf') ) {
                                $('[name=' + data.csrf.name + ']').val( data.csrf.hash );
                            }
                        }

                        if ( [200,201].indexOf(err.status) === -1 ) {
                            if ( [500,502,503].indexOf(err.status) !== -1 ) {
                                text = 'Error Server';
                            }
                            if ( err.status == 504 ) {
                                text = 'Timeout access to Server';
                            }
                            if ( err.status == 403 ) {
                                text = 'Token expired! reload page, please';
                            }
                            snarlDanger({
                                title: 'Failed',
                                text: text,
                                icon: '<i class="zmdi zmdi-alert-triangle"></i>',
                                timeout: 3000
                            });
                        }
                    });
                }
            });
        }
    };
});

var base = window.location.protocol + '//' + window.location.host + window.location.pathname;
var path = base.replace(root + 'power-admin/', '');
var surl = path.split('/');

function load( n ) {
    document.write('<script src="' + n + '"></script>');
}