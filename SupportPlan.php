<script src="SupportPlan.js"></script>
<link href="CSS/SupportPlan.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" media="screen and (max-aspect-ratio: 4/3)" href="CSS/SupportPlanSmal.css" />
<div id="SupportPlan">
</div>
    <?php
    if (session_status() == PHP_SESSION_NONE) {
      session_start(); // Starten der Session nur, wenn keine Session aktiv ist
  }
    $SupportplanNotSaved = 1;
if ( isset($_GET['SetSupportPlan']) ){
    require ("content/db.php");
    include ("content/helpers.php");
    //Prüfen ob noch ein offener Supportplan besteht
    if ($SupportplanNotSaved < 2){
      if ($_SESSION['LocalChat'] == true){
        $db_link1 = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
      }
      else{
      $db_link1 = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
      }
      //INSERT INTO `supportplan`(`id`, `clientID`, `erstellt`, `geaendert`, `gespeichert`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]')
        $sql1 = "SELECT * FROM `supportplan` WHERE `clientID`= ".$_SESSION['ActualClient']." AND `gespeichert` = 0";
        $db_erg1 = mysqli_query( $db_link1, $sql1 );
        if ( ! $db_erg1 )
        {
          echo  'ungültige Bereich SetSupportPlan: Error message: %s\n'. $db_link1->error;
        }
        //$SupportplanNotSaved = 4;
        while ($zeile1 = mysqli_fetch_array($db_erg1, MYSQLI_ASSOC)) {
          if($zeile1['clientID'] > 0){
          $SupportplanNotSaved = 0;
          }
        }
      }


    $Inhalt ="";
    $Inhalt = $Inhalt . '<div class="HeadData">';
    if ($_SESSION['LocalChat'] == true){
      $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }

    $sql = "SELECT * FROM client WHERE `id` =  ".$_SESSION['ActualClient']." ";
    $db_erg = mysqli_query( $db_link, $sql );
    if ( ! $db_erg )
    {
      $Inhalt = 'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_link->error;
    }
      while ($zeile = mysqli_fetch_assoc( $db_erg))
    {
    
      $_SESSION['Name'] = $zeile['Name'] ;
      $_SESSION['Vorname'] = $zeile['Vorname'] ;
      $_SESSION['Geburtsdatum'] = $zeile['Geburtsdatum'] ;
      $_SESSION['email'] = $zeile['email'] ;
      $_SESSION['id'] = $zeile['id'] ;
      $Inhalt = "";
      $Inhalt = $Inhalt . '<div>';
      $Inhalt = $Inhalt . 'Name : ('.$zeile['id'].'),'.$zeile['Name'].', '.$zeile['Vorname'].' ';
      $Inhalt = $Inhalt .  '</div>';
      $Inhalt = $Inhalt . '<div>';
      $Inhalt = $Inhalt . 'Geburtsdatum : '.$zeile['Geburtsdatum'].' ';
      $Inhalt = $Inhalt .  '</div>';
      $Inhalt = $Inhalt . '<div>';
      $Inhalt = $Inhalt . 'email : '.$zeile['email'].' ';
      $Inhalt = $Inhalt .  '</div>';
      $Inhalt = $Inhalt . '<div>';
      $Inhalt = $Inhalt . 'Geburtsdatum : '.$zeile['Geburtsdatum'].' ';
      $Inhalt = $Inhalt .  '</div>';
      $Inhalt = $Inhalt . '<div>_____________________________________________</div>';
      $Inhalt = $Inhalt . '<div>';
      $Inhalt = $Inhalt . 'Eltern : '.$zeile['Parentvorname'].'  '.$zeile['Parentname'].'  ';
      $Inhalt = $Inhalt .  '</div>';
      $Inhalt = $Inhalt . '<div>';
      $Inhalt = $Inhalt . 'email Eltern : '.$zeile['Parentemail'].' ';
      $Inhalt = $Inhalt .  '</div>';
      $Inhalt = $Inhalt .  '<div><button typ="button" class="SelectionButton" onclick="HideSupportPlan();">schliessen</button><button typ="button" class="SelectionButton" onclick="LoadELDiBTable();">Liste</button>';

       //SaveSupportPlanButton
       if ($SupportplanNotSaved == 0){
        $Inhalt = $Inhalt .'<button typ="button" id="SaveSupportPlan"class="SaveSupportPlanButton" onclick="SaveSupportPlan('.$_GET['SetSupportPlan'].');">Förderplan speichern</button>';
        $Inhalt = $Inhalt .'<button typ="button" id="CancelSupportPlan"class="SaveSupportPlanButton" onclick="CancelSupportPlan('.$_GET['SetSupportPlan'].');">Förderplan verwerfen</button>';
       }
       else if ($SupportplanNotSaved == 1){
        $Inhalt = $Inhalt .'<button typ="button" id="NewSupportPlan" class="SaveSupportPlanButton" onclick="NewSupportPlan('.$_GET['SetSupportPlan'].');">neuen Förderplan erstellen</button>';
        $Inhalt = $Inhalt .'<button typ="button" id="CreateSupportPlan" class="SaveSupportPlanButton" onclick="CreateSupportPlan('.$_GET['SetSupportPlan'].');">Förderplan automatisch erstellen</button>';
       }
       
        $Inhalt = $Inhalt .'<button typ="button" id="CloseSelectSupportPlan"class="CloseSelectSupportPlan" onclick="CloseSelectSupportPlan();">gespeicherten Förderplan schließen</button>';
       
       //gespeicherte Förderpläne
       $Inhalt = $Inhalt .  '<label for="SelectSupportPlan"> </label>';
       $Inhalt = $Inhalt .  '<select title="SelectSupportPlan" name="SelectSupportPlan" id="SelectSupportPlan" onchange="ChangedSelectionSupportPlan()">';
       $Inhalt = $Inhalt .  '<option class="optionSupportPlan" value=0>gespeicherten Förderplan auswählen</option>';

       //  Supportplan eintragen
       if ($_SESSION['LocalChat'] == true){
        $db_linkSaved = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
      }
      else{
      $db_linkSaved = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
      }
     
       $sqlSaved = "SELECT * FROM `supportplan` WHERE `clientID` = ".$_SESSION['ActualClient']." AND `gespeichert` > 0";
       $db_ergSaved = mysqli_query( $db_linkSaved, $sqlSaved );
       if ( ! $db_ergSaved )
       {
         $Inhalt = 'ungültige Bereich Abfrage client: Error message: %s\n'. $db_linkSaved->error;
       }
         while ($zeileSaved = mysqli_fetch_assoc( $db_ergSaved))
       {
         // echo '<option class="optionSupportPlan" value="'.$zeile['id'].'">('.$zeile['id'].'),'.$zeile['Name'].', '.$zeile['Vorname'].' - '.$zeile['Geburtsdatum'].'</option>';
         $Inhalt = $Inhalt . '<option class="optionSupportPlan" value="'.$zeileSaved['id'].'">'.$zeileSaved['geaendert'].'</option>';
       }

       $Inhalt = $Inhalt .  '</select>';
       //ENDE
       
      $Inhalt = $Inhalt .  '</div>';
      $Inhalt = $Inhalt .  '</div>';
      
    }
    //Überschrift
    $Inhalt = $Inhalt .  '</div>';
    $Inhalt = $Inhalt .  '<div class="ContentTable">';
    $Inhalt = $Inhalt .  '<table>';
    $Inhalt = $Inhalt .  '<tr  class="columnSupportHead">';
    $Inhalt = $Inhalt .  '<td class="columnSupportHead1 heading"><div>Entwicklungsbereiche</div></td>';
    $Inhalt = $Inhalt .  '<td class="columnSupportHead2 heading"><div>Lernausgangslage</div></td>';
    $Inhalt = $Inhalt .  '<td class="columnSupportHead3 heading"><div>Formulierungen</div></td>';
    $Inhalt = $Inhalt .  '<td class="columnSupportHead4 heading"><div>Maßnahmen</div></td>';
    $Inhalt = $Inhalt .  '</tr>';
    $Inhalt = $Inhalt .  '</table>';
    $Inhalt = $Inhalt .  '</div>';
    
    //Inhalt
    $Inhalt = $Inhalt .  '<div class="ContentTableInhalt" id="ContentTableInhalt">';
    $Inhalt = $Inhalt .  '<table>';

    if ($_SESSION['LocalChat'] == true){
      $db_linkDat = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_linkDat = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }
    $sqlDat = "SELECT  * FROM supportplanitems JOIN supportplan ON supportplanitems.`supportplanID`=supportplan.id WHERE supportplan.clientID = ".$_SESSION['ActualClient']." AND supportplan.gespeichert = 0 ";
    $db_ergDat = mysqli_query( $db_linkDat, $sqlDat );
    if ( ! $db_ergDat )
    {
      $Inhalt = 'ungültige Bereich supportplanitems: Error message: %s\n'. $db_linkDat->error;
    }
      while ($zeileDat = mysqli_fetch_assoc( $db_ergDat))
    {
 
    $Inhalt = $Inhalt .  '<tr >';
    $Inhalt = $Inhalt .  '<td class="columnSupport1 TabInhalt"><div  class="columnSupportTextarea" id="columnSupport1" >'.$zeileDat['Spalte1'].'</div></td>';
    $Inhalt = $Inhalt .  '<td class="columnSupport2 TabInhalt"><div class="columnSupportTextarea" id="columnSupport2" >'.$zeileDat['Spalte2'].'</div></td>';
    $Inhalt = $Inhalt .  '<td class="columnSupport3 TabInhalt"><div class="columnSupportTextarea" id="columnSupport3" >'.$zeileDat['Spalte3'].'</div></td>';
    $Inhalt = $Inhalt .  '<td class="columnSupport4 TabInhalt"><div class="columnSupportTextarea" id="columnSupport4" >'.$zeileDat['Spalte4'].'</div></td>';
    $Inhalt = $Inhalt .  '<td  class="TabInhalt"><button type="button" class="columnSupportDeleteButton" onclick="DeleteSupportTextArea('.$zeileDat['idItem'].');">löschen</button></td>';
    $Inhalt = $Inhalt .  '</tr>';
    }
       
    if ($SupportplanNotSaved == 0){
      $Inhalt = $Inhalt .  '<tr  onclick="ShowSupportPlanForm();" >';
      $Inhalt = $Inhalt .  '<td class="columnSupport1 TabEmpty"><div  class="columnSupportdiv" id="columnSupport1"></div></td>';
      $Inhalt = $Inhalt .  '<td class="columnSupport2 TabEmpty"><div onclick="ShowSupportPlanForm();" class="columnSupportdiv" id="columnSupport2"></div></td>';
      $Inhalt = $Inhalt .  '<td class="columnSupport3 TabEmpty"><div onclick="ShowSupportPlanForm();" class="columnSupportdiv" id="columnSupport3"></div></td>';
      $Inhalt = $Inhalt .  '<td class="columnSupport4 TabEmpty"><div onclick="ShowSupportPlanForm();" class="columnSupportdiv" id="columnSupport4"></div></td>';
      $Inhalt = $Inhalt .  '</tr>';
    }
    $Inhalt = $Inhalt .  '</table>';     
    $Inhalt = $Inhalt .  '</div>';
    // $Inhalt = $Inhalt .'<div class="NewLineButtontd"><button typ="button" class="NewLineSupportButton" onclick="NewLineSupportPlan('.$_GET['SetSupportPlan'].');">neue Zeile</button></div>';   

  echo $Inhalt;
}

