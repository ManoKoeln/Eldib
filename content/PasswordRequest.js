function MNsendEmailPW (Receiver,password){
    alert("MNsendEmailPW");
    Sender = "ELDiB Portal"

    subject = "neue Nachrichten vom  ELDIB- Portal";
    mytext = "dein neues Passwort ist : '" + password + "'";
    sendEmailPW(Sender,Receiver,subject,mytext);
    console.log("Sender : "+Sender+" ,Receiver : "+Receiver+" ,subject : "+subject+" , mytext : "+mytext);
    
  }
  function sendEmailPW(name,email,subject,body) {
    console.log("Messages.js sendEmail email = " + email);
          $.ajax({
             url: 'sendEmail.php',
             method: 'POST',
             dataType: 'json',
             data: {
                 name: name,
                 email: email,
                 subject: subject,
                 body: body
             }, success: function (response) {
    
                  $('.sent-notification').text("Message Sent Successfully.");
             }
          });
    }
    function ChangedSelectionSchool(){
    
      let school = document.getElementById("SelectSchool").value; 
      console.log("Start PasswortRequestChangedSelectionSchool =" + school);    
      if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
    xmlhttp.onreadystatechange=function()
    {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
          // document.getElementById("ELDiBLehrercontent").innerHTML=xmlhttp.responseText;
      }
    }
  
  xmlhttp.open("POST","../content/PasswordRequest.php?SelectionSchoolValue="+school,false);
  xmlhttp.send();
  
  }