<?php

require_once("../connection/dbconn.php");

class supervisors{
	protected $db;
	
	function __construct($db){
		$this->db = $db;
	}

	function getSingleSupervisor($ser_id){
			$query = "SELECT * FROM `supervisors` WHERE ser_id =".$ser_id."";
			$adv_list = array();
			$result = $this->db->query($query);
			if($result) {
					$k=0;
					while($adv_row = $result->fetch_assoc()){
						$adv_list["supervisor"]["$k"]["sup_id"]=$adv_row["sup_id"];
						$adv_list["supervisor"]["$k"]["sup_fname"]=$adv_row["sup_fname"];
						$adv_list["supervisor"]["$k"]["sup_phone"]=$adv_row["sup_phone"];
						$adv_list["supervisor"]["$k"]["sup_email"]=$adv_row["sup_email"];
						$k++;
					}
					return $adv_list;
			} else {
			    echo "Error: " . $query . "<br>" . $this->db->error;
			}
	}
}
?>