<?php
	require_once('load.php');
	if ( $_GET['action'] == 'logout' ) {
		$loggedout = $j->logout();
	}
	
	$logged = $j->login('home.php');
?>
<html>
	<head>
		<title>Login Form</title>
		<!--<style type="text/css">
			body { background: #c7c7c7;}
		</style> -->
	</head>

	<body>		
		<div style="width: 960px; background: #339966; border: 1px solid #e4e4e4; padding: 20px; margin: 10px auto;">
			<p style="text-align: center;font-family: Arial; font-size: 30px;color: #fff">Welcome To <strong>EAT&MORE</strong></p>
		</div>
		<div style="width: 960px; background: #ccff99; padding: 20px; margin: 10px auto;">
			<?php if ( $logged == 'invalid' ) : ?>
				<p style="background: #e49a9a; border: 1px solid #c05555; padding: 7px 10px;">
					The username password combination you entered is incorrect. Please try again.
				</p>
			<?php endif; ?>
			<?php if ( $_GET['reg'] == 'true' ) : ?>
				<p style="background: #fef1b5; border: 1px solid #eedc82; padding: 7px 10px;">
					Your registration was successful, please login below.
				</p>
			<?php endif; ?>
			<?php if ( $_GET['action'] == 'logout' ) : ?>
				<?php if ( $loggedout == true ) : ?>
					<p style="background: #fef1b5; border: 1px solid #eedc82; padding: 7px 10px;">
						You have been successfully logged out.
					</p>
				<?php else: ?>
					<p style="background: #e49a9a; border: 1px solid #c05555; padding: 7px 10px;">
						There was a problem logging you out.
					</p>
				<?php endif; ?>
			<?php endif; ?>
			<!-- <?php if ( $_GET['msg'] == 'login' ) : ?>
				<p style="background: #e49a9a; border: 1px solid #c05555; padding: 7px 10px;">
						You must log in to view this content. Please log in below.
					</p>
			<?php endif; ?> -->
		
			<h3>Login</h3>
			
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<table>
					<tr>
						<td>Username:</td>
						<td><input type="text" value="enter username" onclick="value="" onblur="if(this.value==")this.value='enter username';" name="username" /></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><input type="password" name="password" /></td>
					</tr>
					<tr>
						<td></td>
						<td><input style="color:#ffffff; background-color:#339966; width:150px; height:25px;"
							type="submit" value="Log in" /></td>
					</tr>
				</table>
			</form>
			<p>Not a member? <a href="register.php">Register here</a></p>
		</div>
	</body>
</html>

