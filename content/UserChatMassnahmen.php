<!-- <header(Content-type: text/html; charset=utf-8)>
<script src="UserChatMassnahmen.js"></script>
</header> -->
<link href="CSS/UserChatMassnahmen.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" media="screen and (max-aspect-ratio: 4/3)" href="CSS/UserChatMassnahmenSmal.css" />
<body>
    <div  id="MyUserChatMassnahmen" >
        <div class="MyUserChatMassnahmenHead2">Chat Massnahmen</div>
        <div class="container" id="MyUserChatMassnahmenText">diese Chat- Funktion wir zur Zeit noch entwickelt</div>

        <div class="MyUserChatMassnahmenDiv3">
            <button class="UserChatMassnahmenClose"type="button" onclick="NoDisplayUserChatMassnahmen();"> schliessen </button>
        </div>
    </div>
</body>
<?php
include ("db.php");

if (isset($_GET['ExitChatMassnahmen'])){
    if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }


    $sql = "UPDATE `chatmassnahmen` SET `deactivated` = '1' WHERE  `chatmassnahmen`.`IDSource` = ".$_GET['ExitChatMassnahmen']." AND (`chatmassnahmen`.`IdAutor` = " . $_SESSION['userid'] . " OR `chatmassnahmen`.`IdUser` = " . $_SESSION['userid'] . ")";
     $db_erg = mysqli_query($db_link, $sql);
    if (!$db_erg) {
        $Inhalt = 'ungültige Bereich Abfrage Chat Massnahmen: Error message: %s\n' . $db_link->error;
    }



    while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {


    }

}


if (isset($_GET['UserChatMassnahmenMassnahmenID'])) {

    $OldIDSource = "";
    $Inhalt = "";
    $Inhalt = $Inhalt.'<div class="MyUserChatMassnahmenDiv2">';
    $Inhalt = $Inhalt.  '<table class="MyUserChatMassnahmenTable">';
       

    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
/* check connection */
if (mysqli_connect_errno()) {
    $Inhalt ="Connect failed: %s\n". mysqli_connect_error();
    echo $Inhalt;
    exit();
}
// Alle Einträge abholen

// Alle Einträge chatMassnahmen abholen

    if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }

    // $sql = "SELECT * FROM chatmassnahmen WHERE (IdUser = '" . $_SESSION['userid'] . "' OR IdAutor = '" . $_SESSION['userid'] . "') AND deactivated <> 1 ORDER BY  `chatmassnahmen`.`IDSource` DESC";
    $sql = "SELECT * , MAX(chatmassnahmen.Time) AS Time FROM chatmassnahmen  WHERE (IdUser = '" . $_SESSION['userid'] . "' OR IdAutor = '" . $_SESSION['userid'] . "') AND deactivated <> 1  GROUP BY chatmassnahmen.IDSource ORDER BY Time DESC";
    $db_erg = mysqli_query($db_link, $sql);
    if (!$db_erg) {
        $Inhalt = 'ungültige Bereich Abfrage Chat Massnahmen: Error message: %s\n' . $db_link->error;
        echo $Inhalt;
        exit();
    }
    // $Inhalt = $Inhalt . 'TEST';
    

    while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
            // $Inhalt = $Inhalt . 'IDSource = ' . $zeile['IDSource'];

    // if ($OldIDSource <> $zeile['IDSource'])  {
    //     $OldIDSource = $zeile['IDSource'];
        
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
            $Inhalt = 'ungültige Bereich Abfrage Chat Massnahmen: Error message: %s\n' . $db_link->error;
            echo $Inhalt;
        }
            $Inhalt = $Inhalt . '<tr>';
            $Inhalt = $Inhalt . '<td colspan="3"><div class="ChatMassnahmenInfoDiv2">'.$zeile['Time'].'</div></td>';
        while ($zeile1 = mysqli_fetch_array($db_erg1, MYSQLI_ASSOC)) {
            $MyMassnahmen = $zeile1['Text'];
            $MyFormulierungenID = $zeile1['FormulierungenID'];
            }


        //Formulierungen lesen
            $sql1 = "SELECT * FROM formulierungen WHERE id = '".$MyFormulierungenID."'";
            $db_erg1 = mysqli_query($db_link, $sql1);
            if (!$db_erg1) {
                $Inhalt = 'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n' . $db_link->error;
                echo $Inhalt;
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
            echo $Inhalt;
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
                echo $Inhalt;
            }
            while ($zeile1 = mysqli_fetch_array($db_erg1, MYSQLI_ASSOC)) {
                $myBereichText = $zeile1['Text'];
                }            
                //__


            $Inhalt = $Inhalt.'<tr>';
            $Inhalt = $Inhalt.'<td class="BereichText" colspan="3">'.$myBereichText.'</td>';
            $Inhalt = $Inhalt.'</tr>';
            $Inhalt = $Inhalt.'<tr>';
            $Inhalt = $Inhalt.'<td class="ZielZieleNummer">'.$myZieleNummer.' </td>';
            $Inhalt = $Inhalt.'<td class="ZielZieleStichwort">'.$myZieleStichwort.' </td>';
            $Inhalt = $Inhalt.'<td class="ZielZieleBeschreibung">'.$myZieleBeschreibung.' </td>';
            $Inhalt = $Inhalt.'</tr>';
            $Inhalt = $Inhalt . '<tr>';
            $Inhalt = $Inhalt . '<td class="ChatFormulierungenText" colspan="3">'.$MyFormulierungen.'</td>';
            $Inhalt = $Inhalt . '</tr>';
            $Inhalt = $Inhalt . '<tr>';     
            $Inhalt = $Inhalt . '<td class="MassnahmenText" colspan="3">'.$MyMassnahmen.'</td>';
            $Inhalt = $Inhalt . '</tr>';            
            $Inhalt = $Inhalt . '<tr>';
            $Inhalt = $Inhalt . '</tr>';
            $Inhalt = $Inhalt . '<tr>';
            $Inhalt = $Inhalt . '<td colspan="3">';
            $Inhalt = $Inhalt . '<button class="MyChatButton" type="button" onclick="CallChatMassnahmen(' . $zeile['IDSource'] . ');">zum Chat</button>';
            $Inhalt = $Inhalt .'<button class="MyChatButton" type="button" onclick="ExitChatMassnahmen(' . $zeile['IDSource'] . ');">verlassen</button>';
            $Inhalt = $Inhalt .'</td>';
            $Inhalt = $Inhalt . '</tr>';
            }


    $Inhalt = $Inhalt . '</table>';
    $Inhalt = $Inhalt . '</div>';
    echo $Inhalt;

        }

?>
