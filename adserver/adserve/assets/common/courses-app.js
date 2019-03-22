var app = angular.module('myApp', []);

app.controller('coursesController', function($scope, $http) {
app_home();
function app_home() {
  $scope.name = 'Amit';
  // Initialising the variable.
  $scope.dataLoaded = false;
  $scope.courses = [];
  // Getting the list of users through ajax call.
  $http({
    url: siteurl+'courses/json_get_courses',
    method: "POST",
  }).success(function (data) {
    $scope.courses = data;
	
	$scope.dataLoaded = true;
  });
}


 
$scope.deleteCourse = function (pId) { 
         //Defining $http service for deleting a list 
		 var r=confirm("Do you want to delete this course with all its classes?")
   		 if (r==true)
		 {
		  $scope.id = undefined;
         $http({ method: 'DELETE',
                 url: siteurl+'courses/json_del_course',
                 data : JSON.stringify({id:pId})     //how can i send this pId to ci controller
         }).success(function (data) {
			
          window.location.href=siteurl+'admin/courses/?rdone=1';
         });
		 }
		 else
		 return false;
     }
	 
	 
	 
});

//add controller
app.controller('addcourseController', function($scope, $http) {
FormController();
function FormController() {
 $scope.title = '';
 $scope.short_desc = '';
 $scope.description = '';
 $scope.fromduration = '';
  $scope.toduration = '';
 $scope.price = '';
 $scope.teacher = '';
 $scope.status = '1';
 
 //fetch teachers
$scope.teachers = [];
  // Getting the list of users through ajax call.
  $http({
    url: siteurl+'users/json_get_teacher',
    method: "POST",
  }).success(function (data) {
    $scope.teachers = data;
  });
 
 
 //Check username is unique or duplicate
 $scope.uniqueCourse = function()
 {
	var title=document.getElementById('title').value;
	$scope.title=title;
$http({
    url: siteurl+'courses/json_check_course_unique',
	data: JSON.stringify({title: $scope.title}),
    method: "POST",
  }).success(function (data) {
	  if(data=='Duplicate')
	  {
		  alert('Course Title already exists');
		  document.getElementById('title').value='';
		  document.getElementById('title').focus();
		  return false;
	  }else{
		return true;  
	  }
  });
 }
  //Check username is unique or duplicate
  
  
 
 $scope.submitForm = function ()
 { 
 $scope.fromduration=document.getElementById('fromduration').value;
 $scope.toduration=document.getElementById('toduration').value;
 
var selectedteacher = new Array();
$("input:checkbox[id=teacher]:checked").each(function() {
       selectedteacher.push($(this).val());
  });
$scope.teacher=selectedteacher;

 $http({
 method: 'POST',
 url: siteurl+'courses/json_add_course',
 data: JSON.stringify({ title: $scope.title,short_desc: $scope.short_desc,description: $scope.description,fromduration: $scope.fromduration,toduration: $scope.toduration,status: $scope.status,price: $scope.price,teachers : $scope.teacher})

 }).success(function (data) {
	 //console.log(data);
	window.location.href=siteurl+'admin/courses/?done=success';
	 });
 }
 }

});

//edit controller
app.controller('editcoursesController', function($scope, $http) {

editController();
function editController() {
	//get current url
	var href = document.URL;
	var selids=[];	
//get values from database
$http({
    url: siteurl+'courses/json_get_coursebyid',
	data: JSON.stringify({id: href.substr(href.lastIndexOf('/') + 1)}),
    method: "POST",
  }).success(function (data) {
    $scope.title = data.title;
 $scope.short_desc = data.short_desc;
 $scope.description = data.description;
 var duration=data.duration;
 var dur=duration.split(' - ');
 
 $scope.fromduration = dur[0];
 $scope.toduration = dur[1];
 $scope.price = data.price;
 $scope.status = data.status;
 $scope.teacher = data.teachers;
 
    $scope.id = data.id;

  });
  
   //fetch teachers
$scope.teachers = [];
  // Getting the list of users through ajax call.
  $http({
    url: siteurl+'users/json_get_teacher',
    method: "POST",
  }).success(function (data) {
    $scope.teachers = data;
  });


 //Check username is unique or duplicate
 $scope.uniqueCourse = function()
 {
	var title=document.getElementById('title').value;
	$scope.title=title;
$http({
    url: siteurl+'course/json_check_course_unique',
	data: JSON.stringify({title: $scope.title}),
    method: "POST",
  }).success(function (data) {
	  if(data=='Duplicate')
	  {
		  alert('Title already exists');
		  document.getElementById('title').value='';
		  document.getElementById('title').focus();
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
 $scope.fromduration=document.getElementById('fromduration').value;
 $scope.toduration=document.getElementById('toduration').value;
 var selectedteacher = new Array();
$("input:checkbox[id=teacher]:checked").each(function() {
       selectedteacher.push($(this).val());
  });
$scope.teacher=selectedteacher;


 $http({
 method: 'POST',
 url: siteurl+'courses/json_edit_course',
 data: JSON.stringify({ title:$scope.title,short_desc: $scope.short_desc,description: $scope.description,fromduration: $scope.fromduration,toduration: $scope.toduration,status: $scope.status,price: $scope.price,teachers : $scope.teacher,id: $scope.id})

 }).success(function (data) {
	 
	 window.location.href=siteurl+'admin/courses/?udone=success';
	 });
 }
 }

});



