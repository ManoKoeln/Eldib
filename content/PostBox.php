<link href="CSS/PostBox.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" media="screen and (max-aspect-ratio: 4/3)" href="CSS/PostBoxSmal.css" />
<body>
    <div  id="MyPostBox" >
        <div class="MyPostBoxHead1">Gesendet</div><div class="MyPostBoxHead2">Empfangen</div>
        <div class="container" id="MyPostBoxText">diese Chat- Funktion wir zur Zeit noch entwickelt</div>

        <div class="MyPostBoxDiv3">
            <button class="PostBoxClose"type="button" onclick="NoDisplayPostBox();"> schliessen </button>
        </div>
    </div>
</body>
<?php
include ("db.php");
include_once("helpers.php");
if (isset($_GET['PostBoxFormulierungenID'])) {

    
    $Inhalt = '<div class="MyPostBoxDiv1">';
    $Inhalt = $Inhalt.  '<table class="MyPostBoxTable">';

    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);

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
// $sql = "SELECT * FROM postbox WHERE SenderID = '" . $_SESSION['userid'] . "' ORDER BY  `postbox`.`SendTime` DESC ";

$db_erg = mysqli_query($db_link, $sql);
if (!$db_erg) {
    $Inhalt = 'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n' . $db_link->error;
    echo $Inhalt;
}

//Alle Einträge Messages als gelesen markieren
$sql = "UPDATE `postbox` SET  `ChatUnReaded` = '0', `ReadingTime` = NOW() WHERE ReceiverID = '" . $_SESSION['userid'] . "' AND `ChatUnReaded` = 1";
// $sql = "SELECT * FROM postbox WHERE SenderID = '" . $_SESSION['userid'] . "' ORDER BY  `postbox`.`SendTime` DESC ";

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
    // $sql = "SELECT * FROM chatformulierungen WHERE IDSource = '".$FormulierungenID."' ORDER BY  `chatformulierungen`.`Time` DESC";

    $db_erg = mysqli_query($db_link, $sql);
    if (!$db_erg) {
        $Inhalt = 'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n' . $db_link->error;
        echo $Inhalt;
    }
  

    while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
        $Inhalt = $Inhalt . '<tr>';
        $Inhalt = $Inhalt .'<td class="PostBoxInfoText">';
        $Inhalt = $Inhalt .'<div class="PostBoxInfoDiv1" onclick="MessageToAutor('.$zeile['ReceiverID'].')";>';

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
        $Inhalt = $Inhalt . '<div class="PostBoxInfoDiv2">'.$zeile['SendTime'].'</div></td>';   
        $Inhalt = $Inhalt.'</tr>';       
        $Inhalt = $Inhalt.'<tr>';
        $Inhalt = $Inhalt.'<td class="PostBoxText">'.MyStringHTML($zeile['Text']).' </td>';
        $Inhalt = $Inhalt.'</tr>';
         }


    $Inhalt = $Inhalt . '</table>';
    $Inhalt = $Inhalt . '</div>';
    // $Inhalt = $Inhalt . '<button class="PostBoxClose"type="button" onclick="NoDisplayPostBox();"> schliesssen </button>';

    /// Alle Einträge Postbox abholen EMPFANGEN

    $OldIDSource = "";
    
    $Inhalt = $Inhalt.'<div class="MyPostBoxDiv2">';
    $Inhalt = $Inhalt.  '<table class="MyPostBoxTable">';
       

    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
/* check connection */
if (mysqli_connect_errno()) {
    $Inhalt ="Connect failed: %s\n". mysqli_connect_error();
    echo $Inhalt;
    exit();
}
// Alle Einträge abholen

// Alle Einträge chatformulierungen abholen
if ($_SESSION['LocalChat'] == true){
    $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
}
else{
$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
}

