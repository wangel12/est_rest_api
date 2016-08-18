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

$adv_rs = $crud->fetchResultSet("advisors");
$i=0;
while($row = $adv_rs->fetch_assoc()){
	$rows["advisors"]["$i"]["adv_id"]= $row["adv_id"];
		$rows["advisors"]["$i"]["adv_fname"]= $row["adv_fname"];
		$rows["advisors"]["$i"]["adv_lname"]= $row["adv_lname"];
		$i++;
}
$serty_rs = $crud->fetchResultSet("service_types");
$j=0;
while($row = $serty_rs->fetch_assoc()){
		$rows["service_types"]["$j"]["serty_id"]= $row["serty_id"];
		$rows["service_types"]["$j"]["serty_name"]= $row["serty_name"];
		$j++;
}

echo json_encode($rows);
?>