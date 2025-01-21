
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

        // session_destroy();
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
          echo '<script>console.log("Index run: pw is : " + ' . json_encode($row["USERNAME"]) . ');</script>';

          session_start();
          $_SESSION["username"] = $row["USERNAME"];
          
          $_SESSION["Vorname"] = $row["Vorname"];
          $_SESSION["Nachname"] = $row["Nachname"];
          $_SESSION["userid"] = $row["userid"];
          $_SESSION["SelectionSchool"] = $_POST["SelectSchool"];
          $_SESSION["userlevel"] = $row["userlevel"];
          $_SESSION['LocalChat'] = true;

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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="content/Favicon.ico"/>
    <link href="CSS/index.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" media="screen and (max-aspect-ratio: 4/3)" href="CSS/indexSmal.css" />
    <script src="JScript/index.js"></script>
    <title>Login</title>
  </head>
  <header>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
  <!-- <div class="HeaderL1" > -->
  <div class="container">
      <div class="col-sm-12">
        <div class="row">
          <div class="col-sm-8">
            <h1 class="fs-1">ETEP</h1>
            <h2 class="fs-2">Entwicklungstherapie/ Entwicklungspädagogik</h2>
          </div>
          <div class="col-sm-4 text-right">
            <img src="CSS/ManoLogoTrans3.ico" alt="logo" style="width: auto; height: auto; max-width: 100%; max-height: 100%;">
          </div>
        </div>
      </div>
    </div>
  </header>
  <body>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
  <form action="index.php" method="post"  needs-validation" novalidate>
  <!-- <form action="index.php" method="post"> -->
    <div class="row mb-3"> 
      <p class="col-sm-12 col-form-label fs-2">Anmelden</p>
    </div>
    <div class="row mb-3 ml-1 justify-content-center">   
      <label for="inputPassword3" class="col-sm-2 col-form-label">Schule auswählen</label>
      <div class="col-sm-4 ">
        <select class="form-control " title="SelectSchool" name="SelectSchool" id="SelectSchool" onclick="ChangedSelectionSchool();" required class="form-select" aria-label="Default select example">
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
    </div>
<!-- <div class="IndexInput"> -->


<div class="row mb-3 ml-1 justify-content-center">

        <label for="formFile" class="col-sm-2 col-form-label col-form-label-sm">Email</label>
        <div class="col-sm-4"> 
        <input type="text" class="form-control form-control-sm" id="formFile" name="username" autocomplete="username" placeholder="Username" required>
        </div>
    </div>

    <div class="row mb-3 ml-1 justify-content-center">  
        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Password</label>
        <div class="col-sm-4"> 
            <input type="password" class="form-control form-control-sm" name="pw" placeholder="Passwort" required >
        </div>
    </div>
      <div class="row mb-3 ml-1 justify-content-center">    
        <div class="col-sm-12"> 
          <button type="submit" class="btn btn-primary btn-sm" autocomplete= "password" suggested="current-password" name="submit">Einloggen</button>
        </div>
    </div>

    <div class="row mb-3 ml-1 justify-content-center"> 
    <div class="col-sm-12"> 
      <a href="content/PasswordRequest.php">Passwort anfordern</a>
      </div>
    </div>

</div>
      </form>

      <!-- <div class="register"><a href="content/register.php">Noch keinen Account?</a></div>
      <br> -->

  </form>
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
