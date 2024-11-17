
function PopUpInsertFormulierungen(PopUpInsertFormulierungenID){

    document.getElementById("MyPopUp").style.display= "block";

    if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest();} else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
    xmlhttp.onreadystatechange=function()
    {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
        // document.getElementById("PopUpDiv1").innerHTML=xmlhttp.responseText;
        document.getElementById("MyPopUpText").innerHTML=xmlhttp.responseText;
        }
      }   
      xmlhttp.open("POST","content/PopUp.php?PopUpInsertFormulierungenID="+PopUpInsertFormulierungenID,false);
    xmlhttp.send();
}

function PopUpEditFormulierungen(PopUpEditFormulierungenID){

    document.getElementById("MyPopUp").style.display= "block";
   document.getElementById("MainNavigation").style.display = "none";
    document.getElementById("click").checked = false;
    
        if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest();} else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
        xmlhttp.onreadystatechange=function()
        {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
          {
            //  document.getElementById("PopUpDiv1").innerHTML=xmlhttp.responseText;
            
        document.getElementById("MyPopUpText").innerHTML=xmlhttp.responseText;
            }
          }   
        xmlhttp.open("POST","content/PopUp.php?PopUpEditFormulierungenID="+PopUpEditFormulierungenID,false);
        xmlhttp.send();
    }

function EditFormulierungen(parent){

    text = String(document.getElementById("PopUpEditFormulierungenText").value);

    console.log("PopUp.js EditFormulierungen parent = " + parent + " -- eingabe = " + text);

        if (window.XMLHttpRequest) {xmlhttp=new XMLHttpRequest();} else {xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
        xmlhttp.onreadystatechange=function()
        {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
        NoDisplayEditPopUpFormulierungen();
        }
    }
    xmlhttp.open("POST","content/PopUp.php?EditFormulierungen="+parent+"&text="+encodeURI(text),false);
    xmlhttp.send();          
    }

function PopUpDeleteFormulierungen(PopUpDeleteFormulierungenID){

    document.getElementById("MyPopUp").style.display= "block";
   document.getElementById("MainNavigation").style.display = "none";
    document.getElementById("click").checked = false;
    
        if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest();} else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
        xmlhttp.onreadystatechange=function()
        {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                // document.getElementById("PopUpDiv1").innerHTML=xmlhttp.responseText;
                document.getElementById("MyPopUpText").innerHTML=xmlhttp.responseText;
            }
            }   
        xmlhttp.open("POST","content/PopUp.php?PopUpDeleteFormulierungenID="+PopUpDeleteFormulierungenID,false);
        xmlhttp.send();
    }
      


function NoDisplayInsertPopUpFormulierungen (){
    document.getElementById("MyPopUp").style.display = 'none';
   document.getElementById("MainNavigation").style.display = "inline-table";
}
function NoDisplayEditPopUpFormulierungen (){
    document.getElementById("MyPopUp").style.display = 'none';
   document.getElementById("MainNavigation").style.display = "inline-table";
    
}
function NoDisplayDeletePopUpFormulierungen (){
    document.getElementById("MyPopUp").style.display = 'none';
   document.getElementById("MainNavigation").style.display = "inline-table";
    
}

//Massnahmen


function PopUpInsertMassnahmen(PopUpInsertMassnahmenID){

    document.getElementById("MyPopUp").style.display= "block";
    
        if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest();} else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
        xmlhttp.onreadystatechange=function()
        {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
          {
            // document.getElementById("PopUpDiv1").innerHTML=xmlhttp.responseText;
            document.getElementById("MyPopUpText").innerHTML=xmlhttp.responseText;
            }
          }   
        xmlhttp.open("POST","content/PopUp.php?PopUpInsertMassnahmenID="+PopUpInsertMassnahmenID,false);
        xmlhttp.send();
    }
    
function PopUpEditMassnahmen(PopUpEditMassnahmenID){

    document.getElementById("MyPopUp").style.display= "block";
   document.getElementById("MainNavigation").style.display = "none";
    document.getElementById("click").checked = false;
    
        if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest();} else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
        xmlhttp.onreadystatechange=function()
        {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                // document.getElementById("PopUpDiv1").innerHTML=xmlhttp.responseText;
                document.getElementById("MyPopUpText").innerHTML=xmlhttp.responseText;
            
            }
            }   
        xmlhttp.open("POST","content/PopUp.php?PopUpEditMassnahmenID="+PopUpEditMassnahmenID,false);
        xmlhttp.send();
    }
    
