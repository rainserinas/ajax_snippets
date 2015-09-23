var app = angular.module('sectionApp', []);
app.controller('sectionctrl', function($scope,$http) {
    
	





	onloadData();


	function onloadData(){

		$http({
		    url: "http://localhost/project_api/index.php/portfoliocontroller/select_portfolio", 
		    method: "GET"
		}).success(function(data) {
		   
			console.log(data);
			$scope.tabledata = data;
		});



	}


});