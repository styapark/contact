/**
 * Created by Marco Bunge on 18.08.2015.
 * Inspired by http://ryanalberts.com/797/parsley-validation-with-angularjs/
 */
(function (angular, jq, window, document) {
    'use strict';
    //var ngParsley = angular.module('parsley', [])
    //ngParsley.constant('parsleyConfig', {});

    var ngParsleyJs = angular.module('parsley', []);

    //add config
    ngParsleyJs.provider('parsleyConfig', function(){
        this.parsleyConfig = {};
        this.$get = function(){
            return this.parsleyConfig;
        };

        this.setConfig = function(config){
            this.parsleyConfig = config;
        };
    });

    var parsleyFieldDirective = function ($timeout) {
        return {
            restrict: 'E',
            require: '^?form',
            link: function (scope, field, c) {
                jq(field).on('change blur', function () {
                    jq(this).parsley().validate();
                });
            }
        };
    };

    ngParsleyJs.parsleyOptions = {
        priorityEnabled: false,
        errorsWrapper: '<ul class="parsley-error-list"></ul>'
    };

    ngParsleyJs.directive('form', ['$timeout', 'parsleyConfig', function ($timeout, parsleyConfig) {
        var createParsleyInstance = function(form){
            return jq(form).parsley(parsleyConfig);
        };
        return {
            restrict: 'E',
            require: '^?form',
            link: function (scope, form, attrs) {
                form.bind('$destroy', function () {
                    scope.parsley.destroy();
                });

                if (!scope.parsley) {
                    scope.parsley = createParsleyInstance(form);
                    $timeout(function () {
                        //scope.parsley.validate()
                    }, 100);
                }

                scope.$on('blur');

                scope.$on('feedReceived', function () {
                    if (!scope.parsley) {
                        scope.parsley = createParsleyInstance(form);
                    }
                    scope.parsley.validate();
                });
            }
        };
    }]);

    //We register our parsley logic for various element types.
    ngParsleyJs.directive('input', parsleyFieldDirective);
    ngParsleyJs.directive('textarea', parsleyFieldDirective);
    ngParsleyJs.directive('select', parsleyFieldDirective);
})(angular, jQuery, window, document);