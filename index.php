
<?php

// Connect to the MySQL database  
include "scripts/connect.php"; 

require "header.php"; //showing head section

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
             $details = $row["details"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
             $product_list .=
             
'<!--single product showing in main page -->

            <article class="product">
                <div class="img-container text-center">
                    <img src="inventory_images/' . $id . '.jpg" alt="" class="product-img">
                    <button class="btn btn-green" > <i class="fas fa-shopping-cart"></i> </button>
                    <button type="button" class="btn" data-toggle="modal" data-target=#product' . $id . '> <i class="fas fa-eye"></i> </button>
                </div>
                    <h3>' . $product_name . '</h3>
                    <h4>Bdt' . $price . '</h4>
            </article> 

<!--end of showing single product in main page-->

<!--Showing product in modal/popover on clicking eye button-->

        <div id="product' . $id . '" class="modal fade" >
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" >' . $product_name . '</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    <img src="inventory_images/' . $id . '.jpg" alt="" class="product-img">
                                </div>
                                <div class="col-6">
                                    <p>' . $details . '</p>
                                    <h4>Price : Bdt' . $price . '</h4>
                                    <h4>Date : ' . $date_added . '</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-green">Add to Cart</button>
                    </div>

                </div>
            </div>
        </div> ';

    }
} else {
	$product_list = "You have no products listed in your store yet";
}


?>
<!--showing the product in main page -->
    <section class="products">
        <div class="section-title">
            <h2>Our product</h2>
        </div>
        <div class="products-center">
         <?php echo $product_list;?>
        </div>    
    </section>

 








