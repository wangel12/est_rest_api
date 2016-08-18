<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
if ( "OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {
die();
}
require_once('../connection/dbconn.php');
require_once('../crud/crud.php');


$postdata = file_get_contents("php://input");
$request = $postdata;
echo $request; 
$db = new dbconn();
$dbconn = $db->getConnection();
$crud = new crud($dbconn);

$crud->insert("notification_users",array('nu_token'),array($request));

?>