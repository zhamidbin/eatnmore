<?php
	require_once('load.php');
	$j->register('login.php');
?>

<html>
	<head>
		<title>Registration Form</title>
		<!--<style type="text/css">
			body { background: #c7c7c7;}
		</style>
		<link rel="stylesheet" href="css/style.css" /> -->
	</head>

	<body>
		<div style="width: 960px; background: #339966; border: 1px solid #e4e4e4; padding: 20px; margin: 10px auto;">
			<p style="text-align: center;font-family: Arial; font-size: 30px;color: #fff">Welcome To <strong>EAT&MORE</strong></p>
		</div>
		<div style="width: 960px; background: #ccff99; padding: 20px; margin: 10px auto;">
			<h3>Register</h3>
			
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<table>
					<tr>
						<td>Name:</td>
						<td><input type="text" name="name" /></td>
					</tr>
					<tr>
						<td>Username:</td>
						<td><input type="text" value="enter username" onclick="value="" onblur="if(this.value==")this.value='enter username';" name="username" /></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><input type="password" name="password" /></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><input type="text" name="email" /></td>
					</tr>
					<input type="hidden" name="date" value="<?php echo time(); ?>" />
					<tr>
						<td></td>
						<td><input style="color:#ffffff; background-color:#339966; width:150px; height:25px;"
							type="submit" value="Register" /></td>
					</tr>
				</table>
			</form>
			<p>Already a member? <a href="login.php">Log in here</a></p>
		</div>
	</body>
</html>