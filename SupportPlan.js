function SetRightSite(MyVal){
  // let MyVal = document.getElementById("SelectClient").value;
  // alert("MyVal = "+ MyVal);
  // document.getElementById("MainNavigation").style.display = "none";
  if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
        document.getElementById("rightSite").innerHTML=xmlhttp.responseText;
        // CheckSupportPlan();
        SetSupportPlan();
    }
}

xmlhttp.open("POST","Functions.php?SetRightSite="+MyVal,false);
xmlhttp.send();
}
function SetSupportPlan(){
  let MyVal = document.getElementById("SelectClient").value;
  // CheckSupportPlan();
  if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
    xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById("SupportPlan").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("POST","SupportPlan.php?SetSupportPlan="+MyVal,false);
  xmlhttp.send();
}

function ShowSupportPlan(){
    document.getElementById("SupportPlan").style.display = "block"; 
}
function HideSupportPlan(){
    document.getElementById("SupportPlan").style.display = "none"; 
    document.getElementById("MainNavigation").style.display = "inline-table";
    HideSupportPlanForm();
}
function ChangedSelectionSupportPlan(){

  let MyVal = document.getElementById("SelectSupportPlan").value;
  // CheckSupportPlan();
  
  //   document.getElementById("CloseSelectSupportPlan").style.display = "block"; 
  //   document.getElementById("NewSupportPlan").style.display = "none"; 
  //  document.getElementById("SaveSupportPlan").style.display = "none"; 
  HideSupportPlanForm();

    if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
        document.getElementById("ContentTableInhalt").innerHTML=xmlhttp.responseText;
        // SetSupportPlan();
            document.getElementById("CloseSelectSupportPlan").style.display = "block"; 
    }
  }
  xmlhttp.open("POST","SupportPlan.php?ChangedSelectionSupportPlan="+MyVal,false);
  xmlhttp.send();
  }
function CloseSelectSupportPlan(){
    // document.getElementById("CloseSelectSupportPlan").style.display = "block";
    if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      SetSupportPlan();
      document.getElementById("CloseSelectSupportPlan").style.display = "none"; 
    }
  }
xmlhttp.open("POST","SupportPlan.php?CloseSelectSupportPlan=1",false);
xmlhttp.send();  
}


function LoadELDiBTable(){
   
    document.getElementById("EContent").style.display = "block"; 
    document.getElementById("SupportPlanForm").style.display = "none"; 

    console.log("LoadELDiBTable");
}
function HideELDiBTable(){
   
  document.getElementById("EContent").style.display = "none"; 

  //https://stackoverflow.com/questions/3141064/how-to-stop-all-timeouts-and-intervals-using-javascript

  // window.setTimeout = function(code, delay, toBeAdded) {
  //     var retval = window.setTimeout(code, delay);
  //     var toBeAdded = toBeAdded || false;
  //     if(toBeAdded) {
  //         window.timeoutList.push(retval);
  //     }
  //     return retval;

  //https://stackoverflow.com/questions/3847121/how-can-i-disable-all-settimeout-events
  // stoppe alle intervalle
  var x = setTimeout('alert("x");',100000); //It is very low probability that after 100 seconds x timeout will not be cleared
  for (var i = 0; i <= x; i++){
      clearTimeout(i);
      };
}

function TakeOverBereich(id){
    // alert("TakeOverZiele = "+ id);
    console.log("TakeOverZiele = "+ id);
    document.getElementById("MainNavigation").style.display = "none";
    //document.getElementById("SupportPlanForm").style.display = "block"; 
    if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
    xmlhttp.onreadystatechange=function()
    {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
        document.getElementById("SupportPlanFormRow1").innerHTML="";
        document.getElementById("SupportPlanFormRow1").innerText =xmlhttp.responseText;
          document.getElementById("SupportPlanFormRow1").value =xmlhttp.responseText;
          
          HideELDiBTable();
      }
    }
  
  xmlhttp.open("POST","SupportPlan.php?TakeOverBereich="+id,false);
  xmlhttp.send();
}

