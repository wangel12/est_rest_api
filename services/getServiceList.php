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
//$postdata = file_get_contents("php://input");

if(isset($_GET['id'])){
	$std_id = $_GET['id'];
}
$db = new dbconn();
$dbconn = $db->getConnection();
$crud = new crud($dbconn);
$serviceList = new serviceList($crud);
$serviceList->listServices($std_id);
?>