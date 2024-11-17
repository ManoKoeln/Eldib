// function ShowELDiBLehrer(){
//     document.getElementById("ELDiBLehrer").style.display = "block"; 
// }
function HideELDiBLehrer(){
  console.log("Start HideELDiBLehrer");
    document.getElementById("ELDiBLehrercontent").style.display = "none"; 
    document.getElementById("MainNavigation").style.display = "inline-table";
}
function ShowELDiBLehrer_New(){
  console.log("Start ShowELDiBLehrer");
    document.getElementById("ELDiBLehrercontent_New").style.display = "block"; 
    document.getElementById("MainNavigation").style.display = "none";
    let MyVal = document.getElementById("SelectClient").value;
    if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
        document.getElementById("ELDiBLehrercontent_New").innerHTML=xmlhttp.responseText;
    }
  }

xmlhttp.open("POST","ELDiBLehrer_New.php?SetELDiBLehrerNew="+MyVal,false);
xmlhttp.send();
}
function CreateNewTableELDiBLehrer(){
  console.log("Start CreateNewTableELDiBLehrer");
  let MyVal = document.getElementById("SelectClient").value;
  if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {

      console.log("respone = " + xmlhttp.responseText);
      if (String(xmlhttp.responseText).length >0){
      console.log(" xmlhttp.responseText");
      }
      ShowELDiBLehrer();
    }
  }

xmlhttp.open("POST","ELDiBLehrer.php?CreateNewTableELDiBLehrer="+MyVal,false);
xmlhttp.send();
}
function ChangedSelectionELDiBLehrer(IdZiel,idData,selectedIndex){
  console.log("ChangedSelectionELDiBLehrer");
  

  let MyVal = document.getElementById("SelectClient").value;
  if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      // ShowELDiBLehrer();
    }
  }

xmlhttp.open("POST","ELDiBLehrer.php?ChangedSelectionELDiBLehrer="+MyVal+"&IdZiele="+ IdZiel+"&Auswahl="+selectedIndex+"&idData="+idData,false);
xmlhttp.send();

}
function ChangedKeywordELDiBLehrer(IdZiel,idData,text){
  console.log("ChangedKeywordELDiBLehrer");
  

  let MyVal = document.getElementById("SelectClient").value;
  if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      // ShowELDiBLehrer();
    }
  }

xmlhttp.open("POST","ELDiBLehrer.php?ChangedKeywordELDiBLehrer="+MyVal+"&IdZiele="+ IdZiel+"&Text="+text+"&idData="+idData,false);
xmlhttp.send();

}

function SaveTableELDiBLehrer(){
  console.log("SaveTableELDiBLehrer");
  let MyVal = document.getElementById("SelectClient").value;
  if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById("ELDiBLehrercontent").innerHTML="";
      ShowELDiBLehrer();
    }
  }

xmlhttp.open("POST","ELDiBLehrer.php?SaveTableELDiBLehrer="+MyVal,false);
xmlhttp.send();
}

