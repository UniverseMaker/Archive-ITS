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


?>