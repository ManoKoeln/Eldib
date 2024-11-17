function ChangedOperatorSelectionReadWrite(){
    let MyVal = document.getElementById("SelectOperatorReadWrite").value;
    //  alert("MyVal = "+ MyVal);
    if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
        document.getElementById("OperatorSelection").style.display = "none";         
        // document.getElementById("AktualClient").innerHTML=xmlhttp.responseText;
        SetRightSite();
    }
  }

xmlhttp.open("POST","Functions.php?NewOperatorReadWrite="+MyVal,false);
xmlhttp.send();
}

function removeoperatorReadWrite(operator){
    //  alert("MyVal = "+ MyVal);
  if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
  {  
      // document.getElementById("AktualClient").innerHTML=xmlhttp.responseText;
      SetRightSite();
  }
}

xmlhttp.open("POST","Functions.php?removeoperatorReadWrite="+operator,false);
xmlhttp.send();
}

function removeoperatorReadOnly(operator){
  //  alert("MyVal = "+ MyVal);
if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{  
    // document.getElementById("AktualClient").innerHTML=xmlhttp.responseText;
    SetRightSite();
}
}

xmlhttp.open("POST","Functions.php?removeoperatorReadOnly="+operator,false);
xmlhttp.send();
}


function ChangedOperatorSelectionReadOnly() {
    let MyVal = document.getElementById("SelectOperatorReadOnly").value;
    //  alert("MyVal = "+ MyVal);
    if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
        document.getElementById("OperatorSelection").style.display = "none";  
        // document.getElementById("AktualClient").innerHTML=xmlhttp.responseText;
        SetRightSite(MyVal);
    }
  }

xmlhttp.open("POST","Functions.php?NewOperatorReadOnly="+MyVal,false);
xmlhttp.send();
}
function OperatorSelectionShow(){
    document.getElementById("OperatorSelection").style.display = "block";  
}
function OperatorSelectionHide(){
    document.getElementById("OperatorSelection").style.display = "none";  
}