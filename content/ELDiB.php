<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Starten der Session nur, wenn keine Session aktiv ist
}
include "db.php";
// $_SESSION["userid"] = 1;
// $_SESSION["username"] = "mano";
echo '<script>console.log("ELDiB Start with User: '.$_SESSION["username"].'");</script>';



if ($_SESSION['LocalChat'] == true){
	$db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
  }
  else{
  $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
  }
$sql = 'SELECT * FROM hostdata WHERE `IdUser` = '.$_SESSION["userid"];

$db_erg = mysqli_query( $db_link, $sql );

if ( ! $db_erg )
	{
	  echo'ungültige Bereich Abfrage: Error message: %s\n'. $db_link->error;
	}
$IP_Saved = false;
	while ($zeile = mysqli_fetch_assoc( $db_erg))
		{
			if ($zeile['IpAdress'] == $_SERVER["REMOTE_ADDR"] ){
				$IP_Saved = true;
			}	  

		}
if (!$IP_Saved){
	$sql =  "INSERT INTO  `hostdata` (`id`, `IdUser`, `IpAdress`,`name`,`Time`) VALUES (NULL, '".$_SESSION["userid"]."', '".$_SERVER["REMOTE_ADDR"]."',' not', current_timestamp());";
	$db_erg = mysqli_query( $db_link, $sql );
	
	if ( ! $db_erg )
		{
		  echo'ungültige Bereich Abfrage: Error message: %s\n'. $db_link->error;
		}

		// while ($zeile = mysqli_fetch_assoc( $db_erg))
		// 	{
		// 		// if ($zeile['IpAdress'] == $_SERVER["REMOTE_ADDR"] ){
		// 		// 	$IP_Saved = true;
		// 		// }	  
	
		// 	}

}
if ($_SESSION['LocalChat'] == true){
	$db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
  }
  else{
  $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
  }
$sql = "SELECT * FROM `usersetup` WHERE userid = '".$_SESSION["userid"]."'";
$db_erg = mysqli_query( $db_link, $sql );
if ( ! $db_erg )
{
	echo   'ungültige Bereich Abfrage Chat massnahmen: Error message: %s\n'. $db_link->error;
}
$FontSize = 0.8;
$FontSizeSmal = 0.8;
while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {

	// https://webdesign.weisshart.de/schriftgroesse.php
	$FontSize = $zeile['fontsize'];
	$FontSizeSmal = $zeile['fontsizesmal'];
	
}
?>
<style>:root {
	--FontSize: <?php echo $FontSize; ?>vw;
	--FontSizeSmal: <?php echo $FontSizeSmal; ?>vw;
	}
	</style>
<?php
//_____________
// https://www.php-kurs.com/mysql-datenbank-auslesen.htm 

?>
<!DOCTYPE html>
<html lang="de">
<title> ETEP </title>
<link rel="icon" href="Favicon.ico"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<meta Content-Type: application/javascript> 
<meta charset="ISO-8859-1">
<script src="content/MyJava.js"></script>
<script src="content/ChatFormulierungen.js"></script>
<script src="content/ChatMassnahmen.js"></script>
<script src="content/UserChatFormulierungen.js"></script>
<script src="content/UserChatMassnahmen.js"></script>
<script type="text/javascript"></script>
<script src="content/Messages.js"></script>
<script src="content/PostBoxReceive.js"></script>
<script src="content/PostBoxSend.js"></script>
<script src="content/Header.js"></script>
<script src="content/PopUp.js"></script>
<script src="content/changePW.js"></script>


<?php
require ("header.php");
require ("db.php");
require ("chatFormulierungen.php");
require ("chatMassnahmen.php");
require ("UserChatFormulierungen.php");
require ("UserChatMassnahmen.php");
require ("Messages.php");
require ("PostBoxReceive.php");
require ("PostBoxSend.php");

require ("PopUp.php");
require ("changePW.php");


?> 
<!-- Beispiel aus: https://css-tricks.com/resolution-specific-stylesheets/ -->
<link href="css/Style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" media="screen and (max-aspect-ratio: 4/3)" href="CSS/StyleESmal.css" />


<div id="EContent">
<!-- <body id="MyBody">
  <noscript>
    Bitte aktivieren Sie JavaScript, um das JavaScript-Element zu sehen.
  </noscript> -->
<?php
require ('konfiguration.php');
// echo '<br>';

if ($_SESSION['LocalChat'] == true){
	$db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
  }
  else{
  $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
  }
 
 
   if ($db_link->connect_error) {
    echo('<p>Verbindung zum MySQL Server fehlgeschlagen: </p>'); //'. $db_link->connect_error .'
  } 

//---------------------------------

//Head
?>
<button onclick="HideELDiBTable();">zurück</button>
<div class="MainContent">
	<table  >
		<tr class="BereichHeadline" >
			<td  class="BereichText" >Bereich</td>
		</tr>
		<tr class="ZieleHeadline" >
			<td class="ZielZieleStufe">Stufe</td>
			<td class="ZielZieleNummer">Bereich</td>
			<td class="ZielZieleStichwort">Ziel</td>
			<td class="ZielZieleBeschreibung">Beschreibung </td>
		</tr>

		<tr class="FormulierungenHeadline" id="Div3Head">
			<td class="FormulierungenText" >Formulierungen</td>
		</tr>
		<tr class="MassnahmenHeadline" id="Div4Head" >
			<td class="MassnahmenText">Maßnahmen</td>
		</tr>
	</table>
</div>


<div  class="container" id="Div1"> 
<?php
// Bereich einlesen
  $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);

$sql = "SELECT * FROM bereich";

$db_erg = mysqli_query( $db_link, $sql );
 

if ( ! $db_erg )
	{
	  echo'ungültige Bereich Abfrage: Error message: %s\n'. $db_link->error;
	}
	echo '<table id="containerBereich" >';
	while ($zeile = mysqli_fetch_assoc( $db_erg))
		{
		  echo '<tr class="BereichTab" >';
			echo'<td  class="BereichText" ondblclick="TakeOverBereich('.MyString($zeile['id']).');" 
			 onclick="copyBereich('.$zeile['id'].','.MyString($zeile['Text']).');">'.$zeile['Text'].'
					</td>';	
		  echo "</tr>";		  
		}
	echo "</table>";
	echo '</div>';
	echo '<div class="container" id="Div2"></div>';
	echo '<div class="container" id="Div3" ></div>';
	echo '<div class="container" id="Div4" ></div>';
	echo '</div>'; 

//--------------------------------
mysqli_free_result( $db_erg );
echo '</div>';
echo '<div style="clear:left;"></div>';



?>
</body>
</body>

<footer >
  <div class="Footer1">
	<a href="mailto:info@manosoftware.de">Kontakt</a>
	<p>© 2022 by Manosoftware</p>
  </div>
  <div class="Footer2">
  <a href="impressum.php" target="_blank">Impressum</a>
  </div>
</footer>
	</div>


