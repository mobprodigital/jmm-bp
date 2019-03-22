<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/adserver/config/mtnc_config.php';
function connect(){
	$connection = mysqli_connect(
		$GLOBALS['servername'],
		$GLOBALS['username'],
		$GLOBALS['password'],
		$GLOBALS['dbName']
	);
	$oDbh 		= $connection;
	return $oDbh;
 }
?>