<?php session_start(); ?>
<?php include "base.php";?>
<?php
	$email = "";
	$email = $_SESSION['email'];
	$type = "";
	$check_email = mysql_query("SELECT * FROM User WHERE email = '$email'");
	echo "<a href = \"logout.php\">
		<input type = \"button\" value = \"Logout\"\> 
		</a>";
	echo "<a href = \"editprofile.php\">
		<input type = \"button\" value = \"Edit Profile\"\> 
		</a>";
	while($user = mysql_fetch_array($check_email))
	{	
		echo $user['first_name'];
		echo "</br></br>";
		echo "<img src=".$user["avatar"]."  width = '50' height = '50' />";
	}
	echo "</br></br>";
	$get_products = mysql_query("SELECT * FROM products");
	echo "<button id = checkout onclick= 'checkout()' >Cart</button>";
	echo "<div id = 'products'>"; 
	while($product = mysql_fetch_array($get_products))
	{
		echo "<div>";
		echo "<img src=".$product["image"]."  width = '200' height = '200' />";
		echo "</br>";
		
		if($product['quantity'] < 0)
			$product['quantity'] = 0;
		
		echo "<p>".$product['name']."</p>";
		echo "<p>".$product['quantity']."</p>";
		echo "<p>".$product['price']."</p>";
		if($product['quantity'] > 0)
		{
			echo "<button id ='".$product['name']."' onclick= 'buy(\"".$product['name']."\")' >buy</button>";
		}
		else
			echo "<p>OUT OF STOCK MA3LESH</p>";
		echo "</div>";
	}
	echo "</div>";

?>
<!DOCTYPE html>
<html>
<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.43/jquery.form-validator.min.js"></script>
<link rel="stylesheet" type="text/css" href="register.css" />
<link rel="stylesheet" type="text/css" href="bootstrap.min.css" />
<title>Home</title>
<script type="text/javascript">

function buy(product) {
  if(confirm ("Are you sure ?!"))
  {
	var xhttp = new XMLHttpRequest();
	xhttp.open("GET","buy.php?q=" + product,true);
	xhttp.send();

	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
		 document.getElementById("products").innerHTML = xhttp.responseText;
		}
	}
  }
}

function checkout() {
	window.location.replace("http://localhost/ecommerce/checkout.php");
}
</script>
</head>
<body>
<!-- <img src="image.php?id=1" width="175" height="200" /> -->
</body>
</html>
