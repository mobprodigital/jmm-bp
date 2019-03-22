
function userController($scope,$http) {
// first show the loading animation
$('#class_activity').addClass('loading');
$scope.pages = [];
$http.get('http://192.168.1.100/kanika/trevo/index.php/admin/pages/json_get_pages').success(function($data){ $scope.pages=$data;  $('#class_activity').removeClass('loading'); });
}

function deletePage(id){
   var r=confirm("Do you want to delete this with all its child category?")
   if (r==true)
      window.location = "http://fcdemoserver.com/php/trevoinsurance/admin/category/delete/"+id;
   else
     return false;
} 

function deletePages(id){
   var r=confirm("Do you want to delete this page?")
   if (r==true)
      window.location = "http://fcdemoserver.com/php/trevoinsurance/admin/pages/delete/"+id;
   else
     return false;
} 

function deleteFaq(id){
   var r=confirm("Do you want to delete this Question?")
   if (r==true)
      window.location = "http://fcdemoserver.com/php/trevoinsurance/admin/faq/delete/"+id;
   else
     return false;
} 

function deleteTesti(id){
   var r=confirm("Do you want to delete this Testimonial?")
   if (r==true)
      window.location = "http://fcdemoserver.com/php/trevoinsurance/admin/testimonials/delete/"+id;
   else
     return false;
} 

function deleteclient(id){
   var r=confirm("Do you want to delete this Client?")
   if (r==true)
      window.location = "http://fcdemoserver.com/php/trevoinsurance/admin/clients/delete/"+id;
   else
     return false;
} 

function deletebanner(id){
   var r=confirm("Do you want to delete this Banner?")
   if (r==true)
      window.location = "http://fcdemoserver.com/php/trevoinsurance/admin/banners/delete/"+id;
   else
     return false;
} 

function deleteList(id){
   var r=confirm("Do you want to delete this?")
   if (r==true)
      window.location = "http://fcdemoserver.com/php/trevoinsurance/admin/whytrevo/delete/"+id;
   else
     return false;
} 

function deletehomebanner(id){
   var r=confirm("Do you want to delete this Banner?")
   if (r==true)
      window.location = "http://fcdemoserver.com/php/trevoinsurance/admin/homebanner/delete/"+id;
   else
     return false;
} 


function deleteimage(name){
   var r=confirm("Do you want to delete this image?")
   if (r==true)
      window.location = "http://fcdemoserver.com/php/trevoinsurance/admin/media/delete/"+name;
   else
     return false;
} 

