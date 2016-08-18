<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
if ( "OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {
die();
}
require_once('../connection/dbconn.php');
require_once('../crud/crud.php');
date_default_timezone_set('America/New_York');
$time =  date("h:i:a");
$date = date("m.d.y");
if(isset($_GET['ser_id'])){
    $ser_id = $_GET['ser_id'];
}
if(isset($_GET['std_id'])){
    $std_id = $_GET['std_id'];
}
//echo $orgname.$orgdesc.$siteaddress.$date.$hours.$advisor.$serviceType.$supervisor.$telephone.$sMail;
$db = new dbconn();
$dbconn = $db->getConnection();
$crud = new crud($dbconn);

$crud->deleteSingleResult("services","ser_id",$ser_id);
//$std_id = $crud;
$crud->insert("activity",array('std_id','spc_act_id','act_tab','act_name','act_date','act_time'),array($std_id,$ser_id,'services','deleteForm',$date,$time));
		
?>