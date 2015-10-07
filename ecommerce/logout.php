<?php session_start(); ?>
<?php include "base.php";?>
<?php
	session_destroy();
	header ('location:http://localhost/ecommerce/login.php');		
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
</body>
</html>	