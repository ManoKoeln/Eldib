var PostBoxSendInterval;
var PostBoxSendTextLen;

var PostBoxSendTextLenOld;

function PostBoxSendOpen (){
    console.log('PostBoxSendOpen ');
    PostBoxSendFormulierungenID = 1;
clearInterval(PostBoxSendInterval);
      document.getElementById("MyPostBoxSend").style.display = 'block';
      document.getElementById("MainNavigation").style.display = "none";
      document.getElementById("click").checked = false;
    if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest();} else{xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
    xmlhttp.onreadystatechange=function()
      {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
          PostBoxSendText = xmlhttp.responseText;
          PostBoxSendTextLen = PostBoxSendText.length;
          if (PostBoxSendTextLen != PostBoxSendTextLenOld){
          document.getElementById("MyPostBoxSendText").innerHTML=xmlhttp.responseText;
          PostBoxSendTextLenOld = PostBoxSendTextLen;
          }
          PostBoxSendInterval = setInterval(PostBoxSendOpen,1000);
        }
      }
    
   xmlhttp.open("POST","content/PostBoxSend.php?PostBoxSendFormulierungenID="+PostBoxSendFormulierungenID,false);
  
  
console.log("PostBoxSendOpen = " + PostBoxSendFormulierungenID );
    xmlhttp.send();


}
function NoDisplayPostBoxSend() {
  document.getElementById("MainNavigation").style.display = "inline-table";
  // alert('NoDisplayUserChat');
  document.getElementById("MyPostBoxSend").style.display = 'none';
  clearInterval(PostBoxSendInterval);

 }

