<script src="Myjs.js"></script>
<script src="ELDiBEltern.js"></script>
<link href="CSS/ELDiBKEL.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" media="screen and (max-aspect-ratio: 4/3)" href="CSS/ELDiBKELSmal.css" />
<div id="ELDiBElterncontent">
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
if ( isset($_GET['SetELDiBEltern']) ){
    echo '<script>console.log("SetELDiBEltern");</script>';
    $Inhalt= '<div id="ELDiBElternhead">';
    //Prüfen ob eine ungespeicherte Tabelle existiert $TableStatus = 0
    if ($_SESSION['LocalChat'] == true){
      $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
  }
  else{
  $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
  }
      
    $sql = "SELECT * FROM eldibdataeltern WHERE idClient = '".$_GET['SetELDiBEltern']."'";
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
    $Inhalt.= '  <h1>ELDiB Bewertungsbogen Eltern</h1><button type="button" onclick="HideELDiBEltern();" class="btn btn-primary btn-sm">zurück</button>';
    $Inhalt.= '<div class="Schuelerdaten">';  
    $Inhalt.= '<div>';
    $Inhalt.= 'Name : '.$_SESSION["Name"].', '.$_SESSION["Vorname"].' ';
    $Inhalt.=  '</div>';
    $Inhalt.= '<div>';
    $Inhalt.= 'Geburtsdatum : '.$_SESSION["Geburtsdatum"].' ';
    $Inhalt.=  '</div>';
    $Inhalt.= '<div>';
    $Inhalt.= 'email : '.$_SESSION["email"].' ';
    $Inhalt.=  '</div>';
    $Inhalt.= '<div>';
    $Inhalt.= 'Geburtsdatum : '.$_SESSION["Geburtsdatum"].' ';
    $Inhalt.=  '</div>';
    // $Inhalt.= '<div>_____________________________________________</div>';
    $Inhalt.=  '</div>';
    if($TableStatus == 0){
      $Inhalt.='<button type="button" class="btn btn-primary btn-sm" onclick="CreateNewTableELDiBEltern();">neuen Bogen erstellen</button>';
    }
    $Inhalt.= '</div>';
    $ValuesArray = array("Key");
    $ArrayCounter = 1;
    $ValueCounter = 1;
    $ValueSum = 0;
    //Berechnung für Diagramm
    if ($_SESSION['LocalChat'] == true){
      $db_linkHistory = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
  }
  else{
  $db_linkHistory = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
  }
    $sqlHistory = "SELECT * FROM clienthistoryeldibeltern WHERE idChild = '".$_GET['SetELDiBEltern']."' ORDER BY `clienthistoryeldibeltern`.`SaveTime` DESC";
    $db_ergHistory = mysqli_query( $db_linkHistory, $sqlHistory );
    if ( ! $db_ergHistory )
    {
      echo  'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_linkHistory->error;
    }
    
    while ($zeileHistory = mysqli_fetch_assoc( $db_ergHistory))
      {               
        $ActId = $zeileHistory['id'];
            //History Berechnung für Diagramm
            if ($_SESSION['LocalChat'] == true){
              $db_linkHistory2 = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
          }
          else{
          $db_linkHistory2 = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
          }
    for($number = 1; $number < 183; $number ++){
      $sqlHistory2 = "SELECT * FROM clienthistoryeldibeltern WHERE idChild = '".$_GET['SetELDiBEltern']."' AND id = ".$ActId." ORDER BY `clienthistoryeldibeltern`.`SaveTime` DESC";
      $db_ergHistory2 = mysqli_query( $db_linkHistory2, $sqlHistory2 );
      if ( ! $db_ergHistory2 )
      {
        echo  'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_linkHistory2->error;
      }
      
      while ($zeileHistory2 = mysqli_fetch_assoc( $db_ergHistory2))
        {       
          
          $ValueSum = $ValueSum + $zeileHistory2[$number];
          $ValueCounter = $ValueCounter +1;
        }
      }
      $ValuesArray[$ArrayCounter] =  $ValueSum;
      $ValueSum = 0;
      $ArrayCounter = $ArrayCounter + 1;
      $ValueCounter = 1;

    }
    if ($ArrayCounter > 1){
//Bildschirmauflösung ermitteln
      $Maxx = 900 / 1920 * $_SESSION['screen_width'];
      $Maxy = 170/ 1080  * $_SESSION['screen_height'];
      $Distance = $Maxx /($ArrayCounter -1);      
      $StartPosY = $Maxy - $ValuesArray[1];
      $OffsetPos = $Distance / 2;
      $StartPosX = $OffsetPos ;
      $Inhalt.= '<svg class="DiagrammBox" style= "width: '.$Maxx.'px; height: '.$Maxy.'px;">'; //height="$Maxy" width="700"
      for($Test = 1; $Test < $ArrayCounter; $Test ++){
        $Inhalt.= '<line x1="'.$StartPosX.'" y1="'.$StartPosY.'" x2="'.$Distance * ($Test - 1) + $OffsetPos.'" y2="'. $Maxy - $ValuesArray[$Test].'" style="stroke:rgb(255,0,0);stroke-width:2" />';
        $StartPosX = $Distance * ($Test - 1) + $OffsetPos;
        $StartPosY = $Maxy - $ValuesArray[$Test];
  
      }
      $Inhalt.= '</svg>';
    }
    $Inhalt.='</div>';
    $Inhalt.='<div id="ELDiBElterncontainer class="tableFixHead"">';
    $Inhalt.='<table class="table table-bordered table-striped table-hover table-sm">';
    $Inhalt.='<thead>';
    $Inhalt.='<tr class="BeschreibungHead">';
    $Inhalt.='<th class="KELZielBeschreibungHead">Beschreibung</th><th class="KELZielNummerHead">Bereich</th>'; 
    if ($TableStatus >= 1){
      $Inhalt.='<th><button class="btn btn-primary btn-sm" type="button" onclick="SaveTableELDiBEltern();">Bogen speichern</button></th>';
    }

    //History Datum eintragen
    if ($_SESSION['LocalChat'] == true){
      $db_linkHistory = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
  }
  else{
  $db_linkHistory = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
  }
    $sqlHistory = "SELECT * FROM clienthistoryeldibeltern WHERE idChild = '".$_GET['SetELDiBEltern']."' ORDER BY `clienthistoryeldibeltern`.`SaveTime` DESC";
    $db_ergHistory = mysqli_query( $db_linkHistory, $sqlHistory );
    if ( ! $db_ergHistory )
    {
      echo  'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_linkHistory->error;
    }
    
    while ($zeileHistory = mysqli_fetch_assoc( $db_ergHistory))
      {       
        $Inhalt.='<th>'.date("d.m.Y",strtotime($zeileHistory['SaveTime'])).'</th>';
    }
    $Inhalt.='</tr>';
  //alle 4 Bereiche durchgehen
  for($BereichID = 1; $BereichID <=4; $BereichID++){
    $Stufe = 0;

    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    $sql = "SELECT * FROM zieleeldibeltern WHERE BereichID = '".$BereichID."'";
    $db_erg = mysqli_query( $db_link, $sql );
    if ( ! $db_erg )
    {
      echo  'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_link->error;
    }
    while ($zeile = mysqli_fetch_assoc( $db_erg))
      {
        //Stufe anzeigen
      if ($Stufe != $zeile['Stufe']){
        $Inhalt.='<tr>';
      
        //Stufe Beschreibung
        $Inhalt.='<td class="ZielStufe" >Stufe :'.$zeile['Stufe'];

        $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
        $sqls = "SELECT * FROM stufenbeschreibungen WHERE BereichID = '1' AND Stufe = ".$zeile['Stufe']." ";
        $db_ergs = mysqli_query( $db_link, $sqls );
        if ( ! $db_ergs )
          {
            echo 'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_link->error;
          }
          
          while ($zeiles = mysqli_fetch_assoc( $db_ergs))
          {
            $Inhalt.='  '.MyStringHTML($zeiles['Beschreibung1']).'<br> '.MyStringHTML($zeiles['Beschreibung2']).'</td>';
          }
        $Inhalt.= "</tr>";
        $Stufe = $zeile['Stufe'];
      }
      // Beschreibung und Stichwort Ziele eintragem
      $Inhalt.='<td class="KELZielBeschreibung TabContent'.$BereichID.'" ondblclick="readText(this)"> '.MyStringHTML($zeile['ZieleBeschreibung']).'</td>';
      $Inhalt.='<td class="KELZielNummer TabContent'.$BereichID.'" ondblclick="readText(this)">'.$zeile['ZieleNummer'].' '.MyStringHTML($zeile['ZieleStichwort']).'</td>';
      // Value von eldibdatadetailseltern abfragen
      if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
      }
      else{
      $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
      }
      $sqldata = "SELECT * FROM `eldibdatadetailseltern` LEFT JOIN  eldibdataeltern ON eldibdatadetailseltern.idData = eldibdataeltern.idClient WHERE eldibdataeltern.idClient = ".$_GET['SetELDiBEltern']." AND  eldibdatadetailseltern.idZiele = ".$zeile['id']." ";

      $db_ergdata = mysqli_query( $db_link, $sqldata );
      if ( ! $db_ergdata )
        {
          echo 'ungültig Value von eldibdatadetailseltern abfragen: Error message: %s\n'. $db_link->error;
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
        $Inhalt.='<td>
        <label for="Auswahl"> </label>
        <select name="Auswahl" id="AuswahlELDiBEltern" onchange="ChangedSelectionELDiBEltern('.$zeile['id'].','.$idData.',selectedIndex)">';
        if($StatusVal == 0){
          $Inhalt.='<option class="option1" value="später" selected>später</option>';
        }
        else
        {
          $Inhalt.='<option class="option1" value="später" >später</option>';
        }
        if($StatusVal == 1){
          $Inhalt.='<option class="option2" value="übt es jetzt" selected>Übt es jetzt</option>';
        }
        else
        {
          $Inhalt.='<option class="option2" value="übt es jetzt">Übt es jetzt</option>';
        }
        if($StatusVal == 2){
          $Inhalt.='<option class="option3" value="kann das Kind" selected>Kann das Kind</option>';
        }
        else{

            $Inhalt.='<option class="option3" value="kann das Kind" >Kann das Kind</option>';
        }
        $Inhalt.='</select>
        </td>';        
        }   
                //History anzeigen
                $sqlHistory = "SELECT * FROM clienthistoryeldibeltern WHERE idChild = '".$_GET['SetELDiBEltern']."' ORDER BY `clienthistoryeldibeltern`.`SaveTime` DESC";
                $db_ergHistory = mysqli_query( $db_linkHistory, $sqlHistory );
                if ( ! $db_ergHistory )
                {
                  echo  'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_linkHistory->error;
                }
                
                while ($zeileHistory = mysqli_fetch_assoc( $db_ergHistory))
                  {
                    switch ($zeileHistory[$MyZiel]) {
                      case 0:
                        $Inhalt.='<td class="tdELDiBHistory"><div>später</div><br>';
                          break;
                      case 1:
                        $Inhalt.='<td class="tdELDiBHistory"><div>übt es jetzt</div><br>';
                        break;
                      case 2:
                        $Inhalt.='<td class="tdELDiBHistory"><div>kann das Kind</div><br>';
                        break;
                      }
                      $Inhalt = $Inhalt.$zeileHistory[$MyZiel.$Stichwort].'</td>';
                  }

        $Inhalt.= "</tr>";
        $Inhalt.='<tr>';
        if($TableStatus == 1){  
        $Inhalt.= '<td><div class="StichwörterDesc">Stichwörter <input type="text" onchange="ChangedKeywordELDiBEltern('.$zeile['id'].','.$idData.',this.value);" class="Stichwörter" value="'.$keyword.'"></input></div></td>';
        }
        else{
          $Inhalt.= '<td><div class="StichwörterDesc"></div></td>';
        }
        $Inhalt.= "</tr>";
      
      
      }
	
  }
  $Inhalt.= "</table>";			
  $Inhalt.= "</div>";	
    echo $Inhalt;
}

