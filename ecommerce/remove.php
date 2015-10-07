<?php session_start(); ?>
<?php include "base.php";?>
<?php
	$product_name = $_GET['product'];
	$email = $_SESSION['email'];
	$delete_query = mysql_query("DELETE FROM cart WHERE email = '$email' AND product_name = '$product_name'");
	$products_query = mysql_query("SELECT * FROM cart WHERE email = '$email'");
	$count = 0;
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
		echo "<button id onclick= 'remove(\"".$product['name']."\")' >remove from cart</button>";
		echo "</div>";
	}
	echo "</br></br></br>";
	echo "<input type = \"submit\" value = \"checkout\" />";
?>
<!DOCTYPE html>
<html>
<head>
<script type="text/javascript">
function remove(product) {

  if(confirm ("Are you sure ?!"))
  {
  
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
</head>
<body>
</body>
</html>	