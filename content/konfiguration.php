<?php
$included_files = get_included_files();
$Helpersfound = 0;
foreach ($included_files as $filename) {
    // echo "$filename\n".'<br>';
	if ($filename == "helpers.php"){
		$Helpersfound = 1;
	}

	}
if ($Helpersfound == 0){
	
	include_once("helpers.php");
}

require ('db.php');
// if ( isset($_GET['SelectionSchool'])){
// 	session_start();
// 	$sql = "SELECT * FROM hostschool WHERE id = '".$_GET['SelectionSchool']."'";
// 	$db_erg = mysqli_query( $db_link, $sql );
// 	if ( ! $db_erg )
// 	{
// 		$Inhalt = 'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_link->error;
// 	}
	
// 		while ($zeile = mysqli_fetch_assoc( $db_erg))
// 	{
// 		$_SESSION["host_nameSchool"]=$zeile['host_name']; 
// 		$_SESSION["databaseSchool"]=$zeile['data_base']; 
// 		$_SESSION["user_nameSchool"]=$zeile['user_name']; 
// 		$_SESSION["passwordSchool"]=$zeile['password'];
// 	}

// }




$parent = '';
$parentText = '';

// Load Ziele
if ( isset($_GET['Bereich']) )
{
    $parent = $_GET['Bereich'];
    $_SESSION["bereich1"] = $_GET['Bereich'];
    $_SESSION["BereichText"] = $_GET['BereichText'];
 	$parentText = $_GET['BereichText'];

	$Inhalt ="";
	

	$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);

	//global $BereichID;
	$BereichID = $parent;

	$sql = "SELECT * FROM ziele WHERE BereichID = '".$parent."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt = 'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_link->error;
	}

	$Inhalt = $Inhalt = '<table id="containerZiele" >'; 
		
		while ($zeile = mysqli_fetch_assoc( $db_erg))
	{
		$Inhalt = $Inhalt . '<tr class="ZielTab" >';
		$Inhalt = $Inhalt .'<td class="ZielZieleStufe" >'.$zeile['Stufe'].'</td>';
		$Inhalt = $Inhalt .'<td class="ZielZieleNummer"  ondblclick="TakeOverZiele('.MyString($zeile['id']).');" onclick="copyZiele('.$zeile['id'].','.MyString($zeile['ZieleNummer']).','.MyStringClip($zeile['ZieleNummer']).');" >'.$zeile['ZieleNummer'].'</td>';
		$Inhalt = $Inhalt .'<td class="ZielZieleStichwort"  ondblclick="TakeOverZiele('.MyString($zeile['id']).');" onclick="copyZiele('.MyString($zeile['id']).','.MyString($zeile['ZieleNummer']).','.MyStringClip($zeile['ZieleStichwort']).');">'.MyStringHTML($zeile['ZieleStichwort']).'</td>';
		$Inhalt = $Inhalt .'<td class="ZielZieleBeschreibung"  ondblclick="TakeOverZiele('.MyString($zeile['id']).');" onclick="copyZiele('.MyString($zeile['id']).','.MyString($zeile['ZieleNummer']).','.MyStringClip($zeile['ZieleBeschreibung']).');"> '.MyStringHTML($zeile['ZieleBeschreibung']).'</td>';


		$Inhalt = $Inhalt .'<td>';

	
		if ( $_SESSION["username"] == "Mano" ){				
		$Inhalt = $Inhalt .'<div type="text" class="ButtonEdit" onclick="EditZiele('.$zeile['id'].','.$parent.','.MyString($zeile['ZieleBeschreibung']).','.MyString($zeile['ZieleStichwort']).');">Edit</div>';
		}
		$Inhalt = $Inhalt .'</td>';
		$Inhalt = $Inhalt . "</tr>";
	}
	$Inhalt = $Inhalt . "</table>";			
	echo $Inhalt;
}

		
// function LoadFormulierungen ($db_link,$parent="") 
if ( isset($_GET['Ziele']) )
{
	$parent = $_GET['Ziele'];
		
	if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }

	// LoadZiele ($db_link,$BereichID);

	$sql = "SELECT * FROM formulierungen WHERE ZieleID = '".$parent."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt = 'ungültige Bereich Abfrage formulierungen: Error message: %s\n'. $db_link->error;
	}

	$Inhalt = '<table id="containerFormulierungen">'; 

	while ($zeile = mysqli_fetch_assoc( $db_erg))
	{
		$Inhalt = $Inhalt .  '<tr class="FormulierungTab" >'; // FormulierungTabelleStyle

		$Inhalt = $Inhalt .'<td >
		<div  class="FormulierungenText" ondblclick="TakeOverFormulierungen('.MyString($zeile['id']).');" onclick="copyFormulierungen('.$zeile['id'].','.MyStringClip($zeile['Text']).');"        				
		>'.MyStringHTML($zeile['Text']).'</div> 
		</td><td>';

		// chat vorhanden ?
		if ($_SESSION['LocalChat'] == true){
			$db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
		}
		else{
			$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"] ,$_SESSION["database"]);
		}
		$Chatsql = "SELECT * FROM  chatformulierungen WHERE IDSource = '".$zeile['id']."'";
		$Chatdb_erg = mysqli_query( $db_link, $Chatsql );
		if ( ! $Chatdb_erg )
		{
		$Inhalt = 'ungültige Bereich Abfrage formulierungen: Error message: %s\n'. $db_link->error;
		}
		$ChatActiveMembers = false;
		$ChatPresent = false;
		while ($Chatzeile = mysqli_fetch_assoc( $Chatdb_erg)){
			$ChatPresent = true;
			if($Chatzeile['deactivated'] == 0){
				$ChatActiveMembers = true;
			}
		}


		if (($zeile['AutorID'] == $_SESSION["userid"] OR $_SESSION["username"] == 'Mano') AND ($ChatPresent == false OR $ChatActiveMembers == false)){
			$Inhalt = $Inhalt .'<div type="text" class="ButtonDelete" onclick="PopUpDeleteFormulierungen('.$zeile['id'].','.$zeile['ZieleID'].');">Delete</div><br>';						
		}

		if ($zeile['AutorID'] == $_SESSION["userid"] OR $_SESSION["username"] == 'Mano'){					
			$Inhalt = $Inhalt .'<div type="text" class="ButtonEdit" onclick="PopUpEditFormulierungen('.$zeile['id'].','.$zeile['ZieleID'].');">Edit</div><br>';
		}

		if ($ChatPresent){			
			$Inhalt = $Inhalt .'<div class="ButtonQuestion" onclick="CallChatFormulierungen('.$zeile['id'].');" data-hover="Fragen an den Autor" >Fragen</div></td>';			
		}
		else{									
			$Inhalt = $Inhalt .'<div class="ButtonNewQuestion" onclick="CallChatFormulierungen('.$zeile['id'].');" data-hover="Fragen an den Autor" >Fragen</div></td>';	
		}
		$Inhalt = $Inhalt .  '</tr>';
	}
	$Inhalt = $Inhalt .  '<tr  >'; // MassnahmTabelleStyle Insert Button
	// $Inhalt = $Inhalt .'<td >
	// <div type="text" class="FormulierungenText"             				
	// onclick="InsertFormulierungen('.$parent.');">Formulierungen hinzufügen</div> 
	// </td>';
	$Inhalt = $Inhalt .'<td >
	<div type="text" class="FormulierungenText"             				
	onclick="PopUpInsertFormulierungen('.$parent.');">Formulierungen hinzufügen</div> 
	</td>';
	$Inhalt = $Inhalt .  '</tr>';

	$Inhalt = $Inhalt .  '</table>';

	echo $Inhalt;
}
		
