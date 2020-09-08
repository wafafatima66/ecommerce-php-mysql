<?php

require "connect.php" ; //connect to database

//command to create table 
$sqlCommand = "CREATE TABLE products (
    id int(11) NOT NULL auto_increment,
    product_name varchar(255) NOT NULL,
    price varchar(16) NOT NULL,
    details text NOT NULL,
    category varchar(16) NOT NULL,
    subcategory varchar(16) NOT NULL,
    date_added date NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY product_name (product_name)
    ) ";

//command to run query 

if (mysqli_query($conn, $sqlCommand)) {
    echo "Table MyGuests created successfully";
  } else {
    echo "Error creating table: " . mysqli_error($conn);
  }
  
  mysqli_close($conn);
?>