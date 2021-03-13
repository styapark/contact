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

gpid.directive('form', function( $rootScope, $http ){
    return {
        restrict: 'E',
        require: '^?form',
        link: function (scope, form, attrs) {
            $(form).submit(function(e){
                e.preventDefault();

                var url = $(this).data('action');
                var data = $(this).serializeArray();

                if ( scope.parsley.isValid() && url != undefined ) {
                    console.log(data);
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