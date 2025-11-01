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

$sql="SELECT * FROM student";
$result=mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        echo $row["id"]."<br>";
        echo $row["name"]."<br>";
        echo $row["age"]."<br>";
    }
}
else{
    echo "no user found";
}
mysqli_close($conn);
?>