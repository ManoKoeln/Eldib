<?php
include ("content/helpers.php");
if ($_SESSION['LocalChat'] == true){
   $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
 }
 else{
 $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
 }
//INSERT INTO `supportplanitems`(`id`, `supportplanID`, `Spalte1`, `Spalte2`, `Spalte3`, `Spalte4`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]')
$sql = "INSERT INTO `supportplanitems`(`id`, `supportplanID`, `Spalte1`, `Spalte2`, `Spalte3`, `Spalte4`) VALUES (NULL,'37','".$_POST['Row1']."','".$_POST['Row2']."','".$_POST['Row3']."','".$_POST['Row4']."')";
$db_erg = mysqli_query( $db_link, $sql );
if ( ! $db_erg )
{
   echo  'ungültige Bereich NewLineSupportPlan: Error message: %s\n'. $db_link->error;
}
?>
