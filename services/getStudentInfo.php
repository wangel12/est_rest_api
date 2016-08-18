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

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$db = new dbconn();
$dbconn = $db->getConnection();
$crud = new crud($dbconn);
//$serviceList = new serviceList($crud);
//$serviceList->listServices();
$rs = $crud->fetchSingleResultSet("students","std_id",$request);

while($row = $rs->fetch_assoc()){
	echo json_encode(array("std_fname"=>$row["std_fname"],
				"std_lname"=>$row["std_lname"],
				"std_email"=>$row["std_email"],
				"std_gradYear"=>$row["std_gradYear"],
				"std_id"=>$row["std_id"],
				"std_password"=>$row["std_password"]));
//echo "<h1>Pirnting</h1>";
}
?>