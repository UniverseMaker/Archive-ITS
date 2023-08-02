<?php
$menu = array();
$menu[] = array("홈", "{$urlpath}/index.php");
$menu[] = array("프로젝트", "{$urlpath}/project/project_list.php", "fa fa-flask");
$menu[] = array("전자문서", "{$urlpath}/document/space_list.php", "fa fa-file-o");
$menu[] = array("보안정보", "#", "fa fa-id-badge");
$default_menu_icon = "fa fa-th-large";

$menu_sidebar_profile = array();
$menu_sidebar_profile[] = array("Profile", "{$urlpath}/auth/profile.php");
//$menu_sidebar_profile[] = array("divider");

?>