<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="facorial.php" method="post">
<label >enter a number you want to know its factorial</label><br>
    <input type="text" name="number"><br>
    <input type="submit" value="submit">
    </form>
</body>
</html>
<?php
$num=$_POST["number"];
$tempnum=$num;
$factorial=1;

while($tempnum>1){
    $factorial=$factorial*$tempnum;
    $tempnum--;
}
echo "the factorial of {$num} is: {$factorial}";
?>