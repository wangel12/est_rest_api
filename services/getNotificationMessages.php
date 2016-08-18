<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
if ( "OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {
die();
}
require_once('../connection/dbconn.php');
require_once('../crud/crud.php');

//echo $orgname.$orgdesc.$siteaddress.$date.$hours.$advisor.$serviceType.$supervisor.$telephone.$sMail;
$db = new dbconn();
$dbconn = $db->getConnection();
$crud = new crud($dbconn);
$rows = array();

$nt_rs = $crud->fetchResultSetOrder("notification_lists","nl_id","10");
$i=0;
while($row = $nt_rs->fetch_assoc()){
	$rows["noti"]["$i"]["nl_title"]= $row["nl_title"];
	$rows["noti"]["$i"]["nl_msg"]= $row["nl_msg"];
	$rows["noti"]["$i"]["nl_is_Seen"]= $row["is_Seen"];
	$i++;
}
echo json_encode($rows);
?>