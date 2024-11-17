
    <?php
    error_reporting(E_ALL); 

    $SelectedSchool1 = "";
    function move_to(){
      
        header("Location: Start2.php",true);
        exit;
     }
     
    if(isset($_POST["submit"])){
      require ("content/db.php");
      if ($_POST['SelectSchool'] == 0){
        echo '<link href="CSS/index.css" rel="stylesheet" type="text/css">';
        echo '<link rel="stylesheet" media="screen and (max-aspect-ratio: 4/3)" href="CSS/indexSmal.css" />';
        echo '<form class="formError" action="../ELDiB/index.php">';
        echo '<h1>keine Schule ausgewählt</h1>';
        echo '  <button type="submit">zurück</button>';
        echo '</form>';

        session_destroy();
        exit;
      
    }
      $db_link = new mysqli($host_name, $user_name, $password, $database);
      $sql = "SELECT * FROM hostschool WHERE id = '".$_POST['SelectSchool']."'";
      $db_erg = mysqli_query( $db_link, $sql );
      if ( ! $db_erg )
      {
        $Inhalt = 'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_link->error;
      }
      
        while ($zeile = mysqli_fetch_assoc( $db_erg))
      {
        $_SESSION["host_nameSchool"]=$zeile['host_name']; 
        $_SESSION["databaseSchool"]=$zeile['data_base']; 
        $_SESSION["user_nameSchool"]=$zeile['user_name']; 
        $_SESSION["passwordSchool"]=$zeile['password'];
      }
      $host_name = $_SESSION["host_nameSchool"];
      $database = $_SESSION["databaseSchool"];
      $user_name = $_SESSION["user_nameSchool"];
      $password = $_SESSION["passwordSchool"];
      $_SESSION['LocalChat'] = true;
//TEST
// echo $host_name . "<br>";
// echo $database. "<br>" ;
// echo $user_name . "<br>";
// echo $password . "<br>";
//'''''''''''''''''''''''''
      try{
        $mysql = new PDO("mysql:host=$host_name;dbname=$database", $user_name, $password);
    } catch (PDOException $e){
        echo "SQL Error: ".$e->getMessage();
    }
      $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
      include_once("content/helpers.php");
      $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user"); //Username überprüfen
      $stmt->bindParam(":user", $_POST["username"]);
      echo '<script>console.log("Index run: execute ");</script>';
      $stmt->execute();
      $count = $stmt->rowCount();
      echo '<script>console.log("Index run: count = '.MyStringHTML($count).'");</script>';
      if($count == 1){
        echo '<script>console.log("Index run: Username ist frei");</script>';
        //Username ist frei
        $row = $stmt->fetch();
        if(password_verify($_POST["pw"], $row["PASSWORD"]) OR (password_verify($_POST["pw"], $row["PASSWORD2"])AND strlen($_POST["pw"]) > 1)){
          echo '<script>console.log("Index run: pw ok");</script>';
          session_start();
          $_SESSION["username"] = $row["USERNAME"];
          
          $_SESSION["Vorname"] = $row["Vorname"];
          $_SESSION["Nachname"] = $row["Nachname"];
          $_SESSION["userid"] = $row["userid"];
          $_SESSION["SelectionSchool"] = $_POST["SelectSchool"];
          $_SESSION["userlevel"] = $row["userlevel"];

      echo $_POST["SelectSchool"];
           move_to();

          exit;
        } else {
          echo "Der Login ist fehlgeschlagen Passwort verify";
        }
      } else {
        echo "Der Login ist fehlgeschlagen count = ".$count;
      }
    }
    if (isset($_POST["SelectionSchoolValue"])){
      echo '<script>alert("Post = ");</script>';
      $SelectedSchool1 = $_GET['SelectionSchool'];
      echo $SelectedSchool1. $_GET['SelectionSchool'];
    }


     ?>
     
     <!DOCTYPE html>
<!-- For Work: session.auto_start = on !!!!
 URL=https://github.com/Tutorialwork/Tutorials/blob/ac1ee61c5b43bde9b811759eaabcbed027b56385/PHP%20Login%20System/mysql.php -->
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="content/Favicon.ico"/>
    <link href="CSS/index.css" rel="stylesheet" type="text/css">
    <link href="/dist/styles.css" rel="stylesheet">
    <link rel="stylesheet" media="screen and (max-aspect-ratio: 4/3)" href="CSS/indexSmal.css" />
    <script src="JScript/index.js"></script>
    <title>Login</title>
  </head>
  <header>
  <div class="HeaderL1" >

    </div>
      <div class="HeaderL2">
      
      <h1>ETEP</h1>
      <h2>Entwicklungstherapie/ Entwicklungspädagogik</h2>
        <img class="Logo" src="CSS/ManoLogoTrans3.ico" alt="logo"></img>
      </div>
  </header>
  <body>
  <form action="index.php" method="post">
  <h3>Anmelden</h3>
<div class="SelectSchoolDiv">
<select title="SelectSchool" name="SelectSchool" id="SelectSchool" onclick="ChangedSelectionSchool();" required>
      <option class="optionSchool" value=0>Schule auswählen</option>
      <?php
      
      require("content/db.php");
      //Schulen eintragen
      $db_link = new mysqli($host_name, $user_name, $password, $database);
    
      $sql = "SELECT * FROM school ";
      $db_erg = mysqli_query( $db_link, $sql );
      if ( ! $db_erg )
      {
        $Inhalt = 'ungültige Bereich Abfrage School: Error message: %s\n'. $db_link->error;
      }
        while ($zeile = mysqli_fetch_assoc( $db_erg))
      {
        echo '<option class="optionSchool" value="'.$zeile['id'].'">'.$zeile['Name'].', '.$zeile['Straße'].', '.$zeile['Ort'].' - '.$zeile['PLZ'].'</option>';
      }
      ?>
      </select>
</div>
<div class="IndexInput">

    
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="password" name="pw" placeholder="Passwort" required><br>
      <button type="submit" autocomplete: "password" suggested: "current-password" name="submit">Einloggen</button>
    </form>
    <br>
    <!-- <div class="register"><a href="content/register.php">Noch keinen Account?</a></div>
    <br> -->
    <div class="Passwort"><a href="content/PasswordRequest.php">Passwort anfordern</a></div>

  </div>
  <!-- <script>
        var elem = document.documentElement;
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        }
        </script> -->
  </body>
</html>
