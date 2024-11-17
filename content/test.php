<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
session_start();
$_SESSION['user'] = 5;

//Verbindung zur DB
//require_once __DIR__. '/../../mysql-connection.php';
require_once ("db.php");
$db = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"] ,$_SESSION["database"]);

$abfrage = $db->query("SELECT * From accounts");

    //Session select user
    $search_user = $db->prepare("SELECT * FROM accounts WHERE userid = ?");
    $search_user->bind_param('i',$_SESSION['user']);
    $search_user->execute();
    $search_result = $search_user->get_result();

    if($search_result->num_rows == 1):
        $search_object = $search_result->fetch_object();
        //Logout funktion
        if(isset($_POST['logout'])):
            session_destroy();
            header('Location: ./index.php');
        endif;
    endif;
    
    //Passwort Ändern
    $ausgabe             = $abfrage->fetch_object();
    $name                = $search_object->user;
    // $name                = $search_object->USERNAME;
    $active_password    = $ausgabe->password;
    $old_password        = $_POST['old_password'];
    $new_password        = $_POST['new_password'];
    $confirm_password    = $_POST['confirm_password'];
    $old_password        = htmlspecialchars($old_password, ENT_QUOTES,'UTF-8');
    $new_password        = htmlspecialchars($new_password, ENT_QUOTES,'UTF-8');
    $confirm_password      = htmlspecialchars($confirm_password, ENT_QUOTES,'UTF-8');
    $old_password        = md5($old_password);
    
    
    if(isset($_POST['change_password'])){
        // Überprüfe auf Leere Felder
        if (empty($old_password) || empty($new_password) || empty($confirm_password)) {
                echo "fülle alle felder aus";
            }
        else {
            //Überprüfe sind neues Passwort und Bestätigung identisch
            if ($active_password==$old_password && $new_password === $confirm_password){
                //Versclüssle neues Passwort
                $new_password = md5($new_password);
                $update_query =    mysqli_query($db, "update user set password ='$new_password' WHERE user='$name'");
                //Passwort ersetzen
                $return_message = '<a class="button-send" href="index.php?page=home">Passwort erfolgreich geändert</a>';
            }    
            else {
                $return_message = '<a class="button-send" href="index.php?page=contact">Etwas ist Schiefgelaufen!</a>';
                
            }
        }
    }
?>
    <nav class="nav-user">
        <div class="nav-center">
            <ul class="nav-user-ul">
                <li class="nav-user-li">
                    <a class="nav-button" href="index.php?page=user">Nutzer Profil</a>
                </li>
                <li class="nav-user-li">
                    <a class="nav-button" href="index.php?page=order">Bestellungen</a>
                </li>
                <li class="nav-user-li">
                    <a class="nav-button" href="index.php?page=bill">Rechnungen</a>
                </li>
                <li class="nav-user-li">
                    <a class="nav-button" href="index.php?page=settings">Einstellungen</a>
                </li>
            </ul>                
        </div>
    </nav>
        <div class="item-user-div">
            <form method="post">
                    <input name="old_password" placeholder="Altes Passwort" type="password">
                    <input name="new_password" placeholder="Neues Passwort" type="password">
                    <input name="confirm_password" placeholder="Passwort Widerholen" type="password">
                    <button class="button-send" name="change_password">Passwort Ändern</button>
                    <button class="button-send" name="logout">Logout</button> 
                    <?php echo "<br><br>".$return_message; ?>
               </form>