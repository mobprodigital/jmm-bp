var app = angular.module('myApp', []);

app.controller('userController', function($scope, $http){
	app_home();
	function app_home() {
		$scope.name = 'Amit';
		$scope.dataLoaded = false;
		$scope.users = [];
		$http({
			url: siteurl+'users/getadvertiser',
			method: "POST",
		}).success(function (data) {
			//console.log(data);
			$scope.users = data;
			$scope.dataLoaded = true;
		});
	}


 
$scope.deleteUser = function (pId) { 
         //Defining $http service for deleting a list 
		 var r=confirm("Do you want to delete this user?")
   		 if (r==true)
		 {
		  $scope.id = undefined;
         $http({ method: 'DELETE',
                 url: siteurl+'users/json_del_user',
                 data : JSON.stringify({id:pId})     //how can i send this pId to ci controller
         }).success(function (data) {
			
          window.location.href=siteurl+'admin/users/?rdone=1';
         });
		 }
		 else
		 return false;
     }
	 
	 
	 
});

//add controller
app.controller('adduserController', function($scope, $http) {
FormController();
function FormController() {
$scope.email = /^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/;
 $scope.username = '';
 $scope.password = '';
 $scope.firstname = '';
 $scope.lastname = '';
 $scope.role = '';
 $scope.userid = '';
 $scope.status = '1';
 

 
 
 //Check username is unique or duplicate
 $scope.uniqueUser = function()
 {
	var uname=document.getElementById('username').value;
	$scope.uname=uname;
$http({
    url: siteurl+'users/json_check_user_unique',
	data: JSON.stringify({uname: $scope.uname}),
    method: "POST",
  }).success(function (data) {
	  if(data=='Duplicate')
	  {
		  alert('Username already exists');
		  document.getElementById('username').value='';
		  document.getElementById('username').focus();
		  return false;
	  }else{
		return true;  
	  }
  });
 }
  //Check username is unique or duplicate
  
  
 
 $scope.submitForm = function ()
 { 
 $http({
 method: 'POST',
 url: siteurl+'users/json_add_user',
 data: JSON.stringify({ username: $scope.username,password: $scope.password,firstname: $scope.firstname,lastname: $scope.lastname,role: $scope.role,userid: $scope.userid,status: $scope.status})

 }).success(function (data) {
	 //console.log(data);
	window.location.href=siteurl+'admin/users/?done=success';
	 });
 }
 }

});

//edit controller
app.controller('edituserController', function($scope, $http) {

editController();
function editController() {
	//get current url
	var href = document.URL;
	var selids=[];	
//get values from database
$http({
    url: siteurl+'users/json_get_userbyid',
	data: JSON.stringify({id: href.substr(href.lastIndexOf('/') + 1)}),
    method: "POST",
  }).success(function (data) {
    $scope.username = data.username;
 $scope.password = data.password;
 $scope.firstname = data.firstname;
 $scope.lastname = data.lastname;
 $scope.role = data.role;
 $scope.status = data.status;
    $scope.id = data.id;
  });
  


 //Check username is unique or duplicate
 $scope.uniqueUser = function()
 {
	var uname=document.getElementById('username').value;
	$scope.uname=uname;
$http({
    url: siteurl+'users/json_check_user_unique',
	data: JSON.stringify({uname: $scope.uname}),
    method: "POST",
  }).success(function (data) {
	  if(data=='Duplicate')
	  {
		  alert('Username already exists');
		  document.getElementById('username').value='';
		  document.getElementById('username').focus();
		  return false;
	  }else{
		return true;  
	  }
  });
 }
  //Check username is unique or duplicate
  
  


//update values in database  
 $scope.submitForm = function ()
 { 
 $http({
 method: 'POST',
 url: siteurl+'users/json_edit_user',
 data: JSON.stringify({ username: $scope.username,password: $scope.password,firstname: $scope.firstname,lastname: $scope.lastname,role: $scope.role,status: $scope.status,id: $scope.id})

 }).success(function (data) {
	 window.location.href=siteurl+'admin/users/?udone=success';
	 });
 }
 }

});



//edit controller
app.controller('settingsuserController', function($scope, $http) {

settingsController();
function settingsController() {
	//get current url
	var href = document.URL;
 $scope.newpwd = '';
 $scope.uid = href.substr(href.lastIndexOf('/') + 1);
//update values in database  
 $scope.submitForm = function ()
 { 
 $http({
 method: 'POST',
 url: siteurl+'users/settings_change/',
 data: JSON.stringify({ password:$scope.newpwd,id: $scope.uid})

 }).success(function (data) {
	 //console.log(data);
	 window.location.href=siteurl+'admin/settings/'+data+'?udone=success';
	 });
 }
 }

});