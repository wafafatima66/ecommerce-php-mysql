
<?php
session_start();
  
include "scripts/connect.php"; // Connect to the MySQL database

?>

<?php
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
                    $status="Product is removed";
                    header("location:index.php");
                }
            }
        }
    }

    if (isset($_GET['cmd']) && $_GET['cmd'] == "emptycart") {
        unset($_SESSION["shopping_cart"]);
        $status="Cart is empty";
        header("location:index.php");
    }
    
    ?>


<?php


//This block make the shopping cart

if (isset($_POST['id']) && $_POST['id']!=" ")
{
        $id = $_POST['id'];
        
        $result = mysqli_query($conn,"SELECT * FROM products WHERE id ='$id' LIMIT 1");
        $row = mysqli_fetch_assoc($result);
        $product_name = $row['product_name'];
        $id = $row['id'];
        $price = $row['price'];
      
            $cartArray = array(
                $id=>array(
                'product_name'=>$product_name,
                'id'=>$id,
                'price'=>$price,
                'quantity' =>$quantity
               )
            );

        if(!empty($_SESSION["shopping_cart"]))
        
            {
                $array_keys = array_keys($_SESSION["shopping_cart"]);
                if(in_array($id ,$array_keys)) 
                {
                    $status = "Product is already added to your cart!";	
                } else {
                    $_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
                    $status = "Product is added to your cart!";
                }

	        }
           
        else{
            $_SESSION["shopping_cart"] = $cartArray;
            $status = "Product is added to your cart!";
        }
}

?>

<?php
include "header.php"; //showing head section
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
                    <img src="inventory_images/' . $id . '.jpg" alt="" class="product-img image">

                 <form  method="post" action="">
                    <input type="hidden" name="id" id="id" value="' . $id . '" />
                    <input type="hidden" name="product_name" value="' . $product_name . '" />
                    <input type="hidden" name="price" value="' . $price . '" />
                    <button type="submit" class="btn btn-green"  > <i class="fas fa-shopping-cart"></i> </button>
                  </form>

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

mysqli_close($conn);
?>

            <!--hero -->
            <header class="hero">
                    <div class="banner">
                        <h1 class="banner-title">AMEX bazaar</h1>
                        <button class="banner-btn">Shop Now</button>
                    </div>
                </header>
            <!--end of hero -->

            <?php
                if($status!=""){
                    ?>
                        <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $status ?>
                        </div>
            <?php
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

    <!-- end showing the product in main page -->

   

            <!--cart -->
          
        <div class="cart-overlay">
            <div class="cart">
                <span class="close-cart" onclick="hidecart()">
                    <i class="fas fa-window-close"></i>
                </span>
                <h2>your cart</h2>
              
                <?php
                            if(isset($_SESSION["shopping_cart"]))
                                {
                                    $total = 0;
                                    foreach($_SESSION["shopping_cart"] as $product)
                                    {
                        ?>
              
                    
                            <!--cart item-->
                                <div class="cart-item">
                                <img src="inventory_images/<?php echo $product["id"]; ?>.jpg" alt="" class="">
                                    <div >
                                       
                                        <h4><?php echo $product["product_name"]; ?></h4>
                                        <h5>$ <?php echo $product["price"]; ?></h5>
                                        <span class="remove-item" ><a href="index.php?action=delete&id=<?php echo $product["id"]; ?>">Remove</a></span>
                                    </div>
                                    <div>    
                                        <i class="fas fa-chevron-up" > </i>  
                                        <p class="item-amount"> <?php echo $product["quantity"] ?></p>
                                        <i class="fas fa-chevron-down" ></i>
                                    </div>
                                </div> 
                            <!--end of cart item -->
                    

                        <?php 
                            
                            $total = $total + ($product["quantity"] * $product["price"]);
                                }
					    ?>

                       

                        <div class="cart-footer">
                            <h3>your total :  <span class="cart-total">$ <?php echo number_format($total, 2); ?></span></h3>
                            <button class="clear-cart banner-btn">	<a href="index.php?cmd=emptycart">Clear Cart</a></button>
                        </div>

                        <?php
                        } else{
                            $status = "Your cart is empty!";
                            }
                            ?>
                    </div>
                </div>

              <!--end of cart -->
 <?php

include "footer.php";

?>


