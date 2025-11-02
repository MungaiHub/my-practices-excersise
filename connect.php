<?php
$dbserver = "localhost";
$dbuser = "root";
$dppassword = "";
$dbname = "school";
$conn = "";

$conn = mysqli_connect($dbserver ,$dbuser,$dppassword,$dbname );
if($conn){
    echo "you are connected";
}
else{
    echo "could not connect";
}
?>