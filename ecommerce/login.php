<?php session_start(); ?>
<?php include "base.php";?>
<?php
		$file = "";
		$image = "";
		if(isset($_POST['email'])&& isset($_POST['password']))
		{
			$email = $_POST['email'];
			$password = md5($_POST['password']);
			
			$_SESSION['email'] = $email;
			$check_email = mysql_query("SELECT * FROM User WHERE email = '$email' 
				AND password = '$password'");
			if(mysql_num_rows(($check_email)) == 0)
			{
				 echo "
				      <script type='text/javascript'>
				      alert('please insert a correct email/password');
				      </script>
				    ";
			}else
			{
				header ('location:http://localhost/ecommerce/home.php');		
			}					
			$_POST = array();
			$_GET = array();
			$_FILES = array();
		}
?>
<!DOCTYPE html>
<html>
<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.43/jquery.form-validator.min.js"></script>
<link rel="stylesheet" type="text/css" href="register.css" />
<link rel="stylesheet" type="text/css" href="bootstrap.min.css" />
<title>Login</title>
</head>
<body>
	<form action = "login.php" method = "post" id = "form">
		<p>Email</p>
		<input type = "text" name = "email" id = "email" data-validation="email"/>
		<p>Password</p>
		<input type = "password" name = "password" id = "password" />
		<input type = "submit" value = "Login" id = "submit" />
	</form>
</body>
</html>
	