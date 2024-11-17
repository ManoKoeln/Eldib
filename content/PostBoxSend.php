<link href="CSS/PostBoxSend.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" media="screen and (max-aspect-ratio: 4/3)" href="CSS/PostBoxSendSmal.css" />
<body>
    <div  id="MyPostBoxSend" >
        <div class="MyPostBoxSendHead1">Gesendet</div>
        <div class="container" id="MyPostBoxSendText">diese Chat- Funktion wir zur Zeit noch entwickelt</div>

        <div class="MyPostBoxSendDiv3">
            <button class="PostBoxSendClose"type="button" onclick="NoDisplayPostBoxSend();"> schliessen </button>
        </div>
    </div>
</body>
<?php
include ("db.php");
include_once("helpers.php");
if (isset($_GET['PostBoxSendFormulierungenID'])) {

    
    $Inhalt = '<div class="MyPostBoxSendDiv1">';
    $Inhalt = $Inhalt.  '<table class="MyPostBoxSendTable">';

    if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }

        /* check connection */
    if (mysqli_connect_errno()) {
        $Inhalt ="Connect failed: %s\n". mysqli_connect_error();
            echo $Inhalt;
        exit();
    }

    //Alle Einträge Messages als gelesen markieren
    if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }
        $sql = "UPDATE `postbox` SET `UnReaded` = '0',  `ReadingTime` = NOW() WHERE ReceiverID = '" . $_SESSION['userid'] . "' AND `UnReaded` = 1";

    $db_erg = mysqli_query($db_link, $sql);
    if (!$db_erg) {
        $Inhalt = 'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n' . $db_link->error;
        echo $Inhalt;
    }

    //Alle Einträge Messages als gelesen markieren
    if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }
    $sql = "UPDATE `postbox` SET  `ChatUnReaded` = '0', `ReadingTime` = NOW() WHERE ReceiverID = '" . $_SESSION['userid'] . "' AND `ChatUnReaded` = 1";

    $db_erg = mysqli_query($db_link, $sql);
    if (!$db_erg) {
        $Inhalt = 'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n' . $db_link->error;
        echo $Inhalt;
    }


    // Alle Einträge Postbox abholen GESENDET
    if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }
    $sql = "SELECT * FROM postbox WHERE SenderID = '" . $_SESSION['userid'] . "' ORDER BY  `postbox`.`SendTime` DESC ";

    $db_erg = mysqli_query($db_link, $sql);
    if (!$db_erg) {
        $Inhalt = 'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n' . $db_link->error;
        echo $Inhalt;
    }
  

    while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
        $Inhalt = $Inhalt . '<tr>';
        $Inhalt = $Inhalt .'<td class="PostBoxSendInfoText">';
        $Inhalt = $Inhalt .'<div class="PostBoxSendInfoDiv1" onclick="MessageToAutor('.$zeile['ReceiverID'].')";>';

            		// Name des Autor eintragen
		$sqlAutor = "SELECT * FROM accounts WHERE userid = '".$zeile['ReceiverID']."'";
		$db_ergAutor = mysqli_query( $db_link, $sqlAutor );
		if ( ! $db_ergAutor )
		{
			$Inhalt =  'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n'. $db_link->error;
		}


		while ($zeileAutor = mysqli_fetch_array($db_ergAutor, MYSQLI_ASSOC)) {
				$Inhalt = $Inhalt.'Empfänger = '.$zeileAutor['USERNAME'];
		}	
        $Inhalt = $Inhalt . '</div>';
        $Inhalt = $Inhalt . '<div class="PostBoxSendInfoDiv2">'.$zeile['SendTime'].'</div></td>';   
        $Inhalt = $Inhalt.'</tr>';       
        $Inhalt = $Inhalt.'<tr>';
        $Inhalt = $Inhalt.'<td class="PostBoxSendText">'.MyStringHTML($zeile['Text']).' </td>';
        $Inhalt = $Inhalt.'</tr>';
         }


    $Inhalt = $Inhalt . '</table>';
    $Inhalt = $Inhalt . '</div>';

        echo $Inhalt;

}

?>
