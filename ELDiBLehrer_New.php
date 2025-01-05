<script src="Myjs.js"></script>
<script src="JScript/ELDiBLehrer_New.js"></script>
<link href="CSS/ELDiBKEL.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" media="screen and (max-aspect-ratio: 4/3)" href="CSS/ELDiBKELSmal.css" />
<div id="ELDiBLehrercontent_New">
</div>
<!-- </body>
</html> -->

<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start(); // Starten der Session nur, wenn keine Session aktiv ist
}
$Stichwort = " stichwort";
include("content/db.php");
include_once("content/helpers.php");
//Seitenansicht
if ( isset($_GET['SetELDiBLehrerNew']) ){
    echo '<script>console.log("SetELDiBLehrerNew");</script>';
    $Inhalt =  '<div id="ELDiBLehrerhead">';
    //Prüfen ob eine ungespeicherte Tabelle existiert $TableStatus = 0

    if ($_SESSION['LocalChat'] == true){
      $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }
      
    $sql = "SELECT * FROM eldibdatalehrer WHERE idClient = '".$_GET['SetELDiBLehrerNew']."'";
    $db_erg = mysqli_query( $db_link, $sql );
    if ( ! $db_erg )
    {
      echo  'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_link->error;
    }
    $TableStatus = 0;
      while ($zeile = mysqli_fetch_assoc( $db_erg))
    {

        $TableStatus = $zeile['Status'];
      
    }
    $Inhalt = $Inhalt . '  <h1>ELDiB Bewertungsbogen Lehrer</h1>';

    $Inhalt = $Inhalt . '<div class="MBackButton"><button type="button" onclick="HideELDiBLehrer();" class="ButtonBack">zurück</button></div>';
    $Inhalt = $Inhalt . '<div class="Schuelerdaten">';    
    $Inhalt = $Inhalt . '<div>';
    $Inhalt = $Inhalt . 'Name : '.$_SESSION["Name"].', '.$_SESSION["Vorname"].' ';
    $Inhalt = $Inhalt .  '</div>';
    $Inhalt = $Inhalt . '<div>';
    $Inhalt = $Inhalt . 'Geburtsdatum : '.$_SESSION["Geburtsdatum"].' ';
    $Inhalt = $Inhalt .  '</div>';
    $Inhalt = $Inhalt . '<div>';
    $Inhalt = $Inhalt . 'email : '.$_SESSION["email"].' ';
    $Inhalt = $Inhalt .  '</div>';
    $Inhalt = $Inhalt . '<div>';
    $Inhalt = $Inhalt . 'Geburtsdatum : '.$_SESSION["Geburtsdatum"].' ';
    $Inhalt = $Inhalt .  '</div>';

    // $Inhalt = $Inhalt . '<div>_____________________________________________</div>';
    $Inhalt = $Inhalt .  '</div>';
    $Inhalt = $Inhalt . '<div>';
    if($TableStatus == 0){
      $Inhalt = $Inhalt .'<button type="button" class="CreateNewTableELDiBKEL" onclick="CreateNewTableELDiBLehrer();">neuen Bogen erstellen</button>';
    }
    $Inhalt = $Inhalt . '</div>';
    $ValuesArray = array("Key");
    $ArrayCounter = 1;
    $ValueCounter = 1;
    $ValueSum = 0;
    //Berechnung für Diagramm
    // if ($_SESSION['LocalChat'] == true){
    //   $db_linkHistory = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    // }
    // else{
    //   $db_linkHistory = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    // }
    // $sqlHistory = "SELECT * FROM clienthistoryeldiblehrer WHERE idChild = '".$_GET['SetELDiBLehrerNew']."' ORDER BY `clienthistoryeldiblehrer`.`SaveTime` DESC";
    // $db_ergHistory = mysqli_query( $db_linkHistory, $sqlHistory );
    // if ( ! $db_ergHistory )
    // {
    //   echo  'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_linkHistory->error;
    // }
    
    // while ($zeileHistory = mysqli_fetch_assoc( $db_ergHistory))
    //   {               
    //   $ActId = $zeileHistory['id'];
    //     //History Berechnung für Diagramm
    //     if ($_SESSION['LocalChat'] == true){
    //       $db_linkHistory2 = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    //     }
    //     else{
    //       $db_linkHistory2 = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    //     }
    // for($number = 1; $number < 183; $number ++){
    //   $sqlHistory2 = "SELECT * FROM clienthistoryeldiblehrer WHERE idChild = '".$_GET['SetELDiBLehrerNew']."' AND id = ".$ActId." ORDER BY `clienthistoryeldiblehrer`.`SaveTime` DESC";
    //   $db_ergHistory2 = mysqli_query( $db_linkHistory2, $sqlHistory2 );
    //   if ( ! $db_ergHistory2 )
    //   {
    //     echo  'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_linkHistory2->error;
    //   }
      
    //   while ($zeileHistory2 = mysqli_fetch_assoc( $db_ergHistory2))
    //   {       
        
    //     $ValueSum = $ValueSum + $zeileHistory2[$number];
    //     $ValueCounter = $ValueCounter +1;
    //   }
    // }
    // $ValuesArray[$ArrayCounter] =  $ValueSum;
    // $ValueSum = 0;
    // $ArrayCounter = $ArrayCounter + 1;
    // $ValueCounter = 1;

    // }
    // if ($ArrayCounter > 1){
    //   //Bildschirmauflösung ermitteln
    //   $Maxx = 900 / 1920 * $_SESSION['screen_width'];
    //   $Maxy = 150/ 1080  * $_SESSION['screen_height'];
    //   $Distance = $Maxx /($ArrayCounter -1);
    
      
    //   $StartPosY = $Maxy - $ValuesArray[1];
    //   $OffsetPos = $Distance / 2;
    //   $StartPosX = $OffsetPos ;
    //   $Inhalt = $Inhalt . '<svg class="DiagrammBox" style= "width: '.$Maxx.'px; height: '.$Maxy.'px;">'; //height="$Maxy" width="700"
    //   for($Test = 1; $Test < $ArrayCounter; $Test ++){
    //     $Inhalt = $Inhalt . '<line x1="'.$StartPosX.'" y1="'.$StartPosY.'" x2="'.$Distance * ($Test - 1) + $OffsetPos.'" y2="'. $Maxy - $ValuesArray[$Test].'" style="stroke:rgb(255,0,0);stroke-width:2" />';
    //     $StartPosX = $Distance * ($Test - 1) + $OffsetPos;
    //     $StartPosY = $Maxy - $ValuesArray[$Test];

    //   }
    //   $Inhalt = $Inhalt . '</svg>';
    // }
    $Inhalt = $Inhalt .'</div>';
    $Inhalt = $Inhalt .'<div id="ELDiBLehrercontainer" class="tableFixHead">';
    $Inhalt = $Inhalt .'<table>';
    $Inhalt = $Inhalt .'<thead>';
    $Inhalt = $Inhalt .'<tr class="BeschreibungHead">';
    $Inhalt = $Inhalt .'<td class="KELZielBeschreibungHead">Beschreibung</td><td class="KELZielNummerHead">Bereich</td>'; 
    if ($TableStatus >= 1){
      $Inhalt = $Inhalt .'<td><button type="button" onclick="SaveTableELDiBLehrer();">Bogen speichern</button></td>';
    }
    echo $Inhalt;
  }
  if ( isset($_GET['SetELDiBLehrerNew222'])){
    //History Datum eintragen
    // if ($_SESSION['LocalChat'] == true){
    //   $db_linkHistory = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    // }
    // else{
    //   $db_linkHistory = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    // }
    // $sqlHistory = "SELECT * FROM clienthistoryeldiblehrer WHERE idChild = '".$_GET['SetELDiBLehrerNew']."' ORDER BY `clienthistoryeldiblehrer`.`SaveTime` DESC";
    // $db_ergHistory = mysqli_query( $db_linkHistory, $sqlHistory );
    // if ( ! $db_ergHistory )
    // {
    //   echo  'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_linkHistory->error;
    // }
    
    // while ($zeileHistory = mysqli_fetch_assoc( $db_ergHistory))
    //   {       
    //     $Inhalt = $Inhalt .'<td>'.date("d.m.Y",strtotime($zeileHistory['SaveTime'])).'</td>';
    // }

    $Inhalt = $Inhalt .'</tr>';
    $Inhalt = $Inhalt .'</thead>';
//    echo $Inhalt;
//  }
//  if ( isset($_GET['SetELDiBLehrerNewp2']) ){
  //alle 4 Bereiche durchgehen
  for($BereichID = 1; $BereichID <=4; $BereichID++)
    {
    $Stufe = 0;

    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    $sql = "SELECT * FROM zieleeldiblehrer WHERE BereichID = '".$BereichID."'";
    $db_erg = mysqli_query( $db_link, $sql );
    if ( ! $db_erg )
    {
      echo  'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_link->error;
    }
    while ($zeile = mysqli_fetch_assoc( $db_erg))
      {
        //Stufe anzeigen
      if ($Stufe != $zeile['Stufe']){
        $Inhalt = $Inhalt .'<tr>';
      
        //Stufe Beschreibung
        $Inhalt = $Inhalt .'<td class="ZielStufe" >Stufe :'.$zeile['Stufe'];
        $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
        $sqls = "SELECT * FROM stufenbeschreibungen WHERE BereichID = '1' AND Stufe = ".$zeile['Stufe']." ";
        $db_ergs = mysqli_query( $db_link, $sqls );
        if ( ! $db_ergs )
          {
            echo 'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_link->error;
          }
          
          while ($zeiles = mysqli_fetch_assoc( $db_ergs))
          {
            $Inhalt = $Inhalt .'  '.MyStringHTML($zeiles['Beschreibung1']).'<br> '.MyStringHTML($zeiles['Beschreibung2']).'</td>';
          }
          $Inhalt = $Inhalt . "</tr>";
        $Stufe = $zeile['Stufe'];
      }
      // Beschreibung und Stichwort Ziele eintragem
      $Inhalt = $Inhalt .'<td class="KELZielBeschreibung TabContent'.$BereichID.'"> '.MyStringHTML($zeile['ZieleBeschreibung']).'</td>';
      $Inhalt = $Inhalt .'<td class="KELZielNummer TabContent'.$BereichID.'">'.$zeile['ZieleNummer'].' '.MyStringHTML($zeile['ZieleStichwort']).'</td>';
      // Value von eldibdatadetailslehrer abfragen
      if ($_SESSION['LocalChat'] == true)
      {
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
      }
      else{
        $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
      }
      //$sqldata = "SELECT * FROM clienthistoryeldiblehrer WHERE idChild = '".$_GET['SetELDiBLehrerNew']."' ORDER BY `clienthistoryeldiblehrer`.`SaveTime` DESC";
      $sqldata = "SELECT * FROM `eldibdatadetailslehrer` LEFT JOIN  eldibdatalehrer ON eldibdatadetailslehrer.idData = eldibdatalehrer.idClient WHERE eldibdatalehrer.idClient = ".$_GET['SetELDiBLehrerNew']." AND  eldibdatadetailslehrer.idZiele = ".$zeile['id']." ";

      $db_ergdata = mysqli_query( $db_link, $sqldata );
      if ( ! $db_ergdata )
        {
          echo 'ungültig Value von eldibdatadetailslehrer abfragen: Error message: %s\n'. $db_link->error;
        }
        $idData = 999;
        $StatusVal = 4;
        $keyword ="";
        while ($zeiledata = mysqli_fetch_assoc( $db_ergdata))
        {
          $StatusVal = $zeiledata['Value'];
          // echo $zeiledata['Value'].'<br>';
          $idData = $zeiledata['idData'];
          $keyword = $zeiledata['stichwort'];
          $MyZiel = $zeiledata['idZiele'];
        }
        //das Select entsprechend dem Status setzen
        if($TableStatus == 1){  
        $Inhalt = $Inhalt .'<td>
        <label for="Auswahl"> </label>
        <select name="Auswahl" id="AuswahlELDiBLehrer" onchange="ChangedSelectionELDiBLehrer('.$zeile['id'].','.$idData.',selectedIndex)">';
        if($StatusVal == 0){
          $Inhalt = $Inhalt .'<option class="option1" value="später" selected>später</option>';
        }
        else
        {
          $Inhalt = $Inhalt .'<option class="option1" value="später" >später</option>';
        }
        if($StatusVal == 1){
          $Inhalt = $Inhalt .'<option class="option2" value="übt es jetzt" selected>Übt es jetzt</option>';
        }
        else
        {
          $Inhalt = $Inhalt .'<option class="option2" value="übt es jetzt">Übt es jetzt</option>';
        }
        if($StatusVal == 2){
          $Inhalt = $Inhalt .'<option class="option3" value="kann das Kind" selected>Kann das Kind</option>';
        }
        else{

            $Inhalt = $Inhalt .'<option class="option3" value="kann das Kind" >Kann das Kind</option>';
        }
        $Inhalt = $Inhalt .'</select>
        </td>';        
        }   
        //History anzeigen
        $sqlHistory = "SELECT * FROM clienthistoryeldiblehrer WHERE idChild = '".$_GET['SetELDiBLehrerNew']."' ORDER BY `clienthistoryeldiblehrer`.`SaveTime` DESC";
        $db_ergHistory = mysqli_query( $db_linkHistory, $sqlHistory );
        if ( ! $db_ergHistory )
        {
          echo  'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_linkHistory->error;
        }
        
        while ($zeileHistory = mysqli_fetch_assoc( $db_ergHistory))
          {
            switch ($zeileHistory[$MyZiel]) {
              case 0:
                $Inhalt = $Inhalt .'<td class="tdELDiBHistory"><div>später</div><br>';
                  break;
              case 1:
                $Inhalt = $Inhalt .'<td class="tdELDiBHistory"><div>übt es jetzt</div><br>';
                break;
              case 2:
                $Inhalt = $Inhalt .'<td class="tdELDiBHistory"><div>kann das Kind</div><br>';
                break;
              }
              $Inhalt = $Inhalt.$zeileHistory[$MyZiel.$Stichwort].'</td>';
          }

        $Inhalt = $Inhalt . "</tr>";
        $Inhalt = $Inhalt .'<tr>';
        if($TableStatus == 1){  
        $Inhalt = $Inhalt . '<td><div class="StichwörterDesc">Stichwörter <input type="text" onchange="ChangedKeywordELDiBLehrer('.$zeile['id'].','.$idData.',this.value);" class="Stichwörter" value="'.$keyword.'"></input></div></td>';
        }
        else{
          $Inhalt = $Inhalt . '<td><div class="StichwörterDesc"></div></td>';
        }
        $Inhalt = $Inhalt . "</tr>";
      
      
      }
	
  }
  $Inhalt = $Inhalt . "</table>";			
  $Inhalt = $Inhalt . "</div>";	
    echo $Inhalt;
}

