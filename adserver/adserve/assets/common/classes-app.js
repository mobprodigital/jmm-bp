var app = angular.module('myApp', []);

app.controller('classesController', function($scope, $http) {
app_home();
function app_home() {
  $scope.name = 'Amit';
  // Initialising the variable.
  $scope.dataLoaded = false;
  $scope.classes = [];
  // Getting the list of users through ajax call.
  $http({
    url: siteurl+'classes/json_get_classes',
    method: "POST",
  }).success(function (data) {
    $scope.classes = data;
	
	$scope.dataLoaded = true;
  });
}


 
$scope.deleteClass = function (pId) { 
         //Defining $http service for deleting a list 
		 var r=confirm("Do you want to delete this class with its all time slots?")
   		 if (r==true)
		 {
		  $scope.id = undefined;
         $http({ method: 'DELETE',
                 url: siteurl+'classes/json_del_class',
                 data : JSON.stringify({id:pId})     //how can i send this pId to ci controller
         }).success(function (data) {
			
          window.location.href=siteurl+'admin/classes/?rdone=1';
         });
		 }
		 else
		 return false;
     }
	 
	 
	 
});





