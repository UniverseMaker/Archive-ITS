<?php
$_POST["theme_options"] = "simple";
require_once('../header.php');

if(!isset($_POST["username"]) || !isset($_POST["password"])) exit;

if(get_magic_quotes_gpc())
{
	$username = stripslashes($_POST["username"]);
	$password = stripslashes($_POST["password"]);
}
else
{
	$username = $_POST["username"];
	$password = $_POST["password"];
}
//mysql_real_escape_string({$username}, $connect)
//echo $username . " " . $password . "<br/><br/>";
$query = "SELECT * FROM {$db_account} WHERE username='{$username}' and password='{$password}'";
$result = mysqli_query($dbconnect, $query);
$data = mysqli_fetch_assoc($result); //mysqli_fetch_array($result);
//echo print_r($data, true) . "<br/><br/>";

if(!isset($data["password"])) {
        echo "<script>alert('아이디 또는 패스워드가 잘못되었습니다.');</script>"; //history.back();
		echo "<meta http-equiv='refresh' content='0;url=login.php'>";
        exit;
}
if((string)$data["password"] != $password) {
        echo "<script>alert('아이디 또는 패스워드가 잘못되었습니다.');</script>";
		echo "<meta http-equiv='refresh' content='0;url=login.php'>";
        exit;
}

$token = session_id();
$_SESSION["token"] = $token;
$_SESSION['username'] = $username;

date_default_timezone_set("Asia/Seoul");
$time = date("Y-m-d H:i:s",time());

$query = "UPDATE {$db_account} SET token='{$token}', date_lastlogin='{$time}' WHERE username='{$username}'";
$result = mysqli_query($dbconnect, $query);

echo "<script>alert('로그인 성공.');</script>";
echo "<meta http-equiv='refresh' content='0;url=../'>";

require_once('../footer.php');
?>