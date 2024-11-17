<link href="CSS/PostBoxReceive.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" media="screen and (max-aspect-ratio: 4/3)" href="CSS/PostBoxReceiveSmal.css" />
<body>
    <div  id="MyPostBoxReceive" >
        <div class="MyPostBoxReceiveHead1">Empfangen</div>
        <div class="container" id="MyPostBoxReceiveText">diese Chat- Funktion wir zur Zeit noch entwickelt</div>

        <div class="MyPostBoxReceiveDiv3">
            <button class="PostBoxReceiveClose"type="button" onclick="NoDisplayPostBoxReceive();"> schliessen </button>
        </div>
    </div>
</body>
<?php
include ("db.php");
include_once("helpers.php");
if (isset($_GET['PostBoxReceiveFormulierungenID'])) {


    /// Alle Einträge PostBoxReceive abholen EMPFANGEN

    $OldIDSource = "";
    
    $Inhalt = '<div class="MyPostBoxReceiveDiv1">';
    $Inhalt = $Inhalt.  '<table class="MyPostBoxReceiveTable">';
       

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
            $Inhalt = $Inhalt .'<td class="PostBoxReceiveInfoText">';
            $Inhalt = $Inhalt .'<div class="PostBoxReceiveInfoDiv1" onclick="MessageToAutor('.$zeile['ReceiverID'].')";>';
            
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
        $Inhalt = $Inhalt . '<div class="PostBoxReceiveInfoDiv2">'.$zeile['SendTime'].'</div></td>';
            $Inhalt = $Inhalt.'</tr>';    
            $Inhalt = $Inhalt.'<tr>';
            $Inhalt = $Inhalt.'<td class="PostBoxReceiveText">'.MyStringHTML($zeile['Text']).' </td>';   
        }

        $Inhalt = $Inhalt.'</tr>';

    $Inhalt = $Inhalt . '</table>';
    $Inhalt = $Inhalt . '</div>';
    echo $Inhalt;

}

?>
