<?php
include_once('../header.php');

if(1 < 10)
	exit;

if($cryptocontrol === "false1313"){
	$query = "SELECT p.id, p.id_owner, p.name, p.contents, p.status, p.tag, p.date_create, p.date_modify, a.username, a.keypair_puk, a.keypair_prk, a.keypair_password FROM {$db_project} AS p LEFT JOIN {$db_account} AS a ON p.id_owner = a.id";
	$result = mysqli_query($dbconnect, $query);
	$sbuild = false;
	while($data = mysqli_fetch_assoc($result))
	{
		$data["name"] = urlencode(rsa_decrypt2($data["name"], $data["keypair_prk"], $data["keypair_password"]));
		$data["contents"] = urlencode(rsa_decrypt2($data["contents"], $data["keypair_prk"], $data["keypair_password"]));
		$data["tag"] = urlencode(rsa_decrypt2($data["tag"], $data["keypair_prk"], $data["keypair_password"]));
		$data["contents"] = str_replace("\r", '', str_replace("\n", '', $data["contents"]));

		$query2 = "UPDATE {$db_project} SET name='{$data["name"]}', contents='{$data["contents"]}', tag='{$data["tag"]}' WHERE id='{$data["id"]}'";
		$result2 = mysqli_query($dbconnect, $query2);
		//$openview = mysqli_fetch_assoc($result2);
	}
	
	$query = "SELECT sp.id, sp.id_owner, sp.name, sp.contents, sp.status, sp.tag, sp.date_create, sp.date_modify, a.username, a.keypair_puk, a.keypair_prk, a.keypair_password FROM {$db_space} AS sp LEFT JOIN {$db_account} AS a ON sp.id_owner = a.id";
	$result = mysqli_query($dbconnect, $query);
	$sbuild = false;
	while($data = mysqli_fetch_assoc($result))
	{
		$data["name"] = urlencode(rsa_decrypt2($data["name"], $data["keypair_prk"], $data["keypair_password"]));
		$data["contents"] = urlencode(rsa_decrypt2($data["contents"], $data["keypair_prk"], $data["keypair_password"]));
		$data["tag"] = urlencode(rsa_decrypt2($data["tag"], $data["keypair_prk"], $data["keypair_password"]));
		$data["contents"] = str_replace("\r", '', str_replace("\n", '', $data["contents"]));

		$query = "UPDATE {$db_space} SET name='{$data["name"]}', contents='{$data["contents"]}', tag='{$data["tag"]}' WHERE id='{$data["id"]}'";
		$result2 = mysqli_query($dbconnect, $query);
		//$openview = mysqli_fetch_assoc($result2);
	}
	
	$query = "SELECT i.id, i.id_owner, i.id_manager, i.name, i.contents, i.security_level, i.tag, i.variable, i.date_create, i.date_modify, a.username, a.keypair_puk, a.keypair_prk, a.keypair_password FROM {$db_issue} AS i LEFT JOIN {$db_account} AS a ON a.id = i.id_owner";
	$result = mysqli_query($dbconnect, $query);
	$sbuild = false;
	while($data = mysqli_fetch_assoc($result))
	{
		$data["name"] = urlencode(rsa_decrypt2($data["name"], $data["keypair_prk"], $data["keypair_password"]));
		$data["contents"] = urlencode(rsa_decrypt2($data["contents"], $data["keypair_prk"], $data["keypair_password"]));
		$data["tag"] = urlencode(rsa_decrypt2($data["tag"], $data["keypair_prk"], $data["keypair_password"]));
		$data["contents"] = str_replace("\r", '', str_replace("\n", '', $data["contents"]));

		$query = "UPDATE {$db_issue} SET name='{$data["name"]}', contents='{$data["contents"]}', tag='{$data["tag"]}' WHERE id='{$data["id"]}'";
		$result2 = mysqli_query($dbconnect, $query);
		//$openview = mysqli_fetch_assoc($result2);
	}
	
	$query = "SELECT d.id, d.id_owner, d.name, d.contents, d.security_level, d.tag, d.variable, d.date_create, d.date_modify, a.username, a.keypair_puk, a.keypair_prk, a.keypair_password FROM {$db_document} AS d LEFT JOIN {$db_account} AS a ON a.id = d.id_owner";
	$result = mysqli_query($dbconnect, $query);
	$sbuild = false;
	while($data = mysqli_fetch_assoc($result))
	{
		$data["name"] = urlencode(rsa_decrypt2($data["name"], $data["keypair_prk"], $data["keypair_password"]));
		$data["contents"] = urlencode(rsa_decrypt2($data["contents"], $data["keypair_prk"], $data["keypair_password"]));
		$data["tag"] = urlencode(rsa_decrypt2($data["tag"], $data["keypair_prk"], $data["keypair_password"]));
		$data["contents"] = str_replace("\r", '', str_replace("\n", '', $data["contents"]));

		$query = "UPDATE {$db_document} SET name='{$data["name"]}', contents='{$data["contents"]}', tag='{$data["tag"]}' WHERE id='{$data["id"]}'";
		$result2 = mysqli_query($dbconnect, $query);
		//$openview = mysqli_fetch_assoc($result2);
	}

	$query = "SELECT i.id, i.id_owner, i.contents, a.username, a.keypair_puk, a.keypair_prk, a.keypair_password FROM {$db_issue_activity} AS i LEFT JOIN {$db_account} AS a ON a.id = i.id_owner";
	$result = mysqli_query($dbconnect, $query);
	$sbuild = false;
	while($data = mysqli_fetch_assoc($result))
	{
		$data["contents"] = urlencode(rsa_decrypt2($data["contents"], $data["keypair_prk"], $data["keypair_password"]));
		$data["contents"] = str_replace("\r", '', str_replace("\n", '', $data["contents"]));

		$query = "UPDATE {$db_issue_activity} SET contents='{$data["contents"]}' WHERE id='{$data["id"]}'";
		$result2 = mysqli_query($dbconnect, $query);
		//$openview = mysqli_fetch_assoc($result2);
	}

}
?>