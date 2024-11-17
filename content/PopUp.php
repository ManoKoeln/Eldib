<link href="CSS/PopUp.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" media="screen and (max-aspect-ratio: 4/3)" href="CSS/PopUpSmal.css" />

<div  id="MyPopUp" >
	<div class="container" id="MyPopUpText">		
		<div class="PopUpDiv1" id="PopUpDiv1">diese Funktion - PopUpDiv1 - wir zur Zeit noch entwickelt</div>
		<div class="PopUpDiv2" id="PopUpDiv2"></div>
	</div>
</div>


<?php
$PopUpEditFormulierungenID;
include_once("helpers.php");


// Insert Formulierungen
if (isset($_GET['PopUpInsertFormulierungenID'])) {
    fPopUpInsertFormulierungenID1();
}
function fPopUpInsertFormulierungenID1(){
	if (isset($_GET['PopUpInsertFormulierungenID'])) {
		$PopUpInsertFormulierungenID = $_GET['PopUpInsertFormulierungenID'];
		$_SESSION['PopUpInsertFormulierungenID'] = $PopUpInsertFormulierungenID;
	}
	else
	{
		$PopUpInsertFormulierungenID = $_SESSION['PopUpInsertFormulierungenID'];
	}

	$Inhalt ="";
	//Linke Seite
	$Inhalt = $Inhalt.'<table class="ChatFormulierungenTabel">';
	$Inhalt = $Inhalt.'<tr class="ZielTab">';

	//   Beschreibungen holen        
	//Ziele
	$db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"] ,$_SESSION["database"]);
	$sql = "SELECT * FROM ziele WHERE id = '".$PopUpInsertFormulierungenID."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n'. $db_link->error;
	}


	while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
		$myZieleNummer = $zeile['ZieleNummer'];
		$myZieleStichwort = $zeile['ZieleStichwort'];
		$myZieleBeschreibung = MyStringHTML($zeile['ZieleBeschreibung']);
		$myBereichID = $zeile['BereichID'];

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

	//Ende   Beschreibungen holen
	$Inhalt = $Inhalt.'<td class="BereichText">'.$myBereichText.'</td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt.'<td class="ZielZieleNummer">'.$myZieleNummer.' </td>';
	$Inhalt = $Inhalt.'<td class="ZielZieleStichwort">'.$myZieleStichwort.' </td>';
	$Inhalt = $Inhalt.'<td class="ZielZieleBeschreibung">'.$myZieleBeschreibung.' </td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt."<td>Du möchtest einen neuen Eintrag machen :</td>";
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt.'<td><form action="ELDiB.php" target="top" method="get">
	<textarea id="PopUpTextFormulierungen" type="text/html" name="PopUpEingabe" placeholder="Ihr Text"></textarea><br>	
	</form></td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt.'<td>';													
	// $Inhalt = $Inhalt.'<button type="button" onclick="InsertPopUpFormulierungen('.MyString($PopUpInsertFormulierungenID).','.MyString($_SESSION["userid"]).','.MyString($myFormulierungenText).');" > speichern</button></td>';	
	$Inhalt = $Inhalt.'<button type="button" onclick="InsertFormulierungen('.MyString($PopUpInsertFormulierungenID).');" > speichern</button></td>';	
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt.'<td>';
	$Inhalt = $Inhalt.'<button type="button" onclick="NoDisplayInsertPopUpFormulierungen();" > schliessen</button></td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'</table>';	
	echo $Inhalt;
}
// Edit Formulierungen
if (isset($_GET['PopUpEditFormulierungenID'])) {
    fPopUpEditFormulierungenID1();
}
function fPopUpEditFormulierungenID1(){
	if (isset($_GET['PopUpEditFormulierungenID'])) {
		$PopUpEditFormulierungenID = $_GET['PopUpEditFormulierungenID'];
		$_SESSION['PopUpEditFormulierungenID'] = $PopUpEditFormulierungenID;
	}
	else
	{
		$PopUpEditFormulierungenID = $_SESSION['PopUpEditFormulierungenID'];
	}

	$Inhalt ="";
	//Linke Seite
	$Inhalt = $Inhalt.'<table class="ChatFormulierungenTabel">';
	$Inhalt = $Inhalt.'<tr class="ZielTab">';

	//   Beschreibungen holen
	if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }

	//Formulierungen
	$sql = "SELECT * FROM formulierungen WHERE id = '".$PopUpEditFormulierungenID."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n'. $db_link->error;
	}


	while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
		$myFormulierungenText = $zeile['Text'];
		$myZielID = $zeile['ZieleID'];

	}


    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
	//Ziele
	$sql = "SELECT * FROM ziele WHERE id = '".$myZielID."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n'. $db_link->error;
	}


	while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
		$myZieleNummer = $zeile['ZieleNummer'];
		$myZieleStichwort = $zeile['ZieleStichwort'];
		$myZieleBeschreibung = MyStringHTML($zeile['ZieleBeschreibung']);
		$myBereichID = $zeile['BereichID'];

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

	//Ende   Beschreibungen holen
    
	$Inhalt = $Inhalt.'<td class="BereichText">'.$myBereichText.'</td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt.'<td class="ZielZieleNummer">'.$myZieleNummer.' </td>';
	$Inhalt = $Inhalt.'<td class="ZielZieleStichwort">'.$myZieleStichwort.' </td>';
	$Inhalt = $Inhalt.'<td class="ZielZieleBeschreibung">'.$myZieleBeschreibung.' </td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt."<td>Du möchtest diesen Eintrag ändern :</td>";
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt.'<td><form action="ELDiB.php" target="top" method="get">
	<textarea id="PopUpEditFormulierungenText" type="text/html" name="PopUpEingabe" placeholder="Ihr Text">'.$myFormulierungenText.'</textarea><br>	
	</form></td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt.'<td>';													
	$Inhalt = $Inhalt.'<button type="button" onclick="EditFormulierungen('.MyString($PopUpEditFormulierungenID).');" > speichern</button></td>';	
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt.'<td>';
	$Inhalt = $Inhalt.'<button type="button" onclick="NoDisplayEditPopUpFormulierungen();" > schliessen</button></td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'</table>';	
	echo $Inhalt;
}

