<?php
$token_username = false;
if(isset($_SESSION["username"]))
	$token_username = $_SESSION["username"];

$user["security_level"] = false;
$query = "SELECT * FROM {$db_account} WHERE token='{$token}'";
$result = mysqli_query($dbconnect, $query);
$user = mysqli_fetch_assoc($result);
if(!isset($user["security_level"]))
	$user["security_level"] = 0;
if(!isset($user["username"]))
	$user["username"] = "";

authcheck_page();

if(isset($_REQUEST['spaceid']))
{
	if(get_magic_quotes_gpc())
		$id_space = stripslashes($_POST['spaceid']);
	else
		$id_space = $_REQUEST['spaceid'];

	$query = "SELECT sp.id, sp.id_owner, sp.name, sp.contents, sp.status, sp.tag, sp.date_create, sp.date_modify, s.name AS 'slname', s.data AS 'sldata', s.options AS 'sloptions', s2.name AS 'stname', s2.code AS 'stcode' FROM {$db_space} AS sp LEFT JOIN {$db_status} as s ON sp.security_level = s.code LEFT JOIN {$db_status} as s2 ON sp.status = s2.code WHERE sp.id='{$id_space}'";
	$result = mysqli_query($dbconnect, $query);
	$space = mysqli_fetch_assoc($result);
	//$space["name"] = rsa_decrypt2($space["name"], $user["keypair_prk"], $user["keypair_password"]);
	//$space["contents"] = rsa_decrypt2($space["contents"], $user["keypair_prk"], $user["keypair_password"]);
	$space["name"] = urldecode($space["name"]);
	$space["contents"] = urldecode($space["contents"]);
	
	//$space["tag"] = rsa_decrypt2($space["tag"], $user["keypair_prk"], $user["keypair_password"]);
	$space["sloptions"] = json_decode($space["sloptions"]);
	
	if($user["username"] != $token_username || (isset($space["sldata"]) && $user["security_level"] < $space["sldata"]))
		frame_access_deni(true);
}

if(isset($_REQUEST['documentid']))
{
	if(get_magic_quotes_gpc())
		$id_document = stripslashes($_POST['documentid']);
	else
		$id_document = $_REQUEST['documentid'];

	$query = "SELECT d.id, d.id_owner, d.name, d.contents, d.security_level, d.tag, d.variable, d.date_create, d.date_modify, a.username AS 'username_owner', a.profile AS 'profile_owner', s1.name AS 'priority', s1.code AS 's1code', s1.options AS 's1options', s2.name AS 'slname', s2.data AS 'sldata', s2.options AS 's2options', s3.name AS 'status', s3.code AS 's3code', s3.options AS 's3options' FROM {$db_document} AS d LEFT JOIN {$db_account} AS a ON a.id = d.id_owner LEFT JOIN {$db_status} as s1 ON d.priority = s1.code LEFT JOIN {$db_status} as s2 ON d.security_level = s2.code LEFT JOIN {$db_status} as s3 ON d.status = s3.code WHERE d.id={$id_document} ORDER BY d.id DESC";
	$result = mysqli_query($dbconnect, $query);
	$document = mysqli_fetch_assoc($result);
	
	//$document["name"] = rsa_decrypt2($document["name"], $user["keypair_prk"], $user["keypair_password"]);
	//$document["contents"] = rsa_decrypt2($document["contents"], $user["keypair_prk"], $user["keypair_password"]);
	$document["name"] = urldecode($document["name"]);
	$document["contents"] = urldecode($document["contents"]);
	
	//$document["tag"] = rsa_decrypt2($document["tag"], $user["keypair_prk"], $user["keypair_password"]);
	$document["variable"] = json_decode($document["variable"]);
	$document["prograss"] = $document["variable"]->prograss;
	$document["duedate"] = $document["variable"]->duedate;
	//$document["s0options"] = json_decode($document["s0options"]);
	$document["s1options"] = json_decode($document["s1options"]);
	$document["s2options"] = json_decode($document["s2options"]);
	$document["s3options"] = json_decode($document["s3options"]);
	$document["profile_owner"] = json_decode($document["profile_owner"]);
	//$document["profile_manager"] = json_decode($document["profile_manager"]);
}

if(!isset($_REQUEST['spaceid']) && isset($_REQUEST['documentid'])){
	$query = "SELECT d.id, d.id_space, s.name AS 'slname', s.data AS 'sldata', s.options AS 'sloptions' FROM {$db_document} AS d LEFT JOIN {$db_space} AS sp ON sp.id = d.id_space LEFT JOIN {$db_status} as s ON sp.security_level = s.code WHERE d.id={$id_document} ORDER BY d.id DESC";
	$result = mysqli_query($dbconnect, $query);
	$documentsid = mysqli_fetch_assoc($result);
	if($user["username"] != $token_username || (isset($documentsid["sldata"]) && $user["security_level"] < $documentsid["sldata"]))
		frame_access_deni(true);
}

//if($user["username"] != $token_username || (isset($space["sdata"]) && $user["security_level"] < $space["sdata"])) // && $user["username"] == $token_username
//{
//	echo frame_page_wrapper_top();
//	echo frame_display_message("Access Denied", "You have no authority to access this page");
//	echo frame_page_wrapper_bottom();
//	exit;
//}



?>