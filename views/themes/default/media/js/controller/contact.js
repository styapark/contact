gpid.controller('contactController', function( $scope, $http, $timeout ) {
    $scope.defaultTitle = 'Pribadi';
    $scope.title = $scope.defaultTitle;
    $scope.detail_type = [
        { value: 'phone', label: 'Telepon' },
        { value: 'email', label: 'E-mail' },
        { value: 'tags', label: 'Tags' },
        { value: 'note', label: 'Catatan' }
    ];
});
gpid.controller('AddController', function( $scope, $http, $timeout, $element ) {
    $scope.tableDetails = [];
    $scope.rowDetail = {
        type: 'phone',
        title: '',
        value: ''
    };
    $scope.addDetail = function ( index = null ) {
        var row = angular.copy($scope.rowDetail);
        row.title = $scope.title;
        $scope.title = $scope.defaultTitle;

        $scope.tableDetails.push(row);
    };
    $scope.addDetail();

//    $($element).submit(function(e){
//        e.preventDefault();
//        console.log('aja');
//    });
});
gpid.controller('AddDetailController', function( $scope, $http, $timeout, $element ) {
    $scope.$watch('detail.type', function($current){
        if ( $current == 'phone' ) {
            $timeout(function(){
                window.dataNumber( $($element).find('[data-number]') );
            },50);
        }
    });
});


gpid.controller('EditController', function( $scope, $http, $timeout ) {
    $scope.tableDetails = [];
});
gpid.controller('EditDetailController', function( $scope, $http, $timeout ) {
    
});