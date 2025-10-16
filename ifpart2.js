/* 
document.getElementById("mybutton").onclick = calculate;

function calculate() {
    var grade = document.getElementById("mytext").value;
    grade = Number(grade);

    if (grade >= 70) {
        document.getElementById("result").innerHTML = "You have attained grade A";
    } else if (grade >= 60) {
        document.getElementById("result").innerHTML = "You have attained grade B";
    } else if (grade >= 50) {
        document.getElementById("result").innerHTML = "You have attained grade C";
    } else if (grade >= 40) {
        document.getElementById("result").innerHTML = "You have attained grade D";
    } else {
        document.getElementById("result").innerHTML = "You have attained grade E";
    }
} */





document.getElementById("mybutton").onclick = calculate;

function calculate() {
    var grade = Number(document.getElementById("mytext").value);

    // Use a switch to check ranges by comparing directly within cases
    switch (true) {
        case (grade >= 70 && grade <= 100):
            document.getElementById("result").innerHTML = "You have attained grade A";
            break;
        case (grade >= 60):
            document.getElementById("result").innerHTML = "You have attained grade B";
            break;
        case (grade >= 50):
            document.getElementById("result").innerHTML = "You have attained grade C";
            break;
        case (grade >= 40):
            document.getElementById("result").innerHTML = "You have attained grade D";
            break;
        case (grade >= 0 && grade < 40):
            document.getElementById("result").innerHTML = "You have attained grade E";
            break;
        default:
            document.getElementById("result").innerHTML = "Invalid grade entered.";
            break;
    }
}