// function LoadMassnahmen ($db_link,$parent="") 
	if ( isset($_GET['Formulierungen']) )
	{
		$parent = $_GET['Formulierungen'];	
		print("<script>console.log('function LoadMassnahmen: ' );</script>");

	if ($_SESSION['LocalChat'] == true){
		$db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
	}
	else{
	$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
	}

	$sql = "SELECT * FROM massnahmen WHERE FormulierungenID = '".$parent."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_link->error;
	}

	$Inhalt =   '<table id="containerMassnahmen">'; 

	while ($zeile = mysqli_fetch_array( $db_erg, MYSQLI_ASSOC))
	{
		//_____________________
		// chat vorhanden ?
		if ($_SESSION['LocalChat'] == true){
			$db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
		}
		else{
		$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
		}
		$Chatsql = "SELECT * FROM  chatmassnahmen WHERE IDSource = '".$zeile['id']."'";
		$Chatdb_erg = mysqli_query( $db_link, $Chatsql );
		if ( ! $Chatdb_erg )
		{
		$Inhalt = 'ungültige Bereich Abfrage massnahmen: Error message: %s\n'. $db_link->error;
		}
		$ChatActiveMembers = false;
		$ChatPresent = false;
		while ($Chatzeile = mysqli_fetch_assoc( $Chatdb_erg)){
			$ChatPresent = true;
			if($Chatzeile['deactivated'] == 0){
				$ChatActiveMembers = true;
			}
		}

		$Inhalt = $Inhalt .  '<tr class="MassnahmenTab" >'; // MassnahmTabelleStyle
		//$Inhalt = $Inhalt .'<td class="MassnahmenText">
		$Inhalt = $Inhalt .'<td >
		<div type="text" class="MassnahmenText" ondblclick="TakeOverMassnahmen('.MyString($zeile['id']).');"           				
		onclick="copyMassnahmen('.MyStringClip($zeile['Text']).');">'.MyStringHTML($zeile['Text']).'</div> 
		</td><td>';
		if (($zeile['AutorID'] == $_SESSION["userid"] or $_SESSION["username"] == 'Mano') and ($ChatPresent == false or $ChatActiveMembers == false)) {
			$Inhalt = $Inhalt .'<div type="text" class="ButtonDelete" onclick="PopUpDeleteMassnahmen('.$zeile['id'].','.$zeile['FormulierungenID'].');">Delete</div><br>';			

		}
		if ($zeile['AutorID'] == $_SESSION["userid"] OR $_SESSION["username"] == 'Mano'){


			
			$Inhalt = $Inhalt .'<div type="text" class="ButtonEdit" onclick="PopUpEditMassnahmen('.$zeile['id'].','.$zeile['FormulierungenID'].');">Edit</div><br>';
		}

			if ($ChatPresent){
				
				$Inhalt = $Inhalt .'<div class="ButtonQuestion" onclick="CallChatMassnahmen('.$zeile['id'].');" data-hover="Fragen an den Autor" >Fragen</div></td>';
				// $Inhalt = $Inhalt .'<div class="ButtonQuestion" onclick="CallChatFormulierungen('.$zeile['id'].','.MyString($zeile['Text']).','.$zeile['ChatId'].');" data-hover="Fragen an den Autor" >Fragen</div></td>';
			}
			else{
				
				
				$Inhalt = $Inhalt .'<div class="ButtonNewQuestion" onclick="CallChatMassnahmen('.$zeile['id'].');" data-hover="Fragen an den Autor" >Fragen</div></td>';	
			}

//_____________________




		// $Inhalt = $Inhalt .'<div class="ButtonQuestion" onclick="ChatMassnahmen();">Fragen</div></td>';
		$Inhalt = $Inhalt .  '</tr>';
	}
	$Inhalt = $Inhalt .  '<tr >'; // MassnahmTabelleStyle Insert Button
	// $Inhalt = $Inhalt .'<td class="MassnahmenText">
	// <div type="text"         				
	// onclick="InsertMassnahmen('.$parent.');">Massnahme hinzufügen</div> 
	// </td>';
	$Inhalt = $Inhalt .'<td >
	<div type="text" class="MassnahmenText"             				
	onclick="PopUpInsertMassnahmen('.$parent.');">Massnahmen hinzufügen</div> 
	</td>';

	$Inhalt = $Inhalt .  '</tr>';

	$Inhalt = $Inhalt .  "</table>";
	echo $Inhalt;
}
// Edit Ziele
if ( isset($_GET['EditZiele']) )
{
	$parent = $_GET['EditZiele'];
	$ZieleId = $_GET['ZieleId'];
	$TextZiele = $_GET['TextZiele'];

	// ZieleId="+id+"&TextZiele
	

	$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
	$sql = "UPDATE `ziele` SET `ZieleBeschreibung` = '".$TextZiele."' WHERE `ziele`.`id` = '".$ZieleId."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige EditZiele: Error message: %s\n'. $db_link->error;
	}	
}
// neue Massnahme
if ( isset($_GET['NewMassnahmen']) )
{
	$parent = $_GET['NewMassnahmen'];
	$TextMassnahme = $_GET['TextMassnahmen'];
	
	if ($_SESSION['LocalChat'] == true){
		$db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
	}
	else{
	$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
	}

	$sql = "INSERT INTO `massnahmen` (`id`, `FormulierungenID`, `Text`, `AutorID`) VALUES (NULL, '".$parent."', '".$TextMassnahme."', '".$_SESSION["userid"]."')";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige NewMassnahmen: Error message: %s\n'. $db_link->error;
	}	
}
// DelMassnahmen
if ( isset($_GET['DelMassnahmen']) )
{
	$parent = $_GET['DelMassnahmen'];
	
	if ($_SESSION['LocalChat'] == true){
		$db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
	}
	else{
	$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
	}
	$sql = "DELETE FROM `massnahmen` WHERE `massnahmen`.`id` = '".$parent."'";	
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige DelMassnahmen: Error message: %s\n'. $db_link->error;
	}	
}

