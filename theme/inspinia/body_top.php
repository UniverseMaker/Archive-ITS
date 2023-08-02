<?php
include_once($rootpath . "/header/header_userdata.php");
include_once($rootpath . "/menu.php");
?>
<body>

<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
						<span><img alt="image" class="img-circle" src="<?php echo $userdata["profile"]->avatar_link; ?>" style="width: 48px"></span>
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">
						<span class="clear">
							<span class="block m-t-xs"> <strong class="font-bold"><?php echo $userdata["profile"]->nickname; ?> <b class="caret"></b></strong></span>
							<span class="text-muted text-xs block"><?php echo $userdata["profile"]->job; ?></span>
							<span class="text-muted text-xs block"><?php echo $userdata["security_level_name"]; ?></span>
						</span> </a>
						<ul class="dropdown-menu animated fadeInRight m-t-xs">
							<?php echo frame_login_sidebar(); ?>
						</ul>
                    </div>
                    <div class="logo-element">
                        SELEOS
                    </div>
                </li>
                <?php echo frame_menu_sidebar(); ?>
            </ul>

        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                    <form role="search" class="navbar-form-custom" method="post" action="#">
                        <div class="form-group">
                            <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                        </div>
                    </form>
                </div>
                <ul class="nav navbar-top-links navbar-right">
					<li><span class="m-r-sm text-muted welcome-message">Welcome to Seleos.</span></li>
					<li><span class="label label-info">Last login <?php echo $userdata["date_lastlogin"]; ?></span></li>
					<li><span class="label label-info">Session expire <?php echo session_cache_expire(); ?>m</span></li>
                    <?php echo frame_login_topbar(); ?>
                </ul>

            </nav>
        </div>
		
		