<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
if ( "OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {
die();
}
require_once('../connection/dbconn.php');
require_once('../crud/crud.php');

if(isset($_GET['edit'])){
	$edit = $_GET['edit'];
}
       /*
	   * Collect all Details from Angular HTTP Request.
	   */ 
	    $postdata = file_get_contents("php://input");
	    $request = json_decode($postdata);
    	@$orgname = $request->orgname;
    	//echo $orgname."--";
        @$ser_id = $request->ser_id;
    	@$orgdesc = $request->orgdesc;
    	@$siteaddress = $request->location;
    	@$date = $request->date;
    	@$hours = $request->hours;
    	@$advisor = $request->advisor;
    	@$serviceType = $request->serviceType;
    	@$supervisor = $request->supervisor;
    	@$telephone = $request->telephone;
    	@$sMail = $request->sEmail;
    	@$date = $request->date;
    	@$std_id = $request->std_id;
    
    	echo $serviceType;//.$supervisor.$telephone.$sMail;$orgname.$orgdesc.$siteaddress.$date.$hours.$advisor.
	  	$db = new dbconn();
		$dbconn = $db->getConnection();
		$crud = new crud($dbconn);

		if(isset($_GET['edit'])){
			$orgrs = $crud->fetchSingleResultSet("organizations","ser_id",$ser_id);
            while($orgrow = $orgrs->fetch_assoc()){
                    $orgid = $orgrow["org_id"];
            }
			$crud->update("organizations",array('org_name','org_address','org_desc'),array($orgname,$siteaddress,$orgdesc),"org_id",$orgid);
			//$ser_id = $crud->returnLatestID("services","ser_id");
			$crud->update("services",array('ser_date','serty_id','adv_id','ser_hr'),array($date,$serviceType,$advisor,$hours),"ser_id",$ser_id);
            $crud->update("supervisors",array('sup_fname','sup_email','sup_phone'),array($supervisor,$sMail,$telephone),"ser_id",$ser_id);
		}
?>