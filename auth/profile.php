<?php
include_once('../header.php');
include_once("{$rootpath}/header/header_userdata.php");

echo frame_page_title(array("Home", "Profile detail")); // {$issue["name"]}

echo frame_page_wrapper_top();
echo frame_box_top("Please fill out your profile!");

echo "<form action=\"profile_submit.php\" method=\"post\">";

$query = "SELECT * FROM {$db_global_config} WHERE code='profile' ORDER BY priority ASC";
$result = mysqli_query($dbconnect, $query);
$sbuild = false;
while($data = mysqli_fetch_assoc($result))
{
	$value = "";
	if(isset($userdata["profile"]->{$data["data"]}))
		$value = $userdata["profile"]->{$data["data"]};
	
	echo "<div class=\"row\"><div class=\"col-xs-12\"><div class=\"form-group\"><label>{$data["name"]}</label><input type=\"text\" class=\"form-control\" name=\"{$data["data"]}\" placeholder=\"{$data["name"]}\" value=\"{$value}\"></div></div></div>";
}

echo "<div class=\"row\"><div class=\"col-xs-12\"><button type=\"submit\" class=\"btn btn-sm btn-primary pull-right m-t-n-xs\"><strong>Submit</strong></button></div></div>";
echo "</form>";

echo frame_box_bottom();
echo frame_page_wrapper_bottom();

include_once('../footer.php');
?>