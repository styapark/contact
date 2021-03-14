gpid.controller('contactController', function( $scope, $http, $timeout ) {
    $scope.defaultTitle = 'Pribadi';
    $scope.title = $scope.defaultTitle;
    $scope.detail_type = [
        { value: 'phone', label: 'Telepon' },
        { value: 'email', label: 'E-mail' },
        { value: 'tags', label: 'Tags' },
        { value: 'note', label: 'Catatan' }
    ];
    $scope.rowDetail = {
        id: 0,
        type: 'phone',
        title: '',
        value: '',
        visible: 1
    };
});
gpid.controller('AddController', function( $scope, $http, $timeout, $element, $filter ) {
    $scope.tableDetails = [];
    $scope.addDetail = function ( index = null ) {
        var row = angular.copy($scope.rowDetail);
        row.title = $scope.title;
        $scope.title = $scope.defaultTitle;

        $scope.tableDetails.push(row);
        $timeout(function(){
            $($element).find('[ng-model="detail.value"]:last-of-type').focus();
        }, 10);
    };
    $scope.addDetail();
    $scope.$watch('search', function( $current ){
        if ( $current != undefined ) {
            var main_index = [], arr_index = [];
            var copy = angular.copy($scope.tableDetails);
            main_index = Array.from($scope.tableDetails.keys());
            var filter = $filter('filter')( copy, function(r){
                return r.title.indexOf($current) !== -1 || r.value.indexOf($current) !== -1;
            });
            filter.forEach(function(row) {
                var index = $scope.tableDetails.findIndex(function(r){
                    return r.title == row.title || (row.value != '' && r.value == row.value);
                });
                arr_index.push(index);
            });

            // hide and unhide process
            var difference = arrayDiff(main_index, arr_index);
            $scope.tableDetails.forEach(function(row, index){
                $scope.tableDetails[ index ].visible = 1;
                if ( difference.indexOf(index) !== -1 ) {
                    $scope.tableDetails[ index ].visible = 0;
                }
            });
        }
    });
});
gpid.controller('AddDetailController', function( $scope, $http, $timeout, $element ) {
    $scope.$watch('detail.type', function( $current ){
        if ( $current == 'phone' ) {
            $timeout(function(){
                window.dataNumber( $($element).find('[data-number]') );
            },50);
        }
    });
});


gpid.controller('EditController', function( $scope, $http, $timeout, $element, $filter ) {
    $scope.tableDetails = [];
    $scope.addDetail = function ( index = null ) {
        var row = angular.copy($scope.rowDetail);
        row.title = $scope.title;
        $scope.title = $scope.defaultTitle;

        $scope.tableDetails.push(row);
        $timeout(function(){
            $($element).find('[ng-model="detail.value"]:last-of-type').focus();
        }, 10);
    };
    $scope.addDetail();
    $scope.$watch('search', function( $current ){
        if ( $current != undefined ) {
            var main_index = [], arr_index = [];
            var copy = angular.copy($scope.tableDetails);
            main_index = Array.from($scope.tableDetails.keys());
            var filter = $filter('filter')( copy, function(r){
                return r.title.indexOf($current) !== -1 || r.value.indexOf($current) !== -1;
            });
            filter.forEach(function(row) {
                var index = $scope.tableDetails.findIndex(function(r){
                    return r.title == row.title || (row.value != '' && r.value == row.value);
                });
                arr_index.push(index);
            });

            // hide and unhide process
            var difference = arrayDiff(main_index, arr_index);
            $scope.tableDetails.forEach(function(row, index){
                $scope.tableDetails[ index ].visible = 1;
                if ( difference.indexOf(index) !== -1 ) {
                    $scope.tableDetails[ index ].visible = 0;
                }
            });
        }
    });
});
gpid.controller('EditDetailController', function( $scope, $http, $timeout, $element ) {
    $scope.$watch('detail.type', function( $current ){
        if ( $current == 'phone' ) {
            $timeout(function(){
                window.dataNumber( $($element).find('[data-number]') );
            },50);
        }
    });
});