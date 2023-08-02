<?php
include_once('../header.php');
include_once('./subheader.php');

$query = "SELECT d.id, d.id_owner, d.name, d.contents, d.security_level, d.tag, d.variable, d.date_create, d.date_modify, a.username AS 'username_owner', a.profile AS 'profile_owner', s1.name AS 'priority', s1.options AS 's1options', s2.name AS 'slname', s2.data AS 'sldata', s2.options AS 's2options', s3.name AS 'status', s3.options AS 's3options' FROM {$db_document} AS d LEFT JOIN {$db_account} AS a ON a.id = d.id_owner LEFT JOIN {$db_status} as s1 ON d.priority = s1.code LEFT JOIN {$db_status} as s2 ON d.security_level = s2.code LEFT JOIN {$db_status} as s3 ON d.status = s3.code WHERE d.id_space={$id_space} ORDER BY d.id DESC";
$result = mysqli_query($dbconnect, $query);
$sbuild = false;
while($data = mysqli_fetch_assoc($result))
{
	$data["profile_owner"] = json_decode($data["profile_owner"]);
	//$data["profile_manager"] = json_decode($data["profile_manager"]);
	
	//$data["name"] = rsa_decrypt2($data["name"], $user["keypair_prk"], $user["keypair_password"]);
	//$data["contents"] = rsa_decrypt2($data["contents"], $user["keypair_prk"], $user["keypair_password"]);
	//$data["tag"] = rsa_decrypt2($data["tag"], $user["keypair_prk"], $user["keypair_password"]);
	$data["name"] = urldecode($data["name"]);
	$data["contents"] = urldecode($data["contents"]);
	$data["tag"] = urldecode($data["tag"]);
	
	$data["variable"] = json_decode($data["variable"]);
	
	//$data["s0options"] = json_decode($data["s0options"]);
	$data["s1options"] = json_decode($data["s1options"]);
	$data["s2options"] = json_decode($data["s2options"]);
	$data["s3options"] = json_decode($data["s3options"]);
	
	$sbuild .= "<tr>";
	$sbuild .= "<td>{$data["id"]}</td>";
	
	$date = "Created {$data["date_create"]}";
	if($data["date_create"] !== $data["date_modify"])
		$date = "Modified {$data["date_modify"]}";
	$sbuild .= "<td><a href=\"document_view.php?spaceid={$id_space}&documentid={$data["id"]}\">{$data["name"]}</a><br/><small>{$date}</small></td>";
	
	$sbuild .= "<td><span class=\"label label-{$data["s1options"]->color_class}\">{$data["priority"]}</span></td>";
	
	if(!isset($data["security_level"]) || $data["security_level"] == "")
	{
		$data["sldata"] = $space["sldata"];
		$data["slname"] = $space["slname"];
		$data["s2options"] = $space["sloptions"];
	}
	$sbuild .= "<td><span class=\"label label-{$data["s2options"]->color_class}\">{$data["slname"]} {$data["sldata"]}</span></td>";
	
	$sbuild .= "<td><span class=\"label label-{$data["s3options"]->color_class}\">{$data["status"]}</span></td>";
	$sbuild .= "<td>{$data["tag"]}</td>";
	$sbuild .= "<td><small>Completion with: {$data["variable"]->prograss}%</small><div class=\"progress progress-mini\"><div style=\"width: {$data["variable"]->prograss}%;\" class=\"progress-bar\"></div></div></td>";
	$sbuild .= "<td>{$data["profile_owner"]->nickname}</td>";
	//$sbuild .= "<td>{$data["profile_manager"]->nickname}</td>";
	//$sbuild .= "<td>{$data["date_create"]}</td>";
	//$sbuild .= "<td>{$data["date_modify"]}</td>";
	$sbuild .= "</tr>";
}

if($sbuild == false) { echo "<META HTTP-EQUIV=REFRESH CONTENT=\"1; 'document_write.php?spaceid={$id_space}'\">"; exit; }

echo frame_page_title(array("Home", "Space {$space["name"]}", "Document list"));

echo frame_page_wrapper_top();
echo frame_box_top("Document list", array("새로운 문서", "document_write.php?spaceid={$id_space}"));
echo frame_table_top();
echo "<thead><tr><td>번호</td><td>이슈명</td><td>우선순위</td><td>보안등급</td><td>상태</td><td>태그</td><td>진척도</td><td>소유자</td></tr></thead>";
echo "<tbody>{$sbuild}</tbody>";
echo frame_table_bottom();
echo frame_box_bottom();
echo frame_page_wrapper_bottom();

include_once('../footer.php');
?>