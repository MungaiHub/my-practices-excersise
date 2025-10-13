<?php
$foods=array("apple","orange","pineapple","coconut");
//because we cannot output this way echo $food. "<br>" they will bbe an error
// we can output this way echo $foods[0];  which is tiresome because you need to output every elment one by one
//we use foreeach
foreach ($foods as $food){
    echo $food."\n";
}

?>