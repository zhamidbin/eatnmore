<?php
	require_once('load.php');
	$logged = $j->checkLogin();
	
	if ( $logged == false ) {
		//Build our redirect
		$url = "http" . ((!empty($_SERVER['HTTPS'])) ? "s" : "") . "://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
		$redirect = str_replace('index.php', 'login.php', $url);
		
		//Redirect to the home page
		header("Location: $redirect?msg=login");
		exit;
	} else {
		//Grab our authorization cookie array
		$cookie = $_COOKIE['joombologauth'];
		
		//Set our user and authID variables
		$user = $cookie['user'];
		$authID = $cookie['authID'];
		
		//Query the database for the selected user
		$table = 's_users';
		$sql = "SELECT * FROM $table WHERE user_login = '" . $user . "'";
		$results = $jdb->select($sql);

		//Kill the script if the submitted username doesn't exit
		if (!$results) {
			die('Sorry, that username does not exist!');
		}

		//Fetch our results into an associative array
		$results = mysql_fetch_assoc( $results );
		$active =  $results['id'];
		$GLOBALS['logged_user_id'] = $GLOBALS['active']; 
?>
<html>
	<head><!--
		<title>Members Area</title>
		<link rel="stylesheet" href="css/style.css" /> -->
	</head>

	<body>
		<!-- <div id="navigation">
			<ul>
				<li><a href="home.php">Home</a></li>
				<li><a href="profile-view.php">View Profile</a></li>
				<li><a href="profile-edit.php">Edit Profile</a></li>
				<li><a href="friends-directory.php">Member Directory</a></li>
				<li><a href="friends-list.php">Friends List</a></li>
				<li><a href="feed-view.php">View Feed</a></li>
				<li><a href="feed-post.php">Post Status</a></li>
				<li><a href="messages-inbox.php">Inbox</a></li>
				<li><a href="messages-compose.php">Compose</a></li>
			</ul>
		</div>
		<div style="width: 960px; background: #fff; border: 1px solid #e4e4e4; padding: 20px; margin: 10px auto;">
			<h3>Members Area</h3>
			<?php echo 'logged in as'.' '.$results['id']; ?>
			<p><b>User Info</b></p>
			<table>
				<tr>
					<td>Name: </td>
					<td><?php echo $results['user_name']; ?></td>
				</tr>
				
				<tr>
					<td>Username: </td>
					<td><?php echo $results['user_login']; ?></td>
				</tr>
				
				<tr>
					<td>Email: </td>
					<td><?php echo $results['user_email']; ?></td>
				</tr>
				
				<tr>
					<td>Registered: </td>
					<td><?php echo date('l, F jS, Y', $results['user_registered']); ?></td>
				</tr>
			</table>
			-->
			<p style="color: 999999">Logged in as<?php echo ' '.$results['user_login']; ?>
				<a style="text-decoration: none" href="login.php?action=logout">Logout</a></p>
			
			
		</div>
	</body>
</html>
<?php } ?>