$sql = "SELECT * FROM postbox WHERE ReceiverID = '" . $_SESSION['userid'] . "'ORDER BY  `postbox`.`SendTime` DESC ";
    $db_erg = mysqli_query($db_link, $sql);
    if (!$db_erg) {
        $Inhalt = 'ungültige Bereich Abfrage Chat Massnahmen: Error message: %s\n' . $db_link->error;
        echo $Inhalt;
        exit();
    }
    // $Inhalt = $Inhalt . 'TEST';
    

    while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
        
            $Inhalt = $Inhalt . '<tr>';
            $Inhalt = $Inhalt .'<td class="PostBoxInfoText">';
            $Inhalt = $Inhalt .'<div class="PostBoxInfoDiv1" onclick="MessageToAutor('.$zeile['ReceiverID'].')";>';
            
 		// Name des Autor eintragen
         if ($_SESSION['LocalChat'] == true){
            $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
        }
        else{
        $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
        }
		$sqlAutor = "SELECT * FROM accounts WHERE userid = '".$zeile['SenderID']."'";
		$db_ergAutor = mysqli_query( $db_link, $sqlAutor );
		if ( ! $db_ergAutor )
		{
			$Inhalt =  'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n'. $db_link->error;
		}


		while ($zeileAutor = mysqli_fetch_array($db_ergAutor, MYSQLI_ASSOC)) {
				$Inhalt = $Inhalt.'Sender = ' .$zeileAutor['USERNAME'];	
		}
        $Inhalt = $Inhalt . '</div>';
        $Inhalt = $Inhalt . '<div class="PostBoxInfoDiv2">'.$zeile['SendTime'].'</div></td>';
            $Inhalt = $Inhalt.'</tr>';    
            $Inhalt = $Inhalt.'<tr>';
            $Inhalt = $Inhalt.'<td class="PostBoxText">'.MyStringHTML($zeile['Text']).' </td>';   
        }

        $Inhalt = $Inhalt.'</tr>';

    $Inhalt = $Inhalt . '</table>';
    $Inhalt = $Inhalt . '</div>';
    echo $Inhalt;

}



