<?php
if(!isset($_POST["theme_options"]) || $_POST["theme_options"] == "full")
	include_once("body_bottom.php");
?>

<!-- Mainly scripts -->
<script src="<?php echo "{$urlpath}/theme/{$theme}"; ?>/js/jquery-3.1.1.min.js"></script>
<script src="<?php echo "{$urlpath}/theme/{$theme}"; ?>/js/bootstrap.min.js"></script>
<script src="<?php echo "{$urlpath}/theme/{$theme}"; ?>/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo "{$urlpath}/theme/{$theme}"; ?>/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?php echo "{$urlpath}/theme/{$theme}"; ?>/js/inspinia.js"></script>
<script src="<?php echo "{$urlpath}/theme/{$theme}"; ?>/js/plugins/pace/pace.min.js"></script>

</body>
</html>