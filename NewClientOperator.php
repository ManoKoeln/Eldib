<script src="Myjs.js"></script>
<link href="CSS/NewClient.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" media="screen and (max-aspect-ratio: 4/3)" href="CSS/NewClientSmal.css" />
<body>
    <div class="NewClient" id="NewClient">
        <!-- <form method="post" enctype="multipart/form-data" action="        "> -->
        <form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">

            <!-- <input type="hidden" name="MAX_FILE_SIZE" value="1048576"> -->

            <!-- <label for="image">AWL Quelle</label>
            <input type="file" id="image" name="image"> -->


            <div class="FormContent">Vorname:<input type="text" name="Vorname" id="Vorname" ></div><br>
            <div class="FormContent">Name:<input type="text" name="Name" id="Name" ></div><br>           
            <div class="FormContent">Geburtstag:<input type="date" name="Birthday" id="Birthday" ></div><br>
            <div class="FormContent">email:<input type="email" name="email" id="email" ></div><br>
            <div>_____________________________________________________________________________________</div> 
            
            <div class="FormContent">Eltern Vorname:<input type="text" name="ParentVorname" id="ParentVorname" ></div><br>
            <div class="FormContent">Eltern Name:<input type="text" name="ParentName" id="ParentName" ></div><br>
            <div class="FormContent">Eltern email:<input type="email" name="Parentemail" id="Parentemail" ></div><br>
            <button>speichern</button>

        </form>
        <button type="button" onclick="NewClientClose();">schliessen</button>
    </div>
</body>

<?php
if (isset($_REQUEST["Name"])){
require ('db.php');
if ($_SESSION['LocalChat'] == true){
    $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
  }
  else{
  $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
  }

    $sql = "INSERT INTO `client`(`id`, `Name`, `Vorname`, `email`, `Geburtsdatum`, `Parentname`, `Parentvorname`, `Parentemail`) VALUES 
    (NULL, '".$_POST['Name']."','".$_POST['Vorname']."','".$_POST['email']."','".$_POST['Birthday']."','".$_POST['ParentName']."','".$_POST['ParentVorname']."','".$_POST['Parentemail']."')";
$db_erg = mysqli_query( $db_link, $sql );
if ( ! $db_erg )
{
    echo  'ungültige SafeNewClient: Error message: %s\n'. $db_link->error;
}	
}
?>
