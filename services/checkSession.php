<?php 
ini_set('session.save_path',getcwd(). '/tmp');
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
if ( "OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {
die();
}
//$_SESSION["std_id"] = 1;

//echo phpinfo();
if(isset($_SESSION["std_id"])){
	echo json_encode(array("session"=>"true","status"=>"200"));
}else {
	session_unset();
	session_destroy();
	echo  json_encode(array("session"=>"false","status"=>"402"));
}


?>