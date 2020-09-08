

<?php 
// This block grabs the whole list for viewing
$product_list = "";
$sql = "SELECT * FROM products ORDER BY id DESC";
$result = mysqli_query($conn,$sql);
$productCount = mysqli_num_rows($result); // count the output amount
if ($productCount > 0) {
	while($row = mysqli_fetch_array($result)){ 
             $id = $row["id"];
			 $product_name = $row["product_name"];
			 $price = $row["price"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
             $product_list .= "
             <tbody>
                    <tr>
                     <td>$id</td>
                     <td>$product_name</td>
                     <td>$price</td>
                     <td>$date_added</td>
                    <td><a class='btn btn-default' href='inventory_edit.php?pid=$id'>EDIT</a>  <a  class='btn btn-default' href='inventory_list.php?deleteid=$id'>DELETE</a></td>
                    </tr>
             </tbody>";
    }
} else {
	$product_list = "You have no products listed in your store yet";
}
?>
