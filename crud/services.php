<?php

require_once("../connection/dbconn.php");

class services{
	protected $db;
	
	function __construct($db){
		$this->db = $db;
	}

	function getSingleService($ser_id){
			$query = "SELECT * FROM `services` WHERE ser_id =".$ser_id."";
			$adv_list = array();
			$result = $this->db->query($query);
			if($result) {
		    	$k=0;
				while($adv_row = $result->fetch_assoc()){
					$adv_list["services"]["$k"]["ser_date"]=$adv_row["ser_date"];
					$adv_list["services"]["$k"]["ser_hr"]=$adv_row["ser_hr"];
					$adv_list["services"]["$k"]["serty_id"]=$adv_row["serty_id"];
					$adv_list["services"]["$k"]["sers_id"]=$adv_row["sers_id"];
					$adv_list["services"]["$k"]["adv_id"]=$adv_row["adv_id"];

					$org_query = "SELECT * FROM `organizations` WHERE `ser_id`=".$ser_id."";
					$org_result = $this->db->query($org_query);

					while($org_row = $org_result->fetch_assoc()){
						$adv_list["services"]["$k"]["org_name"]=$org_row["org_name"];
						$adv_list["services"]["$k"]["org_desc"]=$org_row["org_desc"];
						$adv_list["services"]["$k"]["org_address"]=$org_row["org_address"];
					}

					$k++;
				}
				return $adv_list;
			} else {
			    echo "Error: " . $query . "<br>" . $this->db->error;
			}
	}
}
?>