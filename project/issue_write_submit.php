<?php
include_once("../header.php");
include_once("subheader.php");
include_once("{$rootpath}/lib/lib_authcheck.php");
if(isset($issue["id_owner"]))
	authcheck_owner($issue["id_owner"]);

if(get_magic_quotes_gpc())
{
	$id_project = stripslashes($_POST['projectid']);
	$name = stripslashes($_POST['issuename']);
	$contents = stripslashes($_POST['contents']);
	$type = stripslashes($_POST['type']);
	$priority = stripslashes($_POST['priority']);
	$security_level = stripslashes($_POST['security_level']);
	$status = stripslashes($_POST['status']);
	$tag = stripslashes($_POST['tag']);
}
else
{
	$id_project = $_POST['projectid'];
	$name = $_POST['issuename'];
	$contents = $_POST['contents'];
	$type = $_POST['type'];
	$priority = $_POST['priority'];
	$security_level = $_POST['security_level'];
	$status = $_POST['status'];
	$tag = $_POST['tag'];
}

date_default_timezone_set("Asia/Seoul");
$time = date("Y-m-d H:i:s",time());

$variable["prograss"] = 0;
$variable["duedate"] = '';
$variable = json_encode($variable);

//$name = rsa_encrypt2($name, $user["keypair_puk"]);
//$contents = rsa_encrypt2($contents, $user["keypair_puk"]);
$name = urlencode($name);
$contents = urlencode($contents);

//$tag = rsa_encrypt2($tag, $user["keypair_puk"]);
//$variable = rsa_encrypt2(json_encode($variable), $user["keypair_puk"]);

if(!isset($id_issue))
	$query = "INSERT INTO {$db_issue} VALUES (0, {$id_project}, {$user["id"]}, {$user["id"]}, '{$name}', '{$contents}', '{$type}', '{$priority}', '{$security_level}', '{$status}', '{$tag}', '{$variable}', '{$time}', '{$time}')";
else
	$query = "UPDATE {$db_issue} SET name='{$name}', contents='{$contents}', type='{$type}', priority='{$priority}', security_level='{$security_level}', status='{$status}', tag='{$tag}', variable='{$variable}', date_modify='{$time}' WHERE id='{$id_issue}'";
$result = mysqli_query($dbconnect, $query);

echo frame_page_wrapper_top();
echo frame_box_top("Issue Data Submission");
echo "Command Execute Complete";
echo "ID " . $user["id"] . "<br/>";
echo "NAME " . $name . "<br/>";
echo "CONTENTS " . $contents . "<br/>";
echo "<br/>";
echo "<a href=\"issue_list.php?projectid={$id_project}\" class=\"btn btn-white btn-xs\">목록으로 돌아가기</a>";
echo frame_box_bottom();
echo frame_page_wrapper_bottom();

include_once('../footer.php');
?>