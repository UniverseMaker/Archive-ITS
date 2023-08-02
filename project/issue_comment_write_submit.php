<?php
include_once('../header.php');
include_once('./subheader.php');
include_once('../lib/lib_json.php');
include_once('../lib/lib_comment_process.php');

if(get_magic_quotes_gpc())
{
	$type = stripslashes($_POST['type']);
	$contents = stripslashes($_POST['contents']);
}
else
{
	$type = $_POST['type'];
	$contents = $_POST['contents'];
}

date_default_timezone_set("Asia/Seoul");
$time = date("Y-m-d H:i:s",time());

//process attributes
$ocontents = urldecode($contents);
//echo "target: "  . substr($ocontents, 0, 4);
if(substr($ocontents, 0, 4) === "<p>{"){
	$ocontents = explode("</p>", explode("<p>", $ocontents)[1])[0];
	$ocontents = json_decode_nice($ocontents, true);
	
	//$pcr = processComment($ocontents);
	//echo "pcr: " . $pcr . "<br>";
	//$contents = "<p>" . $pcr . "</p>" . str_replace(urlencode(explode("</p>", urldecode($contents))[0]), "", $contents);
	
	$contents = processComment($ocontents);
}

$query = "UPDATE {$db_issue} SET date_modify='{$time}' WHERE id='{$issue["id"]}'";
$result = mysqli_query($dbconnect, $query);

//echo "final result: " . $contents . "<br>";
//$contents = rsa_encrypt2($contents, $user["keypair_puk"]);
$contents = urlencode($contents);

$query = "INSERT INTO {$db_issue_activity} VALUES (0, {$id_issue}, {$user["id"]}, '{$type}', '{$contents}', '{$time}', '{$time}')";
$result = mysqli_query($dbconnect, $query);

echo "<META HTTP-EQUIV=REFRESH CONTENT=\"1; 'issue_view.php?projectid={$id_project}&issueid={$id_issue}'\">";
exit;


include_once('../footer.php');
?>