// neue Formulierung
if ( isset($_GET['NewFormulierungen']) )
{
	$parent = $_GET['NewFormulierungen'];
	$TextFormulierungen = $_GET['TextFormulierungen'];
	
	if ($_SESSION['LocalChat'] == true){
		$db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
	}
	else{
	$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
	}

	$sql = "INSERT INTO `formulierungen` (`id`, `ZieleID`, `AutorID`, `Text`) VALUES (NULL, '".$parent."', '".$_SESSION["userid"]."' , '".$TextFormulierungen."')";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige NewFormulierungen: Error message: %s\n'. $db_link->error;
	}	

}
// DelFormulierungen
if ( isset($_GET['DelFormulierungen']) )
{
	$parent = $_GET['DelFormulierungen'];
	
	if ($_SESSION['LocalChat'] == true){
		$db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
	}
	else{
	$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
	}
	$sql = "DELETE FROM `formulierungen` WHERE `formulierungen`.`id` = '".$parent."'";	
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige DelFormulierungen: Error message: %s\n'. $db_link->error;
	}	
}


function cuttext ($Text,$Len){

	$MyText = "";

	$MyText = chunk_split( $Text,  $Len ,  $separator = "\r\n");
	return $MyText;
}




//chat füllen	
if ( isset($_GET['ChatFormulierungen']) ){
	// print("<script>console.log('chat füllen' );</script>");
  $Inhalt = "Inhalt von chat = ";
	$Inhalt = $Inhalt.$_GET['ChatFormulierungen'];
	$Inhalt = $Inhalt.'<br>';
	$Inhalt = $Inhalt.'<button>save changes</button>';
	$Inhalt = $Inhalt.'<br>';
	$Inhalt = $Inhalt."test text ChatFormulierungen";
	echo $Inhalt;
		}


?>