if (isset($_GET['PostBoxMassnahmenID'])) {

    $OldIDSource = "";
    
    $Inhalt = '<div class="MyPostBoxDiv1">';
    $Inhalt = $Inhalt.  '<table class="MyPostBoxTable">';

    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);

    /* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

// Alle Einträge abholen
    if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }
    $sql = "SELECT * FROM chatmassnahmen WHERE (IdUser = '" . $_SESSION['userid'] . "' OR IdAutor = '" . $_SESSION['userid'] . "') AND deactivated <> 1 ORDER BY  `chatmassnahmen`.`IDSource` DESC";
    $db_erg = mysqli_query($db_link, $sql);
    if (!$db_erg) {
        $Inhalt = 'ungültige Bereich Abfrage Chat massnahmen: Error message: %s\n' . $db_link->error;
    }

    

    while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {

    if ($OldIDSource <> $zeile['IDSource'])  {
        $OldIDSource = $zeile['IDSource'];
        //Massnahmen lesen

        if ($_SESSION['LocalChat'] == true){
            $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
        }
        else{
        $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
        }

        $sql1 = "SELECT * FROM massnahmen WHERE id = '".$zeile['IDSource']."'";
        $db_erg1 = mysqli_query($db_link, $sql1);
        if (!$db_erg1) {
            $Inhalt = 'ungültige Bereich Abfrage Chat massnahmen: Error message: %s\n' . $db_link->error;
        }
            $Inhalt = $Inhalt . '<tr>';
            $Inhalt = $Inhalt . '<td><div class="ChatMassnahmenInfoDiv2">'.$zeile['Time'].'</div></td>';
        while ($zeile1 = mysqli_fetch_array($db_erg1, MYSQLI_ASSOC)) {
            $MyMassnahmen = $zeile1['Text'];
            $MyFormulierungenID = $zeile1['MyFormulierungenID'];
            }
            //__        
        
        //Formulierungen lesen
            $sql1 = "SELECT * FROM formulierungen WHERE id = '".$MyFormulierungenID."'";
            $db_erg1 = mysqli_query($db_link, $sql1);
            if (!$db_erg1) {
                $Inhalt = 'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n' . $db_link->error;
            }
                $Inhalt = $Inhalt . '<tr>';
                $Inhalt = $Inhalt . '<td><div class="ChatFormulierungenInfoDiv2">'.$zeile['Time'].'</div></td>';
            while ($zeile1 = mysqli_fetch_array($db_erg1, MYSQLI_ASSOC)) {
                $MyFormulierungen = $zeile1['Text'];
                $MyZieleID = $zeile1['ZieleID'];
                }
                //__
        //Ziele lesen
        $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
        $sql1 = "SELECT * FROM ziele WHERE id = '".$MyZieleID."'";
        $db_erg1 = mysqli_query($db_link, $sql1);
        if (!$db_erg1) {
            $Inhalt = 'ungültige Bereich Abfrage Chat massnahmen: Error message: %s\n' . $db_link->error;
        }
        while ($zeile1 = mysqli_fetch_array($db_erg1, MYSQLI_ASSOC)) {
            $myZieleNummer = $zeile1['ZieleNummer'];
            $myZieleStichwort = $zeile1['ZieleStichwort'];
            $myZieleBeschreibung = $zeile1['ZieleBeschreibung'];
            $myBereichID = $zeile1['BereichID'];
            }
            //Bereich leden
            $sql1 = "SELECT * FROM bereich WHERE id = '".$myBereichID."'";
            $db_erg1 = mysqli_query($db_link, $sql1);
            if (!$db_erg1) {
                $Inhalt = 'ungültige Bereich Abfrage Chat massnahmen: Error message: %s\n' . $db_link->error;
            }
            while ($zeile1 = mysqli_fetch_array($db_erg1, MYSQLI_ASSOC)) {
                $myBereichText = $zeile1['Text'];
                }            
                //__


            $Inhalt = $Inhalt.'<tr>';
            $Inhalt = $Inhalt.'<td class="BereichText">'.$myBereichText.'</td>';
            $Inhalt = $Inhalt.'</tr>';
            $Inhalt = $Inhalt.'<tr>';
            $Inhalt = $Inhalt.'<td class="PostBoxText">'.$myZieleNummer.' </td>';
            $Inhalt = $Inhalt.'<td class="ZielZieleStichwort">'.$myZieleStichwort.' </td>';
            $Inhalt = $Inhalt.'<td class="ZielZieleBeschreibung">'.$myZieleBeschreibung.' </td>';
            $Inhalt = $Inhalt.'</tr>';
            $Inhalt = $Inhalt . '<tr>';
            $Inhalt = $Inhalt . '<td class="ChatFormulierungenText">'.$MyFormulierungen.'</td>';
            $Inhalt = $Inhalt . '</tr>';
            $Inhalt = $Inhalt . '<tr>';
            $Inhalt = $Inhalt . '<td class="ChatMassnahmenText">'.$MyMassnahmen.'</td>';
            $Inhalt = $Inhalt . '</tr>';            
            $Inhalt = $Inhalt . '<tr>';
            $Inhalt = $Inhalt . '</tr>';
            $Inhalt = $Inhalt . '<tr>';
            $Inhalt = $Inhalt . '<td>';
            $Inhalt = $Inhalt . '<button class="MyChatButton" type="button" onclick="CallChatMassnahmen(' . $zeile['IDSource'] . ');">zum Chat</button>';
            $Inhalt = $Inhalt .'<button class="MyChatButton" type="button" onclick="ExitChatMassnahmen(' . $zeile['IDSource'] . ');">verlassen</button>';
            $Inhalt = $Inhalt .'</td>';
            $Inhalt = $Inhalt . '</tr>';
        }

    }
    $Inhalt = $Inhalt . '</table>';
    $Inhalt = $Inhalt . '</div>';
    // $Inhalt = $Inhalt . '<button class="PostBoxClose"type="button" onclick="NoDisplayPostBox();"> schliesssen </button>';

    // Chat Massnahmen füllen -------------------------------------------------------------------------------

    $OldIDSource = "";
    
    $Inhalt = $Inhalt.'<div class="MyPostBoxDiv2">';
    $Inhalt = $Inhalt.  '<table class="MyPostBoxTable">';
    $Inhalt = $Inhalt . 'Test';

    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
// Alle Einträge abholen
    if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }
    $sql = "SELECT * FROM chatmassnahmen WHERE (IdUser = '" . $_SESSION['userid'] . "' OR IdAutor = '" . $_SESSION['userid'] . "') AND deactivated <> 1 ORDER BY  `chatmassnahmen`.`IDSource` DESC";
    $db_erg = mysqli_query($db_link, $sql);
    if (!$db_erg) {
        $Inhalt = 'ungültige Bereich Abfrage Chat Massnahmen: Error message: %s\n' . $db_link->error;
        echo $Inhalt;
        exit();
    }

    

    while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {

    if ($OldIDSource <> $zeile['IDSource'])  {
        $OldIDSource = $zeile['IDSource'];
        
        //Massnahmen lesen
        if ($_SESSION['LocalChat'] == true){
            $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
        }
        else{
        $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
        }
        $sql1 = "SELECT * FROM Massnahmen WHERE id = '".$zeile['IDSource']."'";
        $db_erg1 = mysqli_query($db_link, $sql1);
        if (!$db_erg1) {
            $Inhalt = 'ungültige Bereich Abfrage Chat Massnahmen: Error message: %s\n' . $db_link->error;
        }
            $Inhalt = $Inhalt . '<tr>';
            $Inhalt = $Inhalt . '<td><div class="ChatMassnahmenInfoDiv2">'.$zeile['Time'].'</div></td>';
        while ($zeile1 = mysqli_fetch_array($db_erg1, MYSQLI_ASSOC)) {
            $MyMassnahmen = $zeile1['MassnahmenText'];
            $MyFormulierungenID = $zeile1['FormulierungenID'];
            }


        //Formulierungen lesen
            $sql1 = "SELECT * FROM formulierungen WHERE id = '".$MyFormulierungenID."'";
            $db_erg1 = mysqli_query($db_link, $sql1);
            if (!$db_erg1) {
                $Inhalt = 'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n' . $db_link->error;
            }
                $Inhalt = $Inhalt . '<tr>';
                // $Inhalt = $Inhalt . '<td><div class="ChatFormulierungenInfoDiv2">'.$zeile['Time'].'</div></td>';
            while ($zeile1 = mysqli_fetch_array($db_erg1, MYSQLI_ASSOC)) {
                $MyFormulierungen = $zeile1['Text'];
                $MyZieleID = $zeile1['ZieleID'];
                }
                //__
        //Ziele lesen
        $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
        $sql1 = "SELECT * FROM ziele WHERE id = '".$MyZieleID."'";
        $db_erg1 = mysqli_query($db_link, $sql1);
        if (!$db_erg1) {
            $Inhalt = 'ungültige Bereich Abfrage Chat Massnahmen: Error message: %s\n' . $db_link->error;
        }
        while ($zeile1 = mysqli_fetch_array($db_erg1, MYSQLI_ASSOC)) {
            $myZieleNummer = $zeile1['ZieleNummer'];
            $myZieleStichwort = $zeile1['ZieleStichwort'];
            $myZieleBeschreibung = $zeile1['ZieleBeschreibung'];
            $myBereichID = $zeile1['BereichID'];
            }
            //Bereich leden
            $sql1 = "SELECT * FROM bereich WHERE id = '".$myBereichID."'";
            $db_erg1 = mysqli_query($db_link, $sql1);
            if (!$db_erg1) {
                $Inhalt = 'ungültige Bereich Abfrage Chat Massnahmen: Error message: %s\n' . $db_link->error;
            }
            while ($zeile1 = mysqli_fetch_array($db_erg1, MYSQLI_ASSOC)) {
                $myBereichText = $zeile1['Text'];
                }            
                //__


            $Inhalt = $Inhalt.'<tr>';
            $Inhalt = $Inhalt.'<td class="BereichText">'.$myBereichText.'</td>';
            $Inhalt = $Inhalt.'</tr>';
            $Inhalt = $Inhalt.'<tr>';
            $Inhalt = $Inhalt.'<td class="PostBoxText">'.$myZieleNummer.' </td>';
            $Inhalt = $Inhalt.'<td class="ZielZieleStichwort">'.$myZieleStichwort.' </td>';
            $Inhalt = $Inhalt.'<td class="ZielZieleBeschreibung">'.$myZieleBeschreibung.' </td>';
            $Inhalt = $Inhalt.'</tr>';
            $Inhalt = $Inhalt . '<tr>';
            $Inhalt = $Inhalt . '<td class="ChatFormulierungenText">'.$MyFormulierungen.'</td>';
            $Inhalt = $Inhalt . '</tr>';
            $Inhalt = $Inhalt . '<tr>';     
            $Inhalt = $Inhalt . '<td class="MassnahmenText">'.$MyMassnahmen.'</td>';
            $Inhalt = $Inhalt . '</tr>';            
            $Inhalt = $Inhalt . '<tr>';
            $Inhalt = $Inhalt . '</tr>';
            $Inhalt = $Inhalt . '<tr>';
            $Inhalt = $Inhalt . '<td>';
            $Inhalt = $Inhalt . '<button class="MyChatButton" type="button" onclick="CallChatMassnahmen(' . $zeile['IDSource'] . ');">zum Chat</button>';
            $Inhalt = $Inhalt .'<button class="MyChatButton" type="button" onclick="ExitChatMassnahmen(' . $zeile['IDSource'] . ');">verlassen</button>';
            $Inhalt = $Inhalt .'</td>';
            $Inhalt = $Inhalt . '</tr>';
        }

    }
    $Inhalt = $Inhalt . '</table>';
    $Inhalt = $Inhalt . '</div>';
    // $Inhalt = $Inhalt . '<div class="MyPostBoxDiv3">';
    // $Inhalt = $Inhalt . '<button class="PostBoxClose"type="button" onclick="NoDisplayPostBox();"> schliesssen </button>';
    // $Inhalt = $Inhalt . '</div>';
    echo $Inhalt;

}
?>
