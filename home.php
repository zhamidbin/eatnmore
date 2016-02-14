<?php
	require_once('includes/class-query.php');
	require_once('includes/class-insert.php');
	require_once('load.php');
	require_once('index.php');
	$user = $query->load_user_object($logged_user_id);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Eat&More</title>
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
		<h1 style="text-align: center; color:#006699">Welcome, <?php echo $user->user_name;?></h1>
		<h3 style="text-align: center; color:#666699"">Discover great places to eat around you</h3>
		<div>
			<img src="/img/goli.jpg">
		</div>
		<!-- <div class="square">
		<h3>Profile</h3>
		<ul>
			<li><a href="profile-view.php">View Profile</a></li>
			<li><a href="profile-edit.php">Edit Profile</a></li>
		</ul>
		</div>
		<div class="square">
		<h3>Friends</h3>
			<ul>
			<li><a href="friends-directory.php">Member Directory</a></li>
			<li><a href="friends-list.php">Friends List</a></li>
		</ul>
		</div>
		<div class="square">
		<h3>News Feed</h3>
			<ul>
			<li><a href="feed-view.php">View Feed</a></li>
			<li><a href="feed-post.php">Post Status</a></li>
		</ul>
		</div>
		<div class="square">
		<h3>Messages</h3>
			<ul>
			<li><a href="messages-inbox.php">Inbox</a></li>
			<li><a href="messages-compose.php">Compose</a></li>
		</ul>
		</div> -->
	</body>
</html>