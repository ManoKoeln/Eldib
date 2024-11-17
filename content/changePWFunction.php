<link href="../ELDiB/CSS/changePW.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" media="screen and (max-aspect-ratio: 4/3)" href="../ELDiB/CSS/changePWSmal.css" />
  <!-- <script src="content/changePW.js"></script> -->

  <div id="changePW">
  </div>


<?php

$return_message = "";
if ( isset($_POST['change_password'])){
  // if ( isset($_GET['submit'])){
    // echo '<h1> Test </h1>';
    // echo 'pw = '.$_POST["pw"]." pw2 = ".$_POST["pw2"]." user = ". $_SESSION["userid"];
  // }
  // function test(){
  if ($_POST["pw"] == $_POST["pw2"]) {
    // require("contnet/db.php");
      $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);

      $hash = password_hash(htmlentities( $_POST["pw"]), PASSWORD_BCRYPT);
      $hash2 = password_hash($_POST["pw"], PASSWORD_BCRYPT);
      $return_message = $return_message."--".htmlentities( $_POST["pw"])."-----".$hash.'<br>'."--". $_POST["pw"]."--".$hash2;

      // "UPDATE `accounts` SET `PASSWORD` = 'gdfvgdfv' WHERE `accounts`.`userid` = 3"
      $sql = "UPDATE `accounts` SET `PASSWORD` = '" . $hash . "' , `PASSWORD2` = '-'  WHERE `accounts`.`userid` = " . $_SESSION["userid"];
      try{
        $db_erg = mysqli_query($db_link, $sql);
        }
        catch (PDOException $e){
          echo "change_password SQL Error mysql = new PDO - host=".$_SESSION["host_nameSchool"].";dbname=".$_SESSION["databaseSchool"].", username = ".$_SESSION["user_nameSchool"].": ".$e->getMessage();
        }
      if (!$db_erg) {

          // echo 'ungültige Bereich Abfrage submit SavePw: Error message: %s\n' . $db_link->error;
          $return_message = $return_message.'<a class="button-send" href="changePW.php">ungültige Bereich Abfrage submit SavePw: Error message: %s\n' . $db_link->error.'</a>';
      }

          $return_message = $return_message.'<h1>Ihr Passwort wurde geändert</h1>';
          $return_message = $return_message.'<a class="button-send" href="../start.php">zurück</a>';

  }
  else{
      // echo "Die Passwörter stimmen nicht überein";
      $return_message = $return_message.'<a class="button-send" href="changePW.php">Die Passwörter stimmen nicht überein</a>';
  }
 echo $return_message;
}


    ?>