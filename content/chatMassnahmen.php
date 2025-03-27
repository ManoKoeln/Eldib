<!-- <header(Content-type: text/html; charset=utf-8)>
<script src="ChatMassnahmen.js"></script> -->
<link href="CSS/ChatMassnahmen.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" media="screen and (max-aspect-ratio: 4/3)" href="CSS/ChatMassnahmenSmal.css" />
<body>
    <div  id="MyChatMassnahmen">
    <!-- <div class="container" id="MyChatMassnahmenText"> -->
		<div class="ChatMassnahmenDiv1" id="ChatMassnahmenDiv1">diese Funktion - ChatMassnahmenDiv1 - wir zur Zeit noch entwickelt</div>
		<div class="ChatMassnahmenDiv2" id="ChatMassnahmenDiv2">diese Funktion - ChatMassnahmenDiv2 - wir zur Zeit noch entwickelt</div>
		<div class="ChatMassnahmenDiv3">
		
		<button type="button" onclick="NoDisplayChatMassnahmen();" > schliessen</button>

		</div>
    </div>
</body>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Starten der Session nur, wenn keine Session aktiv ist
}

// session_start();
$last_id;

$MassnahmenText ;
$MassnahmenID ;
$ChatID ;
$Inhalt;
	//Chat Massnahmen erstellen
	include 'db.php';
	include_once("helpers.php");


//Chat Massnahmen anzeigen
if ( isset($_GET['MassnahmenID']) ){
	fMassnahmenID1();
	// fMassnahmenID2();
}