function EditMassnahmen(parent){

    text = String(document.getElementById("PopUpEditMassnahmenText").value);

        if (window.XMLHttpRequest) {xmlhttp=new XMLHttpRequest();} else {xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
        xmlhttp.onreadystatechange=function()
        {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
        NoDisplayEditPopUpMassnahmen();
        }
    }
    xmlhttp.open("POST","content/PopUp.php?EditMassnahmen="+parent+"&text="+encodeURI(text),false);
    
    xmlhttp.send();          
    }
    
function PopUpDeleteMassnahmen(PopUpDeleteMassnahmenID){

    document.getElementById("MyPopUp").style.display= "block";
   document.getElementById("MainNavigation").style.display = "none";
    document.getElementById("click").checked = false;
    
        if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest();} else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
        xmlhttp.onreadystatechange=function()
        {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                // document.getElementById("PopUpDiv1").innerHTML=xmlhttp.responseText;
                document.getElementById("MyPopUpText").innerHTML=xmlhttp.responseText;
            
            }
            }   
        xmlhttp.open("POST","content/PopUp.php?PopUpDeleteMassnahmenID="+PopUpDeleteMassnahmenID,false);
        xmlhttp.send();
    }
        


function NoDisplayInsertPopUpMassnahmen (){
    document.getElementById("MyPopUp").style.display = 'none';
   document.getElementById("MainNavigation").style.display = "inline-table";
}
function NoDisplayEditPopUpMassnahmen (){
    document.getElementById("MyPopUp").style.display = 'none';
   document.getElementById("MainNavigation").style.display = "inline-table";
    
}
function NoDisplayDeletePopUpMassnahmen (){
    document.getElementById("MyPopUp").style.display = 'none';
   document.getElementById("MainNavigation").style.display = "inline-table";
    
}
function NoDisplaySetup (){
    document.getElementById("MyPopUp").style.display = 'none';
    document.getElementById("MainNavigation").style.display = "inline-table";
    
}


function NoDisplayChangePassword (){
    document.getElementById("changePW").style.display = 'none';
    
}


function Setup(){
    document.getElementById("MyPopUp").style.display= "block";
   document.getElementById("MainNavigation").style.display = "none";
    document.getElementById("click").checked = false;
    console.log("Setup start");
        if (window.XMLHttpRequest) {xmlhttp=new XMLHttpRequest();} else {xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
        xmlhttp.onreadystatechange=function()
        {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            // document.getElementById("PopUpDiv1").innerHTML=xmlhttp.responseText;
            document.getElementById("MyPopUpText").innerHTML=xmlhttp.responseText;
            console.log("Setup response");
    
        }
    }
    xmlhttp.open("POST","content/PopUp.php?Setup=1",false);
    
    xmlhttp.send();          
    }

    
function WriteSetUpData(){
    
        var csendchat = document.getElementById("sendchat");
    if (csendchat.checked == true){
        sendchat = 1;
    }
    else{
        sendchat = 0;
    }

    var csendpost = document.getElementById("sendpost");
    if (csendpost.checked == true){
        sendpost = 1;
    }
    else{
        sendpost = 0;
    }

        console.log("WriteSetUpData sendchat = " + sendchat + "  sendpost = "+ sendpost)
            if (window.XMLHttpRequest) {xmlhttp=new XMLHttpRequest();} else {xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
            xmlhttp.onreadystatechange=function()
            {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
    
    
            }
        }
        xmlhttp.open("POST","content/PopUpFunctions.php?sendpost="+sendpost+"&sendchat="+sendchat,false);
    
        xmlhttp.send();          
        }

// ChangePassword
function ChangePassword(){
    document.getElementById("changePW").style.display= "block";
   document.getElementById("MainNavigation").style.display = "none";
    document.getElementById("click").checked = false;
    console.log("ChangePassword start");
        if (window.XMLHttpRequest) {xmlhttp=new XMLHttpRequest();} else {xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
        xmlhttp.onreadystatechange=function()
        {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("changePW").innerHTML=xmlhttp.responseText;
            console.log("ChangePassword response");

    
        }
    }
    xmlhttp.open("GET","content/changePW.php?changePW=1",false);
    
    xmlhttp.send();          
}

