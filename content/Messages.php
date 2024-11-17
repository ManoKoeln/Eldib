<!-- <header(Content-type: text/html; charset=utf-8)>
<script src="Messages.js"></script>
</header> -->
<link href="CSS/Messages.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" media="screen and (max-aspect-ratio: 4/3)" href="CSS/MessagesSmal.css" />
<body>
    <div  id="Messages" >
    <div class="containerMessage" id="MessagesText">diese Message- Funktion wir zur Zeit noch entwickelt</div>
    </div>
	<!-- <button class="ButtonMessageClose" type="button" onclick="NoDisplayMessages();"> schliessen </button> -->
</body>
<?php

if (isset($_GET['MessageToAutor'])){
   
	if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }
    	$sqlAutor = "SELECT * FROM accounts WHERE userid = '".$_GET['MessageToAutor']."'";
	$db_ergAutor = mysqli_query( $db_link, $sqlAutor );
	if ( ! $db_ergAutor )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat massnahmen: Error message: %s\n'. $db_link->error;
	}
    $Inhalt = '<h1>Schreiben Sie eine Nachricht an ';

	while ($zeileAutor = mysqli_fetch_array($db_ergAutor, MYSQLI_ASSOC)) {
        
			$Inhalt = $Inhalt .$zeileAutor['USERNAME'];
		$SenderName = MString3($zeileAutor['USERNAME']);
        $ReciverAdress = MString3($zeileAutor['EMAIL']);
			
	}	
    $Inhalt = $Inhalt . '</h1>';
    $Inhalt = $Inhalt . '<br>';

    $Inhalt = $Inhalt.'<div class="MessagesInput"><form action="ELDiB.php" target="top" method="get">
	<textarea id="MessageText" type="text/html" name="Message" placeholder="Ihre Nachricht"></textarea>	
	</form></div>';
    $Inhalt = $Inhalt . '<button class="ButtonMessageSend" type="button" onclick="SendMessage('.$_SESSION['userid'].','.$_GET['MessageToAutor'].','.$ReciverAdress.','.$SenderName.');"> senden </button>';
    $Inhalt = $Inhalt . '<button class="ButtonMessageClose" type="button" onclick="NoDisplayMessages();"> schliessen </button>';
    echo $Inhalt;
}
if (isset($_GET['Sender'])) {
	if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }

	//Abfrage ob ungelesene Nachrichten im Postfach sind
	$sqlAutor = "SELECT * FROM postbox WHERE ReceiverID = '".$_GET['Receiver']."'";
$db_ergAutor = mysqli_query( $db_link, $sqlAutor );
if ( ! $db_ergAutor )
{
	$Inhalt =  'ungültige Bereich Abfrage Chat massnahmen: Error message: %s\n'. $db_link->error;
}

$UnReaded = 0;
while ($zeileAutor = mysqli_fetch_array($db_ergAutor, MYSQLI_ASSOC)) {
		if ($zeileAutor['UnReaded'] == 1) {
			$UnReaded = 1;
		}
		
}
	//---------------------------------------------------


    if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }
    $sql = "INSERT INTO `postbox` (`id`, `SenderID`, `ReceiverID`, `Text`, `UnReaded`) VALUES (NULL, '".$_GET['Sender']."', '".$_GET['Receiver']."', '".$_GET['Text']."', 1)";
	$db_erg = mysqli_query( $db_link, $sql );
    $Inhalt = "";
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Messagbe: Error message: %s\n'. $db_link->error;
        echo $Inhalt;
	}

// Setup abfragen ob email senden bei neuer Nachricht bei neuem Posteintrag
if ($_SESSION['LocalChat'] == true){
	$db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
}
else{
$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
}
$sqlAutor = "SELECT * FROM usersetup WHERE userid = '".$_GET['Receiver']."'";
$db_ergAutor = mysqli_query( $db_link, $sqlAutor );
if ( ! $db_ergAutor )
{
	$Inhalt =  'ungültige Bereich Abfrage Chat Formulierungen Setup abfragen ob email senden bei neuer Nachricht bei neuem Posteintrag: Error message: %s\n'. $db_link->error;
	echo  'ungültige Bereich Abfrage Chat Formulierungen Setup abfragen ob email senden bei neuer Nachricht bei neuem Posteintrag: Error message: %s\n'. $db_link->error;
}


