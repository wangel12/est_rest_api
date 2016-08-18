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
@$std_id = $request->std_id;
@$std_gradYear = $request->std_gradYear;
@$std_lname = $request->std_lname;
@$std_fname = $request->std_fname;
$db = new dbconn();
$dbconn = $db->getConnection();
$crud = new crud($dbconn);
//$serviceList = new serviceList($crud);
//$serviceList->listServices();
echo $crud->update("students",array('std_fname','std_lname','std_gradYear'),array($std_fname,$std_lname,$std_gradYear),"std_id",$std_id);
?>