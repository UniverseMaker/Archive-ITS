<?php
include_once("../header.php");
include_once("subheader.php");
include_once("{$rootpath}/lib/lib_authcheck.php");
if(isset($issue["id_owner"]))
	authcheck_owner($issue["id_owner"]);

if(get_magic_quotes_gpc())
{
	$id_project = stripslashes($_POST['projectid']);
	$id_issue = stripslashes($_POST['issueid']);
	$token = stripslashes($_POST['token']);
	$password = stripslashes($_POST['password']);
	$valid = stripslashes($_POST['valid']);
}
else
{
	$id_project = $_POST['projectid'];
	$id_issue = $_POST['issueid'];
	$token = $_POST['token'];
	$password = $_POST['password'];
	$valid = $_POST['valid'];
}

date_default_timezone_set("Asia/Seoul");
$time = date("Ymd His",time());
if($valid === "")
	$valid = $time;

$name = urlencode($name);
$contents = urlencode($contents);

if(!isset($id_issue))
	$query = "INSERT INTO {$db_openview} VALUES (0, {$id_project}, {$id_issue}, {$token}, '{$password}', '{$valid}')";
else
	$query = "UPDATE {$db_openview} SET projectid='{$id_project}', issueid='{$id_issue}', token='{$token}', password='{$password}', valid='{$valid}' WHERE projectid='{$id_project}' and issueid='{$id_issue}'";
$result = mysqli_query($dbconnect, $query);

echo frame_page_wrapper_top();
echo frame_box_top("Openview Data Submission");
echo "Command Execute Complete<br/>";
echo "TOKEN " . $token . "<br/>";
echo "PASSWORD " . $password . "<br/>";
echo "VALID " . $valid . "<br/>";
echo "<br/>";
echo "<a href=\"issue_view.php?projectid={$id_project}&issueid={$id_issue}\" class=\"btn btn-white btn-xs\">이전으로 돌아가기</a>";
echo frame_box_bottom();
echo frame_page_wrapper_bottom();

include_once('../footer.php');
?>