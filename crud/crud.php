<?php
require_once("../connection/dbconn.php");

class crud{

	protected $db;

	function __construct($db){
		$this->db = $db;
	}

	function insert($tablename,$cols,$vals){
		$tablename = mysqli_real_escape_string($this->db,$tablename);
		$query = "INSERT INTO ".$tablename." (";
		$len = sizeof($cols);
		for($i=0;$i<$len-1;$i++){
			$query = $query."`".$cols[$i]."`,";
		}
		$query = $query."`".$cols[$len-1]."`) VALUES (";

		$len = sizeof($vals);
		for($i=0;$i<$len-1;$i++){
			$query = $query."'".$vals[$i]."',";
		}
		$query = $query."'".$vals[$len-1]."')";
		//echo $query;
		//$this->db->query($query);
			if ($this->db->query($query) === TRUE) {
			    //echo "New record created successfully";
			} else {
			    echo "Error: " . $query . "<br>" . $this->db->error;
			}
	}//end fn

	function update($tablename,$cols,$vals,$where,$id){
		$tablename = mysqli_real_escape_string($this->db,$tablename);
		$id = mysqli_real_escape_string($this->db,$id);

		$query = "UPDATE ".$tablename." SET ";
		$len = sizeof($cols);
		$len2 = sizeof($vals);
		for($i=0;$i<$len-1;$i++){
			for($j=0;$j<$len2-1;$j++){
				if($i==$j){
					$query = $query. $cols[$i]."="."'".$vals[$j]."', ";
				}
			}
		}
		$query = $query.$cols[$len-1]."='".$vals[$len2-1]."' WHERE ".$where."=".$id;
		echo $query;
		//$this->db->query($query);
		if ($this->db->query($query) === TRUE) {
		    echo "record updated successfully";
		} else {
		    echo "Error: " . $query . "<br>" . $this->db->error;
		}
	}//end fn

	function returnLatestID($tablename,$col){
		$tablename = mysqli_real_escape_string($this->db,$tablename);
		$col = mysqli_real_escape_string($this->db,$col);
		$query = "SELECT `".$col."` FROM ".$tablename." ORDER BY ".$col." DESC LIMIT 1";
		$result = $this->db->query($query);
		if ($result) {
			    //echo "latest record fetched successfully";
		} else {
			    echo "Error: " . $query . "<br>" . $this->db->error;
		}
		 /* fetch associative array */
	    while ($row = $result->fetch_assoc()) {
	        return $row[$col];
	    }
	}//end 

	function countRows($tablename,$col,$val){
		$tablename = mysqli_real_escape_string($this->db,$tablename);
		$col = mysqli_real_escape_string($this->db,$col);
		$val = mysqli_real_escape_string($this->db,$val);
		$query = "SELECT * FROM ".$tablename." WHERE ".$col."=\"".$val."\"";
		//echo $query;
		$result = $this->db->query($query);
		if ($result) {
			    return mysqli_num_rows($result);
		} else {
			    echo "Error: " . $query . "<br>" . $this->db->error;
		}
	}

	function fetchResultSet($tablename){
		$tablename = mysqli_real_escape_string($this->db,$tablename);
		$query = "SELECT * FROM ".$tablename."";
		$result = $this->db->query($query);
		if ($result) {
			    return $result;
		} else {
			    echo "Error: " . $query . "<br>" . $this->db->error;
		}
	}//end fn

	function fetchResultSetOrder($tablename,$order,$limit){
		$tablename = mysqli_real_escape_string($this->db,$tablename);
		$limit = mysqli_real_escape_string($this->db,$limit);
		$query = "SELECT * FROM ".$tablename." ORDER BY ".$order." DESC LIMIT ".$limit;
		//echo $query;
		$result = $this->db->query($query);
		if ($result) {
			    return $result;
		} else {
			    echo "Error: " . $query . "<br>" . $this->db->error;
		}
	}//end fn

	function deleteSingleResult($tablename,$col,$val){
		$tablename = mysqli_real_escape_string($this->db,$tablename);
		$val = mysqli_real_escape_string($this->db,$val);
		$query = "DELETE from ".$tablename. " WHERE ".$col." = ".$val;
		//echo $query;
		if($this->db->query($query)){
			echo json_encode(array("delete"=>true));
		}else {
			    echo "Error: " . $query . "<br>" . $this->db->error;
		}

	}

	function fetchSingleResultSetOrder($tablename,$col,$val,$orderCol){
		$value = mysqli_real_escape_string($this->db,$val);
		$query = "SELECT * FROM ".$tablename." WHERE `".$col."` = \"".$value."\" ORDER BY ".$orderCol." DESC LIMIT 6";
		//echo $query;
		//echo $query;	
		$result = $this->db->query($query);
		
		
		if ($result) {
				//echo "successful getting single result";
			    return $result;
		} else {
			    echo "Error: " . $query . "<br>" . $this->db->error;
		}
	}

	function fetchSingleResultSet($tablename,$col,$val){
		$tablename = mysqli_real_escape_string($this->db,$tablename);
		$value = mysqli_real_escape_string($this->db,$val);
		$query = "SELECT * FROM ".$tablename." WHERE `".$col."` = \"".$value."\"";
		//echo $query;	
		$result = $this->db->query($query);
		
		
		if ($result) {
				//echo "successful getting single result";
			    return $result;
		} else {
			    echo "Error: " . $query . "<br>" . $this->db->error;
		}
	}


}

?>