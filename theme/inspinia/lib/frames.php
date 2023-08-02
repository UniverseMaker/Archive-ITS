<?php
function frame_access_deni($withexit)
{
	echo frame_page_wrapper_top();
	echo frame_display_message("Access Denied", "You have no authority to access this page");
	echo frame_page_wrapper_bottom();
	if($withexit === true)
		exit;
}

function frame_menu_sidebar()
{
	$framebody = "<li--class--><!-- class=\"active\" --><a href=\"--location--\"><i class=\"--icon--\"></i> <span class=\"nav-label\">--label--</span></a></li>";
	return frame_menu_core($framebody);
}

function frame_menu_topbar()
{
	$submenu = "<ul role=\"menu\" class=\"dropdown-menu\"><li><a href=\"--location\">--label--</a></li></ul>";
	$submenu = "";
	$framebody = "<li--class--><!--  class=\"dropdown\" --><a aria-expanded=\"false\" role=\"button\" href=\"--location--\"> --label-- <span class=\"caret\"></span></a>{$submenu}</li>"; // class=\"dropdown-toggle\" data-toggle=\"dropdown\"
	
	return frame_menu_core($framebody);
}

function frame_menu_core($framebody)
{
	global $menu, $default_menu_icon;
	$frameresult = false;
	for($i = 0; $i < count($menu); $i++)
	{
		if(!isset($menu[$i][2]) || $menu[$i][2] == "")
			$menu[$i][2] = $default_menu_icon;
		
		$frameresult .= str_replace("--icon--", "{$menu[$i][2]}", str_replace("--class--", "", str_replace("--location--", "{$menu[$i][1]}", str_replace("--label--", "{$menu[$i][0]}", $framebody))));
	}
	
	return $frameresult;
}

function frame_login()
{
	$framebody = "
	<body class=\"gray-bg\">
	<div class=\"middle-box text-center loginscreen animated fadeInDown\">
        <div>
            <!-- <div>
                <h1 class=\"logo-name\">SELEOS</h1>
            </div> -->
			
            <h3>Welcome to SELEOS</h3>
            <p>Seleos Project Management Service with Secure Archive</p>
            <p>Login in. To see it in action.</p>
            <form class=\"m-t\" role=\"form\" action=\"login_submit.php\" method=\"post\">
                <div class=\"form-group\">
                    <input type=\"text\" name=\"username\" class=\"form-control\" placeholder=\"Username\" required=\"\">
                </div>
                <div class=\"form-group\">
                    <input type=\"password\" name=\"password\" class=\"form-control\" placeholder=\"Password\" required=\"\">
                </div>
                <button type=\"submit\" class=\"btn btn-primary block full-width m-b\">Login</button>

                <a href=\"#\"><small>Forgot password?</small></a>
                <p class=\"text-muted text-center\"><small>Do not have an account?</small></p>
                <a class=\"btn btn-sm btn-white btn-block\" href=\"register.php\">Create an account</a>
            </form>
            <p class=\"m-t\"> <small>Seleos.net Secure Archive &copy; 2018</small> </p>
        </div>
    </div>
	";
	
	return $framebody;
}

function frame_login_openview($token, $msg="")
{
	if($msg === "")
		$msg = "비밀번호를 입력해주세요.";
	
	$framebody = "
            <h3>{$msg}</h3>
            <form class=\"m-t\" role=\"form\" action=\"openview.php\" method=\"post\">
				<input type=\"hidden\" name=\"token\" value=\"{$token}\"/>
                <div class=\"form-group\">
                    <input type=\"password\" name=\"password\" class=\"form-control\" placeholder=\"Password\" required=\"\">
                </div>
                <button type=\"submit\" class=\"btn btn-primary block full-width m-b\">Login</button>
            </form>
            <p class=\"m-t\"> <small>Seleos.net Secure Archive &copy; 2018</small> </p>
	";
	
	return $framebody;
}

function frame_login_topbar()
{
	global $urlpath;
	$framebody = false;
	if(!isset($_SESSION['username']) || $_SESSION['username'] == "")
		$framebody = "<li><a href=\"{$urlpath}/auth/login.php\"><i class=\"fa fa-sign-in\"></i> Login</a></li>";
	else
		$framebody = "<li><a href=\"{$urlpath}/auth/logout.php\"><i class=\"fa fa-sign-out\"></i> Logout</a></li>";
	
	return $framebody;
}

function frame_login_sidebar()
{
	global $urlpath, $menu_sidebar_profile;
	$framebody = "";
	for($i = 0; $i < count($menu_sidebar_profile); $i++)
	{
		$framebody .= "<li><a href=\"{$menu_sidebar_profile[$i][1]}\">{$menu_sidebar_profile[$i][0]}</a></li>";
	}
	
	if($framebody !== "")
		$framebody .= "<li class=\"divider\"></li>";
	
	if(!isset($_SESSION['username']) || $_SESSION['username'] == "")
		$framebody .= "<li><a href=\"{$urlpath}/auth/login.php\">Login</a></li>";
	else
		$framebody .= "<li><a href=\"{$urlpath}/auth/logout.php\">Logout</a></li>";
	
	return $framebody;
}

