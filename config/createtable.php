<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "ueab_recipe");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$sql1 = "CREATE TABLE IF NOT EXISTS recipes(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    uname VARCHAR(30) NOT NULL,
    email VARCHAR(70) NOT NULL,
    foodname VARCHAR(30) NOT NULL,
    recipes VARCHAR(30) NOT NULL,
    created_at TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP
    )";
if(mysqli_query($link, $sql1)){
    // echo "Table recipes created successfully.";
} else{
    echo "ERROR: Could not able to execute $sql1. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>
