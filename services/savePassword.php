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
@$std_oldpass = $request->old;
@$std_newpass = $request->new;

$db = new dbconn();
$dbconn = $db->getConnection();
$crud = new crud($dbconn);
//$serviceList = new serviceList($crud);
//$serviceList->listServices();
echo $crud->update("students",array('std_password'),array($std_newpass),"std_id",$std_id);
?>