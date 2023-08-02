<?php
function authcheck_owner($targetid)
{
	global $user;
	if(!isset($user["id"]) || $user["id"] != $targetid)
	{
		echo frame_page_wrapper_top();
		echo frame_display_message("Access Denied", "You have no authority to access this page");
		echo frame_page_wrapper_bottom();
		exit;
	}
}

function authcheck_page($param = false)
{
	global $user, $db_accesscontrol, $dbconnect;
	
	$query = "SELECT * FROM {$db_accesscontrol} WHERE target='{$_SERVER['PHP_SELF']}'";
	$result = mysqli_query($dbconnect, $query);
	if($result)
		$data = mysqli_fetch_assoc($result);
	
	//echo "PPP " . $db_accesscontrol . "CPAGE: " . $_SERVER['PHP_SELF'];
	if(isset($data["read"])){
		//echo $data["read"] . " - " . $user["security_level"];
		
		if(isset($data["read"]) && (int)$data["read"] > (int)$user["security_level"])
			frame_access_deni(true);
	}
	else{
		//처음 등록 페이지 자동오픈됨
		$query = "INSERT INTO {$db_accesscontrol} VALUES (NULL, 'page', '{$_SERVER['PHP_SELF']}', '', '', '', '')";
		$result = mysqli_query($dbconnect, $query);
	
		authcheck_page();
		//echo $query;
	}
}
?>