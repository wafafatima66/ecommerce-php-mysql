<?php 
session_start();

// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Connect to the MySQL database  
include "scripts/connect.php"; 

$status="";


if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete") //to remove a item 
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["id"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				$status = "<div class='box' style='color:red;'>
					Product is removed from your cart!</div>";
			}
		}
	}
}
if (isset($_POST['action']) && $_POST['action']=="change") //to change the quantity of a item
	{
		foreach($_SESSION["shopping_cart"] as &$value)
		{
			if($value["id"] === $_POST["id"])
			{
				$value["quantity"] == $_POST["quantity"];
			
			}
		}
	}

if (isset($_GET['cmd']) && $_GET['cmd'] == "emptycart") {
	unset($_SESSION["shopping_cart"]);
	header("location:index.php");
}

include "header.php"; //showing head section

?>
<!--showing the cart-->
<div class="container">
<h3>Order Details</h3>
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr>
						<th width="40%">Item Name</th>
						<th width="10%">Quantity</th>
						<th width="20%">Price</th>
						<th width="15%">Total</th>
						<th width="5%">Action</th>
					</tr>
					<?php
					if(isset($_SESSION["shopping_cart"]))
				
					{
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $product)
						{
					?>
				
					<tr>
						<td><?php echo $product["product_name"]; ?></td>
						<td>
							<form method='post' action=" " >
								<input type='hidden' name='id' value="<?php echo $product["id"]; ?>" />
								<input type='hidden' name='action' value="change" />
								<select name='quantity' class='quantity' onchange="this.form.submit()">
									<option <?php if($product["quantity"]==1) echo "selected";?> value="1">1</option>
									<option <?php if($product["quantity"]==2) echo "selected";?> value="2">2</option>
									<option <?php if($product["quantity"]==3) echo "selected";?> value="3">3</option>
									<option <?php if($product["quantity"]==4) echo "selected";?> value="4">4</option>
									<option <?php if($product["quantity"]==5) echo "selected";?> value="5">5</option>
								</select>
							</form>
						</td>
						<td>$ <?php echo $product["price"]; ?></td>
						<td>$ <?php echo number_format($product["quantity"] * $product["price"], 2);?></td>
						<td><a href="cart.php?action=delete&id=<?php echo $product["id"]; ?>"><span class="text-danger">Remove</span></a></td>
					</tr>
					

					<?php $total = $total + ($product["quantity"] * $product["price"]);
							
                        }
                        
					?>

					<tr>
						<td colspan="3" align="right">Total</td>
						<td align="right">$ <?php echo number_format($total, 2); ?></td>
						<td></td>
					</tr>
	
				</table>	
		</div>
		<?php
				} else{
					$status = "Your cart is empty!";
					}
				
				?>
</div>

			<div class="message_box h3 text-center" style="margin:10px 0px;">
				<?php echo $status; ?>
			</div>

<?php
	if(!empty($_SESSION["shopping_cart"])){
		?>
		<a href="cart.php?cmd=emptycart" class="btn btn-green">Click Here to Empty Your Shopping Cart</a>
		<?php
	}
?>



