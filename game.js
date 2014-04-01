function select_card(id){

    var oldHTML = document.getElementById(id).innerHTML;
    var oldHTML2 = document.getElementById("cardset_2").innerHTML;
   
 
    if(oldHTML.search("default") == -1){
       document.getElementById(id).innerHTML = oldHTML.replace("success","default");
    }
    else{
       document.getElementById("cardset_2").innerHTLM = oldHTML2.replace("success","default");    
       document.getElementById(id).innerHTML = oldHTML.replace("default","success");
    }
} 
