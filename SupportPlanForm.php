<script src="SupportPlan.js"></script>
<link href="CSS/SupportPlan.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" media="screen and (max-aspect-ratio: 4/3)" href="CSS/SupportPlanSmal.css" />
<div id="SupportPlanForm">
</div>
<?php
if (session_status() == PHP_SESSION_NONE) {
   session_start(); // Starten der Session nur, wenn keine Session aktiv ist
 }
if ( isset($_GET['DeaktiviertShowSupportPlanForm']) ){

// $Inhalt = '<form class="SupportPlanFormular" action="SaveSupportPlanFromData();" method="post" autocomplete="off">';
// $Inhalt = '<form class="SupportPlanFormular" autocomplete="off">';
// $Inhalt.='<textarea id="SupportPlanFormRow1" class="TabInhalt" type="text" name="Row1" value="" autocomplete="off"></textarea>';
// $Inhalt.='<textarea id="SupportPlanFormRow2" class="TabInhalt" type="text" name="Row2" value="" autocomplete="off"></textarea>';
// $Inhalt.='<textarea id="SupportPlanFormRow3" class="TabInhalt" type="text" name="Row3" value="" autocomplete="off"></textarea>';
// $Inhalt.='<textarea id="SupportPlanFormRow4" class="TabInhalt" type="text" name="Row4" value="" autocomplete="off"></textarea>';
// $Inhalt.='<button class="SaveSupportPlanFromData" type="button" onclick="SaveSupportPlanFromData();" >übernehmen</button>';
// $Inhalt.='</form>';
// echo $Inhalt;
}
if ( isset($_GET['SaveSupportPlanFromData']) ){
    include "content/helpers.php";
    require "content/db.php";
    if ($_SESSION['LocalChat'] == true){
      $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }
//SELECT * FROM `supportplan` WHERE `clientID`=37 AND `gespeichert`= 0
$sql = "SELECT * FROM `supportplan` WHERE `clientID` = ".$_SESSION['ActualClient']." AND `gespeichert`= 0";
$db_erg = mysqli_query( $db_link, $sql );
if ( ! $db_erg )
{
   echo  'ungültige Bereich NewLineSupportPlan: Error message: %s\n'. $db_link->error;
}

while ($zeile = mysqli_fetch_assoc( $db_erg))
{
   $actID = $zeile['id'];
}
if($actID > 0){
   $sql = "INSERT INTO `supportplanitems`(`idItem`, `supportplanID`, `Spalte1`, `Spalte2`, `Spalte3`, `Spalte4`) VALUES (NULL,'".$actID."','".$_GET['Row1']."','".$_GET['Row2']."','".$_GET['Row3']."','".$_GET['Row4']."')";
   $db_erg = mysqli_query( $db_link, $sql );
   if ( ! $db_erg )
   {
      echo  'ungültige Bereich NewLineSupportPlan: Error message: %s\n'. $db_link->error;
   }

}

}
?>