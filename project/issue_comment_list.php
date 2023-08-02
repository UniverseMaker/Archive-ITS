<?php
include_once($rootpath . "/header/header_userdata.php");
?>
<div class="row m-t-sm">
<div class="col-lg-12">
<div class="panel blank-panel">

<div class="panel-heading">
	<div class="panel-options">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-1" data-toggle="tab" aria-expanded="true">Activity</a></li>
			<li class=""><a href="#tab-2" data-toggle="tab" aria-expanded="false">Log</a></li>
		</ul>
	</div>
</div>

<div class="panel-body">
<div class="tab-content">

<div class="tab-pane active" id="tab-1">
	<form action="issue_comment_write_submit.php" method="post">
		<div class="form-group">
			<input type="hidden" name="projectid" value="<?php echo $id_project; ?>"/>
			<input type="hidden" name="issueid" value="<?php echo $id_issue; ?>"/>
			<input type="hidden" name="type" value="comment"/>
			<textarea id="contents" name="contents"/></textarea>
		</div>
		<div class="text-right">
			<button type="submit" class="btn btn-sm btn-primary m-t-n-xs"><strong>Submit</strong></button>
		</div>
	</form>
	<div class="hr-line-dashed"></div>
	
	<div class="feed-activity-list">

<?php
$query = "SELECT ia.id, ia.id_owner, ia.type, ia.contents, ia.date_create, ia.date_modify, a.username, a.profile FROM {$db_issue_activity} AS ia LEFT JOIN {$db_account} AS a ON ia.id_owner = a.id WHERE ia.id_issue={$id_issue} ORDER BY ia.id DESC";
$result = mysqli_query($dbconnect, $query);
$sbuild = false;
while($data = mysqli_fetch_assoc($result))
{
	//$data["contents"] = rsa_decrypt2($data["contents"], $user["keypair_prk"], $user["keypair_password"]);
	$data["contents"] = urldecode($data["contents"]);
	
	$activity_name = $data["username"];
	$activity_profile = "{$urlpath}/theme/{$theme}/img/avatar/default_avatar.png";
	if(isset($data["profile"]))
	{
		$data["profile"] = json_decode($data["profile"]);
		$activity_name = $data["profile"]->nickname;
		$activity_profile = "{$urlpath}/theme/{$theme}/{$data["profile"]->avatar}";
	}
	echo "<div class=\"feed-element\"><a href=\"#\" class=\"pull-left\"><img alt=\"image\" class=\"img-circle\" src=\"{$activity_profile}\"></a><div class=\"media-body \"><small class=\"pull-right\">{$data["type"]}</small><small class=\"pull-right\" style=\"margin-right:5px\"><a href=\"../sms/smsbypass.php?issueid={$issue["id"]}&commentid={$data["id"]}\">sms</a></small><strong>{$activity_name}</strong> logged <strong>{$data["type"]}</strong> activity. <br><small class=\"text-muted\">{$data["date_create"]}</small><div class=\"well\">{$data["contents"]}</div></div></div>";
}
?>

	</div>
</div>

<div class="tab-pane" id="tab-2">
	<table class="table table-striped">
		<thead>
		<tr>
			<th>Status</th>
			<th>Title</th>
			<th>Start Time</th>
			<th>End Time</th>
			<th>Comments</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td>
				<span class="label label-primary"><i class="fa fa-check"></i> Completed</span>
			</td>
			<td>
			   Create project in webapp
			</td>
			<td>
			   12.07.2014 10:10:1
			</td>
			<td>
				14.07.2014 10:16:36
			</td>
			<td>
			<p class="small">
				Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable.
			</p>
			</td>

		</tr>
		<tr>
			<td>
				<span class="label label-primary"><i class="fa fa-check"></i> Accepted</span>
			</td>
			<td>
				Various versions
			</td>
			<td>
				12.07.2014 10:10:1
			</td>
			<td>
				14.07.2014 10:16:36
			</td>
			<td>
				<p class="small">
					Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
				</p>
			</td>

		</tr>
		<tr>
			<td>
				<span class="label label-primary"><i class="fa fa-check"></i> Sent</span>
			</td>
			<td>
				There are many variations
			</td>
			<td>
				12.07.2014 10:10:1
			</td>
			<td>
				14.07.2014 10:16:36
			</td>
			<td>
				<p class="small">
					There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which
				</p>
			</td>

		</tr>
	</tbody>
</table>
</div>

</div>
</div>

</div>
</div>
</div>