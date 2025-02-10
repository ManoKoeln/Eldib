    <script src="Myjs.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
    <!-- <link href="CSS/header.css" rel="stylesheet" type="text/css"> -->
<!-- <link rel="stylesheet" media="screen and (max-aspect-ratio: 4/3)" href="CSS/headerSmal.css" /> -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <?php
if (session_status() == PHP_SESSION_NONE) {
  session_start(); // Starten der Session nur, wenn keine Session aktiv ist
}
    $OperatorReadWrite[] = "";
    $OperatorReadOnly[] = "";
    // if(!isset($_SESSION["username"])){
    //   echo "Der Login ist fehlgeschlagen für User: ".$_SESSION["username"];
    //     session_destroy();        
    //   header("Location: ../index.php");
    //   exit;
    // }
        require 'content/db.php';
        include "content/helpers.php";
        include "NewClient.php";
        // include "Assessors.php";

if ( isset($_GET['SetClient']) ){ // SetClient wird übergeben, wenn ein neuer Client ausgewählt wird
  $_SESSION['ActualClient'] = $_GET['SetClient'];
  if ($_SESSION['LocalChat'] == true){
    $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
  }
  else{
  $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
  }
  // Lösche Inhalte von tempoperator
  // $sql = "TRUNCATE TABLE `eldib2022`.`tempoperator`";
  // $db_erg = mysqli_query( $db_link, $sql );
  // if ( ! $db_erg )
  // {
  //   $Inhalt = 'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_link->error;
  // }
  // // Lösche Inhalte von tempoperatorreadonly
  // $sql = "TRUNCATE TABLE `eldib2022`.`tempoperatorreadonly`";
  // $db_erg = mysqli_query( $db_link, $sql );
  // if ( ! $db_erg )
  // {
  //   $Inhalt = 'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_link->error;
  // }

  
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

    $_SESSION["Parentname"] = $zeile['Parentname'] ;
    $_SESSION["Parentvorname"] = $zeile['Parentvorname'] ;
    $_SESSION["Parentemail"] = $zeile['Parentemail'] ;
    $Inhalt = "";
    // $Inhalt.=  '</form>';
   

    // $Inhalt.= '<div class="row row-cols-md-1">';
      $Inhalt.= '<div class="col-md-4 mx-auto" >';
      $Inhalt.=  '<div style="height: 2vh;"></div>';
        $Inhalt.= '<table class="table table-sm">'; //table-borderless deleted
          $Inhalt.= '<tr>';
          $Inhalt.= '<td>Name : </td><td>'.$zeile['Name'].', '.$zeile['Vorname'].'</td>';
          $Inhalt.= '</tr>';
          $Inhalt.= '<tr>';
            $Inhalt.= '<td>Geburtsdatum : </td><td>'.$zeile['Geburtsdatum'].'</td>';
          $Inhalt.= '</tr>';
          $Inhalt.= '<tr>';
          $Inhalt.= '<td>email : </td><td>'.$zeile['email'].'</td>';
          $Inhalt.= '</tr>';
          $Inhalt.= '<tr>';
          $Inhalt.= '<td></td><td></td>';
          $Inhalt.= '</tr>';
          $Inhalt.= '<tr>';
            $Inhalt.= '<td>Eltern : </td><td>'.$zeile['Parentvorname'].'  '.$zeile['Parentname'].'</td>';
          $Inhalt.= '</tr>';
          $Inhalt.= '<tr>';
            $Inhalt.= '<td>email Eltern : </td><td>'.$zeile['Parentemail'].'</td>';
          $Inhalt.= '</tr>';
          $Inhalt.= '<tr>';
        $Inhalt.= '</table>';

      $Inhalt.= '</div>';
      // $Inhalt.= '<div class="row row-md-1">';



    // $Inhalt.= '</div>';
    

    // echo $Inhalt;
  }
