<?php

require_once("../connection/dbconn.php");

class serviceType{
	protected $db;
	
	function __construct($db){
		$this->db = $db;
	}

	function getserviceType(){
			$query = "SELECT * FROM `service_types`";
			$st_list = array();
			$result = $this->db->query($query);
			if($result) {
		    	//echo "record read successfully";
		    	$k=0;
				while($adv_row = $result->fetch_assoc()){
					$st_list["st"]["$k"]["serty_id"]=$adv_row["serty_id"];
					$st_list["st"]["$k"]["serty_name"]=$adv_row["serty_name"];
					$k++;
				}
				return $st_list;
			} else {
			    echo "Error: " . $query . "<br>" . $this->db->error;
			}
	}
}
?>