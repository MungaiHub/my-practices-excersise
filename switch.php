<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="switch.php" method="post">
   <label for="day">enter any of the 7 days in a week: </label> <br>
   <input type="text" name="day"><br>
   <input type="submit" value="submit"><br>
   </form>
</body>
</html>
<?php
$day=$_POST["day"];

switch($day){
    case "saturay";
    case "sunday";
    echo "it is a weekend";
    break;
    case "monday";
    case "tuesday";
    case "wednesday";
    case "thursday";
    case "friday";
    echo "it is a weekday";
    break;
    default;
    echo "<p style='color:red'>enter a valid day</p>";
}


?>