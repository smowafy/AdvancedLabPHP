<?php include "base.php";?>
<?php session_start(); ?>
<?php
	$email = $_SESSION['email'];
	echo $email;
	echo "</br>"
	$check_email = mysql_query("SELECT avatar FROM User WHERE email = '$email'");
  	$result = mysql_query("'$check_email'");
  	$row = mysql_fetch_assoc($result);
  	header("Content-type: image/jpeg");
  	echo $row['avatar'];
?>