while ($zeileAutor = mysqli_fetch_array($db_ergAutor, MYSQLI_ASSOC)) {
	
	$Reciversendpost = $zeileAutor['sendpost'];
		
}
// nur email senden wenn gewüscht
	if ($Reciversendpost == 1 AND $UnReaded == 0) {
		// Empfäneradresse ermittlen
		if ($_SESSION['LocalChat'] == true){
			$db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
		}
		else{
		$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
		}
		$sqlAutor = "SELECT * FROM accounts WHERE userid = '" . $_GET['Receiver'] . "'";
		$db_ergAutor = mysqli_query($db_link, $sqlAutor);
		if (!$db_ergAutor) {
			$Inhalt = 'ungültige Bereich Abfrage Chat Formulierungen nur email senden wenn gewüscht: Error message: %s\n' . $db_link->error;
			echo 'ungültige Bereich Abfrage Chat Formulierungen nur email senden wenn gewüscht: Error message: %s\n' . $db_link->error;
		}
		while ($zeileAutor = mysqli_fetch_array($db_ergAutor, MYSQLI_ASSOC)) {

			$ReciverName = $zeileAutor['USERNAME'];
			$ReciverAdress = $zeileAutor['EMAIL'];

		}

		// ENDE Empfäneradresse ermittlen
		if ($_SESSION['LocalChat'] == true){
			$db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
		}
		else{
		$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
		}
		$sqlAutor = "SELECT * FROM accounts WHERE userid = '" . $_GET['Sender'] . "'";
		$db_ergAutor = mysqli_query($db_link, $sqlAutor);
		if (!$db_ergAutor) {
			$Inhalt =  'ungültige Bereich Abfrage Chat Formulierungen ENDE Empfäneradresse ermittlen: Error message: %s\n'. $db_link->error;
			echo  'ungültige Bereich Abfrage Chat Formulierungen ENDE Empfäneradresse ermittlen: Error message: %s\n'. $db_link->error;
		}

		while ($zeileAutor = mysqli_fetch_array($db_ergAutor, MYSQLI_ASSOC)) {

			$SenderName = $zeileAutor['USERNAME'];
			$SenderAdress = $zeileAutor['EMAIL'];

		}
		// Senderadresse ermittlen

		// ENDE Senderadresse ermittlen
// sende email by Server
		$text = 'Sie haben Nachrichten von ' . $SenderName;
		$text = str_replace("\n.", "\n..", $text);




		// $empfaenger = "home@m-nowack.de";
		$empfaenger = $ReciverAdress;
		$betreff = "Sie haben neue Nachrichten vom ELDiB Server Chatuser : " . $SenderName;
		$betreff = str_replace("\n.", "\n..", $betreff);
		$nachricht = "Hier ist die Nachricht, die versendet werden soll. Empfänger Nr = " . $_GET['Receiver'] . " - Autor = " . $SenderName . " - Sender Adresse = " . $SenderAdress . "<br> - Empfänger = " . $ReciverName . "  - Empfäner Adresse = " . $ReciverAdress;
		// Falls eine Zeile der Nachricht mehr als 70 Zeichen enthälten könnte,
// sollte wordwrap() benutzt werden
		$nachricht = "Der ELDiB User: " . $SenderName . " schreibt : \r\n" . $_GET['Text'];
		$nachricht = wordwrap($nachricht, 70, "\r\n");
		$header = "From: Absender <NoReply@manosoftware.de>";

		mail($empfaenger, $betreff, $nachricht, $header);
	}

    $Inhalt = $Inhalt . '<h1>Nachricht wurde gesendet</h1>';
    $Inhalt = $Inhalt . '<button class="ButtonMessageClose" type="button" onclick="NoDisplayMessages();"> schliessen </button>';
    echo $Inhalt;
 
}
function MString3 ($text){
	$order   = array("\r\n", "\n", "\r");
	$replace = '<br>';
	

	// $NewText = nl2br($text,false);
	$NewText =  str_replace($order,$replace,$text);


	return ("'".$NewText."'");
}
?>