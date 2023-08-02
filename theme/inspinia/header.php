<?php
include_once($rootpath . "/theme/{$theme}/lib/frames.php");
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $sitetitle; ?></title>

    <link href="<?php echo "{$urlpath}/theme/{$theme}"; ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo "{$urlpath}/theme/{$theme}"; ?>/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo "{$urlpath}/theme/{$theme}"; ?>/css/animate.css" rel="stylesheet">
    <link href="<?php echo "{$urlpath}/theme/{$theme}"; ?>/css/style.css" rel="stylesheet">
	
	
</head>

<?php
if(!isset($_POST["theme_options"]) || $_POST["theme_options"] == "full")
{
	if(!isset($_SESSION['username']) || $_SESSION['username'] == "")
		include_once("body_top_topmenu.php");
	else
		include_once("body_top.php");
}
?>