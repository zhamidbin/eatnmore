<?php	
	require_once('includes/class-query.php');
	require_once('includes/class-insert.php');
	require_once('index.php');
	
	//$logged_user_id = 1;
	
	if ( !empty ( $_POST ) ) {
		$update = $insert->update_user($logged_user_id, $_POST);
	}
	
	$user = $query->load_user_object($logged_user_id);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Edit Profile</title>
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
		<h1>Edit Profile</h1>
		<div class="content">
			<form method="post">
				<p>
					<label class="labels" for="name">Full Name:</label>
					<input name="user_name" type="text" value="<?php echo $user->user_name; ?>" />
				</p>
				<p>
					<label class="labels" for="email">Email Address:</label>
					<input name="user_email" type="text" value="<?php echo $user->user_email; ?>" />
				</p>
				<p>
					<label class="labels" for="password">Password:</label>
					<input name="user_pass" type="password" value="<?php echo $user->user_pass; ?>" />
				</p>
				<p>
					<input style="color:#ffffff; background-color:#339966; width:150px; height:25px;"
					type="submit" value="update" />
				</p>
			</form>
		</div>
	</body>
</html>