<?php
	require_once('includes/class-query.php');
	require_once('index.php');

	if(!isset($_POST['search'])) {
		header("Location:res-directory.php");
	}
	//$search_sql = "SELECT * FROM `s_restaurants` WHERE area LIKE '%".$_POST['search']."%';";
	$search_sql = "SELECT * FROM `s_restaurants` WHERE area LIKE '%".$_POST['search']."%' OR cuisine LIKE '%".$_POST['search']."%'";
	$sql = mysql_query($search_sql);
	if(mysql_num_rows($sql) != 0) {
		$search_rs	= mysql_fetch_array($sql);
	}
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
		<h1>Restaurant(s) near <?php echo $_POST['search']; ?></h1>
		<div class="directory_item">
			<p>Click to see details</p>

			<?php
			if(mysql_num_rows($sql) != 0) {
				do { ?>
					<h3><a href="res-view.php?id=<?php echo $search_rs['id']; ?>"><?php echo $search_rs['res_name']; ?></a></h3>
					<p><?php echo $search_rs['address'].' '.$search_rs['area']; ?></p>
					<?php }while ($search_rs = mysql_fetch_array($sql));
				}else{
					echo "No matches found";
				}
	?>
		</div>
	</body>
</html>