// }
$Inhalt.= '<div class="col-md-6 mx-auto" >';
  $Inhalt.= '<p class="fs-4">Verantwortliche / Einschätzende  </p>';
   
  $Inhalt.= '<table class="table col-8 table-borderless table-sm" style="border: 1px solid black;">';

  //aktuelles Operator anzeigen
  if ($_SESSION['LocalChat'] == true){
    $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
  }
  else{
  $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
  }

  $sqlt = "SELECT `OperatorReadWrite` FROM client WHERE `client`.`id` = ".$_SESSION['ActualClient']. " ";
  $db_ergt = mysqli_query( $db_link, $sqlt );
  if ( ! $db_ergt )
  {
    $Inhalt = 'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_link->error;
  }
    while ($zeilet = mysqli_fetch_assoc( $db_ergt))
  {
    $OperatorReadWrite = explode("§",$zeilet['OperatorReadWrite']);
    $OperatorReadWriteCount = $OperatorReadWrite;
    foreach ($OperatorReadWrite as $os){
      //Operator readwrite anzeigen      
      if ($os > 0){
        $sql = "SELECT * FROM accounts WHERE `accounts`.`userid` = '".$os."' ";
        $db_erg = mysqli_query( $db_link, $sql );
        if ( ! $db_erg )
        {
          $Inhalt = 'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_link->error;
        }
          while ($zeile = mysqli_fetch_assoc( $db_erg))
        {
          $Inhalt.=  '<tr>';
          $Inhalt.= '<td >'.$zeile['Vorname'].', '.$zeile['Nachname'].'</td>';
          $Inhalt.= '<td  >'.$zeile['EMAIL'].'</td>';
          $Inhalt.= '<td  ><button class="btn btn-primary "  onclick="removeoperatorReadWrite('.$os.');">entfernen</button></td>';
          $Inhalt.= '</tr>';
        }
      }
    }
  }
       
  $Inhalt.='</table>';
  // $Inhalt.='</div>';

  // $Inhalt.= '<div col-md-6 col-sm-12>';
  $Inhalt.= '<p class="fs-4">Verantwortliche / Einschätzende (nur lesen)</p>';
  // $Inhalt.= '<div row>';
  $Inhalt.= '<table class="table col-8 table-borderless table-sm" style="border: 1px solid black;">';

  //aktuelles Operator nur lesen eintragen
  if ($_SESSION['LocalChat'] == true){
    $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
  }
  else{
  $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
  }

  $sqlt = "SELECT `OperatorReadOnly` FROM client WHERE `client`.`id` = ".$_SESSION['ActualClient']. " ";
  $db_ergt = mysqli_query( $db_link, $sqlt );
  if ( ! $db_ergt )
  {
    $Inhalt = 'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_link->error;
  }
    while ($zeilet = mysqli_fetch_assoc( $db_ergt))
  {
    $OperatorReadWrite = explode("§",$zeilet['OperatorReadOnly']);
    $OperatorReadWriteCount = $OperatorReadWrite;
    foreach ($OperatorReadWrite as $os){
      //Operator readwrite anzeigen      
      if ($os > 0){
        $sql = "SELECT * FROM accounts WHERE `accounts`.`userid` = '".$os."' ";
        $db_erg = mysqli_query( $db_link, $sql );
        if ( ! $db_erg )
        {
          $Inhalt = 'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_link->error;
        }
          while ($zeile = mysqli_fetch_assoc( $db_erg))
        {
          $Inhalt.=  '<tr>';
          $Inhalt.= '<td>'.$zeile['Vorname'].', '.$zeile['Nachname'].'</td>';
          $Inhalt.= '<td>'.$zeile['EMAIL'].'</td>';
          $Inhalt.= '<td><button class="btn btn-primary "  onclick="removeoperatorReadOnly('.$os.');">entfernen</button></td>';
          $Inhalt.= '</tr>';
        }
      }
    }
  }
  $Inhalt.= '</div>';
  // $Inhalt.= '<div class="col-md-5 col-sm-12 ">';           
  $Inhalt.= '</table>';
  $Inhalt.= '</div>';
  $Inhalt.= '<div class="col-4 ml-2">';
  $Inhalt.= '<hr class="featurette-divider">';
  $Inhalt.= '<table class="table table-sm table-borderless">';
    $Inhalt.= '<tr>';
      $Inhalt.= '<td><button typ="button" class="btn-primary "  onclick="ShowELDiBLehrer();">ELDiB Lehrer</button></td><td><button typ="button" class="btn-primary"  onclick="OperatorSelectionShow();">einladen</button></td>';
    $Inhalt.= '</tr>';
    $Inhalt.= '<tr>';
      $Inhalt.= '<td><button typ="button" class="btn-primary "  onclick="ShowELDiBKind();">ELDiB Kind</button></td><td><button typ="button" class="btn-primary "  onclick="ShowEmailKind();">Email Einladung</button></td>';
    $Inhalt.= '</tr>';
    $Inhalt.= '<tr>';
      $Inhalt.= '<td><button typ="button" class="btn-primary "  onclick="ShowELDiBEltern();">ELDiB Eltern</button></td><td><button typ="button" class="btn-primary "  onclick="ShowEmailEltern();">Email Einladung</button></td>';
    $Inhalt.= '</tr>';
    $Inhalt.= '<tr>';
    $Inhalt.= '<td><button typ="button" class="btn-primary "  onclick="ShowSupportPlan();">Förderplan</button></td>';
    $Inhalt.= '</tr>';
    $Inhalt.= '<tr>';
      $Inhalt.= '<td><button typ="button" class="btn-primary "  onclick="ShowELDiBLehrer_New();">ELDiB Lehrer New</button></td>';
    $Inhalt.= '</tr>';
  $Inhalt.= '</table>';
  $Inhalt.= '</div>';
  $Inhalt.= '</div>';
  $Inhalt.= '</div>';
  echo $Inhalt;


}
  if ( isset($_GET['NewOperatorReadWrite']) ){
  
    //aktuelles Operator eintragen
    if ($_SESSION['LocalChat'] == true){
      $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }

    $sqlt = "SELECT `OperatorReadWrite` FROM client WHERE `client`.`id` = ".$_SESSION['ActualClient']. " ";
    $db_ergt = mysqli_query( $db_link, $sqlt );
    if ( ! $db_ergt )
    {
      $Inhalt = 'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_link->error;
    }
      while ($zeilet = mysqli_fetch_assoc( $db_ergt))
    {
      $OperatorReadWrite = explode("§",$zeilet['OperatorReadWrite']);
    }

    // $OperatorReadWrite[] = $zeilet['SourceId'];
    $OperatorReadWrite[] = $_GET['NewOperatorReadWrite'];
    //Operator readwrite in DB eintragen mit § getrennt
    $sqlop = "UPDATE `client` SET `OperatorReadWrite` = '".implode("§",$OperatorReadWrite). "' WHERE `client`.`id` = ".$_SESSION['ActualClient']. " ";        
    $db_ergop = mysqli_query( $db_link, $sqlop );
    if ( ! $db_ergop )
    {
      $Inhalt = 'ungültige Bereich Functions.php OperatorReadWrite: Error message: %s\n'. $db_link->error;
    }
    //   while ($zeile = mysqli_fetch_assoc( $db_ergop))
    // {
    // }
  }