//   //CreateNewTable neuen Abfragebogen erstellen
if ( isset($_GET['CreateNewTableELDiBEltern']) ){
  include_once("content/db.php");
  $host_name = $_SESSION["host_name"]; 
  $database = $_SESSION["database"]; 
  $user_name = $_SESSION["user_name"]; 
  $password = $_SESSION["password"];
  $DataDetailsID = 0;

  //Abfrage ob schom ein Eintrag in eldibdataeltern besteht
  if ($_SESSION['LocalChat'] == true){
    $db_linkExist = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_linkExist = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }
  $sqlExist = "SELECT * FROM `eldibdataeltern` ";
  $db_ergExist = mysqli_query( $db_linkExist, $sqlExist );
  if ( ! $db_ergExist )
  {
    echo  'ungültige CreateNewTableELDiBEltern: Error message: %s\n'. $db_linkExist->error;
  }
  $ElternExist = 0;
  while ($zeileExist = mysqli_fetch_assoc( $db_ergExist))
  {
    $ElternExist = 1;
  }
  if($ElternExist > 0){
    //INSERT INTO `eldibdataeltern` (`id`, `idClient`, `Status`, `CreationTime`, `OperatorReadWrite`, `OperatorReadonly`, `Änderung`) VALUES (NULL, '99', '0', current_timestamp(), '', '', current_timestamp())
    if ($_SESSION['LocalChat'] == true){
      $db_linkNewOp = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
  }
  else{
  $db_linkNewOp = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
  }
    $sqlNewOp = "INSERT INTO `eldibdataeltern` (`id`, `idClient`, `Status`)VALUES (NULL, '".$_GET['CreateNewTableELDiBEltern']."', '0')";
    $db_ergNewOp = mysqli_query( $db_linkNewOp, $sqlNewOp );
    if ( ! $db_ergNewOp )
    {
      echo  'ungültige CreateNewTableELDiBEltern insert new Eltern: Error message: %s\n'. $db_linkNewOp->error;
    }


  }
  //Data Details Tabelle anlegen

  //Alle Bereiche anlegen
  $BereichID = 1;
$db_linkData = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
if ($_SESSION['LocalChat'] == true){
  $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
  }
  else{
  $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
  }
  for($BereichID=1;$BereichID<=4;$BereichID++){

  $sql = "SELECT * FROM zieleeldibeltern WHERE BereichID = '".$BereichID."'";
  $db_erg = mysqli_query( $db_linkData, $sql );
  if ( ! $db_erg )
  {
    echo  'ungültige zieleeldibEltern: %s\n'. $db_linkData->error ;
  }
    while ($zeileData = mysqli_fetch_assoc( $db_erg))
  {

  $sqlData = "INSERT INTO `eldibdatadetailseltern` (`id`, `idData`, `idZiele`, `Value`,`stichwort`) VALUES (NULL, '".$_GET['CreateNewTableELDiBEltern']."', '".$zeileData['id']."', '0',' ')";
  $db_ergData = mysqli_query( $db_link, $sqlData );
  if ( ! $db_ergData )
  {
    echo  'ungültige eldibdatadetailseltern'. $db_link->error;
  }

  }
  //Status Tabelle angelegt eintragen
  if ($_SESSION['LocalChat'] == true){
    $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }
    $sql = "UPDATE `eldibdataeltern` SET `Status` = '1' WHERE `eldibdataeltern`.`idClient` = ".$_GET['CreateNewTableELDiBEltern']."";
    $db_erg = mysqli_query( $db_link, $sql );
    if ( ! $db_erg )
    {
      echo  'ungültige CreateNewTableELDiBEltern: Error message: %s\n'. $db_link->error;
    }
    //id ermitteln
    if ($_SESSION['LocalChat'] == true){
      $db_linkReq = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_linkReq = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }
    $sql = "SELECT * FROM `eldibdataeltern` WHERE `idClient`=".$_GET['CreateNewTableELDiBEltern']."";
    $db_erg = mysqli_query( $db_linkReq, $sql );
    if ( ! $db_erg )
    {
      echo  'ungültige CreateNewTableELDiBEltern Status eintragen in eldibdataeltern: Error message: %s\n'. $db_linkReq->error;
    }
  }
}