function SavePw(){
    document.getElementById("MyPopUp").style.display= "block";
    console.log("SavePw start");
        if (window.XMLHttpRequest) {xmlhttp=new XMLHttpRequest();} else {xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
        xmlhttp.onreadystatechange=function()
        {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            
            console.log("SavePw response");
        
        }
    }
    xmlhttp.open("POST","content/PopUpFunctions.php?SavePw=1",false);
    
    xmlhttp.send();          
    }

    //https://www.w3schools.com/Css/css3_variables_javascript.asp
    // Get the root element
    var r = document.querySelector(':root');

    // Create a function for getting a variable value
function myFunction_get() {
    // Get the styles (properties and values) for the root
    var rs = getComputedStyle(r);
    // Alert the value of the --blue variable
    alert("The value of --blue is: " + rs.getPropertyValue('--blue'));
}

    // Create a function for setting a variable value
function myFunction_set() {
    // Set the value of variable --blue to another value (in this case "lightblue")
    r.style.setProperty('--blue', 'lightblue');
}

    var r = document.querySelector(':root');
    var MyFontSize = 0;
    var jsVar;

function myFunction_Bigger() {
        // MyFontSize = document.documentElement.style.getPropertyValue('--FontSize');
        // MyFontSizeSmal = document.documentElement.style.getPropertyValue('--FontSizeSmal');
    var With = document.documentElement.clientWidth * 4;
    var Height = document.documentElement.clientHeight * 3;

    const styles = getComputedStyle(document.documentElement);

    if (Height < With) //Desk
        { 


        MyFontSize = styles.getPropertyValue('--FontSize');
        var s = MyFontSize.replace("vw", "");
        s = s * 10;
        if (s < 12){
            s =  s + 1;
        }
        s = s / 10;
        MyFontSize = s + "vw";
        
        document.documentElement.style.setProperty('--FontSize', MyFontSize);

        console.log("MyFontSize = " + MyFontSize);

        if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }

        xmlhttp.open("POST","content/PopUpFunctions.php?FontSize="+MyFontSize,false);
        xmlhttp.send();
        }
    else // Mobile
        {
        MyFontSizeSmal = styles.getPropertyValue('--FontSizeSmal');
        var s = MyFontSizeSmal.replace("vw", "");
        s = s * 10;
        if (s < 12){
            s =  s + 1;
        }
        s = s / 10;
        MyFontSizeSmal = s + "vw";
        document.documentElement.style.setProperty('--FontSizeSmal', MyFontSizeSmal);   
        console.log("MyFontSizeSmal = " + MyFontSizeSmal);
        if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
        xmlhttp.open("POST","content/PopUpFunctions.php?FontSizeSmal="+MyFontSizeSmal,false);
        xmlhttp.send();
    }
}

function myFunction_Smaller() {
    MyFontSize = document.documentElement.style.getPropertyValue('--FontSizeSmal');
    const styles = getComputedStyle(document.documentElement);
    var With = document.documentElement.clientWidth * 4;
    var Height = document.documentElement.clientHeight * 3;

    if (Height < With) //Desk
    { 

    MyFontSize = styles.getPropertyValue('--FontSize');
    var s = MyFontSize.replace("vw", "");
    s = s * 10;
    if (s > 6){
        s =  s - 1;
    }
    s = s / 10;
    MyFontSize = s + "vw";
    document.documentElement.style.setProperty('--FontSize', MyFontSize);
    console.log("MyFontSize = " + MyFontSize);
    if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }  
    xmlhttp.open("POST","content/PopUpFunctions.php?FontSize="+MyFontSize,false);
    xmlhttp.send();
    }
    else
    { 
        MyFontSizeSmal = styles.getPropertyValue('--FontSizeSmal');
       var s = MyFontSizeSmal.replace("vw", "");
       s = s * 10;
       if (s > 6){
         s =  s - 1;
        }
       s = s / 10;
       MyFontSizeSmal = s + "vw";       
       document.documentElement.style.setProperty('--FontSizeSmal', MyFontSizeSmal);
       console.log("MyFontSizeSmal = " + MyFontSizeSmal);
       if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }    
     xmlhttp.open("POST","content/PopUpFunctions.php?FontSizeSmal="+MyFontSizeSmal,false);
     xmlhttp.send();
   }
}
  
  // Create a function for setting a variable value
function myFunction_set() {
    // Set the value of variable --blue to another value (in this case "lightblue")
    r.style.setProperty('--FontSize', 1);
}

function NoDisplayChangePW (){
    console.log("NoDisplayChangePW");
    document.getElementById("changePW").style.display= "none";
    // copyBereich();
}
