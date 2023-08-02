<?php
include_once("../header.php");
include_once("subheader.php");
include_once("{$rootpath}/lib/lib_authcheck.php");
if(isset($issue["id_owner"]))
	authcheck_owner($issue["id_owner"]);

date_default_timezone_set("Asia/Seoul");
$time = date("Y-m-d H:i:s",time());

$query = "SELECT * FROM {$db_openview} WHERE projectid='{$id_project}' and issueid='{$id_issue}'";
$result = mysqli_query($dbconnect, $query);
if($result)
	$data = mysqli_fetch_assoc($result);

echo frame_page_title(array("Home", "Project {$project["name"]}", "Issue", "Issue Submission")); 

echo frame_page_wrapper_top();
echo frame_box_top("Issue Data Submission");

?>

<form action="openview_management_submit.php" method="post">
<input type="hidden" name="projectid" value="<?php echo $id_project; ?>"/>
<?php if(isset($id_issue)) echo "<input type=\"hidden\" name=\"issueid\" value=\"{$id_issue}\"/>"; ?>

<div class="row">
	<div class="col-xs-12">
		<div class="form-group">
			<label>TOKEN</label>
			<input type="text" class="form-control" name="token" placeholder="TOKEN OF THIS ISSUE" value="<?php if(isset($data["token"])) echo $data["token"]; ?>">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="form-group">
			<label>PASSWORD</label>
			<input type="text" class="form-control" name="password" placeholder="PASSWORD OF THIS ISSUE" value="<?php if(isset($data["password"])) echo $data["password"]; ?>">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="form-group">
			<label>VALID</label>
			<input type="text" class="form-control" name="valid" placeholder="VALID DATE" value="<?php if(isset($data["valid"])) echo $data["valid"]; ?>">
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