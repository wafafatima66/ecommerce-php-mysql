<?php 

// Delete Item Question to Admin, and Delete Product if they choose

// Connect to the MySQL database  
include "../scripts/connect.php"; 

if (isset($_GET['yesdelete'])) {
	// remove item from system and delete its picture
	// delete from database
	$id = $_GET['yesdelete'];
    $sql = "DELETE FROM products WHERE id='$id' LIMIT 1" or die (mysql_error());
    $result = mysqli_query($conn,$sql);
	// unlink the image from server
	// Remove The Pic -------------------------------------------
    $pictodelete = ("../inventory_images/$id.jpg");
    if (file_exists($pictodelete)) {
       		    unlink($pictodelete);
    }
    if($result == true){
        header("location: admin_index.php?itemdeleted"); 
        exit();
    }else {
        header("location: admin_index.php?itemnotdeleted"); 
        exit();
    }
	
}