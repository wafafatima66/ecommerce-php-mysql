<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amex Bazaar </title>
    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
   <!-- style link -->
   <link rel="stylesheet" href="css/style.css">
   
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
   
      

</head>
<body>
    <!-- navbar -->
    <nav class="navbar">
        <div class="navbar-center">
            <span class="nav-icon">
                <i class="fas fa-bars"></i>
            </span>

            <span class="nav-icon">
               <a href="admin/admin_login.php"> <i class="fas fa-user"></i></a>
            </span>
            
           <!--<img src="./images/logo.png" alt="" class="navbar-logo">--> 
           <?php
           
                if(!empty($_SESSION["shopping_cart"])) {
                $cart_count = count(array_keys($_SESSION["shopping_cart"]));
            ?>

                    <div class="cart-btn" onclick="showcart()">
                         <span class="nav-icon"> <i class="fas fa-cart-plus"></i></span>
                        <div class="cart-items"><?php echo $cart_count; ?></div>
                    </div>

            <?php }else {
                ?>
                    <div class="cart-btn">
                        <span class="nav-icon"> <i class="fas fa-cart-plus"></i> </span>
                        <div class="cart-items">0</div>
                    </div>
                <?php } ?>
        </div>
    </nav>

