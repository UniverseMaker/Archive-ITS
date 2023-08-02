<?php
include_once('../header.php');
include_once('./subheader.php');

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

//$contents = rsa_encrypt2($contents, $user["keypair_puk"]);
$contents = urlencode($contents);

$query = "INSERT INTO {$db_issue_activity} VALUES (0, {$id_issue}, {$type}, {$user["id"]}, '{$contents}', '{$time}', '{$time}')";
$result = mysqli_query($dbconnect, $query);

echo "<META HTTP-EQUIV=REFRESH CONTENT=\"1; 'view.php?projectid={$id_project}&issueid={$id_issue}'\">";
exit;

include_once('../footer.php');
?>