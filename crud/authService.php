<?php
//session_start();
class AuthServices{
	private $user;
	private $pass;
	protected $crud;
	function __construct($crud){
			$this->crud = $crud;
	}

	function authUserPass($user,$pass){
		$user = $user;
		//$this->pass = $pass;


		$rs = $this->crud->fetchSingleResultSet("students","std_email",$user);
		//echo mysqli_num_rows($rs);
		if(mysqli_num_rows($rs)<1){
			echo json_encode(array("status"=>402));
			//need to register since no data associated with the given email
		}else{
			while($row = $rs->fetch_assoc()){
				//match password
				if($row['std_password'] == $pass){
					//if student is active
					if($row['std_isActive'] == 1){
	
							$arr = array(
										"std_fname"=>$row["std_fname"],
										"std_lname"=>$row["std_fname"],
										"std_id"=>$row["std_id"],
										"status"=>1);
							 echo json_encode($arr);
					}else{
						//echo "is inactive";
						$arr = array("status"=>403);
						//session_destroy();
						echo json_encode($arr);
					}
				}else{
						//echo "wrong password";
						$arr = array("status"=>402);
						//session_destroy();
						echo json_encode($arr);
				}
			}
		}//
	}
}

?>