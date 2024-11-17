<script src="Operator.js"></script>
<link href="CSS/OperatorSelectionList.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" media="screen and (max-aspect-ratio: 4/3)" href="CSS/OperatorSelectionListSmal.css" />
<!-- <body> -->
    <div class="OperatorSelection" id="OperatorSelection">
        <div class="ReadWrite"><h3>Bearbeiten</h3>
            
            <label for="SelectOperatorReadWrite"> </label>
            <select title="SelectOperatorReadWrite" name="SelectOperatorReadWrite" id="SelectOperatorReadWrite" onchange="ChangedOperatorSelectionReadWrite()">
            <option class="optionOperatorReadWrite" value=0>Teilnehmer auswählen</option>
            <?php
            include("content/db.php");
            //aktuelles Teilnehmer eintragen
            if ($_SESSION['LocalChat'] == true){
                $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
              }
              else{
              $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
              }
        
            $sql = "SELECT * FROM accounts WHERE userlevel = '10'";
            $db_erg = mysqli_query( $db_link, $sql );
            if ( ! $db_erg )
            {
            echo  'ungültige Bereich Abfrage Operator 1: Error message: %s\n'. $db_link->error;
            }
            while ($zeile = mysqli_fetch_assoc( $db_erg))
            {
            echo '<option class="optionOperator" value="'.$zeile['userid'].'">('.$zeile['userid'].'),'.$zeile['Nachname'].', '.$zeile['Vorname'].' - '.$zeile['EMAIL'].'</option>';
            // echo '<option class="optionOperatorReadWrite" value="'.$zeile['id'].'">'.$zeile['Name'].', '.$zeile['Vorname'].' - '.$zeile['Email'].'</option>';
            }
            ?>
            </select>        
        </div>
        <div class="ReadOnly"><h3>nur lesen</h3>
            <div class="OperatorSelectionReadOnly" id="OperatorSelectionReadOnly">
            <label for="SelectOperatorReadOnlyReadOnly"> </label>
            <select title="SelectOperatorReadOnly" name="SelectOperatorReadOnly" id="SelectOperatorReadOnly" onchange="ChangedOperatorSelectionReadOnly()">
            <!-- <select name="SelectOperatorReadOnly" id="SelectOperatorReadOnly" onchange="ChangedOperatorSelectionReadOnly()"> -->
            <option class="optionOperatorReadOnly" value=0>Teilnehmer auswählen</option>
            <?php
            //aktuelles Teilnehmer eintragen
            if ($_SESSION['LocalChat'] == true){
                $db_link = new mysqli($_SESSION["host_nameSchool"], $_SESSION["user_nameSchool"], $_SESSION["passwordSchool"], $_SESSION["databaseSchool"]);
              }
              else{
              $db_link = new mysqli($_SESSION["host_name"], $_SESSION["user_name"], $_SESSION["password"], $_SESSION["database"]);
              }
        
            $sql = "SELECT * FROM accounts WHERE userlevel = '10'";
            $db_erg = mysqli_query( $db_link, $sql );
            if ( ! $db_erg )
            {
            $Inhalt = 'ungültige Bereich Abfrage Operator 2: Error message: %s\n'. $db_link->error;
            }
            while ($zeile = mysqli_fetch_assoc( $db_erg))
            {
            // echo '<option class="optionOperator" value="'.$zeile['id'].'">('.$zeile['id'].'),'.$zeile['Name'].', '.$zeile['Vorname'].' - '.$zeile['Geburtsdatum'].'</option>';
            echo '<option class="optionOperatorReadOnly" value="'.$zeile['userid'].'">'.$zeile['Nachname'].', '.$zeile['Vorname'].' - '.$zeile['EMAIL'].'</option>';
            }
            ?>
            </select>
        </div>
        <div><button class="OperatorSelectionButtonClose" onclick="OperatorSelectionHide();">schliessen</button></div>
    </div>
    </div>
<!-- </body> -->


