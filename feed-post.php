<?php
	require_once('includes/class-insert.php');
	require_once('index.php');
	//$logged_user_id = 2;
	
	if ( !empty ( $_POST ) ) {
		$add_status = $insert->add_status($logged_user_id, $_POST);
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Share your taste</title>
		<link rel="stylesheet" href="css/style.css" />
	</head>
	<body>
		<div id="navigation">
			<ul>
				<li><a href="home.php">Home</a></li>
				<li><a href="profile-view.php">My Profile</a></li>
				<li><a href="profile-edit.php">Edit Profile</a></li>
				<li><a href="friends-directory.php">Members</a></li>
				<li><a href="friends-list.php">Following</a></li>
				<li><a href="feed-view.php">Timeline</a></li>
				<li><a href="feed-post.php">Share Status</a></li>
				<li><a href="messages-inbox.php">Inbox</a></li>
				<li><a href="messages-compose.php">Compose</a></li>
				<li><a href="res-directory.php">Find Restaurant</a></li>
				<li><a href="res-list.php">My Restaurants</a></li>
			</ul>
		</div>
		<h1>Share your taste</h1>
		<div class="content">
			<form method="post">
				<input name="status_time" type="hidden" value="<?php echo time() ?>" />
				<p>Where have you been to lately?</p>
				<textarea style="width: 450px; height: 150px" placeholder="you must be having something in your mind..." 
				name="status_content"></textarea>
				<p>
					<input style="color:#ffffff; background-color:#339966; width:150px; height:25px;" 
					type="submit" value="Post" />
				</p>
			</form>
		</div>
	</body>
</html>