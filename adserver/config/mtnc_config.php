<?php
$rootPath 		= 'http://localhost/adserver/';
$includeRoot	= $_SERVER['DOCUMENT_ROOT'];
$deliveryPath	= $rootPath.'delivery/'; 
$cachePath		= $deliveryPath.'cache/';

define("OX_PATH", $includeRoot.'/adserver');
define("CACHE_PATH", $includeRoot.'/adserver/delivery/cache/');

define("LIB_PATH", $includeRoot.'/adserver/lib/OT');
define("MAX_PATH", $_SERVER['DOCUMENT_ROOT'].'/adserver/');





//$conf = $GLOBALS['_MAX']['CONF'];
//include MAX_PATH.'/lib/vendor/autoload.php';
$servername 	= "localhost";
$username 		= "root";
$password 		= "";
$dbName			= "adserver";

?>