if ( isset($_GET['TakeOverBereich']) ){
  include ("content/helpers.php");
      	//   Beschreibungen holen
	$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"] ,$_SESSION["database"]);
	// Bereich
	$sql = "SELECT * FROM bereich WHERE id = '".$_GET['TakeOverBereich']."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n'. $db_link->error;
	}
	$myBereichText ="";
	while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {		
		$myBereichText = MyStringHTML($zeile['Text']);		
	}
  ob_end_clean();
  echo $myBereichText;
    }

if ( isset($_GET['TakeOverZiele']) ){
  include ("content/helpers.php");
      	//   Beschreibungen holen
	$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"] ,$_SESSION["database"]);
  	// Ziele
	$sql = "SELECT * FROM ziele WHERE id = '".$_GET['TakeOverZiele']."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n'. $db_link->error;
	}
  $myZieleNummer = "";
  $myZieleStichwort = "";
  $myZieleBeschreibung = "";
  $myBereichID = "";
	while ($zeile1 = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
    $myZieleNummer = $zeile1['ZieleNummer'];
    $myZieleStichwort = $zeile1['ZieleStichwort'];
    $myZieleBeschreibung = $zeile1['ZieleBeschreibung'];
    $myBereichID = $zeile1['BereichID'];		
		// $myBereichText = MyStringHTML($zeile1['Text']);		
	}
	// Bereich
	$sql = "SELECT * FROM bereich WHERE id = '".$myBereichID."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n'. $db_link->error;
	}
	
	while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {		
		$myBereichText = MyStringHTML($zeile['Text']);		
	}
  ob_end_clean();
  echo $myZieleNummer.' '.$myZieleStichwort.'

