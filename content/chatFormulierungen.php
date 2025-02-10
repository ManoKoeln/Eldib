<!-- <header(Content-type: text/html; charset=utf-8)>
<script src="ChatFormulierungen.js"></script> -->
<?php
$FormulierungenID ;
?>
<link href="css/ChatFormulierungen.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" media="screen and (max-aspect-ratio: 4/3)" href="CSS/ChatFormulierungenSmal.css" />
<body>
    <div  id="MyChatFormulierungen" >
    <!-- <div class="container" id="MyChatFormulierungenText"> -->
		<div class="ChatFormulierungenDiv1" id="ChatFormulierungenDiv1"></div>
		<div class="ChatFormulierungenDiv2" id="ChatFormulierungenDiv2"></div>
	<!-- </div> -->
	<div class="ChatFormulierungenDiv3">
	<button type="button" onclick="NoDisplayChatFormulierungen();" > schliessen</button>
	</div>
    </div>
</body>
<?php
include_once("helpers.php");
// session_start();
$last_id;

$FormulierungenText ;
$FormulierungenID ;
$ChatID ;
$Inhalt;
	//Chat Formulierungen erstellen
	include 'db.php';

//Chat Formulierungen anzeigen
if ( isset($_GET['FormulierungenID']) ){
	fFormulierungenID1();
	// fFormulierungenID2();
}