//Auswahlfeld Änderung eintragen
if ( isset($_GET['ChangedSelectionELDiBEltern']) ){
  if ($_SESSION['LocalChat'] == true){
    $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
  }
  else{
  $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
  }
  $sql = "UPDATE `eldibdatadetailseltern` SET `Value` = '".$_GET['Auswahl']."' WHERE `eldibdatadetailseltern`.`idZiele` = ".$_GET['IdZiele']." AND `eldibdatadetailseltern`.`idData` = ".$_GET['ChangedSelectionELDiBEltern'].";";
  $db_erg = mysqli_query( $db_link, $sql );
  if ( ! $db_erg )
  {
    echo  'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_link->error;
  }

}

//stichwort Änderung eintragen
if ( isset($_GET['ChangedKeywordELDiBEltern']) ){
  if ($_SESSION['LocalChat'] == true){
    $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
  }
  else{
  $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
  }
  $sql = "UPDATE `eldibdatadetailseltern` SET `stichwort` = '".$_GET['Text']."' WHERE `eldibdatadetailseltern`.`idZiele` = ".$_GET['IdZiele']." AND `eldibdatadetailseltern`.`idData` = ".$_GET['ChangedKeywordELDiBEltern'].";";
  $db_erg = mysqli_query( $db_link, $sql );
  if ( ! $db_erg )
  {
    echo  'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_link->error;
  }

}
if ( isset($_GET['SaveTableELDiBEltern']) ){
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
$sqlChild = "INSERT INTO `clienthistoryeldibeltern` (`id`,`idChild`) VALUES (NULL,'".$_GET['SaveTableELDiBEltern']."')";
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
  $sql = "SELECT * FROM eldibdatadetailseltern WHERE idData = '".$_SESSION['ActualClient']."'";
  $db_erg = mysqli_query( $db_link, $sql );
  if ( !$db_erg )
  {
    echo  'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_link->error;
  }
  while ($zeile = mysqli_fetch_assoc( $db_erg))
    {

    
      
    $sqlZiel = "UPDATE `clienthistoryeldibeltern` SET `".$zeile['idZiele']."` = '".$zeile['Value']."', `".$zeile['idZiele'].$Stichwort."` = '".$zeile['stichwort']."'  WHERE `clienthistoryeldibeltern`.`id` = ".$LastId."";
    
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
  $sql = "UPDATE `eldibdataeltern` SET `Status` = '0' WHERE `eldibdataeltern`.`idClient` = ".$_GET['SaveTableELDiBEltern']."";
  $db_erg = mysqli_query( $db_link, $sql );
  if ( ! $db_erg )
  {
    echo  'ungültige SaveTableELDiBEltern Status 0 setzen: Error message: %s\n'. $db_link->error;
  }
}
?>


