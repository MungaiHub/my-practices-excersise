<?php

function findLargest($num1, $num2, $num3) {
    if ($num1 >= $num2 && $num1 >= $num3) {
        return $num1;
    } elseif ($num2 >= $num1 && $num2 >= $num3) {
        return $num2; 
    } else {
        return $num3; 
    }
}

// Using readline() to get input from the user
$firstNumber = readline("Enter first number: ");
$secondNumber = readline("Enter second number: ");
$thirdNumber = readline("Enter third number: ");

// Convert the input to numbers (since readline() returns strings)
$firstNumber = (float)$firstNumber;
$secondNumber = (float)$secondNumber;
$thirdNumber = (float)$thirdNumber;

// Call the function and display the result
$largest = findLargest($firstNumber, $secondNumber, $thirdNumber);
echo "The largest number is: " . $largest . "\n";

?>