if ( isset($_GET['EditFormulierungen']) )
{
	$parent = $_GET['EditFormulierungen'];
	// $FormulierungenId = $_GET['FormulierungenId'];
	$TextFormulierungen = $_GET['text'];

	// FormulierungenId="+id+"&TextFormulierungen
    echo '<scrip>console.log("Versuchtext");</script>';
    // echo '<script>console.log("php EditFormulierungen parent = ' . $parent . ' ___ text = ' . $TextFormulierungen . '");</script>';
	
	if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }
	$sql = "UPDATE `formulierungen` SET `Text` = '".$TextFormulierungen."' WHERE `formulierungen`.`id` = '".$parent."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige EditFormulierungen: Error message: %s\n'. $db_link->error;
	}	
}

// Delete Formulierungen

if ( isset($_GET['PopUpDeleteFormulierungenID'])){
    fPopUpDeleteFormulierungenID1();
}
function fPopUpDeleteFormulierungenID1(){
	if (isset($_GET['PopUpDeleteFormulierungenID'])) {
		$PopUpDeleteFormulierungenID = $_GET['PopUpDeleteFormulierungenID'];
		$_SESSION['PopUpDeleteFormulierungenID'] = $PopUpDeleteFormulierungenID;
	}
	else
	{
		$PopUpDeleteFormulierungenID = $_SESSION['PopUpDeleteFormulierungenID'];
	}

	$Inhalt ="";
	//Linke Seite
	$Inhalt = $Inhalt.'<table class="ChatFormulierungenTabel">';
	$Inhalt = $Inhalt.'<tr class="ZielTab">';

	//   Beschreibungen holen
	if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }

	//Formulierungen
	$sql = "SELECT * FROM formulierungen WHERE id = '".$PopUpDeleteFormulierungenID."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n'. $db_link->error;
	}


	while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
		$myFormulierungenText = $zeile['Text'];
		$myZielID = $zeile['ZieleID'];

	}

	//Ziele
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
	$sql = "SELECT * FROM ziele WHERE id = '".$myZielID."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat formulierungen: Error message: %s\n'. $db_link->error;
	}


	while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
		$myZieleNummer = $zeile['ZieleNummer'];
		$myZieleStichwort = $zeile['ZieleStichwort'];
		$myZieleBeschreibung = MyStringHTML($zeile['ZieleBeschreibung']);
		$myBereichID = $zeile['BereichID'];

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

	//Ende   Beschreibungen holen
    
	$Inhalt = $Inhalt.'<td class="BereichText">'.$myBereichText.'</td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt.'<td class="ZielZieleNummer">'.$myZieleNummer.' </td>';
	$Inhalt = $Inhalt.'<td class="ZielZieleStichwort">'.$myZieleStichwort.' </td>';
	$Inhalt = $Inhalt.'<td class="ZielZieleBeschreibung">'.$myZieleBeschreibung.' </td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<td class="PopUpQuestion">Du möchtest diesen Eintrag löschen :</td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr>';
    $Inhalt = $Inhalt.'<td class="PopUpText">'.$myFormulierungenText.'</td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt.'<td>';													
	$Inhalt = $Inhalt.'<button type="button" onclick="deleteFormulierungen('.MyString($PopUpDeleteFormulierungenID).');" >löschen</button></td>';	
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt.'<td>';
	$Inhalt = $Inhalt.'<button type="button" onclick="NoDisplayDeletePopUpFormulierungen();" > schliessen</button></td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'</table>';	
	echo $Inhalt;
}
if ( isset($_GET['DeleteFormulierungen']) )
{
	$parent = $_GET['DeleteFormulierungen'];
	// $FormulierungenId = $_GET['FormulierungenId'];
	$TextFormulierungen = $_GET['text'];

	// FormulierungenId="+id+"&TextFormulierungen
    echo 'scrip>console.log("Versuchtext");';
    // echo '<script>console.log("php DeleteFormulierungen parent = ' . $parent . ' ___ text = ' . $TextFormulierungen . '");</script>';
	
	if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }
	$sql = "UPDATE `formulierungen` SET `Text` = '".$TextFormulierungen."' WHERE `formulierungen`.`id` = '".$parent."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige DeleteFormulierungen: Error message: %s\n'. $db_link->error;
	}	
} 

