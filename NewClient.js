function SaveNewClient(){
    console.log("SaveNewClient");
    if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
    xmlhttp.onreadystatechange=function()
    {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
        NewClientClose();
      }
    }
  
  xmlhttp.open("POST","NewClient.php?SaveNewClient=1",false);
  xmlhttp.send();
}
function NewClient(){
    console.log("NewClient");
    if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
    xmlhttp.onreadystatechange=function()
    {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
        document.getElementById("NewClient").innerHTML=xmlhttp.responseText;
        document.getElementById("NewClient").style.display = "flex";
      }
    }     
    xmlhttp.open("POST","NewClient.php?ShowFormNewClient=1",false);
    xmlhttp.send();
}
function NewClientSave(){
    document.getElementById("NewClient").style.display = "none"; 
}
function NewClientClose(){
    document.getElementById("NewClient").style.display = "none"; 
}