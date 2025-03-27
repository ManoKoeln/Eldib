
<?php
session_start(); // Starten der Session
// if (isset($_POST['variableName']) && isset($_POST['value'])) {
//   $variableName = $_POST['variableName'];
//   $value = $_POST['value'];
//   $_SESSION[$variableName] = $value;
//   echo "Session variable set successfully";
// } 

// $user_agent = "";
// $user_agent = $_SERVER['HTTP_USER_AGENT'];
// require "content/db.php";
// $_SESSION['NewColumn'] = 0;
// $_SESSION['ActFilename'] = "actuelle Datei";
// $_SESSION['$data'] = "";

?>
<!DOCTYPE html>
<HTML lang="de">
<meta charset="UTF-8">

<head>
    <title>ETEP</title>
    
    
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" media="screen and (max-aspect-ratio: 4/3)" href="css/styleSmal.css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
    <script src="Myjs.js"></script>
    <script src="Printer.js"></script>
    <script src="ELDiBLehrer.js"></script>
    <script src="JSON_Handling.js"></script>
    
    <style>
        .fixed-top-custom {
            top: 0;
            width: 100%;
            height: 20vh;
            background-color: #f8f9fa; /* Beispielhintergrundfarbe */
        }
          #AktualClient{
            display: none;
          }
        .fixed-middle-custom {
          
            top: 20%;
            width: 100%;
            height: 22vh;
            background-color: lightblue; /* Beispielhintergrundfarbe */
        }

        .fixed-bottom-custom {
            top: 33%;
            width: 100%;
            height: 58vh;
            background-color: #dee2e6; /* Beispielhintergrundfarbe */
            overflow: auto; /* Ermöglicht das Scrollen, wenn der Inhalt größer ist als der Container */
        }
    </style>
    <script>
function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'de'
  }, 'google_translate_element');
}
</script>

<script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<!-- <script src="Myjs.js"></script> -->

    <!-- <script src="Operator.js"></script>
    <script src="ELDiBEltern.js"></script>
    <script src="JScript/ELDiBLehrer_New.js"></script>
    <script src="ELDiBKind.js"></script>
    <script src="ELDiBLehrer.js"></script>
    <script src="SupportPlan.js"></script>
    <script src="EmailKind.js"></script>
    <script src="EmailEltern.js"></script> -->
    <!-- <script>
              window.onload = function() {
            Start();
        };
    </script> -->
    <!-- <script src="NewClient.js"></script> -->
    <?php


// process_json.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // JSON-Daten aus der Anfrage lesen
  $jsonData = file_get_contents('php://input');
  // JSON-Daten dekodieren
  $data = json_decode($jsonData, true);

  // JSON-Daten in der Session speichern
  $_SESSION['data'] = $data;

  echo "JSON-Daten wurden erfolgreich in der Session gespeichert.";

}

        ?>
</head>
<body onload="StartHead();">

<input type="file" id="fileInput" accept=".json" style="display:none;" onchange="handleFileSelect(event)">
    <textarea id="fileContent" style="display:none;"></textarea>
  


<div id="Header" class="fixed-top-custom ">
  Header
</div>
<div id="AktualClient" class="fixed-middle-custom row g-4 p-2">
  <div class="col-md-2">
    <label id="DescVorname" for="validationCustom01" class="form-label">Vorname</label>
    <input type="text" class="form-control" id="validationVorname" value="Vorname" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>
  <div class="col-md-2">
    <label id="DescName" for="validationCustom02" class="form-label">Name</label>
    <input type="text" class="form-control" id="validationName" value="Name" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>

  <div class="col-md-2">
    <label id="DescKlasse" for="validationCustom03" class="form-label">Klasse</label>
    <input type="text" class="form-control" id="validationKlasse" required>
    <div class="invalid-feedback">
      Bitte geben Sie die Klasse ein.
    </div>
  </div>

  <div class="col-md-2">
    <label id="DescLehrer" for="validationCustom05" class="form-label">Lehrer</label>
    <input type="text" class="form-control" id="validationLehrer" required>
    <div class="invalid-feedback">
      Bitte geben Sie den Namen des Lehrers ein.
    </div>
  </div>

  <div class="col-md-12">

  <button class="btn btn-primary m-1" onclick="NewJSON()">Neue Datei erstellen</button>
  <button class="btn btn-primary m-1" onclick="loadJSON()">Lade Daten aus JSON-Datei</button>
  <button class="btn btn-primary m-1" onclick="saveJSON()">Speichere Daten in eine JSON-Datei</button>
  <button class="btn btn-secondary m-1" onclick="saveAsJSON()">Erstelle JSON-Datei</button>

  <button class="btn btn-primary m-1" onclick="window.location.href='JsonEditor.php'">JSON Editor öffnen</button>
  <!-- <button class="btn m-1" onclick="addColumn()">Füge eine Spalte hinzu</button> -->
  <!-- <button class="btn btn-warning m-1" onclick="exportToWord()">Exportiere als Word-Dokument</button> -->
  <!-- <button class="btn btn-secondary m-1" onclick="exportTableToWord()">Tabelle in Word exportieren</button> -->
  <button class="btn btn-primary m-1" onclick="exportTableToWord()">
    <i class="fas fa-print"></i>
</button>

<!-- </form> -->
</div>
</div>
<div id="Startseite" class="fixed-bottom-custom p-1">
  Startseite
</div>
</body>
</html>


