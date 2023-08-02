<?php
include_once("../header.php");
include_once("subheader.php");
include_once("{$rootpath}/lib/lib_authcheck.php");
if(isset($issue["id_owner"]))
	authcheck_owner($issue["id_owner"]);

echo frame_page_title(array("Home", "Project {$project["name"]}", "Issue", "Issue Submission")); 

echo frame_page_wrapper_top();
echo frame_box_top("Issue Data Submission");

?>

<form action="issue_write_submit.php" method="post">
<input type="hidden" name="projectid" value="<?php echo $id_project; ?>"/>
<?php if(isset($id_issue)) echo "<input type=\"hidden\" name=\"issueid\" value=\"{$id_issue}\"/>"; ?>

<div class="row">
	<div class="col-xs-12">
		<div class="form-group">
			<label>SUBJECT</label>
			<input type="text" class="form-control" name="issuename" placeholder="SUBJECT OF THIS ISSUE" value="<?php if(isset($id_issue)) echo $issue["name"]; ?>">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="form-group">
			<label>DESCRIPTION</label>
			<textarea class="form-control" name="contents" placeholder="DESCRIPTION"><?php if(isset($id_issue)) echo $issue["contents"]; ?></textarea>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="form-group">
			<label>TYPE</label>
			<fieldset style="margin-left:30px;">
			<?php
				$query = "SELECT * FROM {$db_status} WHERE category='issue_type' ORDER BY id ASC";
				$result = mysqli_query($dbconnect, $query);
				while($data = mysqli_fetch_assoc($result))
				{
					$data["options"] = json_decode($data["options"]);
					$data["options"]->active = "";
					if(isset($id_issue) && $issue["s0code"] == $data["code"]) $data["options"]->active = " checked=\"\"";
					if(!isset($id_issue) && $issue_default_status == $data["code"]) $data["options"]->active = " checked=\"\"";
					echo "<div class=\"radio\"><input type=\"radio\" id=\"type\" value=\"{$data["code"]}\" name=\"type\"{$data["options"]->active}><label for=\"inlineRadio1\"><span class=\"label label-{$data["options"]->color_class}\"> {$data["name"]} </span></label></div>";
				}
			?>
			</fieldset>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="form-group">
			<label>PRIORITY</label>
			<fieldset style="margin-left:30px;">
			<?php
				$query = "SELECT * FROM {$db_status} WHERE category='issue_priority' ORDER BY id ASC";
				$result = mysqli_query($dbconnect, $query);
				while($data = mysqli_fetch_assoc($result))
				{
					$data["options"] = json_decode($data["options"]);
					$data["options"]->active = "";
					if(isset($id_issue) && $issue["s1code"] == $data["code"]) $data["options"]->active = " checked=\"\"";
					if(!isset($id_issue) && $issue_default_status == $data["code"]) $data["options"]->active = " checked=\"\"";
					echo "<div class=\"radio\"><input type=\"radio\" id=\"priority\" value=\"{$data["code"]}\" name=\"priority\"{$data["options"]->active}><label for=\"inlineRadio1\"><span class=\"label label-{$data["options"]->color_class}\"> {$data["name"]} </span></label></div>";
				}
			?>
			</fieldset>
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
				$ncchk = true;
				while($data = mysqli_fetch_assoc($result))
				{
					$data["options"] = json_decode($data["options"]);
					$data["options"]->active = "";
					if(isset($id_issue) && $issue["sldata"] == $data["data"]) $data["options"]->active = " checked=\"\"";
					if(!isset($id_issue) && $issue_default_security_level == $data["data"]) $data["options"]->active = " checked=\"\"";
					echo "<div class=\"radio\"><input type=\"radio\" id=\"security_level\" value=\"{$data["code"]}\" name=\"security_level\"{$data["options"]->active}><label for=\"inlineRadio1\"><span class=\"label label-{$data["options"]->color_class}\"> Class {$data["data"]} {$data["name"]} </span></label></div>";
					if($data["options"]->active !== "")
						$ncchk = false;
				}
				if($ncchk == true)
					$optionactive = " checked=\"\"";
				echo "<div class=\"radio\"><input type=\"radio\" id=\"security_level\" value=\"\" name=\"security_level\"{$optionactive}><label for=\"inlineRadio1\"><span class=\"label label-info\"> No choose - sync to project </span></label></div>";
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
				$query = "SELECT * FROM {$db_status} WHERE category='issue_status' ORDER BY id ASC";
				$result = mysqli_query($dbconnect, $query);
				while($data = mysqli_fetch_assoc($result))
				{
					$data["options"] = json_decode($data["options"]);
					$data["options"]->active = "";
					if(isset($id_issue) && $issue["s3code"] == $data["code"]) $data["options"]->active = " checked=\"\"";
					if(!isset($id_issue) && $issue_default_status == $data["code"]) $data["options"]->active = " checked=\"\"";
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
			<input type="text" class="form-control" name="tag" placeholder="TAG">
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