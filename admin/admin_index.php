
<?php require "admin_config.php";
//adding configuration to check whether user exist 
?>


<?php require "delete_inventory.php";
//adding product
?>

<?php require "add_inventory.php";
//adding product
?>


<?php require "inventory_list.php";
//showing list of products
?>

<?php require "header_admin.php";
//adding header section 
?>

<?php
//message showing when product added
if(isset($_GET['success'])){
    if($_GET['success']=="newproductadded"){
        echo'<p class="alert alert-success h6">Product Added</p>';
    }
}

//alert to show when whether to delete item or not
if (isset($_GET['deleteid'])) {
	echo '<p class="alert alert-danger">Do you really want to delete product with ID of ' . $_GET['deleteid'] .'? <a href="delete_inventory.php?yesdelete=' . $_GET['deleteid'] . '">Yes</a> | <a href="admin_index.php">No</a></p>';
	exit();
}

//alert to show when item is deleted
if (isset($_GET['itemdeleted'])) {
    echo '<p class="alert alert-success">Item Deleted</p>';
    exit();  
}

//alert to show when item is not deleted
if (isset($_GET['itemnotdeleted'])) {
    echo '<p class="alert alert-success">Item not Deleted</p>';
    exit();  
}

if (isset($_GET['updated'])) {
    echo '<p class="alert alert-success">Item Updated</p>';
    exit();  
}

if (isset($_GET['notupdated'])) {
    echo '<p class="alert alert-success">Item not updated</p>';
    exit();  
}
?>
       
    <div class="container">
        <a name="inventoryTop" id="inventoryTop"></a> <!--anchor to specify scroll up-->
        <div align="right" style="margin:32px;"><a href="admin_index.php#inventoryForm">+ Add New Inventory Item</a></div> <!--button to scroll down to add inventory-->

        <hr />

        <!--inventory list section-->
            <h1 class="text-center" >Welcome Admin</h1>
            <hr />
               <div align="left" style="margin-left:24px;">
                  <h3 class="m-5" >Inventory list</h3>
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Date Added</th>
                                <th scope="col">Modify</th>
                            </tr>
                        </thead>       
                             <?php echo $product_list; ?>
                     </table>
                 </div>
         <!--inventory add section-->
          <a name="inventoryForm" id="inventoryForm"></a> <!--anchor to specify scroll down-->

        <form action="add_inventory.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">  
            <h3 class="m-5">Add New Inventory Item Form</h3>
            <table width="90%" border="0" cellspacing="0" cellpadding="6">
                <tr>
                    <td width="40%" align="right">Product Name</td>
                    <td width="60%"><label>
                    <input name="product_name" type="text" id="product_name" size="50"  />
                    </label></td>
                </tr>

                <tr>
                    <td align="right">Product Price</td>
                    <td><label>
                    $
                    <input name="price" type="text" id="price" size="12" />
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
                    <option value=""></option>
                    <option value="Hats">Hats</option>
                    <option value="Pants">Pants</option>
                    <option value="Shirts">Shirts</option>
                    </select></td>
                </tr>

                <tr>
                    <td align="right">Product Details</td>
                    <td><label>
                    <textarea name="details" id="details" cols="64" rows="5"></textarea>
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
                    <input type="submit" name="button" id="button" value="Add This Item Now" />
                    </label></td>
                </tr>  
            </table>
        </form>
            <div align="right" style="margin:32px;"><a href="admin_index.php#inventoryTop">Back to top</a></div> <!--button to scroll up to add top-->
     </div>
</body>
</html>