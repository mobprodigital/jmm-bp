var app = angular.module('myApp', []);

  

app.controller('dashboardController', function($scope, $http) {
app_home();
function app_home() {
  $scope.name = 'Amit';
  // Initialising the variable.
  
  





  $scope.users=[];
 //get users
	$http({
    url: 'http://localhost/sales/users/json_get_user',
    method: "POST",
  }).success(function (data) {
    $scope.users = data;
  }); 
  
  //get groups
	$http({
    url: 'http://localhost/sales/groups/json_get_group',
    method: "POST",
  }).success(function (data) {
    $scope.groups = data;
  });
  
  //contacts
   $scope.contacts = [];
  // Getting the list of users through ajax call.
  $http({
    url: 'http://localhost/sales/contacts/json_get_contact',
    method: "POST",
  }).success(function (data) {
    $scope.contacts = data;
  });
  
  
  
  $scope.workingprojects = [];
  // Getting the list of users through ajax call.
  $http({
    url: 'http://localhost/sales/report/json_get_report',
	data: JSON.stringify({str:'Working'}),
    method: "POST",
  }).success(function (data) {
    $scope.workingprojects = data;
	$scope.workingTotal = calculateworking('Working');
  });
  
  $scope.wonprojects = [];
  // Getting the list of users through ajax call.
  $http({
    url: 'http://localhost/sales/report/json_get_report',
	data: JSON.stringify({str:'Won'}),
    method: "POST",
  }).success(function (data) {
    $scope.wonprojects = data;
	$scope.wonTotal = calculatewon('Won');
  });
  
  
   $scope.lostprojects = [];
  // Getting the list of users through ajax call.
  $http({
    url: 'http://localhost/sales/report/json_get_report',
	data: JSON.stringify({str:'Lost'}),
    method: "POST",
  }).success(function (data) {
    $scope.lostprojects = data;
	$scope.lostTotal = calculatelost('Lost');
  });
  
//Chart details
	$http({
    url: 'http://localhost/sales/report/json_get_report_chart',
	data: JSON.stringify({str:''}),
    method: "POST",
  }).success(function (data) {	
  $scope.opportunities=data;
		 // LINE CHART
        var line = new Morris.Line({
          element: 'line-chart',
          resize: true,
          data: data,
          xkey: 'salesstage',
          ykeys: ['amount'],
          labels: ['Amount'],
          lineColors: ['#3c8dbc'],
          hideHover: 'auto'
        });

  });
  
  //fetch highest quoted opportunities
  $http({
    url: 'http://localhost/sales/report/json_get_report_highquote',
    method: "POST",
  }).success(function (data) {	
  $scope.opportunities=data;
		  });

}
	
function calculateworking($str)
{
	$http({
    url: 'http://localhost/sales/report/json_get_total',
	data: JSON.stringify({str:$str}),
    method: "POST",
  }).success(function (data) {
    $scope.totalWorking = data;
  });
}

function calculatewon($str)
{
	$http({
    url: 'http://localhost/sales/report/json_get_total',
	data: JSON.stringify({str:$str}),
    method: "POST",
  }).success(function (data) {
    $scope.totalWon = data;
  });
}
function calculatelost($str)
{
	$http({
    url: 'http://localhost/sales/report/json_get_total',
	data: JSON.stringify({str:$str}),
    method: "POST",
  }).success(function (data) {
    $scope.totalLost = data;
  });
}
	

	
	 
});




