<?php
	require_once('includes/class-query.php');
	require_once('index.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Restaurant Directory</title>
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
		<h1>Find your taste</h1>
		<div class="content">
			<p>Search for restaurants nearby</p>
			<form name="form1" method="post" action="searchresults.php">
				<input placeholder="search by area or cuisine..." name="search" type="text" />
				<input style="color:#ffffff; background-color:#339966; width:150px; height:25px;"
				type="submit" name="Submit" value="Search" />
			</form>
			<?php $query->do_res_directory(); ?>
		</div>
	</body>
</html>