<?php include "base.php";?>
<?php session_start(); ?>

<?php
	echo "<a href = \"home.php\">
		<input type = \"button\" value = \"Home\"\> 
		</a>";
	$var = $_SESSION['email'];
	function GetImageExtension($imagetype)
     {
       if(empty($imagetype)) return false;
       switch($imagetype)
       {
           case 'image/bmp': return '.bmp';
           case 'image/gif': return '.gif';
           case 'image/jpeg': return '.jpg';
           case 'image/png': return '.png';
           default: return false;
       }
     }

	$file = "";
	$image = "";
	if(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password_confirmation']) && isset($_POST['password']))
	{
		$email = $_POST['email'];
		$check_email = mysql_query("SELECT * FROM User WHERE email = '$email' AND  !(email = '$var')");
		
		if(mysql_num_rows($check_email) >= 1)
		{
			   echo "
			      <script type='text/javascript'>
			      alert('The email address $email already exists');
			      </script>
			    ";
		}else
		{

        	echo $image;	
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$password = md5($_POST['password']);
			if(!empty($_FILES['avatar']['name']))
			{
				$tmp_name = $_FILES['avatar']['tmp_name'];
				$imgtype = $_FILES['avatar']['type'];
				$ext = GetImageExtension($imgtype);			
				$imagename=$email.$ext;
				$final_path = "user_photos/".$imagename;
				if (move_uploaded_file($tmp_name, $final_path)) {
					$registerquery = mysql_query("UPDATE User SET first_name = '$first_name',last_name = '$last_name', email = '$email',password = '$password', avatar = '$final_path'
						WHERE email = '$var'");
						header ('location:http://localhost/ecommerce/home.php');		
						$_SESSION['email'] = $email;
				}
	        }
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
<title>Edit profile</title>
</head>
<body>
	<form action = "editprofile.php" method = "post" enctype = "multipart/form-data" id = "form">
		<p>First name</p>
		<input type = "text" name = "first_name" id = "first_name" data-validation = "length" data-validation-length = "min4" />
		<p>Last name</p>
		<input type = "text" name = "last_name" id = "last_name" data-validation = "length" data-validation-length = "min4" />
		<p>Email</p>
		<input type = "text" name = "email" id = "email" data-validation="email"/>
		<p>Password</p>
		<input type = "password" name = "password_confirmation" id = "password_confirmation" />
		<p>Confirm</p>
		<input type = "password" name = "password" id = "password" data-validation = "confirmation" data-validation-confirm = "password_confirmation" />
		<p>Upload avatar</p>
		<input name = "avatar" required type = "file" id = "avatar" />
		<input type = "submit" value = "Update" id = "submit"/>
	</form>
	<script>
  		$.validate({
    		modules : 'security',
    		onModulesLoaded : function() {

    		}
  		});
	</script>
</body>
</html>
