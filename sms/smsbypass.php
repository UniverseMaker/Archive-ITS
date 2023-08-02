<?php
include_once("../header.php");
include_once("subheader.php");

$issueid = $_REQUEST["issueid"];
$commentid = $_REQUEST["commentid"];

date_default_timezone_set("Asia/Seoul");
$time = date("Y-m-d H:i:s",time());

echo frame_page_title(array("Home", "Module System", "SMS Bypass System")); // {$issue["name"]}

echo frame_page_wrapper_top();
echo frame_box_top("");


$query = "SELECT * FROM {$db_issue} WHERE id={$issueid}";
$result = mysqli_query($dbconnect, $query);
$data = mysqli_fetch_assoc($result);
$ivar = json_decode($data["variable"], true);

if(isset($ivar["observer"])){
	$query = "SELECT * FROM {$db_issue_activity} WHERE id={$commentid}";
	$result = mysqli_query($dbconnect, $query);
	$data = mysqli_fetch_assoc($result);
	$contents = urldecode($data["contents"]);
	$contents = html_entity_decode($contents);
	$contents = strip_tags($contents);
	
	$ivars = explode(";", $ivar["observer"]);
	for($i = 0; $i < count($ivars); $i++){
		$query = "SELECT * FROM {$db_customer} WHERE id='{$ivars[$i]}'";
		$result = mysqli_query($dbconnect, $query);
		$data = mysqli_fetch_assoc($result);
		
		$query = "SELECT * FROM {$db_sms} WHERE name='{$data["name"]}' and phone='{$data["phone"]}' and data='{$contents}' and status='ready'";
		$result = mysqli_query($dbconnect, $query);
		if($result)
			$data2 = mysqli_fetch_assoc($result);
		else
			echo "nocall " . $query;

		if(!isset($data2["date"])){
			$query = "INSERT INTO {$db_sms} VALUES (NULL, '{$data["name"]}', '{$data["phone"]}', '{$contents}', 'ready', '{$time}')";
			$result = mysqli_query($dbconnect, $query);
			echo "<p>바이패스 요청했습니다 - {$data["name"]} {$data["phone"]}</p>";
		}
		else{
			echo "<p>이미 존재하는 대기 바이패스입니다 - {$data["name"]} {$data["phone"]}</p>";
		}
	}
	
}
else
{
	echo "<p>관측자가 없습니다</p>";
}


echo frame_box_bottom();
echo frame_page_wrapper_bottom();

include_once("../footer.php");
?>