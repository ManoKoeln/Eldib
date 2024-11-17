<script src="NewUser.js"></script>
<link href="CSS/NewUser.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" media="screen and (max-aspect-ratio: 4/3)" href="CSS/NewUserSmal.css" />
<body>

    <div class="NewUser" id="NewUser">
    </div>
    <?php
if (isset($_GET["ShowFormNewUser"])){

    $Inhalt = '<div class="NewUserInside" >';
    // $Inhalt = $Inhalt.'<form method="post" enctype="multipart/form-data" action="'.$_SERVER['PHP_SELF'].'; ">';
    $Inhalt = $Inhalt.'<form method="post" enctype="multipart/form-data">';


    $Inhalt = $Inhalt.'<h4>Neuer Lehrer</h4>';
    $Inhalt = $Inhalt.'<div class="FormContent"><label>Username:</label><input type="text" name="username" id="NewUserUserName" required></input></div>';
    $Inhalt = $Inhalt.'<div class="FormContent"><label>Vorname:</label><input type="text" name="Vorname" id="NewUserVorname" required></input></div>';
    $Inhalt = $Inhalt.'<div class="FormContent"><label>Name:</label><input type="text" name="Name" id="NewUserName" required></input></div>';      
    $Inhalt = $Inhalt.'<div class="FormContent"><label>email:</label><input type="email" name="email" id="NewUseremail" required></div>';
    $Inhalt = $Inhalt.'<div class="NewClientbutton"><button class="NewClientbutton" type="submit" name="SubmitButtonNewUser" onclick="SetNewUser();" required>speichern</button></div>';
    $Inhalt = $Inhalt.'</form>';        
    $Inhalt = $Inhalt.'<div class="NewUserbutton"><button class="NewUserbutton" type="button" onclick="NewUserClose();">schliessen</button></div>';
    $Inhalt = $Inhalt.'</div>';
    echo $Inhalt;

}
// if (isset($_POST["SubmitButtonNewUser"])){
    