function frame_display_message($title, $contents)
{
	$framebody = "<div class=\"wrapper wrapper-content animated fadeInRight\"><div class=\"row\"><div class=\"col-lg-12\"><div class=\"text-center m-t-lg\"><h1>--title--</h1><small>--contents--</small></div></div></div></div>";
	return str_replace("--title--", $title, str_replace("--contents--", $contents, $framebody));
}

function frame_button($button)
{
	$framebody = "<button type=\"button\" class=\"btn btn-sm btn-white\">{$button[0]}</button></a>";
	if(count($button) > 1)
		$framebody = "<a href=\"{$button[1]}\">{$framebody}</a>";
	return $framebody;
}

function frame_submit($button)
{
	$framebody = "<button type=\"submit\" class=\"btn btn-sm btn-white\">{$button[0]}</button></a>";
	if(count($button) > 1)
		$framebody = "<a href=\"{$button[1]}\">{$framebody}</a>";
	return $framebody;
}

function frame_page_title($data)
{
	$framebody_top = "<div class=\"row wrapper border-bottom white-bg page-heading\"><div class=\"col-sm-12\"><h2>{$data[count($data)-1]}</h2><ol class=\"breadcrumb\">";
	$framebody_bottom = "</ol></div></div>";
	$framebody_middle = false;
	for($i = 0; $i < count($data); $i++)
	{
		if($i < count($data) - 1)
			$framebody_middle .= "<li>{$data[$i]}</li>";
		else
			$framebody_middle .= "<li class=\"active\"><strong>{$data[$i]}</strong></li>";
	}
	
	return $framebody_top . $framebody_middle . $framebody_bottom;
}

function frame_page_wrapper_top()
{
	return "<div class=\"wrapper wrapper-content\">";
}

function frame_page_wrapper_bottom()
{
	return "</div>";
}

function frame_box_top($title, $tools = "")
{
	$framebody = "<div class=\"row\"><div class=\"col-lg-12\"><div class=\"ibox float-e-margins\">--titlebody--<div class=\"ibox-content\">";
	$titlebody = "<div class=\"ibox-title\"><h5>--title--</h5>--tools--</div>";
	if($title !== "")
		$titlebody = str_replace("--title--", $title, $titlebody);
	else
		$titlebody = "";
	
	$toolsbody = "<div class=\"ibox-tools\"><a href=\"--location--\" class=\"btn btn-primary btn-xs\">--label--</a></div>";
	$toolsresult = "";
	if($tools !== "")
		for($i = 0; $i < count($tools); $i = $i + 2)
			$toolsresult .= str_replace("--location--", $tools[$i + 1], str_replace("--label--", $tools[$i], $toolsbody));
	
	return str_replace("--tools--", $toolsresult, str_replace("--titlebody--", $titlebody, $framebody));
}

function frame_box_bottom()
{
	$framebody = "</div></div></div></div>";
	return $framebody;
}

function frame_box_buttonset($buttonset)
{
	$framebody_row_top = "<div class=\"row\">";
	$framebody_row_bottom = "</div>";
	
	$framebody_buttomset_top = "<div class=\"col-sm-9 m-b-xs\"><div class=\"btn-group\">";
	$framebody_buttomset_contents = "";
	$framebody_buttomset_contents_body = "<a href=\"--location--\"><button type=\"button\" class=\"btn btn-sm btn-white\">--label--</button></a>&nbsp;"; // active
	$framebody_buttomset_bottom = "</div></div>";
	
	$framebody_search_top = "<div class=\"col-sm-3\"><div class=\"input-group\"><input type=\"text\" placeholder=\"Search\" class=\"input-sm form-control\"> <span class=\"input-group-btn\"><button type=\"button\" class=\"btn btn-sm btn-primary\"> Go!</button> </span></div></div>";
	//$framebody_search_top = "";
	$framebody_search_bottom = "";
	
	for($i = 0; $i < count($buttonset); $i = $i + 2)
	{
		$framebody_buttomset_contents .= str_replace("--location--", $buttonset[$i + 1], str_replace("--label--", $buttonset[$i], $framebody_buttomset_contents_body));
	}
	
	return $framebody_row_top . $framebody_buttomset_top . $framebody_buttomset_contents. $framebody_buttomset_bottom. $framebody_search_top. $framebody_search_bottom. $framebody_row_bottom;
}

function frame_table_top()
{
	$framebody = "<div class=\"table-responsive\"><table class=\"table table-striped\">";
	return $framebody;
}

function frame_table_bottom()
{
	$framebody = "</table></div>";
	return $framebody;
}

