<?php
$query = "SELECT * FROM {$db_account} WHERE token='{$token}'";
$result = mysqli_query($dbconnect, $query);
$userdata = mysqli_fetch_assoc($result);
$userdata["profile"] = json_decode($userdata["profile"]);

if($userdata["profile"] == "")
	$userdata["profile"] = new \stdClass();
	//$userdata[] = array("profile"=>array("avatar"=>"img/avatar/default_avatar.png"));
if(!isset($userdata["profile"]->avatar))
{
	$userdata["profile"]->avatar = "img/avatar/default_avatar.png";
	$userdata["profile"]->avatar_link = "img/avatar/default_avatar.png";
}
if(!isset($userdata["profile"]->nickname))
	$userdata["profile"]->nickname = $userdata["username"];
if(!isset($userdata["profile"]->job))
	$userdata["profile"]->job = "Unknown";

$userdata["profile"]->avatar_link = "{$urlpath}/theme/{$theme}/{$userdata["profile"]->avatar}";

$userdata["security_level_name"] = "Class {$userdata["security_level"]}";
?>