'.$myZieleBeschreibung;
}
if ( isset($_GET['TakeOverZieleBereich']) ){
  include ("content/helpers.php");
      	//   Beschreibungen holen
	$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"] ,$_SESSION["database"]);
  	// Ziele
	$sql = "SELECT * FROM ziele WHERE id = '".$_GET['TakeOverZieleBereich']."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		 echo  'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n'. $db_link->error;
	}
	$MyBereichID ="";
	while ($zeile1 = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
    $MyBereichID = MyStringHTML($zeile1['BereichID']);		
		// $myBereichText = MyStringHTML($zeile1['Text']);		
	}
	// // Bereich
	// $sql = "SELECT * FROM bereich WHERE id = '".$myBereichID."'";
	// $db_erg = mysqli_query( $db_link, $sql );
	// if ( ! $db_erg )
	// {
	// 	$Inhalt =  'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n'. $db_link->error;
	// }
	
	// while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {		
	// 	$myBereichText = MyStringHTML($zeile['Text']);		
	// }
  ob_end_clean();
  echo $MyBereichID;
}
if ( isset($_GET['TakeOverFormulierungen']) ){
  include ("content/helpers.php");
      	//   Beschreibungen holen
        if ($_SESSION['LocalChat'] == true){
          $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
        }
        else{
        $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
        }
  	// Ziele
	$sql = "SELECT * FROM formulierungen WHERE id = '".$_GET['TakeOverFormulierungen']."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n'. $db_link->error;
	}
	$MyFormulierungen = "";	
    $myZieleID = "";
	while ($zeile1 = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
    $MyFormulierungen = $zeile1['Text'];	
    $myZieleID = $zeile1['ZieleID'];
		// $myBereichText = MyStringHTML($zeile1['Text']);		
	}
  ob_end_clean();
  echo $MyFormulierungen;
}
if ( isset($_GET['TakeOverFormulierungenZiele']) ){
  include ("content/helpers.php");
      	//   Beschreibungen holen
        if ($_SESSION['LocalChat'] == true){
          $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
        }
        else{
        $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
        }
  	// Ziele
	$sql = "SELECT * FROM formulierungen WHERE id = '".$_GET['TakeOverFormulierungenZiele']."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		 echo  'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n'. $db_link->error;
	}
	$MyZieleID ="";
	while ($zeile1 = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
    $MyZieleID = MyStringHTML($zeile1['ZieleID']);		
		// $myBereichText = MyStringHTML($zeile1['Text']);		
	}
  ob_end_clean();
  echo $MyZieleID;
}
if ( isset($_GET['TakeOverMassnahmen']) ){
  include ("content/helpers.php");
      	//   Beschreibungen holen
        if ($_SESSION['LocalChat'] == true){
          $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
        }
        else{
        $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
        }
  	// Ziele
	$sql = "SELECT * FROM massnahmen WHERE id = '".$_GET['TakeOverMassnahmen']."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat Massnahmen: Error message: %s\n'. $db_link->error;
	}
	$MyMassnahmen = "";	
	while ($zeile1 = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
    $MyMassnahmen = $zeile1['Text'];	
		// $myBereichText = MyStringHTML($zeile1['Text']);		
	}
  ob_end_clean();
  echo $MyMassnahmen;
}
if ( isset($_GET['TakeOverMassnahmenFormulierungen']) ){
  include ("content/helpers.php");
      	//   Beschreibungen holen
        if ($_SESSION['LocalChat'] == true){
          $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
        }
        else{
        $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
        }
  	// Ziele
	$sql = "SELECT * FROM massnahmen WHERE id = '".$_GET['TakeOverMassnahmenFormulierungen']."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		 echo  'ungültige Bereich Abfrage Chat Massnahmen: Error message: %s\n'. $db_link->error;
	}
	$MyZieleID ="";
	while ($zeile1 = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
    $MyZieleID = MyStringHTML($zeile1['FormulierungenID']);		
		// $myBereichText = MyStringHTML($zeile1['Text']);		
	}
  ob_end_clean();
  echo $MyZieleID;
}

