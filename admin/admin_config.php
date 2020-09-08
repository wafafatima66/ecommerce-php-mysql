
<?php 

session_start();
if (!isset($_SESSION["username"])) {
    header("location: admin_login.php"); 
    exit();
}
// Be sure to check that this username SESSION value is in fact in the database

$usernameID = preg_replace('#[^0-9]#i', '', $_SESSION["id"]); // filter everything but numbers and letters
$username = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["username"]); // filter everything but numbers and letters
$password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["password"]); // filter everything but numbers and letters

// Run mySQL query to be sure that this person is an admin and that their password session var equals the database information
// Connect to the MySQL database  

include "../scripts/connect.php"; 

$sql = "SELECT * FROM admin WHERE id='$usernameID' AND username='$username' AND password='$password' LIMIT 1"; // query the person

$result = mysqli_query($conn,$sql);

// ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
$existCount = mysqli_num_rows($result); // count the row nums
if ($existCount == 0) { // evaluate the count
	 echo "Your login session data is not on record in the database.";
     exit();
}
?>