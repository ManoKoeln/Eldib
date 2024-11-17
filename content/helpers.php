<?php
function MyString ($text){
	$order   = array("\r\n", "\n", "\r");
	$replace = '<br>';
	
	$NewText =  str_replace($order,$replace,$text);
	return ("'".$NewText."'");
}
function MyStringHTML ($text){
	$order   = array("\r\n", "\n", "\r");
	$replace = '<br>';	
	$NewText =  str_replace($order,$replace,$text);
	return ($NewText);
}
function MyStringClip ($text){

	$NewText =  str_replace("\r\n","\\r\\n",$text);	
	$NewText =  str_replace("\n","\\n",$NewText);	
	$NewText =  str_replace("\r","\\r",$NewText);
	$NewText = htmlentities($NewText);
	return ("'".$NewText."'");
}
function MyStringLF ($text){
	$NewText = htmlentities($text);
	return ($NewText);
}
?>