function fMassnahmenID1(){
	if (isset($_GET['MassnahmenID'])) {
		$MassnahmenID = $_GET['MassnahmenID'];
		$_SESSION['MassnahmenID'] = $MassnahmenID;
	}
	else
	{
		$MassnahmenID = $_SESSION['MassnahmenID'];
	}

	$Inhalt ="";
	//Linke Seite
	$Inhalt = $Inhalt.'<table class="ChatMassnahmenTabel">';
	$Inhalt = $Inhalt.'<tr class="ZielTab">';

	//   Beschreibungen holen
	if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }
	// Massnahmen
	$sql = "SELECT * FROM massnahmen WHERE id = '".$MassnahmenID."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat massnahmen: Error message: %s\n'. $db_link->error;
	}
	
	while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {		
		$myMassnahmenText = MyStringHTML($zeile['Text']);		
		$FormulierungenID = $zeile['FormulierungenID'];
		$myMassnahmenAutorID = $zeile['AutorID'];		
	}
			// Name des Autor eintragen
			if ($_SESSION['LocalChat'] == true){
				$db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
			}
			else{
			$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
			}
		
			$sqlAutor = "SELECT * FROM accounts WHERE userid = '".$myMassnahmenAutorID."'";
			$db_ergAutor = mysqli_query( $db_link, $sqlAutor );
			if ( ! $db_ergAutor )
			{
				$Inhalt =  'ungültige Bereich Abfrage Chat massnahmen: Error message: %s\n'. $db_link->error;
			}
	
	
			while ($zeileAutor = mysqli_fetch_array($db_ergAutor, MYSQLI_ASSOC)) {
	
				 $myMassnahmenAutor = $zeileAutor['USERNAME'];
	
			}	
	// Formulierungen

    if ($_SESSION['LocalChat'] == true){
		$db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
	  }
	  else{
	  $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
	  }


	$sql = "SELECT * FROM formulierungen WHERE id = '".$FormulierungenID."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n'. $db_link->error;
	}
	
	while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {		
		$myFormulierungenText = MyStringHTML($zeile['Text']);		
		$myZieleID = $zeile['ZieleID'];

	}
	//Ziele
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
	$sql = "SELECT * FROM ziele WHERE id = '".$myZieleID."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat massnahmen: Error message: %s\n'. $db_link->error;
	}


	while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
		$myZieleNummer = $zeile['ZieleNummer'];
		$myZieleStichwort = $zeile['ZieleStichwort'];
		$myZieleBeschreibung = MyStringHTML($zeile['ZieleBeschreibung']);
		$myBereichID = $zeile['BereichID'];

	}
	// Bereich
	$sql = "SELECT * FROM bereich WHERE id = '".$myBereichID."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat massnahmen: Error message: %s\n'. $db_link->error;
	}


	while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
		$myBereichText = MyStringHTML($zeile['Text']);
	}

	//Ende   Beschreibungen holen
	$Inhalt = $Inhalt.'<tr class="ZielTab">';
	$Inhalt = $Inhalt.'<td class="cMassnahmenText" colspan="3"><div onclick="MessageToAutor('.$myMassnahmenAutorID.')";>Autor dieses Eintrages ist : '.$myMassnahmenAutor.'</div></td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt.'<td class="BereichText" colspan="3">'.$myBereichText.'</td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt.'<td class="cZielZieleNummer">'.$myZieleNummer.' </td>';
	$Inhalt = $Inhalt.'<td class="cZielZieleStichwort">'.$myZieleStichwort.' </td>';
	$Inhalt = $Inhalt.'<td class="cZielZieleBeschreibung">'.nl2br($myZieleBeschreibung).' </td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt . '<td class="cFormulierungenText" colspan="3">' . nl2br($myFormulierungenText).'</td>';
	$Inhalt = $Inhalt.'</tr>';	
	$Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt . '<td class="cMassnahmenText" colspan="3">' . nl2br($myMassnahmenText).'</td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<td colspan="3">Deinen Beitrag eingeben :</td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt.'<td><form action="ELDiB.php" target="top" method="get">
	<textarea id="ChatTextMassnahmen" type="text/html" name="ChatEingabe" placeholder="Ihr Text"></textarea><br>	
	</form></td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt . '<td>';
	$Inhalt = $Inhalt . '<button type="button" onclick="SaveChatMassnahmen(' . MString2($MassnahmenID) . ');" > speichern</button></td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'</table>';	
	echo $Inhalt;
}
if ( isset($_GET['MassnahmenID2']) ){
	// fMassnahmenID1();
	fMassnahmenID2();
}
function fMassnahmenID2(){

	if (isset($_GET['MassnahmenID2'])) {
		$MassnahmenID = $_GET['MassnahmenID2'];
		$_SESSION['MassnahmenID'] = $MassnahmenID;
	}
	else
	{
		$MassnahmenID = $_SESSION['MassnahmenID'];
	}
	// rechte Seite
	
	$Inhalt = '<table class="ChatMassnahmenTabel">';
//_________________________________________________________________________

if ($_SESSION['LocalChat'] == true){
	$db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
}
else{
$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
}


$sql = "SELECT * FROM chatmassnahmen WHERE IDSource = '".$MassnahmenID."' ORDER BY  `chatmassnahmen`.`Time` DESC";
$db_erg = mysqli_query( $db_link, $sql );
if ( ! $db_erg )
{
	$Inhalt =  'ungültige Bereich Abfrage Chat massnahmen: Error message: %s\n'. $db_link->error;
}


while ($zeile = mysqli_fetch_array( $db_erg, MYSQLI_ASSOC))
{
	$Inhalt = $Inhalt .'<tr>';
	if (empty($zeile['IdUser'])){
		$Inhalt = $Inhalt .'<td class="ChatMassnahmenInfoText">';
		$Inhalt = $Inhalt .'<div class="ChatMassnahmenInfoDiv1" onclick="MessageToAutor('.$zeile['IdAutor'].')";">';	

		// Name des Autor eintragen
		if ($_SESSION['LocalChat'] == true){
			$db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
		}
		else{
		$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
		}
	
		$sqlAutor = "SELECT * FROM accounts WHERE userid = '".$zeile['IdAutor']."'";
		$db_ergAutor = mysqli_query( $db_link, $sqlAutor );
		if ( ! $db_ergAutor )
		{
			$Inhalt =  'ungültige Bereich Abfrage Chat massnahmen: Error message: %s\n'. $db_link->error;
		}


		while ($zeileAutor = mysqli_fetch_array($db_ergAutor, MYSQLI_ASSOC)) {
			// $Inhalt = $Inhalt .$zeileAutor['USERNAME'];
			if($zeile['deactivated'] <> 1){
				$Inhalt = $Inhalt .$zeileAutor['USERNAME'];
				}
				else
				{
					$Inhalt = $Inhalt .$zeileAutor['USERNAME'].' hat den Chat verlassen';	
				}
		}	
		
		$Inhalt = $Inhalt .'</div>';
	}
	else{
		$Inhalt = $Inhalt .'<td class="ChatMassnahmenInfoText">';
		$Inhalt = $Inhalt .'<div class="ChatMassnahmenInfoDiv1" onclick="MessageToAutor('.$zeile['IdUser'].')";>';

		// Name des Autor eintragen
		if ($_SESSION['LocalChat'] == true){
			$db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
		}
		else{
		$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
		}
	
		$sqlAutor = "SELECT * FROM accounts WHERE userid = '".$zeile['IdUser']."'";
		$db_ergAutor = mysqli_query( $db_link, $sqlAutor );
		if ( ! $db_ergAutor )
		{
			$Inhalt =  'ungültige Bereich Abfrage Chat massnahmen: Error message: %s\n'. $db_link->error;
		}


		while ($zeileAutor = mysqli_fetch_array($db_ergAutor, MYSQLI_ASSOC)) {
			if($zeile['deactivated'] <> 1){
			$Inhalt = $Inhalt .$zeileAutor['USERNAME'];
			}
			else
			{
				$Inhalt = $Inhalt .$zeileAutor['USERNAME'].' hat den Chat verlassen';	
			}
		}	

		$Inhalt = $Inhalt .'</div>';
	}
	$Inhalt = $Inhalt .'<div class="ChatMassnahmenInfoDiv2">';
	$Inhalt = $Inhalt .$zeile['Time'];
	$Inhalt = $Inhalt .'</div>';
	$Inhalt = $Inhalt .'</td>';
	$Inhalt = $Inhalt .'</tr>';
	$Inhalt = $Inhalt .'<tr>';
	$Inhalt = $Inhalt .'<td class="cMassnahmenText">';
	$Inhalt = $Inhalt .'<div>'.nl2br($zeile['Text']).'</div>';
	$Inhalt = $Inhalt .'</td>';
	$Inhalt = $Inhalt .'</tr>';
}

//__________________________________________________________________________
	$Inhalt = $Inhalt.'<tr>';

	$Inhalt = $Inhalt.'</table>';
	echo $Inhalt;

}		
		