//NewSupportPlan
if ( isset($_GET['NewSupportPlan']) ){
  // include ("content/helpers.php");
  if ($_SESSION['LocalChat'] == true){
    $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
  }
  else{
  $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
  }
 //INSERT INTO `supportplan`(`id`, `clientID`, `erstellt`, `geaendert`, `gespeichert`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]')
  $sql = "INSERT INTO `supportplan`(`id`, `clientID`) VALUES (NULL,'".$_GET['NewSupportPlan']."')";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		 echo  'ungültige Bereich NewSupportPlan: Error message: %s\n'. $db_link->error;
	}
}

//CreateSupportPlan
if ( isset($_GET['CreateSupportPlan']) ){
  // include ("content/helpers.php");
  if ($_SESSION['LocalChat'] == true){
    $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
  }
  else{
  $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
  }
 //INSERT INTO `supportplan`(`id`, `clientID`, `erstellt`, `geaendert`, `gespeichert`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]')
  $sql = "INSERT INTO `supportplan`(`id`, `clientID`) VALUES (NULL,'".$_GET['CreateSupportPlan']."')";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		 echo  'ungültige Bereich CreateSupportPlan: Error message: %s\n'. $db_link->error;
	}

  // Aufgaben:
  //1. ID der neuen Liste ermitteln*/
  $LastId = $db_link->insert_id;
  //2. neueste EldibLehrerListe des Clients suchen
  //SELECT * FROM eldibdatalehrer where idClient = 37 ORDER BY CreationTime DESC LIMIT 1
  $sql = "SELECT * FROM eldibdatalehrer where idClient = ".$_GET['CreateSupportPlan']." ORDER BY CreationTime DESC LIMIT 1";
  $db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		 echo  'ungültige Bereich CreateSupportPlan: Error message: %s\n'. $db_link->error;
	}
  while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
    $eldibDataLehrerID = $zeile['ID'];
  }
  //3.   in dieser Liste die Einträge "Übt es jetzt" heraussuchen und in SupportItems der erstellten Liste (siehe Punkt 1) eintragen 

}