function fFormulierungenID1(){
	if (isset($_GET['FormulierungenID'])) {
		$FormulierungenID = $_GET['FormulierungenID'];
		$_SESSION['FormulierungenID'] = $FormulierungenID;
	}
	else
	{
		$FormulierungenID = $_SESSION['FormulierungenID'];
	}

	$Inhalt ="";
	//Linke Seite
	$Inhalt = $Inhalt.'<table class="ChatFormulierungenTabel">';
	$Inhalt = $Inhalt.'<tr class="ZielTab">';
//-----------------------------------------------------------------------------------------------------------------------
	//   Beschreibungen holen
	if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }
	// Formulierungen
	$sql = "SELECT * FROM formulierungen WHERE id = '".$FormulierungenID."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n'. $db_link->error;
	}
	
	while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {		
		$myFormulierungenText = MyStringHTML($zeile['Text']);		
		$myZieleID = $zeile['ZieleID'];
		$myFormulierungenAutorID = $zeile['AutorID'];		
	}
			// Name des Autor eintragen
			if ($_SESSION['LocalChat'] == true){
				$db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
			}
			$sqlAutor = "SELECT * FROM accounts WHERE userid = '".$myFormulierungenAutorID."'";
			$db_ergAutor = mysqli_query( $db_link, $sqlAutor );
			if ( ! $db_ergAutor )
			{
				$Inhalt =  'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n'. $db_link->error;
			}
	
	
			while ($zeileAutor = mysqli_fetch_array($db_ergAutor, MYSQLI_ASSOC)) {
	
				 $myFormulierungenAutor = $zeileAutor['USERNAME'];
	
			}	

	//Ziele
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
	$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"] ,$_SESSION["database"]);
	$sql = "SELECT * FROM ziele WHERE id = '".$myZieleID."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n'. $db_link->error;
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
		$Inhalt =  'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n'. $db_link->error;
	}


	while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
		$myBereichText = MyStringHTML($zeile['Text']);
	}

	//Ende   Beschreibungen holen
	//------------------------------------------------------------------------------------------------------------
	$Inhalt = $Inhalt.'<tr class="ZielTab">';
	$Inhalt = $Inhalt.'<td class="cFormulierungenText" colspan="3"><div onclick="MessageToAutor('.$myFormulierungenAutorID.')";>Autor dieses Eintrages ist : '.$myFormulierungenAutor.'</div></td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt.'<td class="BereichText" colspan="3">'.$myBereichText.'</td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr><div class="ZielText">';
	$Inhalt = $Inhalt.'<td class="cZielZieleNummer">'.$myZieleNummer.' </td>';
	$Inhalt = $Inhalt.'<td class="cZielZieleStichwort">'.$myZieleStichwort.' </td>';
	$Inhalt = $Inhalt.'<td class="cZielZieleBeschreibung">'.$myZieleBeschreibung.' </td>';
	$Inhalt = $Inhalt.'</div></tr>';
	$Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt . '<td class="cFormulierungenText" colspan="3">' . $myFormulierungenText.'</td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<td colspan="3">Deinen Beitrag eingeben :</td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt.'<td><form action="ELDiB.php" target="top" method="get">
	<textarea id="ChatTextFormulierungen" type="text/html" name="ChatEingabe" placeholder="Ihr Text"></textarea><br>	
	</form></td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt.'<td>';													
	$Inhalt = $Inhalt.'<button type="button" onclick="SaveChatFormulierungen('.MyString($FormulierungenID).');" > speichern</button></td>';	
	$Inhalt = $Inhalt.'</tr>';
	// $Inhalt = $Inhalt.'<tr>';
	// $Inhalt = $Inhalt.'<td>';
	// $Inhalt = $Inhalt.'<button type="button" onclick="NoDisplayChatFormulierungen();" > schliessen</button></td>';
	// $Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'</table>';	
	echo $Inhalt;
}
if ( isset($_GET['FormulierungenID2']) ){
	// fFormulierungenID1();
	fFormulierungenID2();
}
function fFormulierungenID2(){

	if (isset($_GET['FormulierungenID2'])) {
		$FormulierungenID = $_GET['FormulierungenID2'];
		$_SESSION['FormulierungenID'] = $FormulierungenID;
	}
	else
	{
		$FormulierungenID = $_SESSION['FormulierungenID'];
	}
	// rechte Seite
	
	$Inhalt = '<table class="ChatFormulierungenTabel">';
//_________________________________________________________________________
if ($_SESSION['LocalChat'] == true){
	$db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
}
else{
$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"] ,$_SESSION["database"]);
}

$sql = "SELECT * FROM chatformulierungen WHERE IDSource = '".$FormulierungenID."' ORDER BY  `chatformulierungen`.`Time` DESC";
$db_erg = mysqli_query( $db_link, $sql );
if ( ! $db_erg )
{
	$Inhalt =  'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n'. $db_link->error;
}


while ($zeile = mysqli_fetch_array( $db_erg, MYSQLI_ASSOC))
{
	$Inhalt = $Inhalt .'<tr>';
	if (empty($zeile['IdUser'])){
		$Inhalt = $Inhalt .'<td class="ChatFormulierungenInfoText">';
		$Inhalt = $Inhalt .'<div class="ChatFormulierungenInfoDiv1" onclick="MessageToAutor('.$zeile['IdAutor'].')";">';	

		// Name des Autor eintragen
		if ($_SESSION['LocalChat'] == true){
			$db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
		}
		else{
		$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"] ,$_SESSION["database"]);
		}
		$sqlAutor = "SELECT * FROM accounts WHERE userid = '".$zeile['IdAutor']."'";
		$db_ergAutor = mysqli_query( $db_link, $sqlAutor );
		if ( ! $db_ergAutor )
		{
			$Inhalt =  'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n'. $db_link->error;
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
		$Inhalt = $Inhalt .'<td class="ChatFormulierungenInfoText">';
		$Inhalt = $Inhalt .'<div class="ChatFormulierungenInfoDiv1" onclick="MessageToAutor('.$zeile['IdUser'].')";>';

		// Name des Autor eintragen
		if ($_SESSION['LocalChat'] == true){
			$db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
		}
		else{
		$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"] ,$_SESSION["database"]);
		}
		$sqlAutor = "SELECT * FROM accounts WHERE userid = '".$zeile['IdUser']."'";
		$db_ergAutor = mysqli_query( $db_link, $sqlAutor );
		if ( ! $db_ergAutor )
		{
			$Inhalt =  'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n'. $db_link->error;
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
	$Inhalt = $Inhalt .'<div class="ChatFormulierungenInfoDiv2">';
	$Inhalt = $Inhalt .$zeile['Time'];
	$Inhalt = $Inhalt .'</div>';
	$Inhalt = $Inhalt .'</td>';
	$Inhalt = $Inhalt .'</tr>';
	$Inhalt = $Inhalt .'<tr>';
	$Inhalt = $Inhalt .'<td class="FormulierungenText">';
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

if ( isset($_GET['SaveChatFormulierungen']) ){

	echo "SaveChatFormulierungen gestartet"."\r\n";
	$Inhalt = "";

	echo 'ChatText : ' . $_GET['ChatText']."\r\n";
	
// neuen Chat anlegen
	if ($_SESSION['LocalChat'] == true){
		$db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
	}
	else{
	$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"] ,$_SESSION["database"]);
	}
	
	$sql =  "INSERT INTO  `chatformulierungen` (`id`, `IDSource`, `IdUser`,  `Text`, `Time`) VALUES (NULL, '".$_GET['SaveChatFormulierungen']."', '".$_SESSION['userid']."', '".$_GET['ChatText']."', current_timestamp());";
	$db_erg = mysqli_query( $db_link, $sql );
	
	if ( ! $db_erg )
	{
		echo 'ungültige Bereich neuen Chat anlegen: Error message: %s\n'. $db_link->error;
	}
	$_SESSION['FormulierungenID'] = $_GET['SaveChatFormulierungen'];

	  echo 'SaveChatFormulierungen: '.$_GET['SaveChatFormulierungen'].',ChatText = '.$_GET['ChatText']."\r\n";
//-----------------------------------------------------------------------------------------------------------------------
	//   Beschreibungen holen	
	// Formulierungen
	if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }
	$sql = "SELECT * FROM formulierungen WHERE id = '".$_GET['SaveChatFormulierungen']."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n'. $db_link->error;
	}
	
	while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {		
		$myFormulierungenText = MyStringHTML($zeile['Text']);		
		$myZieleID = $zeile['ZieleID'];
		$myFormulierungenAutorID = $zeile['AutorID'];		
	}
			// Name des Autor eintragen
			if ($_SESSION['LocalChat'] == true){
				$db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
			}
			else{
			$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"] ,$_SESSION["database"]);
			}
			$sqlAutor = "SELECT * FROM accounts WHERE userid = '".$myFormulierungenAutorID."'";
			$db_ergAutor = mysqli_query( $db_link, $sqlAutor );
			if ( ! $db_ergAutor )
			{
				$Inhalt =  'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n'. $db_link->error;
			}
	
	
			while ($zeileAutor = mysqli_fetch_array($db_ergAutor, MYSQLI_ASSOC)) {
	
				 $myFormulierungenAutor = $zeileAutor['USERNAME'];
	
			}	

	//Ziele
	$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"] ,$_SESSION["database"]);
	$sql = "SELECT * FROM ziele WHERE id = '".$myZieleID."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n'. $db_link->error;
	}


	while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
		$myZieleNummer = $zeile['ZieleNummer'];
		$myZieleStichwort = $zeile['ZieleStichwort'];
		$myZieleBeschreibung = MyStringHTML($zeile['ZieleBeschreibung']);
		$myBereichID = $zeile['BereichID'];

	}
	// Bereich
	$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"] ,$_SESSION["database"]);
	$sql = "SELECT * FROM bereich WHERE id = '".$myBereichID."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n'. $db_link->error;
	}
	while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
		$myBereichText = MyStringHTML($zeile['Text']);
	}

	//Ende   Beschreibungen holen