if (isset($_GET["SetNewUser"])){
    $Error = 0;    
    include_once ("content/db.php");
    //Abfrage ob Eintrag schon existiert
    if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
        $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }

    //Abfrage ob Benutzer schon existiert
    $sql = 'SELECT `Nachname`,`Vorname` FROM `accounts` WHERE `Nachname`="'.$_GET['Name'].'" AND `Vorname` ="'.$_GET['Vorname'].'" ';

    $db_erg = mysqli_query( $db_link, $sql );
    if ( ! $db_erg )
    {
        echo  'ungültige SafeNewUser: Error message: %s\n'. $db_link->error;
    }	
    while ($zeile = mysqli_fetch_assoc( $db_erg))
    {
    $Error = 1; 
    }
    if($Error == 1 ){
        $Inhalt = '<div class="NewUserInside" >';
        $Inhalt = $Inhalt. '<div class="NewUserError" >der Benutzer : <br><br>'.$_GET['Vorname']. ' '.$_GET['Name'].'<br><br>  existiert schon</div>';
        $Inhalt = $Inhalt. '<div class="NewUserError"><button class="NewUserErrorButton" type="button" onclick="NewUser();">zurück</button></button>';
        $Inhalt = $Inhalt.'</div>';
        echo $Inhalt;
    }
    else{
    //Abfrage ob email schon existiert
        $sql = 'SELECT `EMAIL` FROM `accounts` WHERE `EMAIL`="'.$_GET['email'].'"  ';

        $db_erg = mysqli_query( $db_link, $sql );
        if ( ! $db_erg )
        {
            echo  'ungültige SafeNewUser: Error message: %s\n'. $db_link->error;
            // exit;
        }	
        while ($zeile = mysqli_fetch_assoc( $db_erg))
        {
            $Error = 1; 
        }
    }
    if($Error == 1 ){
        $Inhalt = '<div class="NewUserInside" >';
        $Inhalt = $Inhalt. '<div class="NewUserError" >die email- Adresse : <br><br>'.$_GET['email']. '<br><br>  existiert schon</div>';
        $Inhalt = $Inhalt. '<div class="NewUserError"><button class="NewUserErrorButton" type="button" onclick="NewUser();">zurück</button></button>';
        $Inhalt = $Inhalt.'</div>';
        echo $Inhalt;
    }
    else{
        //Abfrage ob username schon existiert
            $sql = 'SELECT `USERNAME` FROM `accounts` WHERE `USERNAME`="'.$_GET['username'].'"  ';        
            $db_erg = mysqli_query( $db_link, $sql );
            if ( ! $db_erg )
            {
                echo  'ungültige SafeNewUser: Error message: %s\n'. $db_link->error;
            }	
            while ($zeile = mysqli_fetch_assoc( $db_erg))
            {
                $Error = 1; 
            }
        }
    if($Error == 1 ){
        $Inhalt = '<div class="NewUserInside" >';
        $Inhalt = $Inhalt. '<div class="NewUserError" >der username : <br><br>'.$_GET['username']. '<br><br>  existiert schon</div>';
        $Inhalt = $Inhalt. '<div class="NewUserError"><button class="NewUserErrorButton" type="button" onclick="NewUser();">zurück</button></button>';
        $Inhalt = $Inhalt.'</div>';
        echo $Inhalt;
        }
        //alles ok, Passwort generieren und email verschicken
    else{
        // Passwort generieren
        include_once("content/PasswordGenerate.php");
                    $Password = generatePassword ( 8, 2, 2, true );
                    $passwortenc = password_hash($Password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO `accounts`(`userid`, `Nachname`, `Vorname`, `EMAIL`, `userlevel`,`PASSWORD`,`USERNAME`) VALUES (NULL, '".$_GET['Name']."','".$_GET['Vorname']."','".$_GET['email']."','10','".$passwortenc."','".$_GET['username']."')";

        $db_erg = mysqli_query( $db_link, $sql );
        if ( ! $db_erg )
        {
            echo  'ungültige SafeNewUser: Error message: %s\n'. $db_link->error;
        }	
        

        //zugang per email zuschicken
        //email schicken
        $empfaenger = $_GET['email'];
        $betreff = "Ihr ETEP online zugang ist freigeschaltet ";
        $betreff = str_replace("\n.", "\n..", $betreff);
        // Falls eine Zeile der Nachricht mehr als 70 Zeichen enthälten könnte,
        // sollte wordwrap() benutzt werden
        $nachricht = "Ihr Paswort ist :".$Password."";
        $nachricht = wordwrap($nachricht, 70, "\r\n");
        $nachricht = htmlentities($nachricht);
        $nachricht = '<html>
        <head>
            <title>HTML-E-Mail mit PHP erstellen</title>
        </head>
        
        <body>
        
        <h1>Ihr Zugang zur ETEP- online Software ist freigeschaltet </h1>
        
        
        
        <!-- <table border="1"> -->
        <table border="1">
        <tr>
            <td>ETEP online Zugang</td>
            <td>Ihr Paswort ist :'.$Password.'</td>
        </tr>
        <!--   <tr>
            <td>ETEP</td>
            <td>über 100</td>
            </tr> -->
        </table>
        
        <!-- <p>Die meisten HTML-Tags wie <b>fett</b>
        und <i>kursiv</i> stehen zur
        Verfügung</p> -->
        
        </body>
        </html>';
        $header = "From: Absender <NoReply@manosoftware.de>";
        
        $header  = "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html; charset=utf-8\r\n";
        
        $header .= "From: <NoReply@manosoftware.de>\r\n";
        $header .= "Reply-To: NoRelay\r\n";
        // $header .= "Cc: $cc\r\n";  // falls an CC gesendet werden soll
        $header .= "X-Mailer: PHP ". phpversion();


        //  echo "empfaenger = ".$empfaenger."  betreff = ". $betreff."  nachricht = ". $nachricht."  header = ". $header."\r\n";
        mail($empfaenger, $betreff, $nachricht, $header);
        $Inhalt = '<div class="NewUserInside" >';
        $Inhalt = $Inhalt.'<form>';
        $Inhalt = $Inhalt. '<div class="NewUserError">eine Email mit einem Passwort für den Benutzer: '.$_GET['username'].'wurde verschickt.';
        $Inhalt = $Inhalt.'</div>';
        $Inhalt = $Inhalt.'</form>';
        $Inhalt = $Inhalt.'<div class="NewUserbutton"><button class="NewUserbutton" type="button" onclick="NewUserClose();">schliessen</button></div>';
        $Inhalt = $Inhalt.'</div>';
        $Inhalt = $Inhalt.'</div>';
        echo $Inhalt;

    }

}
?>
</body>