// Insert Massnahmen
if (isset($_GET['PopUpInsertMassnahmenID'])) {
    fPopUpInsertMassnahmenID1();
}
function fPopUpInsertMassnahmenID1(){
	if (isset($_GET['PopUpInsertMassnahmenID'])) {
		$PopUpInsertMassnahmenID = $_GET['PopUpInsertMassnahmenID'];
		$_SESSION['PopUpInsertMassnahmenID'] = $PopUpInsertMassnahmenID;
	}
	else
	{
		$PopUpInsertMassnahmenID = $_SESSION['PopUpInsertMassnahmenID'];
	}

	$Inhalt ="";
	//Linke Seite
	$Inhalt = $Inhalt.'<table class="ChatMassnahmenTabel">';
	$Inhalt = $Inhalt.'<tr class="ZielTab">';

	//   Beschreibungen holen
	if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }
	//Formulierungen
	$sql = "SELECT * FROM formulierungen WHERE id = '".$PopUpInsertMassnahmenID."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat massnahmen: Error message: %s\n'. $db_link->error;
	}


	while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
		$myFormulierungenText = $zeile['Text'];
		$myFormulierungenID = $zeile['ZieleID'];
	}

	//Ziele

    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
	$sql = "SELECT * FROM ziele WHERE id = '".$myFormulierungenID."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat massnahmen: Error message: %s\n'. $db_link->error;
	}


	while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
		$myZieleNummer = $zeile['ZieleNummer'];
		$myZieleStichwort = $zeile['ZieleStichwort'];
		$myZieleBeschreibung = MyStringHTML($zeile['ZieleBeschreibung']);
		$myBereichID = $zeile['BereichID'];

	}
	// Bereich
	$sql = "SELECT * FROM bereich WHERE id = '".$myBereichID."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat massnahmen: Error message: %s\n'. $db_link->error;
	}


	while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
		$myBereichText = MyStringHTML($zeile['Text']);
	}

	//Ende   Beschreibungen holen
	$Inhalt = $Inhalt.'<td class="BereichText">'.$myBereichText.'</td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt.'<td class="ZielZieleNummer">'.$myZieleNummer.' </td>';
	$Inhalt = $Inhalt.'<td class="ZielZieleStichwort">'.$myZieleStichwort.' </td>';
	$Inhalt = $Inhalt.'<td class="ZielZieleBeschreibung">'.$myZieleBeschreibung.' </td>';
	$Inhalt = $Inhalt.'</tr>';
    $Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt.'<td class="FormulierungenText">'.$myFormulierungenText.' </td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt."<td>Du möchtest einen neuen Eintrag machen :</td>";
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt.'<td><form action="ELDiB.php" target="top" method="get">
	<textarea id="PopUpTextMassnahmen" type="text/html" name="PopUpEingabe" placeholder="Ihr Text"></textarea><br>	
	</form></td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt.'<td>';													
	// $Inhalt = $Inhalt.'<button type="button" onclick="InsertPopUpMassnahmen('.MyString($PopUpInsertMassnahmenID).','.MyString($_SESSION["userid"]).','.MyString($myMassnahmenText).');" > speichern</button></td>';	
	$Inhalt = $Inhalt.'<button type="button" onclick="InsertMassnahmen('.MyString($PopUpInsertMassnahmenID).');" > speichern</button></td>';	
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt.'<td>';
	$Inhalt = $Inhalt.'<button type="button" onclick="NoDisplayInsertPopUpMassnahmen();" > schliessen</button></td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'</table>';	
	echo $Inhalt;
}
// Edit Massnahmen
if (isset($_GET['PopUpEditMassnahmenID'])) {
    fPopUpEditMassnahmenID1();
}
function fPopUpEditMassnahmenID1(){
	if (isset($_GET['PopUpEditMassnahmenID'])) {
		$PopUpEditMassnahmenID = $_GET['PopUpEditMassnahmenID'];
		$_SESSION['PopUpEditMassnahmenID'] = $PopUpEditMassnahmenID;
	}
	else
	{
		$PopUpEditMassnahmenID = $_SESSION['PopUpEditMassnahmenID'];
	}

	$Inhalt ="";
	//Linke Seite
	$Inhalt = $Inhalt.'<table class="ChatMassnahmenTabel">';
	$Inhalt = $Inhalt.'<tr class="ZielTab">';

	//   Beschreibungen holen
	if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }

	//Massnahmen
	$sql = "SELECT * FROM massnahmen WHERE id = '".$PopUpEditMassnahmenID."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat massnahmen: Error message: %s\n'. $db_link->error;
	}


	while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
		$myMassnahmenText = $zeile['Text'];
		$myFormulierungenID = $zeile['FormulierungenID'];

	}

	//Formulierungen
	$sql = "SELECT * FROM formulierungen WHERE id = '".$myFormulierungenID."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat massnahmen: Error message: %s\n'. $db_link->error;
	}


	while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
		$myFormulierungenText = $zeile['Text'];
		$myZielID = $zeile['ZieleID'];
	}

    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
	//Ziele
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
	$sql = "SELECT * FROM ziele WHERE id = '".$myZielID."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat massnahmen: Error message: %s\n'. $db_link->error;
	}


	while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
		$myZieleNummer = $zeile['ZieleNummer'];
		$myZieleStichwort = $zeile['ZieleStichwort'];
		$myZieleBeschreibung = MyStringHTML($zeile['ZieleBeschreibung']);
		$myBereichID = $zeile['BereichID'];

	}
	// Bereich
	$sql = "SELECT * FROM bereich WHERE id = '".$myBereichID."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat massnahmen: Error message: %s\n'. $db_link->error;
	}


	while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
		$myBereichText = MyStringHTML($zeile['Text']);
	}

	//Ende   Beschreibungen holen
    
	$Inhalt = $Inhalt.'<td class="BereichText">'.$myBereichText.'</td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt.'<td class="ZielZieleNummer">'.$myZieleNummer.' </td>';
	$Inhalt = $Inhalt.'<td class="ZielZieleStichwort">'.$myZieleStichwort.' </td>';
	$Inhalt = $Inhalt.'<td class="ZielZieleBeschreibung">'.$myZieleBeschreibung.' </td>';
	$Inhalt = $Inhalt.'</tr>';
    $Inhalt = $Inhalt.'<td class="FormulierungenText">'.$myFormulierungenText.' </td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt."<td>Du möchtest diesen Eintrag ändern :</td>";
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt.'<td><form action="ELDiB.php" target="top" method="get">
	<textarea id="PopUpEditMassnahmenText" type="text/html" name="PopUpEingabe" placeholder="Ihr Text">'.$myMassnahmenText.'</textarea><br>	
	</form></td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt.'<td>';													
	$Inhalt = $Inhalt.'<button type="button" onclick="EditMassnahmen('.MyString($PopUpEditMassnahmenID).');" > speichern</button></td>';	
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt.'<td>';
	$Inhalt = $Inhalt.'<button type="button" onclick="NoDisplayEditPopUpMassnahmen();" > schliessen</button></td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'</table>';	
	echo $Inhalt;
}

