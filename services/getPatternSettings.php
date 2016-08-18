<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
if ( "OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {
die();
}


require_once('../connection/dbconn.php');
require_once('../crud/crud.php');
require_once('../crud/emailPattern.php');
$postdata = file_get_contents("php://input");
$ser_id = $postdata;
//echo $ser_id;

$db = new dbconn();
$dbconn = $db->getConnection();
//$crud = new crud($dbconn);
$emailPattern = new emailPattern($dbconn);
echo json_encode($emailPattern->getEmailPattern());

//secho json_encode($arr);
//echo $st->getServiceType();
//echo $services->getSingleService(150);




?>
