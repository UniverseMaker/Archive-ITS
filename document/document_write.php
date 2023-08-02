<?php
include_once("../header.php");
include_once("subheader.php");
include_once("{$rootpath}/lib/lib_authcheck.php");
if(isset($document["id_owner"]))
	authcheck_owner($document["id_owner"]);

echo frame_page_title(array("Home", "Space {$space["name"]}", "Document", "Document Submission")); 

echo frame_page_wrapper_top();
echo frame_box_top("Document Write");

?>

<form action="document_write_submit.php" method="post">
<input type="hidden" name="spaceid" value="<?php echo $id_space; ?>"/>
<?php if(isset($id_document)) echo "<input type=\"hidden\" name=\"documentid\" value=\"{$id_document}\"/>"; ?>

<div class="row">
	<div class="col-xs-12">
		<div class="form-group">
			<label>SUBJECT</label>
			<input type="text" class="form-control" name="documentname" placeholder="SUBJECT OF THIS ISSUE" value="<?php if(isset($id_document)) echo $document["name"]; ?>">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="form-group">
			<label>CONTENTS</label>
			<textarea class="form-control" name="contents" placeholder="CONTENTS"><?php if(isset($id_document)) echo $document["contents"]; ?></textarea>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="filebox"> <label class="btn btn-white btn-xs" for="ex_file">IMAGE WITH BASE64</label> <input type="file" id="ex_file" style="width:1px; height:1px; padding:0; margin:-1px; overflow:hidden; border:0; clip:rect(0,0,0,0);"> </div>
		<br/>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="form-group">
			<label>PRIORITY</label>
			<fieldset style="margin-left:30px;">
			<?php
				$query = "SELECT * FROM {$db_status} WHERE category='document_priority' ORDER BY id ASC";
				$result = mysqli_query($dbconnect, $query);
				while($data = mysqli_fetch_assoc($result))
				{
					$data["options"] = json_decode($data["options"]);
					$data["options"]->active = "";
					if(isset($id_document) && $document["s1code"] == $data["code"]) $data["options"]->active = " checked=\"\"";
					if(!isset($id_document) && $document_default_priority == $data["code"]) $data["options"]->active = " checked=\"\"";
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
					if(isset($id_document) && $document["sldata"] == $data["data"]) $data["options"]->active = " checked=\"\"";
					if(!isset($id_document) && $document_default_security_level == $data["data"]) $data["options"]->active = " checked=\"\"";
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
				$query = "SELECT * FROM {$db_status} WHERE category='document_status' ORDER BY id ASC";
				$result = mysqli_query($dbconnect, $query);
				while($data = mysqli_fetch_assoc($result))
				{
					$data["options"] = json_decode($data["options"]);
					$data["options"]->active = "";
					if(isset($id_document) && $document["s3code"] == $data["code"]) $data["options"]->active = " checked=\"\"";
					if(!isset($id_document) && $document_default_status == $data["code"]) $data["options"]->active = " checked=\"\"";
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

echo "<script src=\"//cdn.ckeditor.com/4.8.0/full/ckeditor.js\"></script><script> CKEDITOR.replace('contents', { height: '800px' }); </script>";

include_once('../footer.php');
?>