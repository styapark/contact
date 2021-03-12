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

var base = window.location.protocol + '//' + window.location.host + window.location.pathname;
var path = base.replace(root + 'power-admin/', '');
var surl = path.split('/');

function load( n ) {
    document.write('<script src="' + n + '"></script>');
}