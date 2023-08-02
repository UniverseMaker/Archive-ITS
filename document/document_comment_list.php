<?php
include_once($rootpath . "/header/header_userdata.php");
?>

<div class="row">
	<div class="col-lg-12">

		<h2>Comments:</h2>
		<div class="social-feed-box">
			<div class="social-avatar">
				<a href="" class="pull-left">
					<img alt="image" src="<?php echo "{$urlpath}/theme/{$theme}"; ?>/img/avatar/default_avatar.png">
				</a>
				<div class="media-body">
					<a href="#">
						Andrew Williams
					</a>
					<small class="text-muted">Today 4:21 pm - 12.06.2014</small>
				</div>
			</div>
			<div class="social-body">
				<p>
					Many desktop publishing packages and web page editors now use Lorem Ipsum as their
					default model text, and a search for 'lorem ipsum' will uncover many web sites still
					default model text.
				</p>
			</div>
		</div>
		<div class="social-feed-box">
			<div class="social-avatar">
				<a href="" class="pull-left">
					<img alt="image" src="<?php echo "{$urlpath}/theme/{$theme}"; ?>/img/avatar/default_avatar.png">
				</a>
				<div class="media-body">
					<a href="#">
						Michael Novek
					</a>
					<small class="text-muted">Today 4:21 pm - 12.06.2014</small>
				</div>
			</div>
			<div class="social-body">
				<p>
					Many desktop publishing packages and web page editors now use Lorem Ipsum as their
					default model text, and a search for 'lorem ipsum' will uncover many web sites still
					default model text, and a search for 'lorem ipsum' will uncover many web sites still
					in their infancy. Packages and web page editors now use Lorem Ipsum as their
					default model text.
				</p>
			</div>
		</div>
		<div class="social-feed-box">
			<div class="social-avatar">
				<a href="" class="pull-left">
					<img alt="image" src="<?php echo "{$urlpath}/theme/{$theme}"; ?>/img/avatar/default_avatar.png">
				</a>
				<div class="media-body">
					<a href="#">
						Alice Mediater
					</a>
					<small class="text-muted">Today 4:21 pm - 12.06.2014</small>
				</div>
			</div>
			<div class="social-body">
				<p>
					Many desktop publishing packages and web page editors now use Lorem Ipsum as their
					default model text, and a search for 'lorem ipsum' will uncover many web sites still
					in their infancy. Packages and web page editors now use Lorem Ipsum as their
					default model text.
				</p>
			</div>
		</div>
		<div class="social-feed-box">
			<div class="social-avatar">
				<a href="" class="pull-left">
					<img alt="image" src="<?php echo "{$urlpath}/theme/{$theme}"; ?>/img/avatar/default_avatar.png">
				</a>
				<div class="media-body">
					<a href="#">
						Monica Flex
					</a>
					<small class="text-muted">Today 4:21 pm - 12.06.2014</small>
				</div>
			</div>
			<div class="social-body">
				<p>
					Many desktop publishing packages and web page editors now use Lorem Ipsum as their
					default model text, and a search for 'lorem ipsum' will uncover many web sites still
					in their infancy. Packages and web page editors now use Lorem Ipsum as their
					default model text.
				</p>
			</div>
		</div>

		<hr>
		<form action="document_comment_write_submit.php" method="post">
			<div class="form-group">
				<input type="hidden" name="spaceid" value="<?php echo $id_space; ?>"/>
				<input type="hidden" name="documentid" value="<?php echo $id_document; ?>"/>
				<input type="hidden" name="type" value="comment"/>
				<textarea id="contents" name="contents"/></textarea>
			</div>
			<div class="text-right">
				<button type="submit" class="btn btn-sm btn-primary m-t-n-xs"><strong>Submit</strong></button>
			</div>
		</form>
	</div>
</div>

<?php
/*
$query = "SELECT ia.id, ia.id_owner, ia.type, ia.contents, ia.date_create, ia.date_modify, a.username, a.profile FROM issue_activity AS ia LEFT JOIN account AS a ON ia.id_owner = a.id WHERE ia.id_issue={$id_issue} ORDER BY ia.id DESC";
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
	echo "<div class=\"feed-element\"><a href=\"#\" class=\"pull-left\"><img alt=\"image\" class=\"img-circle\" src=\"{$activity_profile}\"></a><div class=\"media-body \"><small class=\"pull-right\">{$data["type"]}</small><strong>{$activity_name}</strong> logged <strong>{$data["type"]}</strong> activity. <br><small class=\"text-muted\">{$data["date_create"]}</small><div class=\"well\">{$data["contents"]}</div></div></div>";
}
*/
?>

	