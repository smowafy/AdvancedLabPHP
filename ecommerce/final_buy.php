<?php session_start(); ?>
<?php include "base.php";?>


<?php
	$email = $_SESSION['email'];
	$query = mysql_query("SELECT * FROM products");
	while($res = mysql_fetch_array($query))
	{
		$res['name'] = str_replace(" ", "_", $res['name']);
		if(!empty($_POST[$res['name']]))
		{
			$quantity_to_buy = $_POST[$res['name']];
			$quantity = $res['quantity'];
			$quantity = $quantity - $quantity_to_buy;
			$res['name'] = str_replace("_", " ", $res['name']);
			$var = $res['name'];
			$update_query = mysql_query("UPDATE products SET quantity = '$quantity' WHERE name = '$var'");
		}
	}
	$delete_query = mysql_query("DELETE FROM cart WHERE email = '$email'");
	$_POST = array();
	header ('location:http://localhost/ecommerce/home.php');		

?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
</body>
</html>