if ( isset($_GET['SaveSupportPlan']) ){
  // include ("content/helpers.php");
  if ($_SESSION['LocalChat'] == true){
    $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
  }
  else{
  $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
  }
  //UPDATE `supportplan` SET `gespeichert` = '2' WHERE `supportplan`.`id` = 2
  // UPDATE `supportplan` SET `gespeichert` = '1' WHERE `supportplan`.`id` = ".$_GET['SaveSupportPlan']."
   $sql = "UPDATE `supportplan` SET `gespeichert` = '1' WHERE `supportplan`.`clientID` = ".$_GET['SaveSupportPlan']." AND `gespeichert` = '0'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		 echo  'ungültige Bereich SaveSupportPlan: Error message: %s\n'. $db_link->error;
	}
	// $MyZieleID ="";
	// while ($zeile1 = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
  //   $MyZieleID = MyStringHTML($zeile1['FormulierungenID']);		
	// 	// $myBereichText = MyStringHTML($zeile1['Text']);		
	// }
  // ob_end_clean();
  // echo $MyZieleID;
}
//Cancel Supportplan
if ( isset($_GET['CancelSupportPlan']) ){
  // include ("content/helpers.php");
  if ($_SESSION['LocalChat'] == true){
    $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
  }
  else{
  $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
  }
   $sql = "DELETE FROM `supportplan` WHERE `supportplan`.`clientID` = ".$_GET['CancelSupportPlan']." AND `gespeichert` ='0' ";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		 echo  'ungültige Bereich CancelSupportPlan: Error message: %s\n'. $db_link->error;
	}
}
//NewLineSupportPlan
if ( isset($_GET['NewLineSupportPlan']) ){
  include ("content/helpers.php");
      	//   Beschreibungen holen
        if ($_SESSION['LocalChat'] == true){
          $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
        }
        else{
        $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
        }
 //UPDATE `supportplan` SET `clientID` = '37' WHERE `supportplan`.`id` = 1;
	// $sql = "SELECT * FROM massnahmen WHERE id = '".$_GET['TakeOverMassnahmenFormulierungen']."'";
  $sql = "SELECT * FROM massnahmen WHERE id = '".$_GET['TakeOverMassnahmenFormulierungen']."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		 echo  'ungültige Bereich NewLineSupportPlan: Error message: %s\n'. $db_link->error;
	}
	$MyZieleID ="";
	while ($zeile1 = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
    $MyZieleID = MyStringHTML($zeile1['FormulierungenID']);		
		// $myBereichText = MyStringHTML($zeile1['Text']);		
	}
  ob_end_clean();
  echo $MyZieleID;
}
if ( isset($_GET['CheckSupportPlan']) ){
  //Prüfen ob noch ein offener Supportplan besteht
  if ($_SESSION['LocalChat'] == true){
    $db_link1 = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
  }
  else{
  $db_link1 = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
  }
  //INSERT INTO `supportplan`(`id`, `clientID`, `erstellt`, `geaendert`, `gespeichert`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]')
    $sql1 = "SELECT * FROM `supportplan` WHERE `clientID`= ".$_SESSION['ActualClient']." AND `gespeichert` = 0";
    $db_erg1 = mysqli_query( $db_link1, $sql1 );
    if ( ! $db_erg1 )
    {
      echo  'ungültige Bereich CheckSupportPlan: Error message: %s\n'. $db_link1->error;
    }
    $SupportplanNotSaved = 1;
    while ($zeile1 = mysqli_fetch_array($db_erg1, MYSQLI_ASSOC)) {
      if($zeile1['clientID'] > 0){
      $SupportplanNotSaved = 0;
      }
    }
    ob_end_clean();
    echo $SupportplanNotSaved;
}
// ChangedSelectionSupportPlan
if ( isset($_GET['ChangedSelectionSupportPlan']) ){
  require ("content/db.php");
  $Inhalt =  '<table>';

  if ($_SESSION['LocalChat'] == true){
    $db_linkDat = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
  }
  else{
  $db_linkDat = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
  }
  $sqlDat = "SELECT  * FROM supportplanitems JOIN supportplan ON supportplanitems.`supportplanID`=supportplan.id WHERE supportplan.id = ".$_GET['ChangedSelectionSupportPlan']." AND supportplan.gespeichert > 0 ";
  $db_ergDat = mysqli_query( $db_linkDat, $sqlDat );
  if ( ! $db_ergDat )
  {
    $Inhalt = 'ungültige Bereich supportplanitems: Error message: %s\n'. $db_linkDat->error;
  }
    while ($zeileDat = mysqli_fetch_assoc( $db_ergDat))
  {

  $Inhalt = $Inhalt .  '<tr >';
  $Inhalt = $Inhalt .  '<td class="columnSupport1 TabInhalt"><div  class="columnSupportTextarea" id="columnSupport1" >'.$zeileDat['Spalte1'].'</div></td>';
  $Inhalt = $Inhalt .  '<td class="columnSupport2 TabInhalt"><div class="columnSupportTextarea" id="columnSupport2" >'.$zeileDat['Spalte2'].'</div></td>';
  $Inhalt = $Inhalt .  '<td class="columnSupport3 TabInhalt"><div class="columnSupportTextarea" id="columnSupport3" >'.$zeileDat['Spalte3'].'</div></td>';
  $Inhalt = $Inhalt .  '<td class="columnSupport4 TabInhalt"><div class="columnSupportTextarea" id="columnSupport4" >'.$zeileDat['Spalte4'].'</div></td>';
  $Inhalt = $Inhalt .  '</tr>';
  }
  $SupportplanNotSaved = 2;  
  $Inhalt = $Inhalt .  '</table>';     
  $Inhalt = $Inhalt .  '</div>';
  echo $Inhalt;
}
//CloseSelectSupportPlan
if ( isset($_GET['CloseSelectSupportPlan']) ){
  $SupportplanNotSaved = 0; 
}
if ( isset($_GET['DeleteSupportTextArea']) ){
  if ($_SESSION['LocalChat'] == true){
    $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
  }
  else{
  $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
  }
  $sql = "DELETE FROM supportplanitems WHERE `supportplanitems`.`idItem` = '".$_GET['DeleteSupportTextArea']."' ";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		 echo  'ungültige Bereich DeleteSupportTextArea: Error message: %s\n'. $db_link->error;
	}
}
//
?>
