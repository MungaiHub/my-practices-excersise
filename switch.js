var grade;
document.getElementById("mybutton").onclick = function(){

    grade=document.getElementById("mytextbox").value;
    grade = grade.toUpperCase();
    //or grade = document.getElementById("mytextbox").value.toUpperCase(); 

  

    switch (grade){
        case "A":
            document.getElementById("result").innerHTML="you did great!!";
            break;
        case "B":
            document.getElementById("result").innerHTML="you did good!!";
            break;
         case "C":
            document.getElementById("result").innerHTML="you did okay!!";
            break;
        case "D":
            document.getElementById("result").innerHTML="you passed ... barely";
            break;
        case "E":
            document.getElementById("result").innerHTML="you FAILED!";
            break;
        default: 
        document.getElementById("result").innerHTML= grade + " is not a letter grade!";        
    }
}