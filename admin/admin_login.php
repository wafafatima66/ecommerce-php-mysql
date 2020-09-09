<?php
if(isset($_GET['error'])){
    if($_GET['error']=="wrongpasswordorwronguser"){
        echo'<p class="alert alert-danger h6">Wrong password or username</p>';
    }
    if($_GET['error']=="nouser"){
        echo'<p class="alert alert-danger h6">No such User</p>';
    }
}

?>

<?php 
// going to index admin page on getting username name 
session_start();
if (isset($_SESSION["username"])) {
    header("location: admin_index.php"); 
    exit();
}
?>

<?php 
// Parse the log in form if the user has filled it out and pressed "Log In"
if (isset($_POST["username"]) && isset($_POST["password"])) {

	$username = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["username"]); // filter everything but numbers and letters
    $password = preg_replace('#[^A-Za-z0-9]#i', '', $_POST["password"]); // filter everything but numbers and letters
    // Connect to the MySQL database  

    include "../scripts/connect.php"; 
  
    $sql = "SELECT id FROM admin WHERE username='$username' AND password='$password' LIMIT 1"; // query the person
    $result = mysqli_query($conn , $sql);
    // ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
    $existCount = mysqli_num_rows($result); // count the row nums
    if ($existCount == 1) { // evaluate the count
	     while($row = mysqli_fetch_array($result)){ 
             $id = $row["id"];
		 }
		 $_SESSION["id"] = $id;
		 $_SESSION["username"] = $username;
		 $_SESSION["password"] = $password;
		 header("location: admin_index.php");
         exit();
    } else {
        header("Location:../admin_login.php?error=wrongpasswordorwronguser");
        exit();
	}
}
?>


<?php
//adding header section 
require "header_admin.php";
?>


<body>
    <div class="container mt-5 pt-5" style="width:500px">
        <!-- Default form login -->
            <form class="text-center border border-light p-5" method="post" action="admin_login.php">

            <p class="h4 mb-4">Sign in</p>

            <!-- Email -->
            <input type="text" id="username" class="form-control mb-4" placeholder="Username" name="username">

            <!-- Password -->
            <input type="password" id="password" class="form-control mb-4" placeholder="Password" name="password">

            <div class="d-flex justify-content-around">
                <div>
                    <!-- Remember me -->
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="defaultLoginFormRemember">
                        <label class="custom-control-label" for="defaultLoginFormRemember">Remember me</label>
                    </div>
                </div>
                <div>
                    <!-- Forgot password -->
                    <a href="">Forgot password?</a>
                </div>
            </div>

            <!-- Sign in button -->
            <button class="btn btn-info btn-block my-4" type="submit">Sign in</button>

            <!-- Register -->
            <p>Not a member?
                <a href="">Register</a>
            </p>

            <!-- Social login -->
            <p>or sign in with:</p>

            <a href="#" class="mx-2" role="button"><i class="fab fa-facebook-f light-blue-text"></i></a>
            <a href="#" class="mx-2" role="button"><i class="fab fa-twitter light-blue-text"></i></a>
            <a href="#" class="mx-2" role="button"><i class="fab fa-linkedin-in light-blue-text"></i></a>
            <a href="#" class="mx-2" role="button"><i class="fab fa-github light-blue-text"></i></a>

            </form>
<!-- Default form login -->
    </div>
</body>
</html>