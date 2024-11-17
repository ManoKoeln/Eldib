<?php
include 'db.php';
if ( isset($_GET['sendchat'])){
    WriteSetUpData();
}

// if ( isset($_POST['SetupForm1'])){
// 	require("db.php");
// 		//Username ist content
// 	$Inhalt = "";
// 		  //User anlegen
// 		  $stmt = $mysql->prepare("UPDATE `usersetup` SET `sendchat` = :sendchat ,`sendpost` = :sendpost WHERE `usersetup`.`userid` = '".$_SESSION["userid"]."'");
// 		//   $stmt = $mysql->prepare("INSERT INTO accounts (USERNAME, PASSWORD, Vorname, Nachname, EMAIL) VALUES (:user, :pw, :Vorname, :Nachname , :email )");
// 		  $stmt->bindParam(":sendchat", $_POST["sendchat"]);
// 		  $stmt->bindParam(":sendpost", $_POST["sendpost"]);
// 		  $stmt->execute();
// 		//   echo "Dein Account wurde angelegt";
// 		  $Inhalt = $Inhalt.'<form action="PopUp.php" method="post">';
// 		  $Inhalt = $Inhalt.'    <input type="checkbox" name="sendchat" id="sendchat" value="sendchat"> wollen sie bei Änderungen in Ihren chats per email benachrichtigt werden?<br>';
// 		  $Inhalt = $Inhalt.'    <input type="checkbox" name="sendpost" id="sendpost" value="sendpost">wollen sie bei Änderungen in Ihren Anfragen per email benachrichtigt werden?<br>';
// 		  $Inhalt = $Inhalt.'    <button type="submit"  name="SetupForm" onclick="WriteSetUpData();">Übernehmen?</button>';
// 		  $Inhalt = $Inhalt.'  </form>';
// 		  echo $Inhalt;
// 		}

function WriteSetUpData() {

	if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }

	$sql = "UPDATE `usersetup` SET `sendchat` = '".$_GET["sendchat"]."',`sendpost` = '".$_GET["sendpost"]."' WHERE `usersetup`.`userid` = '".$_SESSION["userid"]."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		echo   'ungültige EditZiele: Error message: %s\n'. $db_link->error;
	}

}
if ( isset($_GET['FontSize'])){

	if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }

	$sql = "UPDATE `usersetup` SET `fontsize` = '".$_GET["FontSize"]."' WHERE `usersetup`.`userid` = '".$_SESSION["userid"]."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		echo   'ungültige EditZiele: Error message: %s\n'. $db_link->error;
	}

}

if ( isset($_GET['FontSizeSmal'])){

	if ($_SESSION['LocalChat'] == true){
        $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
    }
    else{
    $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
    }

	$sql = "UPDATE `usersetup` SET `fontsizesmal` = '".$_GET["FontSizeSmal"]."' WHERE `usersetup`.`userid` = '".$_SESSION["userid"]."'";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		echo   'ungültige EditZiele: Error message: %s\n'. $db_link->error;
	}

}

?>









