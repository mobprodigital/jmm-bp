
<?php include('E:\xampp\htdocs\test\sinergi\UserAgent.php');?>
<?php include('E:\xampp\htdocs\test\sinergi\Browser.php');?>
<?php include('E:\xampp\htdocs\test\sinergi\BrowserDetector.php');?>

<?php include('E:\xampp\htdocs\test\sinergi\Os.php');?>
<?php include('E:\xampp\htdocs\test\sinergi\OsDetector.php');?>

<?php include('E:\xampp\htdocs\test\sinergi\Device.php');?>
<?php include('E:\xampp\htdocs\test\sinergi\DeviceDetector.php');?>
<?php include('E:\xampp\htdocs\test\sinergi\Mobile_Detect.php');?>
<?php //http://demo.mobiledetect.net/ ?>

<?php
function checkclientuseragent($userAgent){
	$browser		= new Browser($userAgent);
	$browser->getName();
}

/* function clientos($userAgent){
	$os		= new Os($userAgent);
	$os->getName();
	
} */

$detect = new Mobile_Detect();

// Check for any mobile device.
if ($detect->isMobile()){
	echo 'mobile';
	
	 // mobile content
}else if($detect->isTablet()){
		echo 'tablet';

   // other content for desktops
}else{
	 echo 'desktop';
}

function device($userAgent){
	$device		= new Device($userAgent);
	$device->getName();
	
}

$userAgent			= $_SERVER['HTTP_USER_AGENT'];
//device($userAgent);
//clientos($userAgent);
checkclientuseragent($userAgent);
?>









