<?php

class dbconn{
		private $user;
		private $pass;
		private $host;
		private $database;
		private $switch;
		public $conn;
		public function __construct(){
			$this->user = "wangel12";
			$this->pass = "shuffle101S";
			$this->host = "localhost";
			$this->database = "eservicetracker";
			$this->switch=1;
			//$this->getConnection($this->user,$this->pass,$this->host,$this->database,$this->switch);
		}

		function getConnection(){
			if($this->switch==1){
				$conn = new mysqli($this->host, $this->user, $this->pass,$this->database);	
				//return $conn
			}else{
				$conn = new mysqli("localhost", "root", "",$this->database);		
				//return $conn;
			}
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			} else {
				return $conn;
			}
			echo  "Connected successfully";	
		}				
}

?>