if ( isset($_GET['EditMassnahmen']) )
{
	$parent = $_GET['EditMassnahmen'];
	// $MassnahmenId = $_GET['MassnahmenId'];
	$TextMassnahmen = $_GET['text'];

	// MassnahmenId="+id+"&TextMassnahmen
    echo 'scrip>console.log("Versuchtext");';
    // echo '<script>console.log("php EditMassnahmen parent = ' . $parent . ' ___ text = ' . $TextMassnahmen . '");</script>';
	
	if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }
	$sql = "UPDATE `massnahmen` SET `Text` = '".$TextMassnahmen."' WHERE `massnahmen`.`id` = '".$parent."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige EditMassnahmen: Error message: %s\n'. $db_link->error;
	}	
}

// Delete Massnahmen

if ( isset($_GET['PopUpDeleteMassnahmenID'])){
    fPopUpDeleteMassnahmenID1();
}
function fPopUpDeleteMassnahmenID1(){
	if (isset($_GET['PopUpDeleteMassnahmenID'])) {
		$PopUpDeleteMassnahmenID = $_GET['PopUpDeleteMassnahmenID'];
		$_SESSION['PopUpDeleteMassnahmenID'] = $PopUpDeleteMassnahmenID;
	}
	else
	{
		$PopUpDeleteMassnahmenID = $_SESSION['PopUpDeleteMassnahmenID'];
	}

	$Inhalt ="";
	//Linke Seite
	$Inhalt = $Inhalt.'<table class="ChatMassnahmenTabel">';
	$Inhalt = $Inhalt.'<tr class="ZielTab">';

	//   Beschreibungen holen
	if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }

	//Massnahmen
	$sql = "SELECT * FROM massnahmen WHERE id = '".$PopUpDeleteMassnahmenID."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat massnahmen: Error message: %s\n'. $db_link->error;
	}


	while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
		$myMassnahmenText = $zeile['Text'];
		$myFormulierungenID = $zeile['FormulierungenID'];

	}

	//Formulierungen
	$sql = "SELECT * FROM formulierungen WHERE id = '".$myFormulierungenID."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat massnahmen: Error message: %s\n'. $db_link->error;
	}


	while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
		$myFormulierungenText = $zeile['Text'];
		$myZielID = $zeile['ZieleID'];
	}

	//Ziele
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
	$sql = "SELECT * FROM ziele WHERE id = '".$myZielID."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat massnahmen: Error message: %s\n'. $db_link->error;
	}


	while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
		$myZieleNummer = $zeile['ZieleNummer'];
		$myZieleStichwort = $zeile['ZieleStichwort'];
		$myZieleBeschreibung = MyStringHTML($zeile['ZieleBeschreibung']);
		$myBereichID = $zeile['BereichID'];

	}
	// Bereich
	$sql = "SELECT * FROM bereich WHERE id = '".$myBereichID."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat massnahmen: Error message: %s\n'. $db_link->error;
	}


	while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
		$myBereichText = MyStringHTML($zeile['Text']);
	}

	//Ende   Beschreibungen holen
    
	$Inhalt = $Inhalt.'<td class="BereichText">'.$myBereichText.'</td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt.'<td class="ZielZieleNummer">'.$myZieleNummer.' </td>';
	$Inhalt = $Inhalt.'<td class="ZielZieleStichwort">'.$myZieleStichwort.' </td>';
	$Inhalt = $Inhalt.'<td class="ZielZieleBeschreibung">'.$myZieleBeschreibung.' </td>';
	$Inhalt = $Inhalt.'</tr>';
    $Inhalt = $Inhalt.'<td class="FormulierungenText">'.$myFormulierungenText.' </td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<td class="PopUpQuestion">Du möchtest diesen Eintrag löschen :</td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr>';
    $Inhalt = $Inhalt.'<td class="PopUpText">'.$myMassnahmenText.'</td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt.'<td>';													
	$Inhalt = $Inhalt.'<button type="button" onclick="deleteMassnahmen('.MyString($PopUpDeleteMassnahmenID).');" >löschen</button></td>';	
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'<tr>';
	$Inhalt = $Inhalt.'<td>';
	$Inhalt = $Inhalt.'<button type="button" onclick="NoDisplayDeletePopUpMassnahmen();" > schliessen</button></td>';
	$Inhalt = $Inhalt.'</tr>';
	$Inhalt = $Inhalt.'</table>';	
	echo $Inhalt;
}
if ( isset($_GET['DeleteMassnahmen']) )
{
	$parent = $_GET['DeleteMassnahmen'];
	// $MassnahmenId = $_GET['MassnahmenId'];
	$TextMassnahmen = $_GET['text'];

	// MassnahmenId="+id+"&TextMassnahmen
    echo 'scrip>console.log("Versuchtext");';
    // echo '<script>console.log("php DeleteMassnahmen parent = ' . $parent . ' ___ text = ' . $TextMassnahmen . '");</script>';
	
	if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }
	$sql = "UPDATE `massnahmen` SET `Text` = '".$TextMassnahmen."' WHERE `massnahmen`.`id` = '".$parent."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige DeleteMassnahmen: Error message: %s\n'. $db_link->error;
	}	
} 



