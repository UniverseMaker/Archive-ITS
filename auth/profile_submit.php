<?php
include_once('../header.php');

foreach ($_POST as $key => $value)
{
	if(get_magic_quotes_gpc())
		$variable[$key] = stripslashes($value);
	else
		$variable[$key] = $value;
}

$variable = json_encode($variable, JSON_UNESCAPED_UNICODE);
$query = "UPDATE {$db_account} SET profile='{$variable}' WHERE token='{$token}'";
$result = mysqli_query($dbconnect, $query);

echo frame_page_wrapper_top();
echo frame_box_top("Profile Data Submit Confirm");
echo "Command Execute Complete<br/>";
echo print_r($variable, true);
echo "<br/>";
echo frame_box_bottom();
echo frame_page_wrapper_bottom();

include_once('../footer.php');
?>