// src="http://code.jquery.com/jquery-3.3.1.min.js";
// type="text/javascript";

function MessageToAutor (IdAutor){
// alert('Nachricht an : ' + IdAutor);
console.log('MessageToAutor ');

  document.getElementById("Messages").style.display = 'block';
if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); }else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
// clearInterval(ChatFormulierungen2Interval);
// clearInterval(ChatMassnahmen2Interval);
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById("MessagesText").innerHTML=xmlhttp.responseText;
    }
  }

xmlhttp.open("POST","content/Messages.php?MessageToAutor="+IdAutor,false);


console.log("MessageToAutor = " + IdAutor );
xmlhttp.send();
}
function NoDisplayMessages(){
    document.getElementById("Messages").style.display = 'none';
}



function SendMessage (Sender, Receiver,ReceiverAdress,SenderName){


    text =   document.getElementById("MessageText").value
    if (window.XMLHttpRequest)  { xmlhttp=new XMLHttpRequest();} else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
    xmlhttp.onreadystatechange=function()
      {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
          document.getElementById("MessagesText").innerHTML=xmlhttp.responseText;
          // MNsendEmail(Sender, ReceiverAdress,text,SenderName);
          console.log("Messages.js SendMessage Sender = " + Sender + " Receiver = " + Receiver + " ReceiverAdress = "+ ReceiverAdress + " text = " + text + "SenderName=" + SenderName);
        }
      }
      
   xmlhttp.open("POST","content/Messages.php?Sender="+Sender+"&Receiver="+Receiver+"&Text="+encodeURIComponent(text)+"&SenderName="+SenderName,false);
  
  
console.log("SendMessage = " + text );
    xmlhttp.send();
}

// function MNsendEmail (Sender, Receiver,text,SenderName){
//   subject = "neue Nachrichten vom  ELDIB- Portal";
//   mytext = SenderName + " schreibt: "+ text;
//   sendEmail(Sender,Receiver,subject,mytext);
  
// }

// function sendEmail(name,email,subject,body) {
// console.log("Messages.js sendEmail email = " + email);
//       $.ajax({
//          url: 'sendEmail.php',
//          method: 'POST',
//          dataType: 'json',
//          data: {
//              name: name,
//              email: email,
//              subject: subject,
//              body: body
//          }, success: function (response) {

//               $('.sent-notification').text("Message Sent Successfully.");
//          }
//       });
// }

function isNotEmpty(caller) {
  if (caller.val() == "") {
      caller.css('border', '1px solid red');
      return false;
  } else
      caller.css('border', '');

  return true;
}