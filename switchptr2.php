<?php
// switch= replacement to using many elseif statements
//         more efffiecient, lessc oe to write
echo "enter your grade:";
$grade =strtoupper(trim(readline())) ;

 switch($grade){
    case "A":
        echo "you did great";
        break;
    case "B":
        echo "you did good";
        break;
    case "C":
        echo "you did okay";
        break;
    case "D":
        echo "you did poorly";
        break;
    case "F":
        echo "you failed";
        break;
    default:
            echo "enter valid grade";
            //$input = readline();
             //readline () Read input as a string  and that why we introduce casting
            //types of casting in php:
            //$input = (int)$input;
            //$Input = intval($input)
            //$Input = floatval($input);
            //$Input = strval($input);
            //settype($input, "integer");
            //settype($input, "float");

 }
?>