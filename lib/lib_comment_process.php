<?php
function processComment($ocontents){
	global $dbconnect, $db_translation, $db_customer, $db_issue, $issue;
	//$ctype;
	
	foreach($ocontents as $key=>$value) {
		$ctype = $key;
		$cvalue = $value;
		$query = "SELECT data FROM {$db_translation} WHERE namespace='issue_{$key}'";
		$result = mysqli_query($dbconnect, $query);
		$trans = mysqli_fetch_assoc($result);
	}
	
	if($ctype === "timespent" || $ctype === "timeexpect"){
		$sspent = "";
		if((int)$value / 8 >= 1)
			$sspent = (string)(floor((int)$value / 8)) . "일 ";
		$sspent .= (string)((int)$value % 8) . "시간";
		
		if(!isset($issue["variable"][$ctype]))
			$issue["variable"][$ctype] = 0;
		
		$issue["variable"][$ctype] = (int)$issue["variable"][$ctype] + $cvalue;
		
		$sexpect = "";
		if((int)$issue["variable"][$ctype] / 8 >= 1)
			$sexpect = (string)(floor((int)$issue["variable"][$ctype] / 8)) . "일 ";
		$sexpect .= (string)((int)$issue["variable"][$ctype] % 8) . "시간";
		
		$results = sprintf($trans["data"], $sspent, $sexpect);
	}
	else if($ctype === "observer"){
		$oobs = "";
		if(isset($cvalue)){
			$obs = explode(";", $cvalue);
			for($i = 0; $i < count($obs); $i++){
				$query = "SELECT * FROM {$db_customer} WHERE id='{$obs[$i]}'";
				$result = mysqli_query($dbconnect, $query);
				$data = mysqli_fetch_assoc($result);
				
				if($oobs !== "")
					$oobs .= ";";
				$oobs .= $data["name"] . "(" . $data["id"] . ")";
			}
		}

		$results = sprintf($trans["data"], $oobs);
		$issue["variable"][$ctype] = $cvalue;
	}
	else {
		$results = sprintf($trans["data"], $cvalue);
		$issue["variable"][$ctype] = $cvalue;
	}
	
	//echo "iV: " . $issue["variable"][$ctype] . "<br>";
	echo $results . "<br>";
	$query = "UPDATE {$db_issue} SET variable='" . json_encode($issue["variable"]) . "' WHERE id='{$issue["id"]}'";
	$result = mysqli_query($dbconnect, $query);
	
	return $results;
}
?>