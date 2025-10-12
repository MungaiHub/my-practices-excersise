<?php
setcookie("mycookie","user",time()+(86400*10),"/");
foreach ($_COOKIE as $key=> $value){
    echo "{key}: {value} \n";
}
?>