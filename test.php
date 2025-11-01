<?php
echo "the prime nnumbers: ";
for($i=0;$i<30;$i++){
    if ($i%1==0 && $i%$i==0 ){
        echo $i;
    }

}
?>