if ( isset($_GET['NewOperatorReadOnly']) ){

  //aktuelles Operator eintragen
  if ($_SESSION['LocalChat'] == true){
    $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
  }
  else{
  $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
  }

  $sqlt = "SELECT `OperatorReadOnly` FROM client WHERE `client`.`id` = ".$_SESSION['ActualClient']. " ";
  $db_ergt = mysqli_query( $db_link, $sqlt );
  if ( ! $db_ergt )
  {
    $Inhalt = 'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_link->error;
  }
    while ($zeilet = mysqli_fetch_assoc( $db_ergt))
  {
    $OperatorReadOnly = explode("§",$zeilet['OperatorReadOnly']);
  }

  // $OperatorReadOnly[] = $zeilet['SourceId'];
  $OperatorReadOnly[] = $_GET['NewOperatorReadOnly'];
  //Operator ReadOnly in DB eintragen mit § getrennt
  $sqlop = "UPDATE `client` SET `OperatorReadOnly` = '".implode("§",$OperatorReadOnly). "' WHERE `client`.`id` = ".$_SESSION['ActualClient']. " ";        
  $db_ergop = mysqli_query( $db_link, $sqlop );
  if ( ! $db_ergop )
  {
    $Inhalt = 'ungültige Bereich Functions.php OperatorReadOnly: Error message: %s\n'. $db_link->error;
  }
  //   while ($zeile = mysqli_fetch_assoc( $db_ergop))
  // {
  // }
}
if ( isset($_GET['removeoperatorReadWrite']) ){
      //aktuelle Operator lesen
      if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
      }
      else{
      $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
      }

      $sqlt = "SELECT `OperatorReadWrite` FROM client WHERE `client`.`id` = ".$_SESSION['ActualClient']. " ";
      $db_ergt = mysqli_query( $db_link, $sqlt );
      if ( ! $db_ergt )
      {
        $Inhalt = 'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_link->error;
      }
        while ($zeilet = mysqli_fetch_assoc( $db_ergt))
      {
        $OperatorReadWrite = explode("§",$zeilet['OperatorReadWrite']);
      }

      if (($key = array_search($_GET['removeoperatorReadWrite'], $OperatorReadWrite)) !== false) {
        unset($OperatorReadWrite[$key]);
    }
  
      //Operator readwrite in DB eintragen mit § getrennt
      $sqlop = "UPDATE `client` SET `OperatorReadWrite` = '".implode("§",$OperatorReadWrite). "' WHERE `client`.`id` = ".$_SESSION['ActualClient']. " ";        
      $db_ergop = mysqli_query( $db_link, $sqlop );
      if ( ! $db_ergop )
      {
        $Inhalt = 'ungültige Bereich Functions.php OperatorReadWrite: Error message: %s\n'. $db_link->error;
      }
}

if ( isset($_GET['removeoperatorReadOnly']) ){
  //aktuelle Operator lesen
  if ($_SESSION['LocalChat'] == true){
    $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
  }
  else{
  $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
  }

  $sqlt = "SELECT `OperatorReadOnly` FROM client WHERE `client`.`id` = ".$_SESSION['ActualClient']. " ";
  $db_ergt = mysqli_query( $db_link, $sqlt );
  if ( ! $db_ergt )
  {
    $Inhalt = 'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_link->error;
  }
    while ($zeilet = mysqli_fetch_assoc( $db_ergt))
  {
    $OperatorReadOnly = explode("§",$zeilet['OperatorReadOnly']);
  }

  if (($key = array_search($_GET['removeoperatorReadOnly'], $OperatorReadOnly)) !== false) {
    unset($OperatorReadOnly[$key]);
  }

  //Operator ReadOnly in DB eintragen mit § getrennt
  $sqlop = "UPDATE `client` SET `OperatorReadOnly` = '".implode("§",$OperatorReadOnly). "' WHERE `client`.`id` = ".$_SESSION['ActualClient']. " ";        
  $db_ergop = mysqli_query( $db_link, $sqlop );
  if ( ! $db_ergop )
  {
    $Inhalt = 'ungültige Bereich Functions.php OperatorReadOnly: Error message: %s\n'. $db_link->error;
  }
}
?>