<?php
function isEligibleToVote($age) {
    return $age >= 18; 
}

echo "Please enter your age: ";
$age = trim(readline());  // Using readline instead of fgets(STDIN)

if (is_numeric($age) && $age >= 0) {
    if (isEligibleToVote($age)) {
        echo "You are eligible to vote.\n";
    } else {
        echo "You are not eligible to vote.\n";
    }
} else {
    echo "Invalid input! Please enter a valid age.\n"; 
}

?>

