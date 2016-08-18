<?php

require_once("../connection/dbconn.php");

class emailPattern{
	protected $db;
	
	function __construct($db){
		$this->db = $db;
	}

	function getEmailPattern(){
			$query = "SELECT * FROM `school_emails` ORDER BY `id` DESC LIMIT 1";
			$pattern = array();
			$result = $this->db->query($query);
			if($result) {
		    	//echo "record read successfully";
				while($row = $result->fetch_assoc()){
					$pattern["email"]=$row["suffix"];
				}
				return $pattern;
			} else {
			    echo "Error: " . $query . "<br>" . $this->db->error;
			}
	}
}
?>