if ( isset($_GET['Setup'])){
    Setup();
}


function Setup(){

	$mysendchat = 0;
	$mysendpost = 0;

	if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }
	// $Chatsql = "SELECT * FROM  chatformulierungen WHERE IDSource = '".$zeile['id']."'";
	$sql = "SELECT * FROM `usersetup` WHERE userid = '".$_SESSION["userid"]."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat massnahmen: Error message: %s\n'. $db_link->error;
	}

	while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
		$mysendchat = $zeile['sendchat'];
		$mysendpost = $zeile['sendpost'];
	}
	if($mysendchat == 1){
		$valsendchat = "checked";
	}
	else{
		$valsendchat = "";
	}

	if($mysendpost == 1){
		$valsendpost = "checked";
	}
	else{
		$valsendpost = "";
	}

	$Inhalt ="";

    //$Inhalt = $Inhalt.'<form class="FormSetup" action="PopUp.php" method="post">';
	$Inhalt = $Inhalt.'<table class="CheckTable" ><tr><td class="CheckTab">';
	$Inhalt = $Inhalt.'<button  id="FontSizeBigger" onclick="myFunction_Bigger();">Schrift größer</Button></td>';
	$Inhalt = $Inhalt.'<td><button id="FontSizeSmaller" onclick="myFunction_Smaller();">Schrift kleiner</Button></td></tr>';

	$Inhalt = $Inhalt.'<tr><td class="CheckTab">';
    $Inhalt = $Inhalt.'    <input type="checkbox" name="sendchat" id="sendchat" value="sendchat" '.$valsendchat.' onclick="WriteSetUpData();">';
    $Inhalt = $Inhalt.'    <td class="CheckDescription"> wollen sie bei Änderungen in Ihren chats per email benachrichtigt werden?</td>';
	$Inhalt = $Inhalt.'</tr><tr><td class="CheckTab">';
	$Inhalt = $Inhalt.'    <input type="checkbox" name="sendpost" id="sendpost" value="sendpost" '.$valsendpost.' onclick="WriteSetUpData();">';
	$Inhalt = $Inhalt.'<td class="CheckDescription">wollen sie bei Änderungen in Ihren Anfragen per email benachrichtigt werden?</td></tr></table>';
    // $Inhalt = $Inhalt.'    <button class="SetupButtonTakeOver" type="button"  name="SetupForm" onclick="WriteSetUpData();">Übernehmen</button>';
    //$Inhalt = $Inhalt.'  </form>';
	$Inhalt = $Inhalt . '<br>';
	$Inhalt = $Inhalt . '<button class="SetupButtonPW" onclick="ChangePassword();">Passwort ändern</button>';
	$Inhalt = $Inhalt . '<br>';
	$Inhalt = $Inhalt . '<button class="SetupButtonClose" onclick="NoDisplaySetup();">schliessen</button>';
	//   Userdaten lesen
	if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }

	$sql = "SELECT * FROM usersetup WHERE userid = '".$_SESSION["userid"]."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		$Inhalt =  'ungültige Bereich Abfrage Chat massnahmen: Error message: %s\n'. $db_link->error;
	}


	while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
		$mysendchat = $zeile['sendchat'];
		$mysendpost = $zeile['sendpost'];

	}

	echo $Inhalt;
}

?>









