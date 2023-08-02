<?php
$token_username = false;
if(isset($_SESSION["username"]))
	$token_username = $_SESSION["username"];

if(!isset($_REQUEST["token"]))
	frame_access_deni(true);

if(get_magic_quotes_gpc())
	$password = stripslashes($_POST["password"]);
else
	$password = $_POST["password"];

$ptoken = $_REQUEST["token"];
$password = $_POST["password"];

$query = "SELECT * FROM {$db_openview} WHERE token='{$ptoken}'";
$result = mysqli_query($dbconnect, $query);
$openview = mysqli_fetch_assoc($result);

if(!isset($openview["password"]))
	frame_access_deni(true);

if(!isset($_POST["password"]) || $password !== $openview["password"]){
	include_once("../header.php");
	echo frame_page_title_openview(array("Home", "Project {$project["name"]}", "Issue {$issue["name"]}", "고객용 보안서버 정보조회 서비스")); // {$issue["name"]}
	echo frame_page_wrapper_top();
	echo frame_box_top("");
	if(!isset($_POST["password"]))
		echo frame_login_openview($ptoken);
	else
		echo frame_login_openview($ptoken, "비밀번호가 틀렸습니다. 다시 입력해주세요.");
	echo frame_box_bottom();
	echo frame_page_wrapper_bottom();
	include_once('../footer.php');
	exit;
}

//$user["security_level"] = false;
$query = "SELECT * FROM {$db_account} WHERE id='{$openview["id_owner"]}'";
$result = mysqli_query($dbconnect, $query);
$user = mysqli_fetch_assoc($result);

if(isset($openview["projectid"]))
{
	if(get_magic_quotes_gpc())
		$id_project = stripslashes($openview["projectid"]);
	else
		$id_project = $openview["projectid"];

	$query = "SELECT p.id, p.id_owner, p.name, p.contents, p.status, p.tag, p.date_create, p.date_modify, s.name AS 'slname', s.data AS 'sldata', s.options AS 'sloptions', s2.name AS 'stname', s2.code AS 'stcode' FROM {$db_project} AS p LEFT JOIN {$db_status} as s ON p.security_level = s.code LEFT JOIN {$db_status} as s2 ON p.status = s2.code WHERE p.id='{$openview["projectid"]}'";
	$result = mysqli_query($dbconnect, $query);
	$project = mysqli_fetch_assoc($result);
	//$project["name"] = rsa_decrypt2($project["name"], $user["keypair_prk"], $user["keypair_password"]);
	//$project["contents"] = rsa_decrypt2($project["contents"], $user["keypair_prk"], $user["keypair_password"]);
	$project["name"] = urldecode($project["name"]);
	$project["contents"] = urldecode($project["contents"]);
	
	//$project["tag"] = rsa_decrypt2($project["tag"], $user["keypair_prk"], $user["keypair_password"]);
	$project["sloptions"] = json_decode($project["sloptions"]);
}

if(isset($openview["issueid"]))
{
	if(get_magic_quotes_gpc())
		$id_issue = stripslashes($openview["issueid"]);
	else
		$id_issue = $openview["issueid"];

	$query = "SELECT i.id, i.id_owner, i.id_manager, i.name, i.contents, i.security_level, i.tag, i.variable, i.date_create, i.date_modify, a.username AS 'username_owner', a.profile AS 'profile_owner', a2.username AS 'username_manager', a2.profile AS 'profile_manager', s0.name AS 'type', s0.code AS 's0code', s0.options AS 's0options', s1.name AS 'priority', s1.code AS 's1code', s1.options AS 's1options', s2.name AS 'slname', s2.data AS 'sldata', s2.options AS 's2options', s3.name AS 'status', s3.code AS 's3code', s3.options AS 's3options' FROM {$db_issue} AS i LEFT JOIN {$db_account} AS a ON a.id = i.id_owner LEFT JOIN {$db_account} AS a2 ON a2.id = i.id_manager LEFT JOIN {$db_status} as s0 ON i.type = s0.code LEFT JOIN {$db_status} as s1 ON i.priority = s1.code LEFT JOIN {$db_status} as s2 ON i.security_level = s2.code LEFT JOIN {$db_status} as s3 ON i.status = s3.code WHERE i.id={$openview["issueid"]} ORDER BY i.id DESC";
	$result = mysqli_query($dbconnect, $query);
	$issue = mysqli_fetch_assoc($result);
	
	//$issue["name"] = rsa_decrypt2($issue["name"], $user["keypair_prk"], $user["keypair_password"]);
	//$issue["contents"] = rsa_decrypt2($issue["contents"], $user["keypair_prk"], $user["keypair_password"]);
	$issue["name"] = urldecode($issue["name"]);
	$issue["contents"] = urldecode($issue["contents"]);
	//$issue["tag"] = rsa_decrypt2($issue["tag"], $user["keypair_prk"], $user["keypair_password"]);
	//$issue["variable"] = json_decode(rsa_decrypt2($issue["variable"], $user["keypair_prk"], $user["keypair_password"]));
	$issue["variable"] = json_decode($issue["variable"], true);
	$issue["prograss"] = $issue["variable"]["prograss"];
	$issue["duedate"] = $issue["variable"]["duedate"];
	$issue["s0options"] = json_decode($issue["s0options"]);
	$issue["s1options"] = json_decode($issue["s1options"]);
	$issue["s2options"] = json_decode($issue["s2options"]);
	$issue["s3options"] = json_decode($issue["s3options"]);
	$issue["profile_owner"] = json_decode($issue["profile_owner"]);
	$issue["profile_manager"] = json_decode($issue["profile_manager"]);
}

//if($user["username"] != $token_username || (isset($project["sdata"]) && $user["security_level"] < $project["sdata"])) // && $user["username"] == $token_username
//{
//	echo frame_page_wrapper_top();
//	echo frame_display_message("Access Denied", "You have no authority to access this page");
//	echo frame_page_wrapper_bottom();
//	exit;
//}



?>