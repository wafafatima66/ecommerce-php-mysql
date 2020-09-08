<?php

require "connect.php" ; //connect to database

//command to create table 
$sqlCommand = "CREATE TABLE admin(
    id int (11) NOT NULL auto_increment,
    username varchar(255) NOT NULL ,
    password varchar(255) NOT NULL ,
    last_log_date date NOT NULL , 
    PRIMARY KEY (id),
    UNIQUE KEY username (username)
)" ;

//command to run query 

if (mysqli_query($conn, $sqlCommand)) {
    echo "Table MyGuests created successfully";
  } else {
    echo "Error creating table: " . mysqli_error($conn);
  }
  
  mysqli_close($conn);
?>