<?php
include("connection.php");
$sql="INSERT INTO student (name, age) VALUES ('amos mungai',20)";
mysqli_query($conn,$sql);

mysqli_close($conn);
?>