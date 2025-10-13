<?php

// Step 1: Create an associative array of students and their scores
$students = [
    "Alice" => 85,
    "Bob" => 72,
    "Charlie" => 60,
    "Diana" => 90,
    "Eve" => 50
];

// Step 2: Function to determine grade based on score
function determineGrade($score) {
    if ($score >= 90) {
        return 'A';
    } elseif ($score >= 80) {
        return 'B';
    } elseif ($score >= 70) {
        return 'C';
    } elseif ($score >= 60) {
        return 'D';
    } else {
        return 'F';
    }
}

// Step 3: Iterate through each student and output their grade
foreach ($students as $student => $score) {
    $grade = determineGrade($score);
    echo "{$student} scored {$score} and their grade is: {$grade}<br>";
}

?>
