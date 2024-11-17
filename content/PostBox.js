var PostBoxInterval;
var PostBoxTextLen;

var PostBoxTextLenOld;

function PostBoxOpen (){
    console.log('PostBoxOpen ');
    PostBoxFormulierungenID = 1;
clearInterval(PostBoxInterval);
      document.getElementById("MyPostBox").style.display = 'block';
      document.getElementById("MainNavigation").style.display = "none";
      document.getElementById("click").checked = false;
    if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest();} else{xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
    xmlhttp.onreadystatechange=function()
      {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
          PostBoxText = xmlhttp.responseText;
          PostBoxTextLen = PostBoxText.length;
          if (PostBoxTextLen != PostBoxTextLenOld){
          document.getElementById("MyPostBoxText").innerHTML=xmlhttp.responseText;
          PostBoxTextLenOld = PostBoxTextLen;
          }
          PostBoxInterval = setInterval(PostBoxOpen,1000);
        }
      }
    
   xmlhttp.open("POST","PostBox.php?PostBoxFormulierungenID="+PostBoxFormulierungenID,false);
  
  
console.log("PostBoxOpen = " + PostBoxFormulierungenID );
    xmlhttp.send();


}


