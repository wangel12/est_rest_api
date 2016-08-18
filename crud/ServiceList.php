<?php

	class ServiceList{
		protected $crud;
		function __construct($crud){
			$this->crud = $crud;
		}
		function listServices($std_id){
				
				
				$rs = $this->crud->fetchSingleResultSet("services","std_id",$std_id,"ser_id");

				$schoolYearRs = $this->crud->fetchResultSet("school_years");
				$advisorRs = $this->crud->fetchResultSet("advisors");
				$serviceTypeRs = $this->crud->fetchResultSet("service_types");
				
				$rows = array();
				$j=0;
				while($syrow = $schoolYearRs->fetch_assoc()){
					$rows["schoolYear"]["$j"]["sch_year"] = $syrow["sch_year"];
					$rows["schoolYear"]["$j"]["sch_year_prefix"] = substr($syrow["sch_year"],0,4);
					$rows["schoolYear"]["$j"]["sch_year_suffix"] = substr($syrow["sch_year"],0,4)+1;
					$j++;
				}
				$k=0;
				while($advisorow = $advisorRs->fetch_assoc()){
					$rows["advisors"]["$k"]["adv_id"] = $advisorow["adv_id"];
					$rows["advisors"]["$k"]["adv_fname"] = $advisorow["adv_fname"];
					$rows["advisors"]["$k"]["adv_lname"] = $advisorow["adv_lname"];
					$k++;
				}
				$l=0;
				while($strow = $serviceTypeRs->fetch_assoc()){
					$rows["st"]["$l"]["serty_id"] = $strow["serty_id"];
					$rows["st"]["$l"]["serty_name"] = $strow["serty_name"];
					$l++;
				}

				$i=0;
				while($row = $rs->fetch_assoc()){
					
					//$rows = arra
					$ser_id = $row["ser_id"];
					//echo $ser_id;
					$orgrs = $this->crud->fetchSingleResultSet("organizations","ser_id",$row['ser_id']);
					$advisor = $this->crud->fetchSingleResultSet("advisors","adv_id",$row['adv_id']);
					$supervisors = $this->crud->fetchSingleResultSet("supervisors","ser_id",$row['ser_id']);
					while($innrow = $orgrs->fetch_assoc()){
						while($advrow = $advisor->fetch_assoc()){
							while($supervisorrow = $supervisors->fetch_assoc()){
								$rows["data"]["$i"]["ser_id"] = $row["ser_id"];
								$rows["data"]["$i"]["serty_id"] = $row["serty_id"];
								$rows["data"]["$i"]["sers_id"] = $row["sers_id"];
								$rows["data"]["$i"]["ser_hr"] =$row["ser_hr"];
								$rows["data"]["$i"]["ser_date"] = $row["ser_date"];
								$rows["data"]["$i"]["org_name"] = $innrow["org_name"];
								$rows["data"]["$i"]["org_id"] = $innrow["org_name"];
								$rows["data"]["$i"]["org_desc"] = $innrow["org_desc"];
								$rows["data"]["$i"]["org_address"] = $innrow["org_address"];
								$rows["data"]["$i"]["adv_fname"] = $advrow["adv_fname"];
								$rows["data"]["$i"]["adv_lname"] = $advrow["adv_lname"];
								$rows["data"]["$i"]["supervisor_fname"] = $supervisorrow["sup_fname"];
								$rows["data"]["$i"]["school_year"] = $row["school_year"];
								$rows["data"]["$i"]["sup_email"] = $supervisorrow["sup_email"];
								$rows["data"]["$i"]["sup_phone"] = $supervisorrow["sup_phone"];

								// $rows["$i"]["ser_id"] = $row["ser_id"];
								// $rows["$i"]["sers_id"] = $row["sers_id"];
								// $rows["$i"]["ser_hr"] =$row["ser_hr"];
								// $rows["$i"]["ser_date"] = $row["ser_date"];
								// $rows["$i"]["org_name"] = $innrow["org_name"];
								// $rows["$i"]["org_desc"] = $innrow["org_desc"];
								// $rows["$i"]["org_address"] = $innrow["org_address"];
								// $rows["$i"]["adv_fname"] = $advrow["adv_fname"];
								// $rows["$i"]["adv_lname"] = $advrow["adv_lname"];
								// $rows["$i"]["supervisor_fname"] = $supervisorrow["sup_fname"];
							}
						}
					}
					$i++;
					
				}
				// print "<pre>";
				// print_r($rows);
				// print "</pre>";
				echo json_encode($rows);
		}//end fn

	}//end class

?>