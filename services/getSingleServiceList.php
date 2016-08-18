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
require_once('../crud/advisors.php');
require_once('../crud/serviceType.php');
require_once('../crud/services.php');
require_once('../crud/supervisors.php');
$postdata = file_get_contents("php://input");
$ser_id = $postdata;
//echo $ser_id;

$db = new dbconn();
$dbconn = $db->getConnection();
//$crud = new crud($dbconn);
$advisors = new advisors($dbconn);
$st = new serviceType($dbconn);
$services = new services($dbconn);
$supervisors = new supervisors($dbconn);

$arr = array();
$arr["advisor_info"] = $advisors->getAdvisorsList();
$arr["st_info"] = $st->getServiceType();
$arr["service_info"] = $services->getSingleService($ser_id);
$arr["supervisor_info"] = $supervisors->getSingleSupervisor($ser_id);
echo json_encode($arr);
//echo $st->getServiceType();
//echo $services->getSingleService(150);




?>