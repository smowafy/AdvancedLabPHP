<?php session_start(); ?>
<?php include "base.php";?>
<?php
	echo "<form action = final_buy.php method = \"post\" id = \"form\">";

	$email = $_SESSION['email'];
	$products_query = mysql_query("SELECT * FROM cart WHERE email = '$email'");
	echo "<div id = 'cart'>";
	$count = 0; 
	$arr = array();
	while($res = mysql_fetch_array($products_query))
	{
		$count = $count + 1;
		$var = $res['product_name'];
		$product_query = mysql_query("SELECT * FROM products WHERE name = '$var'");
		$product = mysql_fetch_array($product_query);
		echo "<div>";
		echo "<img src=".$product["image"]."  width = '200' height = '200' />";
		echo "</br>";
		echo "<p>".$product['name']."</p>";
		echo "<p>".$product['price']."</p>";
		echo "<p> Quantity: </p>";
		$arr[] = $product['name'];
		echo "<select required name =\"".$product['name']."\" id = \"".$product['name']."\">";
		echo "<option value= \"\">None</option>";
		for($i = 1 ; $i <= $product['quantity']; $i++)
		{
			echo "<option value = \"".$i."\">".$i."</option>"; 
		}
		echo "</select>";
		echo "</br>";
		echo "</br>";
		echo "<button onclick= 'remove(\"".$product['name']."\")' >remove from cart</button>";
		echo "</div>";
	}
	
	echo "</br></br></br>";
	echo "<input type = \"submit\" value = \"checkout\" />";
	echo "</div>";
	echo "</form>";
?>
<!DOCTYPE html>
<html>
<head>
<script type="text/javascript">
function remove(product) {

  if(confirm ("Are you sure ?!"))
  {
  	var form = document.getElementById("form");
  	form.removeAttribute("action");
   	var count = "<?php echo $count; ?>";
   	var arr = <?php echo json_encode($arr); ?>;
	var xhttp = new XMLHttpRequest();
	alert(arr.length);
	alert(count);
	for(var i = 0 ; i < count ;i++)
	{
		var X = document.getElementById(arr[i]);
		X.removeAttribute("required");
	}
	alert(product);
	xhttp.open("GET","remove.php?product=" + product ,true);
	xhttp.send();

	xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
		 	document.getElementById("cart").innerHTML = xhttp.responseText;
		}
	}
  }
}
</script>
<title> Cart </title>
</head>
<body>
</body>
</html>	