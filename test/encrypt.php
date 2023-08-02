<?php
include_once('../header.php');

$password = $_REQUEST["password"];
$contents = $_REQUEST["contents"];

$keyset = rsa_generate_keys($password);

echo "Encrypt Test System<br/><br/>";
echo "PKCS1 PADDING " . $openssl_pkcs1_padding_custom . "<br/><br/>";

echo "password<br/>" . $password . "<br/><br/>";
echo "contents<br/>" . $contents . "<br/><br/>";

echo "public_key<br/>" . $keyset["public_key"] . "<br/><br/>";
echo "private_key<br/>" . $keyset["private_key"] . "<br/><br/>";

//$keydetail = rsa_detail($keyset["public_key"], "public");
//echo "key_detail_public<br/>" . print_r($keydetail) . "<br/><br/>";

//$keydetail = rsa_detail($keyset["private_key"], "private");
//echo "key_detail_private<br/>" . print_r($keydetail, true) . "<br/><br/>";

$contents = rsa_encrypt2($contents, $keyset["public_key"]);
echo "encrypt contents " . strlen($contents) . "<br/>" . $contents . "<br/><br/>";
$contents = rsa_decrypt2($contents, $keyset["private_key"], $password);
echo "decrypt contents<br/>" . $contents . "<br/><br/>";

include_once('../footer.php');
?>