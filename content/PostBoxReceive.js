var PostBoxReceiveInterval;
var PostBoxReceiveTextLen;

var PostBoxReceiveTextLenOld;

function PostBoxReceiveOpen (){
    console.log('PostBoxReceiveOpen ');
    PostBoxReceiveFormulierungenID = 1;
clearInterval(PostBoxReceiveInterval);
      document.getElementById("MyPostBoxReceive").style.display = 'block';
      document.getElementById("MainNavigation").style.display = "none";
      document.getElementById("click").checked = false;
    if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest();} else{xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
    xmlhttp.onreadystatechange=function()
      {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
          PostBoxReceiveText = xmlhttp.responseText;
          PostBoxReceiveTextLen = PostBoxReceiveText.length;
          if (PostBoxReceiveTextLen != PostBoxReceiveTextLenOld){
          document.getElementById("MyPostBoxReceiveText").innerHTML=xmlhttp.responseText;
          PostBoxReceiveTextLenOld = PostBoxReceiveTextLen;
          }
          PostBoxReceiveInterval = setInterval(PostBoxReceiveOpen,1000);
        }
      }
    
   xmlhttp.open("POST","content/PostBoxReceive.php?PostBoxReceiveFormulierungenID="+PostBoxReceiveFormulierungenID,false);
  
  
console.log("PostBoxReceiveOpen = " + PostBoxReceiveFormulierungenID );
    xmlhttp.send();


}

function NoDisplayPostBoxReceive() {
  document.getElementById("MainNavigation").style.display = "inline-table";
  // alert('NoDisplayUserChat');
  document.getElementById("MyPostBoxReceive").style.display = 'none';
  clearInterval(PostBoxReceiveInterval);

 }


