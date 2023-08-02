<?php
//error_reporting(E_ALL); 
error_reporting(E_ALL & ~E_NOTICE);

ini_set("display_errors", 1); 

session_cache_expire(1440);
//ini_set('session.gc_maxlifetime', 86400);
//ini_set('session.cookie_lifetime', 0);
//ini_set('session.gc_probability', 1);
//ini_set('session.gc_divisor', 1);

session_start();
$token = session_id();

$systemprotocol = "https://";
if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off")
	$systemprotocol = "http://";

$system_root = "/archive";
$rootpath = $_SERVER['DOCUMENT_ROOT'] . $system_root;
$urlpath = $systemprotocol . $_SERVER['HTTP_HOST'] . $system_root;

include_once($rootpath . "/config/dbconfig.php");
include_once($rootpath . "/config/config.php");
include_once($rootpath . "/auth/security.php");
include_once($rootpath . "/lib/rsa.php");

include_once($rootpath . "/theme/{$theme}/header.php");
include_once("{$rootpath}/lib/lib_authcheck.php");


?>
