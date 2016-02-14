<?php
	require_once('includes/class-query.php');
	require_once('includes/class-insert.php');
	require_once('load.php');
	require_once('index.php');
	
	if ( !empty ( $_POST ) ) {
		if ( $_POST['type'] == 'add' ) {
			$add_friend = $insert->add_friend($_POST['user_id'], $_POST['friend_id']);
		}
		
		if ( $_POST['type'] == 'remove' ) {
			$remove_friend = $insert->remove_friend($_POST['user_id'], $_POST['friend_id']);
		}
	}

	//$logged_user_id = 3;
	//echo $logged_user_id;
	$mine = false;
	if ( !empty ( $_GET['id'] ) ) {
		$user_id = $_GET['id'];
		$user = $query->load_user_object($user_id);
		
		if ( $logged_user_id == $user_id ) {
			$mine = true;
		}
	} else {
		$user = $query->load_user_object($logged_user_id);
		$mine = true;
	}

	$friends = $query->get_friends($logged_user_id);
?>

<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $user->user_name; ?></title>
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
		<h1>View Profile</h1>
		<div class="content">
			<p>Name: <?php echo $user->user_name; ?></p>
			<p>Email Address: <?php echo $user->user_email; ?></p>
			<p>Registered: <?php echo date('l, F jS, Y', $user->user_registered); ?></p>
			<?php if ( !$mine ) : ?>
				<?php if ( !in_array($user_id, $friends) ) : ?>
					<p>
						<form method="post">
							<input name="user_id" type="hidden" value="<?php echo $logged_user_id; ?>" />
							<input name="friend_id" type="hidden" value="<?php echo $user_id; ?>" />
							<input name="type" type="hidden" value="add" />
							<input style="color:#ffffff; background-color:#339966; width:150px; height:25px;"
							type="submit" value="Follow" />
						</form>
					</p>
				<?php else : ?>
					<p>
						<form method="post">
							<input name="user_id" type="hidden" value="<?php echo $logged_user_id; ?>" />
							<input name="friend_id" type="hidden" value="<?php echo $user_id; ?>" />
							<input name="type" type="hidden" value="remove" />
							<input style="color:#ffffff; background-color:#339966; width:150px; height:25px;"
							type="submit" value="Unfollow" />
						</form>
					</p>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	</body>
</html>