//   //CreateNewTable neuen Abfragebogen erstellen
if ( isset($_GET['CreateNewTableELDiBLehrer']) ){
  include_once("content/db.php");
  $host_name = $_SESSION["host_name"]; 
  $database = $_SESSION["database"]; 
  $user_name = $_SESSION["user_name"]; 
  $password = $_SESSION["password"];
  $DataDetailsID = 0;

  //Abfrage ob schom ein Eintrag in eldibdatalehrer besteht
  if ($_SESSION['LocalChat'] == true){
    $db_linkExist = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
  }
  else{
  $db_linkExist = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
  }
  $sqlExist = "SELECT * FROM `eldibdatalehrer` ";
  $db_ergExist = mysqli_query( $db_linkExist, $sqlExist );
  if ( ! $db_ergExist )
  {
    echo  'ungültige CreateNewTableELDiBLehrer: Error message: %s\n'. $db_linkExist->error;
  }
  $LehrerExist = 0;
  while ($zeileExist = mysqli_fetch_assoc( $db_ergExist))
  {
    $LehrerExist = 1;
  }
  if($LehrerExist > 0){
    //INSERT INTO `eldibdatalehrer` (`id`, `idClient`, `Status`, `CreationTime`, `OperatorReadWrite`, `OperatorReadonly`, `Änderung`) VALUES (NULL, '99', '0', current_timestamp(), '', '', current_timestamp())
    if ($_SESSION['LocalChat'] == true){
      $db_linkNewOp = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_linkNewOp = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }
    $sqlNewOp = "INSERT INTO `eldibdatalehrer` (`id`, `idClient`, `Status`)VALUES (NULL, '".$_GET['CreateNewTableELDiBLehrer']."', '0')";
    $db_ergNewOp = mysqli_query( $db_linkNewOp, $sqlNewOp );
    if ( ! $db_ergNewOp )
    {
      echo  'ungültige CreateNewTableELDiBLehrer insert new Lehrer: Error message: %s\n'. $db_linkNewOp->error;
    }
    $LastId = $db_linkNewOp->insert_id;

  }
  //Data Details Tabelle anlegen


  //Alle Bereiche anlegen
  $BereichID = 1;
  if ($_SESSION['LocalChat'] == true){
    $db_linkData = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
  }
  else{
  $db_linkData = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
  }
  for($BereichID=1;$BereichID<=4;$BereichID++){

    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);

    $sql = "SELECT * FROM zieleeldiblehrer WHERE BereichID = '".$BereichID."'";
    $db_erg = mysqli_query( $db_link, $sql );
    if ( ! $db_erg )
      {
        echo  'ungültige zieleeldibLehrer: %s\n'. $db_link->error ;
      }
    while ($zeileData = mysqli_fetch_assoc( $db_erg))
    {
      $sqlData = "INSERT INTO `eldibdatadetailslehrer` (`id`, `idData`,`idDatas`, `idZiele`, `Value`,`stichwort`) VALUES (NULL, '".$_GET['CreateNewTableELDiBLehrer']."', '".$LastId."', '".$zeileData['id']."', '0',' ')";
      $db_ergData = mysqli_query( $db_linkData, $sqlData );
      if ( ! $db_ergData )
      {
        echo  'ungültige eldibdatadetailslehrer'. $db_linkData->error;
      }

    }
    //Status Tabelle angelegt eintragen
    if ($_SESSION['LocalChat'] == true){
      $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
      $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }
    $sql = "UPDATE `eldibdatalehrer` SET `Status` = '1' WHERE `eldibdatalehrer`.`idClient` = ".$_GET['CreateNewTableELDiBLehrer']."";
    $db_erg = mysqli_query( $db_link, $sql );
    if ( ! $db_erg )
    {
      echo  'ungültige CreateNewTableELDiBLehrer: Error message: %s\n'. $db_link->error;
    }
    //id ermitteln
    if ($_SESSION['LocalChat'] == true){
      $db_linkReq = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
      $db_linkReq = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }
    $sql = "SELECT * FROM `eldibdatalehrer` WHERE `idClient`=".$_GET['CreateNewTableELDiBLehrer']."";
    $db_erg = mysqli_query( $db_linkReq, $sql );
    if ( ! $db_erg )
    {
      echo  'ungültige CreateNewTableELDiBLehrer Status eintragen in eldibdatalehrer: Error message: %s\n'. $db_linkReq->error;
    }
  }
}

