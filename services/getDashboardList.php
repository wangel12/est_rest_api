<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
if ( "OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {
die();
}
require_once('../connection/dbconn.php');
require_once('../crud/crud.php');
/*
* Collect all Details from Angular HTTP Request.
*/ 
if(isset($_GET['id'])){
    $std_id = $_GET['id'];
}
    
//echo $orgname.$orgdesc.$siteaddress.$date.$hours.$advisor.$serviceType.$supervisor.$telephone.$sMail;
$db = new dbconn();
$dbconn = $db->getConnection();
$crud = new crud($dbconn);
$rows = array();

$rs = $crud->fetchSingleResultSetOrder("activity","std_id",$std_id,"act_id");
$settrs = $crud->fetchResultSet("settings");

while($settrow = $settrs->fetch_assoc()){
    $rows["Hours"]["est_hour"] = $settrow["sett_hour"];   
}
$total_hours_done = 0;
$hrs = $crud->fetchSingleResultSet("services","std_id",$std_id);

while($hrsrow = $hrs->fetch_assoc()){
    if($hrsrow["sers_id"] == 1){
            $total_hours_done = $total_hours_done + $hrsrow["ser_hr"];
    }
}
$i=0;
$rows["Hours"]["total_hours_done"] = $total_hours_done;

//loop activity
while($row = $rs->fetch_assoc()){
    //echo $row["act_id"];
    $getOrg = $crud->fetchSingleResultSet("organizations","ser_id",$row["spc_act_id"]);
    $getSup = $crud->fetchSingleResultSet("supervisors","ser_id",$row["spc_act_id"]);
    $getAdv = $crud->fetchSingleResultSet("services","ser_id",$row["spc_act_id"]);

    while($advrow = $getAdv->fetch_assoc()){
            $rows["data"]["$i"]["ser_date"] = $advrow["ser_date"];
            $rows["data"]["$i"]["ser_hr"] = $advrow["ser_hr"];
            $rows["data"]["$i"]["sers_id"] = $advrow["sers_id"];
            $advrs = $crud->fetchSingleResultSet("advisors","adv_id",$advrow["adv_id"]);
            while($advrsrow = $advrs->fetch_assoc()){
                $rows["data"]["$i"]["adv_fname"] = $advrsrow["adv_fname"];
                $rows["data"]["$i"]["adv_lname"] = $advrsrow["adv_lname"];
            }
    }

    while($orgrow = $getOrg->fetch_assoc()){
          $rows["data"]["$i"]["org_name"] = $orgrow["org_name"];  
          $rows["data"]["$i"]["org_desc"] = $orgrow["org_desc"];  
          $rows["data"]["$i"]["org_address"] = $orgrow["org_address"];  
    }
    while($suprow = $getSup->fetch_assoc()){
          $rows["data"]["$i"]["supervisor_fname"] = $suprow["sup_fname"];  
    }
    if($row['act_name'] == "insertForm"){
         $rows["data"]["$i"]["message"] = "Service hour on review";
    }
    else if($row['act_name'] == 'deleteForm'){
         $rows["data"]["$i"]["message"] = "Service hour deleted";
    }
    else if($row['act_name'] == "accepted s"){
        $rows["data"]["$i"]["message"] = "Service form accepted";
    }
    else if($row['act_name'] == "rejected s"){
        $rows["data"]["$i"]["message"] = "Service form rejected";
    }
    $rows["data"]["$i"]["act_id"] = $row["act_id"];
    $rows["data"]["$i"]["act_time"] = $row["act_time"];
    $rows["data"]["$i"]["act_date"] = $row["act_date"];
    if($row['act_name'] == "insertForm"){
            $serrs = $crud->fetchSingleResultSet("services","ser_id",$row['spc_act_id']);
            while($innrow = $serrs->fetch_assoc()){
                //$rows["data"]["$i"]["message"] = "You submitted your Volunteer Form";
                //$rows["data"]["$i"]["act_id"] = $row["act_id"];
            }
            
    }
    $i++;
}
echo json_encode($rows);
?>