<?php
include_once("../header.php");
include_once("openview_header.php");

//$issue["type"] = "<span class=\"mb-5 label\">{$issue["type"]}</span>";

if(!isset($issue["security_level"]) || $issue["security_level"] == "")
{
	$issue["sldata"] = $project["sldata"];
	$issue["slname"] = $project["slname"];
}

//$issue["priority"] = "<span class=\"label{$priority}\">{$issue["priority"]}</span>";
//$issue["security_level"] = "<span class=\"label{$level}\">{$issue["slname"]} {$issue["security_level"]}</span>";
$issue["security_level"] = "Class {$issue["sldata"]} {$issue["slname"]}";
$issue["status"] = "<span class=\"label label-{$issue["s3options"]->color_class}\">{$issue["status"]}</span>";

if($issue["variable"]["prograss"] == "")
	$issue["variable"]["prograss"] = 0;

$sspent = "";
$sexpect = "";
if(isset($issue["variable"]["timespent"])){
	if((int)$issue["variable"]["timespent"] / 8 >= 1)
		$sspent = (string)(floor((int)$issue["variable"]["timespent"] / 8)) . "일 ";
	$sspent .= (string)((int)$issue["variable"]["timespent"] % 8) . "시간";
}
if(isset($issue["variable"]["timeexpect"])){
	if((int)$issue["variable"]["timeexpect"] / 8 >= 1)
		$sspent = (string)(floor((int)$issue["variable"]["timeexpect"] / 8)) . "일 ";
	$sspent .= (string)((int)$issue["variable"]["timeexpect"] % 8) . "시간";
}
$ddate = "";
if(isset($issue["variable"]["duedate"]) && $issue["variable"]["duedate"] !== ""){
	$ddate = $issue["variable"]["duedate"] . "일";
}
$oobs = "";
if(isset($issue["variable"]["observer"])){
	$obs = explode(";", $issue["variable"]["observer"]);
	for($i = 0; $i < count($obs); $i++){
		$query = "SELECT * FROM {$db_customer} WHERE id='{$obs[$i]}'";
		$result = mysqli_query($dbconnect, $query);
		$data = mysqli_fetch_assoc($result);
		
		if($oobs !== "")
			$oobs .= ";";
		$oobs .= $data["name"] . "(" . $data["id"] . ")";
	}
}

echo frame_page_title_openview(array("Home", "Project {$project["name"]}", "Issue {$issue["name"]}", "고객용 보안서버 정보조회 서비스")); // {$issue["name"]}

echo frame_page_wrapper_top();
echo frame_box_top("");
echo frame_issue_detail_openview(array("location_edit_issue"=>"issue_write.php?projectid={$project["id"]}&issueid={$issue["id"]}", "issue_name"=>$issue["name"], "issue_status"=>$issue["status"], "project_name"=>$project["name"], "issue_type"=>$issue["type"], "issue_priority"=>$issue["priority"], "issue_security_level"=>"{$issue["security_level"]}", "issue_owner"=>$issue["profile_owner"]->nickname, "issue_manager"=>$oobs, "issue_date_modify"=>$issue["date_modify"], "issue_date_create"=>$issue["date_create"], "issue_prograss"=>$issue["variable"]["prograss"], "issue_duedate"=>$ddate, "issue_timespent"=>$sspent, "issue_timeexpect"=>$sexpect, "issue_contents"=>$issue["contents"]));
//echo frame_box_buttonset(array("Encrypt", "http://{$_SERVER["HTTP_HOST"]}{$_SERVER["PHP_SELF"]}?projectid={$id_project}&issueid={$id_issue}&encryption=encrypt", "Decrypt", "http://{$_SERVER["HTTP_HOST"]}{$_SERVER["PHP_SELF"]}?projectid={$id_project}&issueid={$id_issue}&encryption=decrypt"));

include_once("openview_comment.php");

echo frame_box_bottom();
echo frame_page_wrapper_bottom();


echo "<script src=\"//cdn.ckeditor.com/4.8.0/basic/ckeditor.js\"></script><script> CKEDITOR.replace('contents'); </script>";

include_once('../footer.php');
?>