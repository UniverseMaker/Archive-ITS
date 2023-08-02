<?php
include_once("../header.php");
include_once("subheader.php");
include_once("{$rootpath}/lib/lib_authcheck.php");
if(isset($document["id_owner"]))
	authcheck_owner($document["id_owner"]);

if(get_magic_quotes_gpc())
{
	$name = stripslashes($_POST['documentname']);
	$contents = stripslashes($_POST['contents']);
	$priority = stripslashes($_POST['priority']);
	$security_level = stripslashes($_POST['security_level']);
	$status = stripslashes($_POST['status']);
	$tag = stripslashes($_POST['tag']);
}
else
{
	$name = $_POST['documentname'];
	$contents = $_POST['contents'];
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

if(!isset($id_document))
	$query = "INSERT INTO {$db_document} VALUES (0, {$id_space}, {$user["id"]}, '{$name}', '{$contents}', '{$priority}', '{$security_level}', '{$status}', '{$tag}', '{$variable}', '{$time}', '{$time}')";
else
	$query = "UPDATE {$db_document} SET name='{$name}', contents='{$contents}', priority='{$priority}', security_level='{$security_level}', status='{$status}', tag='{$tag}', variable='{$variable}', date_modify='{$time}' WHERE id='{$id_document}'";
$result = mysqli_query($dbconnect, $query);

echo frame_page_wrapper_top();
echo frame_box_top("Document Submission");
echo "Command Execute Complete<br/>";
echo "SPACE " . $id_space . "<br/>";
if(isset($id_document))
	echo "DOCUMENT " . $id_document . "<br/>";
echo "ID " . $user["id"] . "<br/>";
echo "NAME " . $name . "<br/>";
echo "PRIORITY " . $priority . "<br/>";
echo "SECURITY LEVEL " . $security_level . "<br/>";
echo "STATUS " . $status . "<br/>";
echo "TAG " . $tag . "<br/>";
echo "TIME " . $time . "<br/>";
echo "<br/>";
echo "<a href=\"document_list.php?spaceid={$id_space}\" class=\"btn btn-white btn-xs\">목록으로 돌아가기</a>";
echo frame_box_bottom();
echo frame_page_wrapper_bottom();

include_once('../footer.php');
?>