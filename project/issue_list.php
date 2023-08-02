<?php
include_once('../header.php');
include_once('./subheader.php');

$query = "SELECT i.id, i.id_owner, i.id_manager, i.name, i.contents, i.security_level, i.tag, i.variable, i.date_create, i.date_modify, a.username AS 'username_owner', a.profile AS 'profile_owner', a2.username AS 'username_manager', a2.profile AS 'profile_manager', s0.name AS 'type', s0.options AS 's0options', s1.name AS 'priority', s1.options AS 's1options', s2.name AS 'slname', s2.data AS 'sldata', s2.options AS 's2options', s3.name AS 'status', s3.options AS 's3options' FROM {$db_issue} AS i LEFT JOIN {$db_account} AS a ON a.id = i.id_owner LEFT JOIN {$db_account} AS a2 ON a2.id = i.id_manager LEFT JOIN {$db_status} as s0 ON i.type = s0.code LEFT JOIN {$db_status} as s1 ON i.priority = s1.code LEFT JOIN {$db_status} as s2 ON i.security_level = s2.code LEFT JOIN {$db_status} as s3 ON i.status = s3.code WHERE i.id_project={$id_project} ORDER BY i.id DESC";
$result = mysqli_query($dbconnect, $query);
$sbuild = false;
while($data = mysqli_fetch_assoc($result))
{
	$data["profile_owner"] = json_decode($data["profile_owner"]);
	$data["profile_manager"] = json_decode($data["profile_manager"]);
	
	//$data["name"] = rsa_decrypt2($data["name"], $user["keypair_prk"], $user["keypair_password"]);
	//$data["contents"] = rsa_decrypt2($data["contents"], $user["keypair_prk"], $user["keypair_password"]);
	//$data["tag"] = rsa_decrypt2($data["tag"], $user["keypair_prk"], $user["keypair_password"]);
	$data["name"] = urldecode($data["name"]);
	$data["contents"] = urldecode($data["contents"]);
	$data["tag"] = urldecode($data["tag"]);
	
	//$data["variable"] = json_decode(rsa_decrypt2($data["variable"], $user["keypair_prk"], $user["keypair_password"]));
	$data["variable"] = json_decode($data["variable"]);
	
	$data["s0options"] = json_decode($data["s0options"]);
	$data["s1options"] = json_decode($data["s1options"]);
	$data["s2options"] = json_decode($data["s2options"]);
	$data["s3options"] = json_decode($data["s3options"]);
	
	$sbuild .= "<tr>";
	$sbuild .= "<td>{$data["id"]}</td>";
	
	$date = "Created {$data["date_create"]}";
	if($data["date_create"] !== $data["date_modify"])
		$date = "Modified {$data["date_modify"]}";
	$sbuild .= "<td><a href=\"issue_view.php?projectid={$id_project}&issueid={$data["id"]}\">{$data["name"]}</a><br/><small>{$date}</small></td>";
	
	$sbuild .= "<td><span class=\"label label-{$data["s0options"]->color_class}\">{$data["type"]}</span></td>";
	$sbuild .= "<td><span class=\"label label-{$data["s1options"]->color_class}\">{$data["priority"]}</span></td>";
	
	if(!isset($data["security_level"]) || $data["security_level"] == "")
	{
		$data["sldata"] = $project["sldata"];
		$data["slname"] = $project["slname"];
		$data["s2options"] = $project["sloptions"];
	}
	$sbuild .= "<td><span class=\"label label-{$data["s2options"]->color_class}\">{$data["slname"]} {$data["sldata"]}</span></td>";
	
	$sbuild .= "<td><span class=\"label label-{$data["s3options"]->color_class}\">{$data["status"]}</span></td>";
	$sbuild .= "<td>{$data["tag"]}</td>";
	$sbuild .= "<td><small>Completion with: {$data["variable"]->prograss}%</small><div class=\"progress progress-mini\"><div style=\"width: {$data["variable"]->prograss}%;\" class=\"progress-bar\"></div></div></td>";
	$sbuild .= "<td>{$data["profile_owner"]->nickname}</td>";
	$sbuild .= "<td>{$data["profile_manager"]->nickname}</td>";
	//$sbuild .= "<td>{$data["date_create"]}</td>";
	//$sbuild .= "<td>{$data["date_modify"]}</td>";
	$sbuild .= "</tr>";
}

if($sbuild == false) { echo "<META HTTP-EQUIV=REFRESH CONTENT=\"1; 'issue_write.php?projectid={$id_project}'\">"; exit; }

echo frame_page_title(array("Home", "Project {$project["name"]}", "Issue list"));

echo frame_page_wrapper_top();
echo frame_box_top("Issue list", array("새로운 이슈", "issue_write.php?projectid={$id_project}"));
echo frame_table_top();
echo "<thead><tr><td>번호</td><td>이슈명</td><td>유형</td><td>우선순위</td><td>보안등급</td><td>상태</td><td>태그</td><td>진척도</td><td>소유자</td><td>담당자</td></tr></thead>";
echo "<tbody>{$sbuild}</tbody>";
echo frame_table_bottom();
echo frame_box_bottom();
echo frame_page_wrapper_bottom();

include_once('../footer.php');
?>