function frame_issue_detail($data)
{
	$framebody_top = "<div class=\"row\"><div class=\"col-lg-12\"><div class=\"m-b-md\"><a href=\"{$data["location_edit_issue"]}\" class=\"btn btn-white btn-xs pull-right\">Edit issue</a><a href=\"{$data["location_openview"]}\" class=\"btn btn-white btn-xs pull-right\" style=\"margin-right:5px\">Openview</a><h2>{$data["issue_name"]}</h2></div><dl class=\"dl-horizontal\"><dt>Project:</dt> <dd>{$data["project_name"]}</dd><dt>Status:</dt> <dd>{$data["issue_status"]}</dd></dl></div></div>";
	
	$framebody_middle = "<div class=\"row\"><div class=\"col-lg-5\"><dl class=\"dl-horizontal\"><dt>Type:</dt> <dd>{$data["issue_type"]}</dd><dt>Priority:</dt> <dd>{$data["issue_priority"]}</dd><dt>Security level:</dt> <dd>{$data["issue_security_level"]}</dd><dt>Owner:</dt> <dd>{$data["issue_owner"]}</dd><dt>Manager:</dt> <dd>{$data["issue_manager"]}</dd></dl></div><div class=\"col-lg-7\" id=\"cluster_info\"><dl class=\"dl-horizontal\" ><dt>Last Updated:</dt> <dd>{$data["issue_date_modify"]}</dd><dt>Created:</dt> <dd>{$data["issue_date_create"]}</dd><dt>Due date:</dt> <dd>{$data["issue_duedate"]}</dd><dt>Time spent:</dt> <dd>{$data["issue_timespent"]}</dd><dt>Time expect:</dt> <dd>{$data["issue_timeexpect"]}</dd></dl></div></div>";
	
	$framebody_bottom = "<div class=\"row\"><div class=\"col-lg-11\"><dl class=\"dl-horizontal\"><dt>Completed:</dt><dd><div class=\"progress progress-striped active m-b-sm\"><div style=\"width: {$data["issue_prograss"]}%;\" class=\"progress-bar\"></div></div><small>Project completed in <strong>{$data["issue_prograss"]}%</strong>.</small></dd></dl></div></div>";
	
	$framebody_contents = "<div class=\"row\"><div class=\"col-lg-12\"><dl class=\"dl-horizontal\"><dt>Description:</dt><dd>{$data["issue_contents"]}</dd></dl></div></div>";
	
	return $framebody_top . $framebody_middle . $framebody_bottom . $framebody_contents;
}

function frame_page_title_openview($data)
{
	$framebody_top = "<div class=\"row wrapper border-bottom white-bg page-heading\"><div class=\"col-sm-12\"><h2>{$data[count($data)-1]}</h2><ol class=\"breadcrumb\">";
	$framebody_bottom = "</ol></div></div>";
	$framebody_middle = false;
	for($i = 0; $i < count($data); $i++)
	{
		if($i < count($data) - 1)
			$framebody_middle .= "<li>{$data[$i]}</li>";
		else
			$framebody_middle .= "<li class=\"active\"><strong>{$data[$i]}</strong></li>";
	}
	
	return $framebody_top . $framebody_middle . $framebody_bottom;
}

function frame_issue_detail_openview($data)
{
	$framebody_top = "<div class=\"row\"><div class=\"col-lg-12\"><div class=\"m-b-md\"><h2>{$data["issue_name"]}</h2></div><dl class=\"dl-horizontal\"><dt>소속 프로젝트:</dt> <dd>{$data["project_name"]}</dd><dt>진행상태:</dt> <dd>{$data["issue_status"]}</dd></dl></div></div>";
	
	$framebody_middle = "<div class=\"row\"><div class=\"col-lg-5\"><dl class=\"dl-horizontal\"><dt>작업종류:</dt> <dd>{$data["issue_type"]}</dd><dt>우선순위:</dt> <dd>{$data["issue_priority"]}</dd><dt>비밀등급:</dt> <dd>{$data["issue_security_level"]}</dd><dt>담당자:</dt> <dd>{$data["issue_owner"]}</dd><dt>관측자:</dt> <dd>{$data["issue_manager"]}</dd></dl></div><div class=\"col-lg-7\" id=\"cluster_info\"><dl class=\"dl-horizontal\" ><dt>최근 업데이트:</dt> <dd>{$data["issue_date_modify"]}</dd><dt>생성날짜:</dt> <dd>{$data["issue_date_create"]}</dd><dt>목표일:</dt> <dd>{$data["issue_duedate"]}</dd><dt>현재까지 소요시간:</dt> <dd>{$data["issue_timespent"]}</dd><dt>완료까지 예상시간:</dt> <dd>{$data["issue_timeexpect"]}</dd></dl></div></div>";
	
	$framebody_bottom = "<div class=\"row\"><div class=\"col-lg-11\"><dl class=\"dl-horizontal\"><dt>진척도:</dt><dd><div class=\"progress progress-striped active m-b-sm\"><div style=\"width: {$data["issue_prograss"]}%;\" class=\"progress-bar\"></div></div><small>현재까지 프로젝트 <strong>{$data["issue_prograss"]}% 진행되었습니다</strong>.</small></dd></dl></div></div>";
	
	$framebody_contents = "<div class=\"row\"><div class=\"col-lg-12\"><dl class=\"dl-horizontal\"><dt>프로젝트 목적과 목표:</dt><dd>{$data["issue_contents"]}</dd></dl></div></div>";
	
	return $framebody_top . $framebody_middle . $framebody_bottom . $framebody_contents;
}

?>