<?php
include_once("../header.php");
include_once("subheader.php");
include_once("{$rootpath}/lib/lib_authcheck.php");
if(isset($space["id_owner"]))
	authcheck_owner($space["id_owner"]);

echo frame_page_title(array("Home", "Space", "Space Submission"));
echo frame_page_wrapper_top();
echo frame_box_top("Document Space Submission");

?>

<form action="space_write_submit.php" method="post">
<?php if(isset($id_space)) echo "<input type=\"hidden\" name=\"spaceid\" value=\"{$id_space}\"/>"; ?>

<div class="row">
	<div class="col-xs-12">
		<div class="form-group">
			<label>SUBJECT</label>
			<input type="text" class="form-control" name="spacename" placeholder="SUBJECT OF THIS DOCUMENT SPACE" value="<?php if(isset($id_space)) echo $space["name"]; ?>">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="form-group">
			<label>DESCRIPTION</label>
			<textarea class="form-control" name="contents" placeholder="DESCRIPTION"><?php if(isset($id_space)) echo $space["contents"]; ?></textarea>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="form-group">
			<label>SECURITY LEVEL</label>
			<fieldset style="margin-left:30px;">
			<?php
				$query = "SELECT * FROM {$db_status} WHERE category='security_level' ORDER BY id ASC";
				$result = mysqli_query($dbconnect, $query);
				while($data = mysqli_fetch_assoc($result))
				{
					$data["options"] = json_decode($data["options"]);
					$data["options"]->active = "";
					if(isset($id_space) && $space["sldata"] == $data["data"]) $data["options"]->active = " checked=\"\"";
					if(!isset($id_space) && $space_default_security_level == $data["data"]) $data["options"]->active = " checked=\"\"";
					echo "<div class=\"radio\"><input type=\"radio\" id=\"security_level\" value=\"{$data["code"]}\" name=\"security_level\"{$data["options"]->active}><label for=\"inlineRadio1\"><span class=\"label label-{$data["options"]->color_class}\"> Class {$data["data"]} {$data["name"]} </span></label></div>";
				}
			?>
			</fieldset>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="form-group">
			<label>STATUS</label>
			<fieldset style="margin-left:30px;">
			<?php
				$query = "SELECT * FROM {$db_status} WHERE category='space_status' ORDER BY id ASC";
				$result = mysqli_query($dbconnect, $query);
				while($data = mysqli_fetch_assoc($result))
				{
					$data["options"] = json_decode($data["options"]);
					$data["options"]->active = "";
					if(isset($id_space) && $space["stcode"] == $data["code"]) $data["options"]->active = " checked=\"\"";
					if(!isset($id_space) && $space_default_status == $data["code"]) $data["options"]->active = " checked=\"\"";
					echo "<div class=\"radio\"><input type=\"radio\" id=\"status\" value=\"{$data["code"]}\" name=\"status\"{$data["options"]->active}><label for=\"inlineRadio1\"><span class=\"label label-{$data["options"]->color_class}\"> {$data["name"]} </span></label></div>";
				}
			?>
			</fieldset>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="form-group">
			<label>TAG</label>
			<input type="text" class="form-control" name="tag" placeholder="TAG" value="<?php if(isset($id_space)) echo $space["tag"]; ?>">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<button type="submit" class="btn btn-sm btn-primary pull-right m-t-n-xs"><strong>Submit</strong></button>
	</div>
</div>
</form>

<?php
echo frame_box_bottom();
echo frame_page_wrapper_bottom();

echo "<script src=\"//cdn.ckeditor.com/4.8.0/full/ckeditor.js\"></script><script> CKEDITOR.replace('contents'); </script>";

include_once('../footer.php');
?>