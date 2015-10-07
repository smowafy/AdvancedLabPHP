<?php session_start(); ?>
<?php include "base.php";?>

<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
	$product_name = $_GET['q'];
	$email = $_SESSION['email'];
	$incart_query = mysql_query("SELECT * FROM cart WHERE product_name = '$product_name' AND email = '$email'");
	if(mysql_num_rows($incart_query) == 0)
	{			
		$addcart_query = mysql_query("INSERT INTO cart (product_name,email) VALUES ('$product_name','$email')");
	}
	$get_products = mysql_query("SELECT * FROM products");
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
?>
</body>
</html>