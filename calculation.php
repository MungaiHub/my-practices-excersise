<?php

function calculate($num1, $num2, $operator) {
    switch ($operator) {
        case '+':
            return $num1 + $num2; 
        case '-':
            return $num1 - $num2;
        case '*':
            return $num1 * $num2; 
        case '/':
            return ($num2 != 0) ? $num1 / $num2 : "Error: Division by zero"; // Division
        case '%':
            return ($num2 != 0) ? $num1 % $num2 : "Error: Division by zero"; // Modulus
        default:
            return "Invalid operator"; 
    }
}

do {
  
    echo "Enter an operation (+, -, *, /, %, e to exit): ";
    $operator = trim(fgets(STDIN));


    if ($operator === 'e') {
        break;
    }

   
    echo "Enter the first number: ";
    $num1 = trim(fgets(STDIN));
    echo "Enter the second number: ";
    $num2 = trim(fgets(STDIN));

   
    if (is_numeric($num1) && is_numeric($num2)) {
       
        $result = calculate($num1, $num2, $operator);
        echo "Result: $result\n";
    } else {
        echo "Invalid input! Please enter numeric values.\n";
    }

} while (true); 

echo "Goodbye!\n";
?>
