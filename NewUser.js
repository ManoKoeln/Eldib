function SaveNewUser(){
    console.log("SaveNewUser");
    if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
    xmlhttp.onreadystatechange=function()
    {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
        NewUserClose();
      }
    }
  
  xmlhttp.open("POST","NewUser.php?SaveNewUser=1",false);
  xmlhttp.send();
}
function NewUser(){
    console.log("NewUser");
    if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
    xmlhttp.onreadystatechange=function()
    {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
        document.getElementById("NewUser").innerHTML=xmlhttp.responseText;
        document.getElementById("NewUser").style.display = "flex";
      }
    }     
    xmlhttp.open("POST","NewUser.php?ShowFormNewUser=1",false);
    xmlhttp.send();
}
function SetNewUser(){
  
  NewUserVorname = document.getElementById("NewUserVorname").value;
  NewUserName = document.getElementById("NewUserName").value;
  NewUseremail = document.getElementById("NewUseremail").value;
  NewUserUserName = document.getElementById("NewUserUserName").value;
  console.log("SetNewUser;  NewUserVorname = "+NewUserVorname+" NewUserName = "+ NewUserName+ " NewUseremail = "+NewUseremail);
  if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      console.log(xmlhttp.responseText);
      document.getElementById("NewUser").innerHTML ="";
      document.getElementById("NewUser").innerHTML=xmlhttp.responseText;
      console.log("SetNewUser xmlhttp.responseText = "+xmlhttp.responseText);
      if (xmlhttp.responseText=""){
        document.getElementById("NewUser").style.display = "none";
      }
      else{
        document.getElementById("NewUser").style.display = "flex";
      }
      
      // document.getElementById("NewUser").style.display = "flex";
    }
  }     
  // xmlhttp.open("POST","NewUser.php?ShowFormNewUser=1 &SetNewUser=1"+"&Vorname="+NewUserVorname+"&Name"+NewUserName+"&email="+NewUseremail,false);
  xmlhttp.open("POST","NewUser.php?SetNewUser=1"+"&Vorname="+NewUserVorname+"&Name="+NewUserName+"&email="+NewUseremail+"&username="+NewUserUserName,false);
  // xmlhttp.open("POST","NewUser.php?Vorname="+NewUserVorname+"&Name="+NewUserName+"&email="+NewUseremail,false);
  xmlhttp.send();


}
function NewUserSave(){
    document.getElementById("NewUser").style.display = "none"; 
}
function NewUserClose(){
    document.getElementById("NewUser").style.display = "none"; 
}