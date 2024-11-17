function UserChatOpen (){
    console.log('UserChatOpen ');
    UserCHatFormulierungenID = 1;

      document.getElementById("MyUserChat").style.display = 'block';
      document.getElementById("MainNavigation").style.display = "none";
    if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest();} else{xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
    xmlhttp.onreadystatechange=function()
      {
      if (xmlhttp.readyState==4 && xmlhttp.status==200){ document.getElementById("MyUserChatText").innerHTML=xmlhttp.responseText; } }
    
   xmlhttp.open("POST","content/UserChat.php?UserCHatFormulierungenID="+UserCHatFormulierungenID,false);
  
  
  console.log("UserChatOpen = " + UserCHatFormulierungenID );
    xmlhttp.send();


}


function ExitChatFormulierungen (id) {
  console.log('ExitChatFormulierungen ');
 

    document.getElementById("MyUserChat").style.display = 'block';
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
  
 xmlhttp.open("POST","content/UserChat.php?ExitChatFormulierungen="+id,false);
 xmlhttp.send();
 NoDisplayUserChat();
 UserChatOpen();

}

function ExitChatMassnahmen (id) {
  console.log('ExitChatMassnahmen ');
 

    document.getElementById("MyUserChat").style.display = 'block';
    
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
  
 xmlhttp.open("POST","content/UserChat.php?ExitChatMassnahmen="+id,false);
 xmlhttp.send();
 NoDisplayUserChat();
 UserChatOpen();

}