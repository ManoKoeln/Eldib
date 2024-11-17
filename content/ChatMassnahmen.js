let ChatMassnahmen2Interval;
var MassnahmenID2;
var MassnahmenLenOld;
var MassnahmenIDOld;


function SaveChatMassnahmen(MassnahmenID){
  var ChatText = String(document.getElementById("ChatTextMassnahmen").value);
  // var ChatText = "Zeile 1 \n Zeile 2";
  
  console.log("SaveChatMassnahmen ChatText = " + ChatText);
  
    if (ChatText ==""){
      return;
    }
    if (MassnahmenID=="")
      {
      document.getElementById("SaveChatMassnahmen").innerHTML="keine Eingabe";
      return;
      }
    if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest();} else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
    xmlhttp.onreadystatechange=function()
    {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
        CallChatMassnahmen2();
      }
    }
      // https://www.w3schools.com/jsref/jsref_decodeuricomponent.asp
    xmlhttp.open("POST","content/chatMassnahmen.php?SaveChatMassnahmen="+MassnahmenID+"&ChatText="+encodeURIComponent(ChatText),false);
    

    document.getElementById("ChatTextMassnahmen").value = "";
  
    xmlhttp.send();
    document.getElementById("MyChatMassnahmenText").innerHTML=xmlhttp.responseText;
    console.log("SaveChatMassnahmen in ChatMassnahmen.js = " + xmlhttp.responseText );
}

// function CallChatMassnahmen (MassnahmenID){
//   CallChatMassnahmen1 (MassnahmenID);
  
// }
function CallChatMassnahmen (MassnahmenID){
    console.log('ChatMassnahmen MassnahmenID = '+MassnahmenID);
    clearInterval(copyZieleInterval);
    clearInterval(copyFormulierungenInterval);
    clearInterval(copyZieleInterval);
    MassnahmenID2 = MassnahmenID;
        document.getElementById("MyChatMassnahmen").style.display = "block";
        document.getElementById("MainNavigation").style.display = "none";
        document.getElementById("click").checked = false;
      if (window.XMLHttpRequest)  { xmlhttp=new XMLHttpRequest();} else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
      xmlhttp.onreadystatechange=function()
        {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
          {
            document.getElementById("ChatMassnahmenDiv2").innerHTML=xmlhttp.responseText; 
            ChatMassnahmen2Interval = setInterval(CallChatMassnahmen2 , 1000);

          }
        }
        
     xmlhttp.open("POST","content/chatMassnahmen.php?MassnahmenID="+MassnahmenID,false);
    //  xmlhttp.open("POST","content/chatMassnahmen.php?MassnahmenID="+MassnahmenID+"&MassnahmenText="+MassnahmenText+"&ChatID="+ChatID,true);
    
  console.log("CallChatMassnahmen = " + MassnahmenID );
      xmlhttp.send();
      // ChatMassnahmen2Interval = setInterval(CallChatMassnahmen2 (MassnahmenID), 1000);
      

}

function CallChatMassnahmen2 (){
  console.log('ChatMassnahmen MassnahmenID2 = '+MassnahmenID2);
  clearInterval(ChatMassnahmen2Interval);

  if (window.XMLHttpRequest) { xmlhttp2=new XMLHttpRequest(); } else { xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");}
  xmlhttp2.onreadystatechange=function()
    {
    if (xmlhttp2.readyState==4 && xmlhttp2.status==200)
      {
        MassnahmenText = xmlhttp2.responseText;
        MassnahmenLen = MassnahmenText.length;
        if (MassnahmenLen != MassnahmenLenOld || MassnahmenID2 != MassnahmenIDOld){
        document.getElementById("ChatMassnahmenDiv1").innerHTML=MassnahmenText;
        MassnahmenLenOld = MassnahmenLen;  
        MassnahmenIDOld = MassnahmenID2;
      }

        ChatMassnahmen2Interval = setInterval(CallChatMassnahmen2 , 1000);        
      }
    }
  xmlhttp2.open("POST","content/chatMassnahmen.php?MassnahmenID2="+MassnahmenID2,true);
  console.log("CallChatMassnahmen2 = " + MassnahmenID2 );
  xmlhttp2.send();
}



