function UserChatFormulierungenOpen (){
    console.log('UserChatFormulierungenOpen ');
    UserChatFormulierungenFormulierungenID = 1;

      document.getElementById("MyUserChatFormulierungen").style.display = 'block';
      document.getElementById("MainNavigation").style.display = "none";
    if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest();} else{xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
    xmlhttp.onreadystatechange=function()
      {
      if (xmlhttp.readyState==4 && xmlhttp.status==200){ document.getElementById("MyUserChatFormulierungenText").innerHTML=xmlhttp.responseText; } }
      // if (xmlhttp.readyState==4 && xmlhttp.status==200){ document.getElementById("MyUserChatFormulierungen").innerHTML=xmlhttp.responseText; } }
    
   xmlhttp.open("POST","content/UserChatFormulierungen.php?UserChatFormulierungenFormulierungenID="+UserChatFormulierungenFormulierungenID,false);
  
  
console.log("UserChatFormulierungenOpen = " + UserChatFormulierungenFormulierungenID );
    xmlhttp.send();


}


function ExitChatFormulierungen (id) {
  console.log('ExitChatFormulierungen ');
 

    document.getElementById("MyUserChatFormulierungen").style.display = 'block';
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
  
 xmlhttp.open("POST","content/UserChatFormulierungen.php?ExitChatFormulierungen="+id,false);
 xmlhttp.send();
 NoDisplayUserChatFormulierungen();
 UserChatFormulierungenOpen();

}

function NoDisplayUserChatFormulierungen() {
  // alert('NoDisplayUserChat');
  document.getElementById("MyUserChatFormulierungen").style.display = 'none';
  document.getElementById("MainNavigation").style.display = "inline-table";

  

 }
