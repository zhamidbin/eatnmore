<?php
	require_once('includes/class-insert.php');
	require_once('includes/class-query.php');
	require_once('index.php');
	//$logged_user_id = 2;
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Inbox</title>
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
		<h1>Inbox</h1>
		<div class="content">
			<?php $query->do_inbox($logged_user_id); ?>
		</div>
	</body>
</html>