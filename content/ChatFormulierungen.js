let ChatFormulierungen2Interval;
var FormulierungenID2;
var FormulierungenIDOld;
var FormulierungenID2Old;
var FormulierungenLenOld;
var FormulierungenLenOld2;

// SaveChatFormulierungen
function SaveChatFormulierungen(FormulierungenID){
  var ChatText = String(document.getElementById("ChatTextFormulierungen").value);
  // var ChatText = "Zeile 1 \n Zeile 2";
  
  console.log("SaveChatFormulierungen ChatText = " + ChatText);
  clearInterval(ChatFormulierungen2Interval);


    if (ChatText ==""){
      return;
    }
    if (FormulierungenID=="")
      {
      document.getElementById("SaveChatFormulierungen").innerHTML="keine Eingabe";
      return;
      }
    if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest();} else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
    xmlhttp.onreadystatechange=function()
    {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
        console.log(xmlhttp.responseText);
          CallChatFormulierungen2();
        }
      }   

      // https://www.w3schools.com/jsref/jsref_decodeuricomponent.asp
    xmlhttp.open("POST","content/chatFormulierungen.php?SaveChatFormulierungen="+FormulierungenID+"&ChatText="+encodeURIComponent(ChatText),false);
    

    document.getElementById("ChatTextFormulierungen").value = "";
  
    xmlhttp.send();

}

//  CallChatFormulierungen 

function CallChatFormulierungen (FormulierungenID){
    console.log('ChatFormulierungen FormulierungenID = '+FormulierungenID);
    clearInterval(copyZieleInterval);
    clearInterval(ChatFormulierungen2Interval);

    FormulierungenID2 = FormulierungenID;
        document.getElementById("MyChatFormulierungen").style.display = "block";
        document.getElementById("MainNavigation").style.display = "none";
        document.getElementById("click").checked = false;
      if (window.XMLHttpRequest)  { xmlhttp=new XMLHttpRequest();} else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
      xmlhttp.onreadystatechange=function()
        {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
          {
            FormulierungenText = xmlhttp.responseText;
            FormulierungenLen = FormulierungenText.length;
            if((FormulierungenLenOld != FormulierungenLen)||(FormulierungenIDOld != FormulierungenID)){
            document.getElementById("ChatFormulierungenDiv2").innerHTML=FormulierungenText; 
            FormulierungenLenOld = FormulierungenLen;
            FormulierungenIDOld = FormulierungenID;
            
            }
            ChatFormulierungen2Interval = setInterval(CallChatFormulierungen2 , 1000);
          }
        }
        
     xmlhttp.open("POST","content/chatFormulierungen.php?FormulierungenID="+FormulierungenID,false);
    
  console.log("CallChatFormulierungen = " + FormulierungenID );
      xmlhttp.send();
     

}

function CallChatFormulierungen2 (){
  console.log('ChatFormulierungen FormulierungenID2 = '+FormulierungenID2);
  clearInterval(copyZieleInterval);
  clearInterval(copyFormulierungenInterval);
  clearInterval(ChatFormulierungen2Interval);

  if (window.XMLHttpRequest) { xmlhttp2=new XMLHttpRequest(); } else { xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");}
  xmlhttp2.onreadystatechange=function()
    {
    if (xmlhttp2.readyState==4 && xmlhttp2.status==200)
      {
        FormulierungenText2 = xmlhttp2.responseText;
        FormulierungenLen2 = FormulierungenText2.length;
        if ((FormulierungenLen2 != FormulierungenLenOld2)||(FormulierungenID2Old != FormulierungenID2)){
        document.getElementById("ChatFormulierungenDiv1").innerHTML=FormulierungenText2;
        FormulierungenLenOld2 = FormulierungenLen2;
        FormulierungenID2Old = FormulierungenID2;
        }
        ChatFormulierungen2Interval = setInterval(CallChatFormulierungen2 , 1000);        
      }
    }
  xmlhttp2.open("GET","content/chatFormulierungen.php?FormulierungenID2="+FormulierungenID2,true);
  console.log("CallChatFormulierungen2 = " + FormulierungenID2 );
  xmlhttp2.send();
}



