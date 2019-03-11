<?php
$rootPath 		= 'http://localhost/adserver/';
$deliveryPath	= $rootPath.'delivery/'; 
$cachePath		= $deliveryPath.'cache/';
$limitationPath	= $deliveryPath.'limitations/';
$contentPath	= $deliveryPath.'assets/content/';
$bannerPath		= $deliveryPath.'banners/images/';
$videoBannerPath		= $deliveryPath.'banners/videos/';
$includePathRoot		= $_SERVER['DOCUMENT_ROOT'];
$includePathDelivery				= $includePathRoot.'/adserver/delivery/';
$includePathCore					= $includePathDelivery.'core/';
$includePathLimitation				= $includePathDelivery.'limitations/';


//$conf = $GLOBALS['_MAX']['CONF'];
//include MAX_PATH.'/lib/vendor/autoload.php';
$servername 	= "localhost";
$username 		= "root";
$password 		= "";
$dbName			= "adserver";

?>