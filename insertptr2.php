<?php
$dbserver = "localhost";
$dbuser = "root";
$dppassword = "";
$dbname = "school";
$conn = "";
try{
$conn = mysqli_connect($dbserver ,$dbuser,$dppassword,$dbname );
}
catch(mysqli_sql_exception){
    echo "could not connect";
    exit();
}
$sql="INSERT INTO students (name, age) VALUES ('amos mungai',20)";
try{
    mysqli_query($conn,$sql);
    echo "new record added successfully";
}
catch(mysqli_sql_exception){
    echo "failed to insert";
}

mysqli_close($conn);
?>