//Auswahlfeld Änderung eintragen
if ( isset($_GET['ChangedSelectionELDiBLehrer']) ){
  if ($_SESSION['LocalChat'] == true){
    $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
  }
  else{
  $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
  }
  $sql = "UPDATE `eldibdatadetailslehrer` SET `Value` = '".$_GET['Auswahl']."' WHERE `eldibdatadetailslehrer`.`idZiele` = ".$_GET['IdZiele']." AND `eldibdatadetailslehrer`.`idData` = ".$_GET['ChangedSelectionELDiBLehrer'].";";
  $db_erg = mysqli_query( $db_link, $sql );
  if ( ! $db_erg )
  {
    echo  'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_link->error;
  }

}

//stichwort Änderung eintragen
if ( isset($_GET['ChangedKeywordELDiBLehrer']) ){
  if ($_SESSION['LocalChat'] == true){
    $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
  }
  else{
  $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
  }
  $sql = "UPDATE `eldibdatadetailslehrer` SET `stichwort` = '".$_GET['Text']."' WHERE `eldibdatadetailslehrer`.`idZiele` = ".$_GET['IdZiele']." AND `eldibdatadetailslehrer`.`idData` = ".$_GET['ChangedKeywordELDiBLehrer'].";";
  $db_erg = mysqli_query( $db_link, $sql );
  if ( ! $db_erg )
  {
    echo  'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_link->error;
  }

}
if ( isset($_GET['SaveTableELDiBLehrer']) ){
  //clienthistory Tabelle erstellen
//Ziele auslesen
// $Stichwort = " stichwort";
if ($_SESSION['LocalChat'] == true){
  $db_linkZiel = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
}
else{
$db_linkZiel = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
}
// $position = "ChangeTime";
//Client eintragen
if ($_SESSION['LocalChat'] == true){
  $db_linkChild = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
}
else{
$db_linkChild = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
}
$sqlChild = "INSERT INTO `clienthistoryeldiblehrer` (`id`,`idChild`) VALUES (NULL,'".$_GET['SaveTableELDiBLehrer']."')";
$db_ergChild = mysqli_query( $db_linkChild, $sqlChild );
if ( !$db_ergChild )
{
  echo  'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_linkChild->error;
}

$LastId = $db_linkChild->insert_id;

for($BereichID = 1; $BereichID <=4; $BereichID++){
  if ($_SESSION['LocalChat'] == true){
    $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
  }
  else{
  $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
  }
  $sql = "SELECT * FROM eldibdatadetailslehrer WHERE idData = '".$_SESSION['ActualClient']."'";
  $db_erg = mysqli_query( $db_link, $sql );
  if ( !$db_erg )
  {
    echo  'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_link->error;
  }
  while ($zeile = mysqli_fetch_assoc( $db_erg))
    {

    
      
    $sqlZiel = "UPDATE `clienthistoryeldiblehrer` SET `".$zeile['idZiele']."` = '".$zeile['Value']."', `".$zeile['idZiele'].$Stichwort."` = '".$zeile['stichwort']."'  WHERE `clienthistoryeldiblehrer`.`id` = ".$LastId."";
    
    $db_ergZiel = mysqli_query( $db_linkZiel, $sqlZiel );
    // $position = $zeile['ZieleNummer'];
    if ( !$db_ergZiel )
    {
      echo  'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_linkZiel->error;
    }

    }
    
  }
  //
  //Status Tabelle angelegt austragen
  if ($_SESSION['LocalChat'] == true){
    $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
  }
  else{
  $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
  }
  $sql = "UPDATE `eldibdatalehrer` SET `Status` = '0' WHERE `eldibdatalehrer`.`idClient` = ".$_GET['SaveTableELDiBLehrer']."";
  $db_erg = mysqli_query( $db_link, $sql );
  if ( ! $db_erg )
  {
    echo  'ungültige SaveTableELDiBLehrer Status 0 setzen: Error message: %s\n'. $db_link->error;
  }
  // //details löschen
  // $sql = "DELETE FROM `eldibdatadetailslehrer` WHERE `eldibdatadetailslehrer`.`idData` = ".$_GET['SaveTableELDiBLehrer']."";
  // $db_erg = mysqli_query( $db_link, $sql );
  // if ( ! $db_erg )
  // {
  //   echo  'ungültige SaveTableELDiBLehrer löschen details : Error message: %s\n'. $db_link->error;
  // }
}
?>


