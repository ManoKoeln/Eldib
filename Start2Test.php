<?php
session_start(); // Starten der Session
$Sessioncounter = 0;
echo '<script>console.log("Start2Test run: pw ok" + ' . json_encode($_SESSION["username"]) . ');</script>';
if(!isset($_SESSION["username"])){
  echo "<h1>Der Login ist fehlgeschlagen für User: ".$_SESSION["username"]."</h1>";
  session_destroy();
  header("Location: ../ELDiB/index.php");
  exit;
}
else{
  require ("content/db.php");
  $Sessioncounter = $Sessioncounter + 1;
  // echo 'SelectionSchool = '.$_SESSION['SelectionSchool'];
  if ($_SESSION['SelectionSchool'] == 0){
    echo "keine Schule ausgewählt".$_SESSION["username"];
    session_destroy();
  header("Location: ../ELDiB/index.php");
  exit;
  
}
$user_agent = "";
$user_agent = $_SERVER['HTTP_USER_AGENT'];
// echo strchr($user_agent,")",true);
// echo $user_agent;
  
  $db_link = new mysqli($host_name, $user_name, $password, $database);
  $sql = "SELECT * FROM hostschool WHERE id = '".$_SESSION['SelectionSchool']."'";
  $db_erg = mysqli_query( $db_link, $sql );
  if ( ! $db_erg )
  {
    $Inhalt = 'ungültige Abfrage hostschool: Error message: %s\n'. $db_link->error;
  }
  
    while ($zeile = mysqli_fetch_assoc( $db_erg))
  {
    $_SESSION["host_nameSchool"]=$zeile['host_name']; 
    $_SESSION["databaseSchool"]=$zeile['data_base']; 
    $_SESSION["user_nameSchool"]=$zeile['user_name']; 
    $_SESSION["passwordSchool"]=$zeile['password'];
  }
// }

//UserInfo
$db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
$sql = "SELECT * FROM `accounts` WHERE USERNAME = '".$_SESSION["username"]."'";
$db_erg = mysqli_query( $db_link, $sql );
if ( ! $db_erg )
{
  echo '<br>ungültige Abfrage Start2 account USERNAME: Error message: '. $db_link->error;
}


while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
  $MyUserInfo = $zeile['UserInfo'];
}

$Sessioncounter = $Sessioncounter + 1;
if (str_contains($MyUserInfo,$_SERVER['HTTP_USER_AGENT'])){
}
else{
// if (strchr($MyUserInfo,$_SERVER['HTTP_USER_AGENT'],false) == false){
  echo 'Neues Endgerät'. $Sessioncounter;
  //neuer UserInfo eintragen
  $sql = "UPDATE `accounts` SET `UserInfo` = '".$MyUserInfo.$_SERVER['HTTP_USER_AGENT']."' WHERE `USERNAME` = '".$_SESSION["username"]."'";
  $db_erg = mysqli_query( $db_link, $sql );
if ( ! $db_erg )
{
  echo 'ungültige Abfrage Start2 Update UserInfo: Error message: %s\n'. $db_link->error;
}

}


echo '<script>console.log("ELDiB Start with the User: '.$_SESSION["username"].'");</script>';
if(isset($_SESSION['screen_width']) AND isset($_SESSION['screen_height'])){
  // echo 'User resolution: ' . $_SESSION['screen_width'] . 'x' . $_SESSION['screen_height'];
} else if(isset($_REQUEST['width']) AND isset($_REQUEST['height'])) {
  $_SESSION['screen_width'] = $_REQUEST['width'];
  $_SESSION['screen_height'] = $_REQUEST['height'];
  header('Location: ' . $_SERVER['PHP_SELF']);
} else {
  echo '<script>console.log("Neues Endgerät hinzugefügt: '.$_SERVER['HTTP_USER_AGENT'].'");</script>';
  echo '<script type="text/javascript">window.location = "' . $_SERVER['PHP_SELF'] . '?width="+screen.width+"&height="+screen.height;</script>';
}
}
?>
<!DOCTYPE html>
<HTML lang="de">
<meta charset="UTF-8">
<head>
    <title>ETEP</title>

    <!-- <title>ETEP</title><button title="Help" class="ButtonHelp"><a target="_blank" href="https://youtu.be/a7MMDw8-H2E">Help ?</a></button> -->
    <!-- <title>ETEP</title><button class="ButtonHelp"><a target="_blank" href="Video/ELDiB Bogen ausfüllen.mp4">Help ?</a></button> -->
    
    <!-- <a href="https://youtu.be/NshsQsGGbus">Video 1</a> -->
    
    <link href="style.css" rel="stylesheet" type="text/css">
    <link href="CSS/header.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" media="screen and (max-aspect-ratio: 4/3)" href="styleSmal.css" />
    <link rel="stylesheet" media="screen and (max-aspect-ratio: 4/3)" href="CSS/headerSmal.css" />
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">     -->
    <script src="Myjs.js"></script>
    <script src="Operator.js"></script>
    <script src="ELDiBEltern.js"></script>
    <script src="JScript/ELDiBLehrer_New.js"></script>
    <script src="ELDiBKind.js"></script>
    <script src="ELDiBLehrer.js"></script>
    <script src="SupportPlan.js"></script>
    <script src="EmailKind.js"></script>
    <script src="EmailEltern.js"></script>
    <!-- <script src="NewClient.js"></script> -->
    <?php
         require "content/db.php";
         include "content/helpers.php";
         include "NewClient.php";
         include "NewUser.php";
         include "Assessors.php";
         include "ELDiBEltern.php";
         include "ELDiBLehrer.php";
         include "ELDiBLehrer_New.php";
        include "ELDiBKind.php";
        include "SupportPlan.php";
        include "SupportPlanForm.php";
        //include "content/ELDiB.php";
        include "OperatorSelectionList.php";
        
        include "EmailKind.php";
        include "EmailEltern.php";
        ?>
</head>

<body>
<!-- <audio controls id="audioPlayer"></audio> -->
<div class="ClientSelection">
  <label for="SelectClient"> </label>
      <select title="SelectClient" name="SelectClient" id="SelectClient" onchange="ChangedSelection()">
      <option class="optionclient" value=0>Kind auswählen</option>
      <?php
      //aktuelles Kind eintragen

      $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    
      $sql = "SELECT * FROM client ";
      $db_erg = mysqli_query( $db_link, $sql );
      if ( ! $db_erg )
      {
        $Inhalt = 'ungültige Bereich Abfrage client: Error message: %s\n'. $db_link->error;
      }
        while ($zeile = mysqli_fetch_assoc( $db_erg))
      {
        // echo '<option class="optionclient" value="'.$zeile['id'].'">('.$zeile['id'].'),'.$zeile['Name'].', '.$zeile['Vorname'].' - '.$zeile['Geburtsdatum'].'</option>';
        echo '<option class="optionclient" value="'.$zeile['id'].'">'.$zeile['Name'].', '.$zeile['Vorname'].' - '.$zeile['Geburtsdatum'].'</option>';
      }
      ?>
      </select>
      <button type="button" onclick="NewClient();">Neu</button><br>
    </div>
<div class="" id="AktualClient">
<!-- wird von Functions.php gefüllt -->
  </div>
  <div class="rightSite" id="rightSite">

  </div>
</body>
</html>


