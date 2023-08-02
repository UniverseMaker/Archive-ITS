<?php
include_once('../header.php');
include_once('subheader.php');

$query = "SELECT sp.id, sp.id_owner, sp.name, sp.contents, sp.status, sp.tag, sp.date_create, sp.date_modify, a.username, a.profile, s.name AS 'slname', s.data AS 'sldata', s.options AS 'sloptions', s2.name AS 'stname', s2.options AS 'stoptions' FROM {$db_space} AS sp LEFT JOIN {$db_account} AS a ON sp.id_owner = a.id LEFT JOIN {$db_status} as s ON sp.security_level = s.code LEFT JOIN {$db_status} as s2 ON sp.status = s2.code WHERE s.data <= {$user["security_level"]} ORDER BY sp.id DESC";
$result = mysqli_query($dbconnect, $query);
$sbuild = false;
while($data = mysqli_fetch_assoc($result))
{
	$data["profile"] = json_decode($data["profile"]);
	
	//$data["name"] = rsa_decrypt2($data["name"], $user["keypair_prk"], $user["keypair_password"]);
	//$data["contents"] = rsa_decrypt2($data["contents"], $user["keypair_prk"], $user["keypair_password"]);
	//$data["tag"] = rsa_decrypt2($data["tag"], $user["keypair_prk"], $user["keypair_password"]);
	$data["name"] = urldecode($data["name"]);
	$data["contents"] = urldecode($data["contents"]);
	$data["tag"] = urldecode($data["tag"]);
	
	$data["sloptions"] = json_decode($data["sloptions"]);
	$data["stoptions"] = json_decode($data["stoptions"]);
	
	$sbuild .= "<tr>";
	$sbuild .= "<td>{$data["id"]}</td>";
	
	$date = "Created {$data["date_create"]}";
	if($data["date_create"] !== $data["date_modify"])
		$date = "Modified {$data["date_modify"]}";
	$sbuild .= "<td><a href=\"document_list.php?spaceid={$data["id"]}\">{$data["name"]}</a><br/><small>{$date}</small></td>";
	//$sbuild .= "<td>{$data["contents"]}</td>";
	
	$sbuild .= "<td><span class=\"label label-{$data["sloptions"]->color_class}\">{$data["slname"]} {$data["sldata"]}</span></td>";
	$sbuild .= "<td><span class=\"label label-{$data["stoptions"]->color_class}\">{$data["stname"]}</span></td>";
	$sbuild .= "<td>{$data["tag"]}</td>";
	$sbuild .= "<td>{$data["profile"]->nickname}</td>";
	//$sbuild .= "<td>{$data["date_create"]}</td>";
	//$sbuild .= "<td>{$data["date_modify"]}</td>";
	$sbuild .= "<td class=\"text-right\"><a href=\"document_list.php?spaceid={$data["id"]}\" class=\"btn btn-white btn-xs\"><i class=\"fa fa-folder\"></i> View </a><a href=\"space_write.php?spaceid={$data["id"]}\" class=\"btn btn-white btn-xs\"><i class=\"fa fa-pencil\"></i> Edit </a></td>";
	$sbuild .= "</tr>";
}

echo frame_page_title(array("Home", "Space list"));

echo frame_page_wrapper_top();
echo frame_box_top("All document space assigned to this account", array("새로운 공간", "space_write.php"));
//echo frame_box_buttonset(array("새로운 프로젝트", "write.php"));
echo frame_table_top();
//<td>설명</td> <td>작성일</td><td>최근수정일</td>
echo "<thead><tr><td>번호</td><td>스페이스명</td><td>보안등급</td><td>상태</td><td>태그</td><td>소유자</td><td></td></tr></thead>";
echo "<tbody>{$sbuild}</tbody>";
echo frame_table_bottom();
echo frame_box_bottom();
echo frame_page_wrapper_bottom();

include_once('../footer.php');
?>