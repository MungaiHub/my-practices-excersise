document.getElementById("mybutton").onclick=function(){
    if(document.getElementById("mycheckbox").checked){
        document.getElementById("message").innerHTML="you have subscribed!!!"

    }
    else{
        document.getElementById("message").innerHTML="you have not subscribed!!!"   
    }
}