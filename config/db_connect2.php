<?php
    include('config/createdb2.php');
    include('config/createtable2.php');
    //connect to database
    $conn = mysqli_connect("localhost", "root", "", "ueab_recipe2");

    //check connection
    if(!$conn){
        die("<script>alert('Connection error '.)</script>");
    }
?>