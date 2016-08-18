<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
if ( "OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {
die();
}
require_once('../connection/dbconn.php');
require_once('../crud/crud.php');
require_once('../crud/ServiceList.php');



if(isset($_GET['status']){
	$status = $_GET['status'];
}
?>