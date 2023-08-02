<?php
include_once('../header.php');

if(get_magic_quotes_gpc())
	$password = stripslashes($_POST['password']);
else 
	$password = $_POST['password'];
//mysql_real_escape_string($password, $connect);

$keypair = rsa_generate_keys($password);

session_start();
$token = session_id();
echo $password . "<br/>";
echo $token . "<br/>";
echo $keypair["public_key"] . "<br/>";
echo $keypair["private_key"] . "<br/>";
$query="UPDATE {$db_account} SET keypair_password='{$password}', keypair_puk='{$keypair["public_key"]}', keypair_prk='{$keypair["private_key"]}' WHERE token='{$token}'";
$result = mysqli_query($dbconnect, $query);
//while($info=mysql_fetch_array($rs))
//	echo $info['title']."<br>";

echo "Command Execute Complete";

include_once('../footer.php');
?>