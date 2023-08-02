<?php
include_once("../header.php");
include_once("subheader.php");
include_once("{$rootpath}/lib/lib_authcheck.php");
if(isset($project["id_owner"]))
	authcheck_owner($project["id_owner"]);

if(get_magic_quotes_gpc())
{
	$name = stripslashes($_POST['projectname']);
	$contents = stripslashes($_POST['contents']);
	$security_level = stripslashes($_POST['security_level']);
	$status = stripslashes($_POST['status']);
	$tag = stripslashes($_POST['tag']);
}
else
{
	$name = $_POST['projectname'];
	$contents = $_POST['contents'];
	$security_level = $_POST['security_level'];
	$status = $_POST['status'];
	$tag = $_POST['tag'];
}

date_default_timezone_set("Asia/Seoul");
$time = date("Y-m-d H:i:s",time());

//$name = rsa_encrypt2($name, $user["keypair_puk"]);
//$contents = rsa_encrypt2($contents, $user["keypair_puk"]);
$name = urlencode($name);
$contents = urlencode($contents);

//$tag = rsa_encrypt2($tag, $user["keypair_puk"]);

if(!isset($id_project))
	$query = "INSERT INTO {$db_project} VALUES (0, {$user["id"]}, '{$name}', '{$contents}', '{$security_level}', '{$status}', '{$tag}', '{$time}', '{$time}')";
else
	$query = "UPDATE {$db_project} SET name='{$name}', contents='{$contents}', security_level='{$security_level}', status='{$status}', tag='{$tag}', date_modify='{$time}' WHERE id={$id_project}";
$result = mysqli_query($dbconnect, $query);

echo frame_page_wrapper_top();
echo frame_box_top("Project Data Submission");
echo "Command Execute Complete<br/>";
echo "ID " . $user["id"] . "<br/>";
echo "NAME " . $name . "<br/>";
echo "CONTENTS " . $contents . "<br/>";
echo "SECURITY_LEVEL " . $security_level . "<br/>";
echo "STATUS " . $status . "<br/>";
echo "UPDATE TIME " . $time . "<br/>";
echo "<br/>";
echo "<a href=\"project_list.php\" class=\"btn btn-white btn-xs\">목록으로 돌아가기</a>";
echo frame_box_bottom();
echo frame_page_wrapper_bottom();

include_once('../footer.php');
?>