<?php

require_once("../connection/dbconn.php");

class advisors{
	protected $db;
	
	function __construct($db){
		$this->db = $db;
	}

	function getAdvisorsList(){
			$query = "SELECT * FROM `advisors`";
			$adv_list = array();
			$result = $this->db->query($query);
			if($result) {
		    	//echo "record read successfully";
		    	$k=0;
				while($adv_row = $result->fetch_assoc()){
					$adv_list["advisor"]["$k"]["adv_fname"]=$adv_row["adv_fname"]." ".$adv_row["adv_lname"];
					$adv_list["advisor"]["$k"]["adv_lname"]=$adv_row["adv_lname"];
					$adv_list["advisor"]["$k"]["adv_id"]=$adv_row["adv_id"];
					$k++;
				}
				return $adv_list;
			} else {
			    echo "Error: " . $query . "<br>" . $this->db->error;
			}
	}
}
?>