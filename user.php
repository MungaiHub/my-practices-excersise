<?php

echo "Please enter your favorite color: ";
$favColor = trim(fgets(STDIN)); 


echo "Please enter your birth year: ";
$birthYear = trim(fgets(STDIN));


echo "Are you a student? (yes/no): ";
$isStudent = trim(fgets(STDIN)); 


$isStudent = strtolower($isStudent) === 'yes';


echo "\n--- User Information ---\n";
echo "Favorite Color: $favColor\n";
echo "Birth Year: $birthYear\n";
echo "Student Status: " . ($isStudent ? "Yes" : "No") . "\n";
?>