function TakeOverZiele(id){
    // alert("TakeOverZiele = "+ id);
    console.log("TakeOverZiele = "+ id);
    if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
    xmlhttp.onreadystatechange=function()
    {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
        console.log("TakeOverZiele response = " + xmlhttp.responseText );
          document.getElementById("SupportPlanFormRow2").innerText =xmlhttp.responseText;
          //document.getElementById("SupportPlanFormRow2").value =xmlhttp.responseText;          
          TakeOverZieleBereich(id);
          HideELDiBTable();
      }
    }
  
  xmlhttp.open("POST","SupportPlan.php?TakeOverZiele="+id,false);
  xmlhttp.send();
}

function TakeOverZieleBereich(id){
    // alert("TakeOverZiele = "+ id);
    console.log("TakeOverZieleBereich = "+ id);
    if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
    xmlhttp.onreadystatechange=function()
    {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
        console.log("TakeOverZieleBereich response = " + xmlhttp.responseText );
          TakeOverBereich(xmlhttp.responseText);
      }
    }
  
  xmlhttp.open("POST","SupportPlan.php?TakeOverZieleBereich="+id,false);
  xmlhttp.send();
}

function TakeOverFormulierungen(id){
  // alert("TakeOverFormulierungen = "+ id);
  console.log("TakeOverFormulierungen = "+ id);
  if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      console.log("TakeOverZiele response = " + xmlhttp.responseText );
        document.getElementById("SupportPlanFormRow3").innerText =xmlhttp.responseText;
        document.getElementById("SupportPlanFormRow3").value =xmlhttp.responseText;
        TakeOverFormulierungenZiele(id);
        HideELDiBTable();
    }
  }

  xmlhttp.open("POST","SupportPlan.php?TakeOverFormulierungen="+id,false);
  xmlhttp.send();
}

function TakeOverFormulierungenZiele(id){
  console.log("TakeOverFormulierungenZiele = "+ id);
  if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      console.log("TakeOverZieleBereich response = " + xmlhttp.responseText );
        TakeOverZiele(xmlhttp.responseText);
    }
  }

  xmlhttp.open("POST","SupportPlan.php?TakeOverFormulierungenZiele="+id,false);
  xmlhttp.send();
}
//

function TakeOverMassnahmen(id){
  // alert("TakeOverMassnahmen = "+ id);
  console.log("TakeOverMassnahmen = "+ id);
  if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      console.log("TakeOverZiele response = " + xmlhttp.responseText );
        document.getElementById("SupportPlanFormRow4").innerText =xmlhttp.responseText;
        document.getElementById("SupportPlanFormRow4").value =xmlhttp.responseText;
        TakeOverMassnahmenFormulierungen(id);
        HideELDiBTable();
    }
  }
  xmlhttp.open("POST","SupportPlan.php?TakeOverMassnahmen="+id,false);
  xmlhttp.send();
}

function TakeOverMassnahmenFormulierungen(id){
  console.log("TakeOverFormulierungenZiele = "+ id);
  if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      console.log("TakeOverZieleBereich response = " + xmlhttp.responseText );
      TakeOverFormulierungen(xmlhttp.responseText);
    }
  }

  xmlhttp.open("POST","SupportPlan.php?TakeOverMassnahmenFormulierungen="+id,false);
  xmlhttp.send();
}

function SupportTextSave(){
  alert("SupportTextSave");
}

function NewLineSupportPlan(id){
  // columnSupport1 =   document.getElementById("columnSupport1").value
  // columnSupport2 =   document.getElementById("columnSupport2").value
  // columnSupport3 =   document.getElementById("columnSupport3").value
  // columnSupport4 =   document.getElementById("columnSupport4").value

  columnSupport1 =   document.getElementById("SupportPlanFormRow1").innerText
  columnSupport2 =   document.getElementById("SupportPlanFormRow2").innerText
  columnSupport3 =   document.getElementById("SupportPlanFormRow3").innerText
  columnSupport4 =   document.getElementById("SupportPlanFormRow4").innerText
  console.log("NewLineSupportPlan = "+ id);
  if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
    xmlhttp.onreadystatechange=function()
    {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
       TakeOverFormulierungen(xmlhttp.responseText);
    }
  }

  xmlhttp.open("POST","SupportPlan.php?NewLineSupportPlan="+id+"&columnSupport1 ="+columnSupport1+"&columnSupport2 ="+columnSupport2+"&columnSupport3 ="+columnSupport3+"&columnSupport4 ="+columnSupport4 ,false);
  xmlhttp.send();
}

