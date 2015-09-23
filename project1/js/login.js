var app = angular.module('loginApp', []);
app.controller('myCtrl', function($scope,$interval) {
    
	$scope.myVar = false;
	$scope.fail = false;

	$scope.login = function() {
       
		if($scope.username === 'admin' && $scope.password === 'admin'){
				
				$scope.myVar = !$scope.myVar;
				var interval = $interval(function() {
						$scope.myVar = false;
						window.location = "section.html";
		        }, 2000);
		}else{

				$scope.fail = !$scope.fail;
		    	var interval = $interval(function() {
						$scope.fail = false;
		        }, 2000);
		}


    };


});