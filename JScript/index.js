function ChangedSelectionSchool(){
    
    let school = document.getElementById("SelectSchool").value; 
    console.log("[index.js] Start ChangedSelectionSchool =" + school);    
    if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
        // document.getElementById("ELDiBLehrercontent").innerHTML=xmlhttp.responseText;
    }
  }

xmlhttp.open("POST","../ELDiB/index.php?SelectionSchoolValue="+school,false);
xmlhttp.send();

}