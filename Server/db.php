 
<?php
# web configuration
  $host_name = 'db5010288982.hosting-data.io';
  $database = 'dbs8719005';
  $user_name = 'dbu2482717';
  $password = 'ManoEtep:2000';

  $_SESSION["host_name"]=$host_name; 
  $_SESSION["database"]=$database; 
  $_SESSION["user_name"]=$user_name; 
  $_SESSION["password"]=$password;

  $link = new mysqli($host_name, $user_name, $password, $database);

  if ($link->connect_error) {
    die('<p>Verbindung zum MySQL Server fehlgeschlagen: '. $link->connect_error .'</p>');
  } 
  
	try{
    $mysql = new PDO("mysql:host=$host_name;dbname=$database", $user_name, $password);
} catch (PDOException $e){
    echo "SQL Error: ".$e->getMessage();
}
  ?>