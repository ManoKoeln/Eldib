<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Passwort erneuern</title>
    <script src="../content/PasswordRequest.js"></script>
    <!-- <script src="../JScript/index.js"></script> -->
  </head>
  <body>
    <?php
    error_reporting(E_ALL); 
    //  use PHPMailer\PHPMailer\PHPMailer;
        if(isset($_POST["email1"])){
    include_once("../content/PasswordGenerate.php");
    include_once("../content/sendEmail.php");

        require("../content/db.php");
              $db_link = new mysqli($host_name, $user_name, $password, $database);
      $sql = "SELECT * FROM hostschool WHERE id = '".$_POST['SelectSchool']."'";
      $db_erg = mysqli_query( $db_link, $sql );
      if ( ! $db_erg )
      {
        echo  'ungültige Bereich Abfrage Ziele: Error message: %s\n'. $db_link->error;
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
      try{
        $mysql = new PDO("mysql:host=$host_name;dbname=$database", $user_name, $password);
    } catch (PDOException $e){
        echo "SQL Error mysql = new PDO - host=".$host_name.";dbname=".$database.", username = ".$user_name.": selected Shool = ".$_POST['SelectSchool'].$e->getMessage();
    }

      $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);



        $stmt1 = $mysql->prepare("SELECT * FROM accounts WHERE EMAIL = :email"); //email überprüfen
        $stmt1->bindParam(":email", $_POST[ "email1"]);
        try{
        $stmt1->execute();
        }  catch (PDOException $e){
              echo "SQL Error smt1 execute: ".$_SESSION["host_nameSchool"]. $_SESSION["user_nameSchool"]. $_SESSION["passwordSchool"]. $_SESSION["databaseSchool"].$e->getMessage();
          }
        $count = $stmt1->rowCount();
        if ($count <> 0) {

          //Username ist content
        	$sql = "SELECT * FROM accounts WHERE EMAIL = '".$_POST[ "email1"]."'";
          $db_erg = mysqli_query( $db_link, $sql );
          if ( ! $db_erg )
          {
            $Inhalt =  'ungültige Abfrage PassdordRequest user: Error message: %s\n'. $db_link->error;
          }


          while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
            $empfaenger = $zeile['USERNAME'];

          }

            //Passwort erneuern
            $Password = generatePassword ( 8, 2, 2, true );
        $ReceiverAdress = $_POST["email1"];
            $SqlStr1 = "UPDATE `accounts` SET `PASSWORD2` = :pw WHERE `accounts`.`EMAIL` = '".$ReceiverAdress."'";
            $stmt = $mysql->prepare($SqlStr1);
            $hash = password_hash($Password, PASSWORD_BCRYPT);
            $stmt->bindParam(":pw", $hash);
            $stmt->execute();
        // echo '<script>"MNsendEmailPW('.$_POST[ "email1"].', '.$Password.');"</script>';

        //___________________________________________________________________________
         
        // $name = "NoReply";
        // $email = $_POST['email'];
        // $subject = $_POST['subject'];
        // $body = $_POST['body'];

// sende email by Server
$text = 'Sie haben Nachrichten vom ETEP- Server ';
$text = str_replace("\n.", "\n..", $text);




// $empfaenger = "home@m-nowack.de";

$betreff = "Sie haben ein neues Passwort vom ETEP- Server angefordert";
$betreff = str_replace("\n.", "\n..", $betreff);
$nachricht = "<html>
<head>
<title>ETEP Passwort</title>
</head>

<body>

  <h1>Sie haben ein neues Passwort angefordert</h1>
    <table>
      <tr>
          <td>ETEP online Zugang</td>
      </tr>
      <tr>
        <td>Ihr neuer Benutzername lautet: $empfaenger</td>
      </tr>
      <tr>
          <td>Ihr Paswort ist : $Password</td>

      </tr>
      <tr>
          <td>Bitte ändern sie das Passwort nach der nächsten Anmeldung</td>          
      </tr>
  </tabel>
</body>";

$header = "From: ETEP online Zugang neues Passwort angefordert <NoReply@manosoftware.de>\r\n";
// $header = "From: ETEP online Zugang neues Passwort angefordert\r\n";
$header .= "Reply-To: NoReply\r\n";
$header .= "Content-Type: text/html; charset=UTF-8\r\n";
// $header = $header. "Content-Type: text/html\r\n";
$empfaenger = $_POST["email1"];
// echo 'Empfänger = '.$empfaenger.'<br>'.'betreff = '. $betreff.'<br>'.'nachricht = '. $nachricht.'<br>'.'header = '. $header;
          if (mail($empfaenger, $betreff, $nachricht, $header)){
            $status = "";
            $response = "";
        $Inhalt = $status . '  ' . $response . 'eine email mit einem neuen Passwort wurde versendet'.'<br>'.'<br>'.'<a href="../index.php">Zurück zur Anmeldung</a>';
        } else {
            $status = "failed";
            $response = "Something is wrong: <br><br>";
            $Inhalt = $status. '  '. $response. 'email wurde nicht versendet !!!';
        }
        echo $Inhalt;
        exit();
        }
      }
     ?>
         <script src="../content/PasswordRequest.js"></script>
    <h1>Passwort anfordern</h1>
    <form action="../content/PasswordRequest.php" method="post">
    <div class="SelectSchoolDiv">
    <select title="SelectSchool" name="SelectSchool" id="SelectSchool" onclick="ChangedSelectionSchool();" required>
          <option class="optionSchool" value=0>Schule auswählen</option>
          <?php
          
          require("../content/db.php");
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
    
      <input type="email" name= "email1" placeholder="email" required><br>
      <button type="submit" name="submit">Passwort anfordern</button>
    </form>
    <br>
    <a href="../index.php">Hast du bereits einen Account?</a>
  </body>
</html>
