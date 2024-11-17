<!-- <header(Content-type: text/html; charset=utf-8)>
<script src="UserChatFormulierungen.js"></script>
</header> -->
<link href="CSS/UserChatFormulierungen.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" media="screen and (max-aspect-ratio: 4/3)" href="CSS/UserChatFormulierungenSmal.css" />
<body>
    <div  id="MyUserChatFormulierungen" >
        <div  id="MyUserChatFormulierungenFrame" >
            <div class="MyUserChatFormulierungenHead1">Chat Formulierungen???</div>
            <div class="container" id="MyUserChatFormulierungenText">diese Chat- Funktion wir zur Zeit noch entwickelt</div>
            <div class="MyUserChatFormulierungenDiv3">
                <button class="UserChatFormulierungenClose"type="button" onclick="NoDisplayUserChatFormulierungen();"> schliessen </button>
            </div>
        </div>
    </div>
</body>
<?php
include ("db.php");
if (isset($_GET['UserChatFormulierungenFormulierungenID'])) {

    $OldIDSource = "";
    
    $Inhalt = '<div class="MyUserChatFormulierungenDiv1">';
    $Inhalt = $Inhalt.  '<table class="MyUserChatFormulierungenTable">';
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

// Alle Einträge chatformulierungen abholen

    // $sql = "SELECT * FROM chatformulierungen WHERE (IdUser = '" . $_SESSION['userid'] . "' OR IdAutor = '" . $_SESSION['userid'] . "') AND deactivated <> 1 ORDER BY  `chatformulierungen`.`IDSource` DESC";
    if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }
    $sql = "SELECT * , MAX(chatformulierungen.Time) AS Time FROM chatformulierungen  WHERE (IdUser = '" . $_SESSION['userid'] . "' OR IdAutor = '" . $_SESSION['userid'] . "') AND deactivated <> 1  GROUP BY chatformulierungen.IDSource ORDER BY Time DESC";

    // $sql = "SELECT * FROM chatformulierungen" ;
    $db_erg = mysqli_query($db_link, $sql);
    if (!$db_erg) {
        $Inhalt = 'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n' . $db_link->error;
        echo $Inhalt;
    }
  
    
    while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
       
        //Formulierungen lesen
        if ($_SESSION['LocalChat'] == true){
            $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
        }
        else{
        $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
        }

            $sql1 = "SELECT * FROM formulierungen WHERE id = '".$zeile['IDSource']."'";
            $db_erg1 = mysqli_query($db_link, $sql1);
            if (!$db_erg1) {
                $Inhalt = 'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n' . $db_link->error;
                echo $Inhalt;
            }
                $Inhalt = $Inhalt . '<tr>';
                $Inhalt = $Inhalt . '<td><div class="ChatFormulierungenInfoDiv2" colspan="3">'.$zeile['Time'].'</div></td>';
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
            $Inhalt = 'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n' . $db_link->error;
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
                $Inhalt = 'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n' . $db_link->error;
                echo $Inhalt;
            }
            while ($zeile1 = mysqli_fetch_array($db_erg1, MYSQLI_ASSOC)) {
                $myBereichText = $zeile1['Text'];
                }            
                //__


            $Inhalt = $Inhalt.'<tr>';
            $Inhalt = $Inhalt.'<td class="BereichText BereichText1" colspan="3">'.$myBereichText.'</td>';
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
            $Inhalt = $Inhalt . '</tr>';
            $Inhalt = $Inhalt . '<tr>';
            $Inhalt = $Inhalt . '<td colspan="3">';
            $Inhalt = $Inhalt . '<button class="MyChatButton" type="button" onclick="CallChatFormulierungen(' . $zeile['IDSource'] . ');">zum Chat</button>';
            $Inhalt = $Inhalt .'<button class="MyChatButton" type="button" onclick="ExitChatFormulierungen(' . $zeile['IDSource'] . ');">verlassen</button>';
            $Inhalt = $Inhalt .'</td>';
            $Inhalt = $Inhalt . '</tr>';
         }


    $Inhalt = $Inhalt . '</table>';
    $Inhalt = $Inhalt . '</div>';

    echo $Inhalt;

}


if (isset($_GET['ExitChatFormulierungen'])){
    if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }

    $sql = "UPDATE `chatformulierungen` SET `deactivated` = '1' WHERE  `chatformulierungen`.`IDSource` = ".$_GET['ExitChatFormulierungen']." AND (`chatformulierungen`.`IdAutor` = " . $_SESSION['userid'] . " OR `chatformulierungen`.`IdUser` = " . $_SESSION['userid'] . ")";
     $db_erg = mysqli_query($db_link, $sql);
    if (!$db_erg) {
        $Inhalt = 'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n' . $db_link->error;
    }



    while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {


    }

}
?>
