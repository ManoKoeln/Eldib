<?php
    require ('db.php');
	$db_link = new mysqli($host_name, $user_name, $password, $database);
    	$sql = "INSERT INTO `client`(`id`, `Name`, `Vorname`, `email`, `Birthday`, `Parentname`, `Parentvorname`, `Parentemail`) VALUES 
        (NULL, '".$_POST['Name']."','".$_POST['Vorname']."','".$_POST['email']."','".$_POST['Geburtsdatum']."','".$_POST['ParentName']."','".$_POST['ParentVorname']."','".$_POST['Parentemail']."')";
	$db_erg = mysqli_query( $db_link, $sql );
	if ( ! $db_erg )
	{
		echo  'ungültige SafeNewClient: Error message: %s\n'. $db_link->error;
	}	
    ?>