// Chat Eintrag sichern

if ( isset($_GET['SaveChatMassnahmen']) ){


	$Inhalt = "";

	echo '<script>console.log("php Debug Objects: ' . $_GET['ChatText']. '");</script>';
	
	// neuen Chat anlegen
	if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }

		$sql =  "INSERT INTO  `chatmassnahmen` (`id`, `IDSource`, `IdUser`,  `Text`, `Time`) VALUES (NULL, '".$_GET['SaveChatMassnahmen']."', '".$_SESSION['userid']."', '".$_GET['ChatText']."', current_timestamp());";
		// $sql = "INSERT INTO  `chatmassnahmen` (`id`, `IDSource`, `IdUser`,  `Text`, `Time`, `Bereich`, `Ziel1`, `Ziel2`, `Ziel3`, `Massnahmen`) VALUES (NULL, '".$_SESSION['MassnahmenID']."', '".$_SESSION['username']."', '".$_SESSION['ChatText']."', current_timestamp(), '".$_SESSION["bereich1"]."', '".$_SESSION["ZieleZieleNummer"]."', '".$_SESSION["ZieleZieleStichwort"]."', '".$_SESSION["ZieleZieleBeschreibung"]."', '".$_SESSION['MassnahmenText']."');";
	$db_erg = mysqli_query( $db_link, $sql );
	// $db_erg = mysqli_real_escape_string( $db_link, $sql );
	if ( ! $db_erg )
	{
		echo 'ungültige Bereich neuen Chat anlegen: Error message: %s\n'. $db_link->error;
	}
	$_SESSION['MassnahmenID'] = $_GET['SaveChatMassnahmen'];
	// fMassnahmenID1();
	//  fMassnahmenID2();
	  echo '<script>php copyMassnahmen("'.$_GET['SaveChatMassnahmen'].','.$_GET['ChatText'].'")</script>';
		
		}

// function debug_to_console($data) {
// 	$output = $data;
// 	if (is_array($output))
// 		$output = implode(',', $output);

// 	echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
// }   
function MString2 ($text){
	$NewText = strtr($text,'"','\"');

	// str_replace(["\\r\\n","\\r","\\n"],'<br/>',$text);
	// $NewText = strtr($NewText,'°','&deg;');
	// $NewText = htmlentities($NewText);
	$NewText = $text;

	return ("'".$NewText."'");
}
?>