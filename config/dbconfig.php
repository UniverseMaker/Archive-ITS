<?php
$dbhostname="127.0.0.1";
$dbusername="superblaze";
$dbpassword="architecture1!2@";
$dbname="superblaze";

//$dbconnect = mysqli_connect($dbhostname, $dbusername, $dbpassword);
//$dbset = mysqli_select_db($dbname, $dbconnect);

$dbconnect = new mysqli($dbhostname, $dbusername, $dbpassword, $dbname);
if (mysqli_connect_error()) {
    exit('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
}

?>