<?php
$hostname ="localhost";
$Database = "adalot";
$username ="root";
$password = "";

$conn =  mysqli_connect($hostname,$username, $password,$Database);

if(!$conn){
    echo "connection error";
}

?>