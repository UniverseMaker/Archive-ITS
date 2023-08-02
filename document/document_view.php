<?php
include_once("../header.php");
include_once("subheader.php");

//$document["type"] = "<span class=\"mb-5 label\">{$document["type"]}</span>";

if(!isset($document["security_level"]) || $document["security_level"] == "")
{
	$document["sldata"] = $space["sldata"];
	$document["slname"] = $space["slname"];
	$document["s2options"] = $space["sloptions"];
}

//$document["priority"] = "<span class=\"label{$priority}\">{$document["priority"]}</span>";
//$document["security_level"] = "<span class=\"label{$level}\">{$document["slname"]} {$document["security_level"]}</span>";
$document["priority"] = "<span class=\"label label-{$document["s1options"]->color_class}\">PRIORITY {$document["priority"]}</span>";
$document["security_level"] = "<span class=\"label label-{$document["s2options"]->color_class}\">SECURITY LEVEL {$document["slname"]} {$document["sldata"]}</span>";
$document["status"] = "<span class=\"label label-{$document["s3options"]->color_class}\">STATUS {$document["status"]}</span>";

$time = $document["date_create"];
if($document["date_create"] !== $document["date_modify"])
	$time = $document["date_modify"];

if($document["variable"]->prograss == "")
	$document["variable"]->prograss = 0;

echo frame_page_title(array("Home", "Space {$space["name"]}", "Document {$document["name"]}", "Document view")); // {$document["name"]}

echo frame_page_wrapper_top();
echo frame_box_top("");
//echo frame_issue_detail(array("location_edit_issue"=>"issue_write.php?projectid={$space["id"]}&issueid={$document["id"]}", "issue_name"=>$document["name"], "issue_status"=>$document["status"], "project_name"=>$space["name"], "issue_type"=>$document["type"], "issue_priority"=>$document["priority"], "issue_security_level"=>"{$document["security_level"]}", "issue_owner"=>$document["profile_owner"]->nickname, "issue_manager"=>$document["profile_manager"]->nickname, "issue_date_modify"=>$document["date_modify"], "issue_date_create"=>$document["date_create"], "issue_prograss"=>$document["variable"]->prograss, "issue_duedate"=>$document["variable"]->duedate, "issue_contents"=>$document["contents"]));
//echo frame_box_buttonset(array("Encrypt", "http://{$_SERVER["HTTP_HOST"]}{$_SERVER["PHP_SELF"]}?projectid={$id_project}&issueid={$id_issue}&encryption=encrypt", "Decrypt", "http://{$_SERVER["HTTP_HOST"]}{$_SERVER["PHP_SELF"]}?projectid={$id_project}&issueid={$id_issue}&encryption=decrypt"));
?>


<div class="pull-right">
	<?php echo $document["priority"]; ?>
	<?php echo $document["security_level"]; ?>
	<?php echo $document["status"]; ?>
</div>


<div class="text-center article-title">
<span class="text-muted"><i class="fa fa-clock-o"></i> <?php echo $time ?></span>
	<h1>
		<?php echo $document["name"] ?>
	</h1>
</div>

<?php echo $document["contents"] ?>

<div class="row">
	<div class="col-md-12 text-right">
		<a href="document_write.php?spaceid=<?php echo $id_space; ?>&documentid=<?php echo $id_document; ?>" class="btn btn-white btn-xs">Edit</a>
		<a href="#" class="btn btn-white btn-xs">Delete</a>
	</div>
</div>
<hr>

<div class="row">
	<div class="col-md-6">
		<h5>Tags:</h5>
			<?php
			if($document["tag"] !== "")
			{
				echo "<button class=\"btn btn-white btn-xs\" type=\"button\">Publishing</button>";
			}
			?>
	</div>
	<div class="col-md-6">
		<div class="small text-right">
			<h5>Stats:</h5>
			<div> <i class="fa fa-comments-o"> </i> 0 comments </div>
			<i class="fa fa-eye"> </i> 0 views
		</div>
	</div>
</div>

<?php
include_once("document_comment_list.php");

echo frame_box_bottom();
echo frame_page_wrapper_bottom();

echo "<script src=\"//cdn.ckeditor.com/4.8.0/basic/ckeditor.js\"></script><script> CKEDITOR.replace('contents'); </script>";

include_once('../footer.php');
?>