//------------------------------------------------------------------------------------------------------------

	// $MyChatDescription = "Bereich : " . $myBereichText . "\r\n" . "Ziel : " . $myZieleStichwort . "\r\n" . "Formulierung : " . $myFormulierungenText;
	$MyChatDescription = "Bereich : " . $myBereichText . "<br>" . "Ziel : " . $myZieleStichwort . "<br>" . "Formulierung : " . $myFormulierungenText;
	//alle ChatTeilnehmer benachichtigen
	// $sql =  "INSERT INTO  `chatformulierungen` (`id`, `IDSource`, `IdUser`,  `Text`, `Time`) VALUES (NULL, '".$_GET['SaveChatFormulierungen']."', '".$_SESSION['userid']."', '".$_GET['ChatText']."', current_timestamp());";
	if ($_SESSION['LocalChat'] == true){
		$db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
	}
	else{
	$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"] ,$_SESSION["database"]);
	}
	$sql = "SELECT * FROM chatformulierungen WHERE IDSource = '".$_GET['SaveChatFormulierungen']."'";
	$db_erg = mysqli_query( $db_link, $sql );
	// echo "<Script>console.log('TEST 0 Log from Send email from Chat')</Script>";
	if ( ! $db_erg )
	{
		echo 'ungültige Bereich neuen Chat anlegen: Error message: %s\n'. $db_link->error;
	}
	while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
		$myIdUser = MyStringHTML($zeile['IdUser']);
		//Setup abfragen ob der user benachichtigt werden will
		if ($_SESSION['LocalChat'] == true){
			$db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
		}
		else{
		$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"] ,$_SESSION["database"]);
		}
		$sqlSetup = "SELECT * FROM usersetup WHERE userid = '".$zeile['IdUser']."'";
		$db_ergSetup = mysqli_query( $db_link, $sqlSetup );
		if ( ! $db_ergSetup )
		{
			$Inhalt =  'ungültige Bereich Abfrage Chat massnahmen: Error message: %s\n'. $db_link->error;
		}
		
		
		while ($zeileSetup = mysqli_fetch_array($db_ergSetup, MYSQLI_ASSOC)) {
			
			$Reciversendchat = $zeileSetup['sendchat'];
				
		}
		// echo "<Script>console.log('TEST 1 Log from Send email from Chat')</Script>";
		if ($Reciversendchat == 1) {
			//Postfach des Users abfragen ob er schon benachichtigt wurde
			if ($_SESSION['LocalChat'] == true){
				$db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
			}
			else{
			$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"] ,$_SESSION["database"]);
			}
			$sqlPostBox = "SELECT * FROM postbox WHERE ReceiverID = '".$zeile['IdUser']."'";
			$db_ergPostBox = mysqli_query( $db_link, $sqlPostBox );
			if ( ! $db_ergPostBox )
			{
				$Inhalt =  'ungültige Bereich Abfrage Chat massnahmen: Error message: %s\n'. $db_link->error;
			}
			$UnReaded = 0;
			
			while ($zeilePostBox = mysqli_fetch_array($db_ergPostBox, MYSQLI_ASSOC)) {
				if ($zeilePostBox['ChatUnReaded'] == 1) {
					$UnReaded = 1;
				}
					
			}
			// echo "<Script>console.log('TEST 2 Log from Send email from Chat')</Script>";
			if ($UnReaded == 0) {
				echo "UserID = ".$zeile['IdUser']."\r\n";
				// ENDE Empfäneradresse ermittlen
				if ($_SESSION['LocalChat'] == true){
					$db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
				}
				else{
				$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"] ,$_SESSION["database"]);
				}
				$sqlReceiver = "SELECT * FROM accounts WHERE userid = '" . $zeile['IdUser']. "'";
				$db_ergReceiver = mysqli_query($db_link, $sqlReceiver);
				if (!$db_ergReceiver) {
					$Inhalt = 'ungültige Bereich Abfrage Chat massnahmen: Error message: %s\n' . $db_link->error;
				}

				while ($zeileReceiver = mysqli_fetch_array($db_ergReceiver, MYSQLI_ASSOC)) {

					$ReceiverName = $zeileReceiver['USERNAME'];
					$ReceiverAdress = $zeileReceiver['EMAIL'];
					echo "ReceiverName =".$zeileReceiver['USERNAME']."ReceiverAdress = ".$zeileReceiver['EMAIL']."\r\n";

				}
//in Postbox eintragen
				// $sql = "INSERT INTO `postbox` (`id`, `SenderID`, `ReceiverID`, `Text`, `ChatUnReaded`) VALUES (NULL, '0', '".$zeile['IdUser']."', 'News from Chat ', 1)";
				if ($_SESSION['LocalChat'] == true){
					$db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
				}
				else{
				$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"] ,$_SESSION["database"]);
				}
				$sql = "INSERT INTO `postbox` (`id`, `SenderID`, `ReceiverID`, `Text`, `ChatUnReaded`) VALUES (NULL, 0, '".$zeile['IdUser']."', 'News from Chat :\r\n".$MyChatDescription."', 1)";
				$db_erg = mysqli_query( $db_link, $sql );
				if ( ! $db_erg )
				{
					echo  'ungültige Messagbe: Error message: %s\n'. $db_link->error;
				}

				echo "email schicken\r\n";
				//email schicken
				$empfaenger = $ReceiverAdress;
				$betreff = "Im Chat Formulierungen  wurde ein neuer Eintrag gemacht ";
				$betreff = str_replace("\n.", "\n..", $betreff);
				// Falls eine Zeile der Nachricht mehr als 70 Zeichen enthälten könnte,
				// sollte wordwrap() benutzt werden
				$nachricht = "Im Chat :\r\n".$MyChatDescription."  wurden neue Einträge gemacht ";
				$nachricht = wordwrap($nachricht, 70, "\r\n");
				$nachricht = htmlentities($nachricht);
				$nachricht = '<html>
				<head>
					<title>HTML-E-Mail mit PHP erstellen</title>
				</head>
				
				<body>
				
				<h1>Im Chat <br>'.$MyChatDescription.'<br> wurden neue Einträge gemacht </h1>
				
				<p>Diese E-Mail wurde mit PHP und HTML erstellt</p>
				
				<table border="1">
				  <tr>
					<td>Im Chat '.$MyChatDescription.' wurden neue Einträge gemacht</td>
					<td>Anzahl Seiten</td>
				  </tr>
				<!--   <tr>
				 	<td>PHP lernen mit PHP-Kurs.com</td>
				 	<td>über 100</td>
				   </tr> -->
				</table>
				
				<!-- <p>Die meisten HTML-Tags wie <b>fett</b>
				und <i>kursiv</i> stehen zur
				Verfügung</p> -->
				
				</body>
				</html>';
				$header = "From: Absender <NoReply@manosoftware.de>";
				
				$header  = "MIME-Version: 1.0\r\n";
				$header .= "Content-type: text/html; charset=utf-8\r\n";
				
				$header .= "From: <NoReply@manosoftware.de>\r\n";
				$header .= "Reply-To: NoRelay\r\n";
				// $header .= "Cc: $cc\r\n";  // falls an CC gesendet werden soll
				$header .= "X-Mailer: PHP ". phpversion();

		
				echo "empfaenger = ".$empfaenger."  betreff = ". $betreff."  nachricht = ". $nachricht."  header = ". $header."\r\n";
				mail($empfaenger, $betreff, $nachricht, $header);

			}
		}
	}
	//------------------------------------
		}

function debug_to_console($data) {
	$output = $data;
	if (is_array($output))
		$output = implode(',', $output);

	echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}   

?>