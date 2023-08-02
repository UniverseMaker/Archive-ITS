<body class="top-navigation">

<div id="wrapper">
	<div id="page-wrapper" class="gray-bg">
		<div class="row border-bottom white-bg">
		<nav class="navbar navbar-static-top" role="navigation">
			<div class="navbar-header">
				<button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
					<i class="fa fa-reorder"></i>
				</button>
				<a href="#" class="navbar-brand"><?php echo $sitetitle; ?></a>
			</div>
			<div class="navbar-collapse collapse" id="navbar">
				<ul class="nav navbar-nav">
					<?php include_once($rootpath . "/menu.php"); echo frame_menu_topbar();?>
				</ul>
				<ul class="nav navbar-top-links navbar-right">
					<?php echo frame_login_topbar(); ?>
				</ul>
			</div>
		</nav>
		</div>

		
	