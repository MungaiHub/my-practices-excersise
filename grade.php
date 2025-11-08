<?php


function getGrade($score) {
    if ($score > 70) {
        return 'A';
    } elseif ($score > 60) {
        return 'B'; 
    } elseif ($score > 50) {
        return 'C'; 
    } elseif ($score > 40) {
        return 'D';
    } else {
        return 'E'; 
    }
}


echo "Please enter your marks (0-100): ";
$studentScore = trim(fgets(STDIN)); 


if (is_numeric($studentScore) && $studentScore >= 0 && $studentScore <= 100) {
  
    $grade = getGrade($studentScore);

    echo "Your Score: $studentScore\n";
    echo "Your Grade: $grade\n";
} else {
   
    echo "Invalid input! Please enter a number between 0 and 100.\n";
}
?>
