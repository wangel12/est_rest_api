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
       /*
	   * Collect all Details from Angular HTTP Request.
	   */ 
	    $postdata = file_get_contents("php://input");
	    $request = json_decode($postdata);
    	@$orgname = $request->orgname;
    	@$orgdesc = $request->orgdesc;
    	@$siteaddress = $request->location;
    	@$date = $request->date;
    	@$hours = $request->hours;
    	@$advisor = $request->advisor;
    	@$serviceType = $request->serviceType;
        //echo $serviceType;
    	@$supervisor = $request->supervisor;
    	@$telephone = $request->telephone;
    	@$sMail = $request->sEmail;
    	@$date = $request->date;
    	@$std_id = $request->std_id;
    
    	//echo $orgname.$orgdesc.$siteaddress.$date.$hours.$advisor.$serviceType.$supervisor.$telephone.$sMail;
	  	$db = new dbconn();
		$dbconn = $db->getConnection();
		$crud = new crud($dbconn);

        $schyr = $crud->returnLatestID("school_years","sch_year");

		$crud->insert("services",array('std_id','ser_date','adv_id','sers_id','ser_hr','serty_id','school_year'),array($std_id,$date,$advisor,3,$hours,$serviceType,$schyr));
		$last_id = $crud->returnLatestID("services","ser_id");
		$crud->insert("organizations",array('org_name','org_desc','org_address','ser_id'),array($orgname,$orgdesc,$siteaddress,$last_id));
		$crud->insert("supervisors",array('ser_id','sup_fname','sup_email','sup_phone'),array($last_id,$supervisor,$sMail,$telephone));
        $crud->insert("activity",array('std_id','spc_act_id','act_tab','act_name','act_date','act_time'),array($std_id,$last_id,'services','insertForm',$date,$time));
		
?>