function NewSupportPlan(id){
  console.log("NewSupportPlan = "+ id);

  if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      // TakeOverFormulierungen(xmlhttp.responseText);
      SetSupportPlan();
      ShowSupportPlanForm();
    }
  }

  xmlhttp.open("POST","SupportPlan.php?NewSupportPlan="+id,false);
  xmlhttp.send();
}

function CreateSupportPlan(id){
  console.log("CreateSupportPlan = "+ id);

  if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      // TakeOverFormulierungen(xmlhttp.responseText);
      SetSupportPlan();
      ShowSupportPlanForm();
    }
  }

  xmlhttp.open("POST","SupportPlan.php?CreateSupportPlan="+id,false);
  xmlhttp.send();
}
//Save Supportplan
function SaveSupportPlan(id){
  console.log("SaveSupportPlan = "+ id);
  if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      // TakeOverFormulierungen(xmlhttp.responseText);
      SetSupportPlan();
    }
  }

  xmlhttp.open("POST","SupportPlan.php?SaveSupportPlan="+id,false);
  xmlhttp.send();
}
//Cancel Supportplan
function CancelSupportPlan(id){
  console.log("CancelSupportPlan = "+ id);
  if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      // TakeOverFormulierungen(xmlhttp.responseText);
      SetSupportPlan();
    }
  }

  xmlhttp.open("POST","SupportPlan.php?CancelSupportPlan="+id,false);
  xmlhttp.send();
}


//CheckSupportPlan
function CheckSupportPlan(){
  console.log("CheckSupportPlan = ");
  if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
       if (xmlhttp.responseText > 0){
        document.getElementById("NewSupportPlan").style.display = "block"; 
       }
       else{
        document.getElementById("SaveSupportPlan").style.display = "block"; 
       }      
    }
  }

  

  xmlhttp.open("POST","SupportPlan.php?CheckSupportPlan=1",false);
  xmlhttp.send();
}
function OldShowSupportPlanForm(){
  //document.getElementById("SupportPlanForm").style.display = "block"; 
  console.log("ShowSupportPlanForm = ");
  if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
        document.getElementById("SupportPlanForm").innerHTML = xmlhttp.responseText;   
    }
  }
  xmlhttp.open("POST","SupportPlanForm.php?ShowSupportPlanForm=1",false);
  xmlhttp.send();
}
function HideSupportPlanForm(){
  document.getElementById("SupportPlanForm").style.display = "none"; 
  document.getElementById("SupportPlanForm").innerHTML ="";
}

//SaveSupportPlanFromData
function SaveSupportPlanFromData(){
  // var Row1 = document.getElementById("SupportPlanFormRow1").value; 
  // var Row2 = document.getElementById("SupportPlanFormRow2").value; 
  // var Row3 = document.getElementById("SupportPlanFormRow3").value; 
  // var Row4 = document.getElementById("SupportPlanFormRow4").value; 
  var Row1 = document.getElementById("SupportPlanFormRow1").innerText; 
  var Row2 = document.getElementById("SupportPlanFormRow2").innerText; 
  var Row3 = document.getElementById("SupportPlanFormRow3").innerText; 
  var Row4 = document.getElementById("SupportPlanFormRow4").innerText; 
  console.log("SaveSupportPlanFromData = ");
  if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
        // document.getElementById("SupportPlanForm").innerHTML = xmlhttp.responseText;  
        console.log("SaveSupportPlanFromData is ok "); 
        HideSupportPlanForm();
        SetSupportPlan();
        //ShowSupportPlanForm();
    }
  }
  console.log("SaveSupportPlanFromData >>"+Row1);
  xmlhttp.open("POST","SupportPlanForm.php?SaveSupportPlanFromData=1"+"&Row1="+Row1+"&Row2="+Row2+"&Row3="+Row3+"&Row4="+Row4,false);
  xmlhttp.send();
}

function DeleteSupportTextArea(id){
  console.log("DeleteSupportTextArea = "+ id);
  if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
        // document.getElementById("SupportPlanForm").innerHTML = xmlhttp.responseText;  
        console.log("DeleteSupportTextArea is ok "+ xmlhttp.responseText); 
        // HideSupportPlanForm();
        SetSupportPlan();
    }
  }
  xmlhttp.open("POST","SupportPlan.php?DeleteSupportTextArea="+id,false);
  xmlhttp.send();
}