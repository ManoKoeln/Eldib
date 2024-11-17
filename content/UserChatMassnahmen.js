function UserChatMassnahmenOpen (){
    console.log('UserChatMassnahmenOpen ');
    UserChatMassnahmenFormulierungenID = 1;

      document.getElementById("MyUserChatMassnahmen").style.display = 'block';
      document.getElementById("MainNavigation").style.display = "none";
    if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest();} else{xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
    xmlhttp.onreadystatechange=function()
      {
      if (xmlhttp.readyState==4 && xmlhttp.status==200){ document.getElementById("MyUserChatMassnahmenText").innerHTML=xmlhttp.responseText; } }
    
   xmlhttp.open("POST","content/UserChatMassnahmen.php?UserChatMassnahmenMassnahmenID="+UserChatMassnahmenFormulierungenID,false);
  
  
  console.log("UserChatMassnahmenOpen = " + UserChatMassnahmenFormulierungenID );
    xmlhttp.send();


}



function ExitChatMassnahmen (id) {
  console.log('ExitChatMassnahmen ');
 

    document.getElementById("MyUserChatMassnahmen").style.display = 'block';
    
  if (window.XMLHttpRequest)
    {
    // AJAX nutzen mit IE7+, Chrome, Firefox, Safari, Opera
    //alert("AJAX nutzen mit IE7+, Chrome, Firefox, Safari, Opera");
    xmlhttp=new XMLHttpRequest();
    }
  else
    {
    // AJAX mit IE6, IE5
    //alert("AJAX mit IE6, IE5");
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  
 xmlhttp.open("POST","content/UserChatMassnahmen.php?ExitChatMassnahmen="+id,false);
 xmlhttp.send();
 NoDisplayUserChatMassnahmen();
 UserChatMassnahmenOpen();

}

function NoDisplayUserChatMassnahmen() {
  // alert('NoDisplayUserChat');
  document.getElementById("MyUserChatMassnahmen").style.display = 'none';
  document.getElementById("MainNavigation").style.display = "inline-table";

 }