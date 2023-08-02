<?php
session_start();
$token = session_id();

session_regenerate_id();
if(isset($_SESSION['id']))
   unset($_SESSION['id']);
if(isset($_SESSION['token']))
   unset($_SESSION['token']);
if(isset($_SESSION['username']))
   unset($_SESSION['username']);

//$query = "UPDATE account SET token='logout' WHERE token='{$token}'";
//$result = mysqli_query($dbconnect, $query);

//echo $token;
session_destroy();

echo "<script>alert('로그아웃 성공.');</script>";
?>

<meta http-equiv='refresh' content='0;url=../'>