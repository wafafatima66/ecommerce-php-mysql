<?php

if(isset($_GET['error'])){
    if($_GET['error']=="wrongpasswordorwronguser"){
        echo'<p class="alert alert-danger h6">Wrong password or username</p>';
    }
    if($_GET['error']=="nouser"){
        echo'<p class="alert alert-danger h6">No such User</p>';
    }
}

require "header.php";

?>