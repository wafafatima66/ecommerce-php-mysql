<?php 
session_start();
if (!isset($_SESSION["username"])) {
    header("location: admin_login.php"); 
    exit();
}
// Be sure to check that this manager SESSION value is in fact in the database
$managerID = preg_replace('#[^0-9]#i', '', $_SESSION["id"]); // filter everything but numbers and letters
$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["username"]); // filter everything but numbers and letters
$password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["password"]); // filter everything but numbers and letters
// Run mySQL query to be sure that this person is an admin and that their password session var equals the database information
// Connect to the MySQL database  
include "../scripts/connect.php";  
?>

<?php
if (isset($_POST['product_name'])) {
	$pid = mysqli_real_escape_string($conn,$_POST['thisID']);
    $product_name = mysqli_real_escape_string($conn ,$_POST["product_name"]);
	$price = mysqli_real_escape_string($conn ,$_POST["price"]);
	$category = mysqli_real_escape_string($conn ,$_POST["category"]);
	$subcategory = mysqli_real_escape_string($conn ,$_POST["subcategory"]);
    $details = mysqli_real_escape_string($conn ,$_POST["details"]);
    
	// See if that product name is an identical match to another product in the system
    $sql = "UPDATE products SET product_name='$product_name', price='$price', details='$details', category='$category', subcategory='$subcategory' WHERE id='$pid'" ;

    $result=mysqli_query($conn,$sql);

	if ($_FILES['fileField']['tmp_name'] != "") {
	    // Place image in the folder 
	    $newname = "$pid.jpg";
	    move_uploaded_file($_FILES['fileField']['tmp_name'], "../inventory_images/$newname");
	} if($result==true){
        header("location: admin_index.php?updated"); 
            exit();
    }else{
        header("location: admin_index.php?notupdated"); 
            exit();
    }
	
}
?>


<?php
// Gather this product's full information for inserting automatically into the edit form below on page
if (isset($_GET["pid"])) {
    
	$targetID = $_GET["pid"];
    $sql = "SELECT * FROM products WHERE id='$targetID' LIMIT 1";
    $result=mysqli_query($conn,$sql);
    $productCount = mysqli_num_rows($result); // count the output amount
    if ($productCount > 0) {
	    while($row = mysqli_fetch_array($result)){ 
             
			 $product_name = $row["product_name"];
			 $price = $row["price"];
			 $category = $row["category"];
			 $subcategory = $row["subcategory"];
			 $details = $row["details"];
			
        }
    } else {
	    echo "Sorry dude that crap dont exist.";
		exit();
    }

}
// Parse the form data and edit inventory item to the system

require "header_admin.php";
//adding header section 


?>
<form action="edit_inventory.php" enctype="multipart/form-data" name="myForm" id="myform" method="POST">
<h3 class="m-5">Edit Inventory</h3>
    <table width="90%" border="0" cellspacing="0" cellpadding="6">

      <tr>
        <td width="20%" align="right">Product Name</td>
        <td width="80%"><label>
          <input name="product_name" type="text" id="product_name" size="64" value="<?php echo $product_name; ?>" />
        </label></td>
      </tr>

      <tr>
        <td align="right">Product Price</td>
        <td><label>
          $
          <input name="price" type="text" id="price" size="12" value="<?php echo $price; ?>" />
        </label></td>
      </tr>

      <tr>
        <td align="right">Category</td>
        <td><label>
          <select name="category" id="category">
          <option value="Clothing">Clothing</option>
          </select>
        </label></td>
      </tr>

      <tr>
        <td align="right">Subcategory</td>
        <td><select name="subcategory" id="subcategory">
          <option value="<?php echo $subcategory; ?>"><?php echo $subcategory; ?></option>
          <option value="Hats">Hats</option>
          <option value="Pants">Pants</option>
          <option value="Shirts">Shirts</option>
          </select></td>
      </tr>

      <tr>
        <td align="right">Product Details</td>
        <td><label>
          <textarea name="details" id="details" cols="64" rows="5"><?php echo $details; ?></textarea>
        </label></td>
      </tr>

      <tr>
        <td align="right">Product Image</td>
        <td><label>
          <input type="file" name="fileField" id="fileField" />
        </label></td>
      </tr>   

      <tr>
        <td>&nbsp;</td>
        <td><label>
          <input name="thisID" type="hidden" value="<?php echo $targetID; ?>" />
          <input type="submit" name="editbutton" id="button" value="Make Changes" />
        </label></td>
      </tr>

    </table>
    </form>
    </body>
</html>