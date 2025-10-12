<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <form action="get_and_post.php"method="get">
    <label >username</label><br>
    <input type="text"name="username"><br>
    <label >password</label><br>
    <input type="password"name="password"><br>
    <input type="submit" value="log in">
   </form> 
</body>
</html>
<?php
echo $_GET["username"]. "<br>";
echo $_GET["password"];
?>