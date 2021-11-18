<?php
    include('config/createdb.php');
    include('config/createtable.php');
    //connect to database
    $conn = mysqli_connect("localhost", "root", "", "ueab_recipe");

    //check connection
    if(!$conn){
        die("<script>alert('Connection error '.)</script>");
    }
?>