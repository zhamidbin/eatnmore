<?php
$dbcon = mysqli_connect("localhost", "social_hamid", 
	"deadbeat", "social");
//Evaluate the connection
if(mysqli_connect_errno()) {
	echo mysqli_connect_error;
	exit();
}
?>