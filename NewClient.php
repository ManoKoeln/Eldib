<script src="NewClient.js"></script>
<link href="CSS/NewClient.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" media="screen and (max-aspect-ratio: 4/3)" href="CSS/NewClientSmal.css" />
<!-- <body> -->

    <div class="NewClient" id="NewClient">
    </div>
    <?php
if (isset($_GET["ShowFormNewClient"])){

    $Inhalt = '<div class="NewClientInside" >';
    // $Inhalt = $Inhalt.'<form method="post" enctype="multipart/form-data" action="'.$_SERVER['PHP_SELF'].'; ">';
    $Inhalt = $Inhalt.'<form method="post" enctype="multipart/form-data">';


    $Inhalt = $Inhalt.'<h4>Neuer Schüler</h4>';
    $Inhalt = $Inhalt.'<div class="FormContent"><label>Vorname:</label><input type="text" name="Vorname" id="NewClientVorname" required></input></div>';
    $Inhalt = $Inhalt.'<div class="FormContent"><label>Name:</label><input type="text" name="Name" id="NewClientName" required></input></div>';      
    $Inhalt = $Inhalt.'<div class="FormContent"><label>Geburtstag:</label><input type="date" name="Birthday" id="NewClientBirthday" ></input></div>';
    $Inhalt = $Inhalt.'<div class="FormContent"><label>Klasse:</label><input type="text" name="ScoolClass" id="NewClientScoolClass" ></div>';
    $Inhalt = $Inhalt.'<div class="FormContent"><label>Schuljahr:</label><input type="number" name="ScoolYear" id="NewClientScoolYear" ></div>';
    $Inhalt = $Inhalt.'<div class="FormContent"><label>email:</label><input type="email" name="email" id="NewClientemail" ></div>';
    $Inhalt = $Inhalt.'<hr>';  
    $Inhalt = $Inhalt.'<h4>Eltern</h4>';          
    $Inhalt = $Inhalt.'<div class="FormContent"><label>Eltern Vorname:</label><input type="text" name="ParentVorname" id="ParentVorname" ></div>';
    $Inhalt = $Inhalt.'<div class="FormContent"><label>Eltern Name:</label><input type="text" name="ParentName" id="ParentName" ></div>';
    $Inhalt = $Inhalt.'<div class="FormContent"><label>Eltern email:</label><input type="email" name="Parentemail" id="Parentemail" ></div>';
    $Inhalt = $Inhalt.'<div class="NewClientbutton"><button class="NewClientbutton" type="submit" name="SubmitButton" required>speichern</button></div>';

           
    $Inhalt = $Inhalt.'<div class="NewClientbutton"><button class="NewClientbutton" type="button" onclick="NewClientClose();">schliessen</button></div>';
    $Inhalt = $Inhalt.'</div>';
    $Inhalt = $Inhalt.'</form>'; 
    echo $Inhalt;

}
if (isset($_POST["SubmitButton"])){
// function setClient(){
include_once ("content/db.php");
//Abfrage ob Eintrag schon existiert
if ($_SESSION['LocalChat'] == true){
    $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
  }
  else{
  $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
  }

     $sql = "INSERT INTO `client`(`id`, `Name`, `Vorname`, `email`, `Geburtsdatum`, `Parentname`, `Parentvorname`, `Parentemail`,`AutorId`,`StatusELDiBLehrer`,`StatusELDiBEltern`,`StatusELDiBKind`) VALUES (NULL, '".$_POST['Name']."','".$_POST['Vorname']."','".$_POST['email']."','".$_POST['Birthday']."','".$_POST['ParentName']."','".$_POST['ParentVorname']."','".$_POST['Parentemail']."','0','0','0','0')";

$db_erg = mysqli_query( $db_link, $sql );
if ( ! $db_erg )
{
    echo  'ungültige SafeNewClient: Error message: %s\n'. $db_link->error;
}	
$_POST["SubmitButton"] = NULL;
}
?>
<!-- </body> -->



