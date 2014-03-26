function select_card(id){

    var oldHTML = document.getElementById(id).innerHTML;
    if(oldHTML.search("default") == -1){
       document.getElementById(id).innerHTML = oldHTML.replace("success","default");
    }
    else{
          document.getElementById(id).innerHTML = oldHTML.replace("default","success");
    }
} 