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
       /*
	   * Collect all Details from Angular HTTP Request.
	   */ 
	    $postdata = file_get_contents("php://input");
	    $request = json_decode($postdata);
    	@$fname = $request->fname;
    	//@$checked = $request->checked;
    	@$lname = $request->lname;
    	@$email = $request->enEmail;
    	@$gradYear = $request->gradYear;
    	@$password = $request->enPass;
    	@$token = $request->token;

		$db = new dbconn();
		$dbconn = $db->getConnection();
		$crud = new crud($dbconn);
		$stdRow=$crud->countRows("students","std_email",$email);
		//echo $stdRow;
		$msg = array();
		if($stdRow == 1){
			$msg["status"] = "taken";
		}else if($stdRow == 0){
			//echo json_encode(array("status"=>"registration_successful"));
			
		    $crud->insert("students",array('std_fname','std_lname','std_email','std_gradYear','std_password','std_isActive','token'),array($fname,$lname,$email,$gradYear,$password,1,$token));
		    $msg["status"] = "free";
		}

		echo json_encode($msg);
		
?>