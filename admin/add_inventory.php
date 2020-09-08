
<?php 

// Connect to the MySQL database  
include "../scripts/connect.php"; 

// Parse the form data and add inventory item to the system
if (isset($_POST['product_name'])) {
	
    $product_name = mysqli_real_escape_string($conn , $_POST['product_name']);
	$price = mysqli_real_escape_string($conn , $_POST['price']);
	$category = mysqli_real_escape_string($conn , $_POST['category']);
	$subcategory = mysqli_real_escape_string($conn , $_POST['subcategory']);
    $details = mysqli_real_escape_string($conn , $_POST['details']);
    
	// See if that product name is an identical match to another product in the system
    $sql = "SELECT id FROM products WHERE product_name='$product_name' LIMIT 1";
    $result = mysqli_query($conn , $sql);
	$productMatch = mysqli_num_rows($result); // count the output amount
    if ($productMatch > 0) {
		echo 'Sorry you tried to place a duplicate "Product Name" into the system, <a href="inventory_list.php">click here</a>';
		exit();
    }
    
	// Add this product into the database now
	$sql = "INSERT INTO products (product_name, price, details, category, subcategory, date_added) 
        VALUES('$product_name','$price','$details','$category','$subcategory',now())" or die (mysqli_error());
        $result = mysqli_query($conn , $sql);
     $pid = mysqli_insert_id($conn);
	// Place image in the folder 
	$newname = "$pid.jpg";
    move_uploaded_file( $_FILES['fileField']['tmp_name'], "../inventory_images/$newname");
    if($result==true){
        header("location: admin_index.php?success=newproductadded"); 
    exit();
    }else echo "not added";
	
}
?>
