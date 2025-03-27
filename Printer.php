<!-- <script>
        function copyDivTextToInput(divId) {
            var divText = document.getElementById(divId).innerText;
            return divText;
        }

    </script> -->
    <script src="Printer.js"></script>
<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Starten der Session nur, wenn keine Session aktiv ist
    }


  if (!function_exists('PrintLehrer')) {
  function PrintLehrer() {
    // Implementiere hier die Druckfunktion
    for ($i = 1; $i <= $_SESSION['LehrerArrayCounter']; $i++) {
      $elementId = "Column1_" . $i;
      if (isset($_POST[$elementId])) {
        $text = $_POST[$elementId];
        echo "Text from element $elementId: $text<br>";
      }
    }
    // echo "Druckfunktion wird ausgeführt...";
  }
  }
  if (isset($_GET['PrintLehrer'])) {
    PrintLehrer();
  }
  
  include "wordgenerator.php";
  use WordGenerator\WordGenerator;
  require 'vendor/autoload.php';
  use PhpOffice\PhpWord\PhpWord;
  use PhpOffice\PhpWord\IOFactory;
  
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Empfangen der JSON-Daten
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $vorname = $data['Vorname'] ?? 'Vorname nicht gesetzt';
    $nachname = $data['Nachname'] ?? 'Nachname nicht gesetzt';
    $klasse = $data['Klasse'] ?? 'Klasse nicht gesetzt';
    $lehrer = $data['Lehrer'] ?? 'Lehrer nicht gesetzt';
    $Column1 = $data['Column1'] ?? [];
    $Column2 = $data['Column2'] ?? [];
    $Column3 = $data['Column3'] ?? [];
    $Notizen = $data['Notizen'] ?? ['keine Notizen'];
      $title = $_POST['title'] ?? 'Einschätzungsbogen Lehrer';
      $content = $_POST['content'] ?? 'Inhalt des Dokuments.';
      $Filename = 'Dokument.docx';
  
  $phpWord = new PhpWord();
  $section = $phpWord->addSection();
  $section->addText($title , array('bold' => true));
  $section->addTextBreak();
  // $section->addSection();
  $section->addText('Vorname:'. $vorname);
  $section->addText('Nachname:'. $nachname);
  $section->addText('Klasse :'. $klasse);
  $section->addText('Lehrer :'. $lehrer);
  

  $tableStyle = array(
      'borderColor' => '006699',
      'borderSize'  => 6,
      'cellMargin'  => 50,
      'bgColor'     => 'white'
  );
  // $firstRowStyle = array('bgColor' => 'gray');
  // $phpWord->addTableStyle('myTable', $tableStyle, $firstRowStyle);
  // $table = $section->addTable('myTable');
  // $table->addRow();
  // $cell = $table->addCell(2000);
  // $cell->getStyle()->setGridSpan(1);
  // $cell->addText("Bereich", array('bold' => true), array('alignment' => 'left'));

  // $cell = $table->addCell(5000);
  // $cell->getStyle()->setGridSpan(1);
  // $cell->addText("Beschreibung", array('bold' => true), array('alignment' => 'left'));

  // $cell = $table->addCell(2000);
  // $cell->getStyle()->setGridSpan(1);
  // $cell->addText("Datum", array('bold' => true), array('alignment' => 'left'));
  
$tNotizen ="";
// $table->addRow();
// $cell = $table->addCell(2000, array('bgColor' => 'D3D3D3'));
// $cell->getStyle()->setGridSpan(3);
// $cell->addText("LehrerArrayCounter = ".$_SESSION['LehrerArrayCounter'], array('bold' => false), array('alignment' => 'left'));
  for ($i = 0 ; $i <= $_SESSION['LehrerArrayCounter']; $i++) {

    // for ($i = 1; $i <= $_SESSION['LehrerArrayCounter']; $i++) {
    if ($Column2[$i] =="") {
      $firstRowStyle = array('bgColor' => 'gray');
      $section->addPageBreak();
      $section->addTextBreak();
      $phpWord->addTableStyle('myTable', $tableStyle, $firstRowStyle);
      $table = $section->addTable('myTable');
      $table->addRow();
      $cell = $table->addCell(2000);
      $cell->getStyle()->setGridSpan(1);
      $cell->addText("Bereich", array('bold' => true), array('alignment' => 'left'));
    
      $cell = $table->addCell(5000);
      $cell->getStyle()->setGridSpan(1);
      $cell->addText("Beschreibung", array('bold' => true), array('alignment' => 'left'));
    
      $cell = $table->addCell(2000);
      $cell->getStyle()->setGridSpan(1);
      $cell->addText("Datum", array('bold' => true), array('alignment' => 'left'));

      // $section->addPageBreak();
      // $section->addTextBreak();
      // $table = $section->addTable('myTable');
      $table->addRow();
      $cell = $table->addCell(2000, array('bgColor' => 'D3D3D3'));
      $cell->getStyle()->setGridSpan(3);
      // $cell->addText($line.$Column1[$i], array('bold' => true), array('alignment' => 'center'));
      $cell->addText($Column1[$i], array('bold' => false), array('alignment' => 'left'));
    }
    else {

      $table->addRow();
      $cell = $table->addCell(2000);
      $cell->getStyle()->setGridSpan(1);
      // $cell->addText($line.$Column1[$i], array('bold' => true), array('alignment' => 'center'));
      $cell->addText($Column1[$i], array('bold' => false), array('alignment' => 'left'));

      $cell = $table->addCell(5000);
      $cell->getStyle()->setGridSpan(1);
      // $cell->addText($line.$Column1[$i], array('bold' => true), array('alignment' => 'center'));
      $cell->addText($Column2[$i]." i = ".$i, array('bold' => false), array('alignment' => 'left'));

      $cell = $table->addCell(2000);
      $cell->getStyle()->setGridSpan(1);
      // $cell->addText($line.$Column1[$i], array('bold' => true), array('alignment' => 'center'));
      $cell->addText($Column3[$i], array('bold' => false), array('alignment' => 'left'));

      $table->addRow();
      $cell = $table->addCell(10000);
      $cell->getStyle()->setGridSpan(3); // Setzt die Zelle auf die gesamte Tabellenbreite
      
      // if ($Notizen[$i] == "Notizen") {
      //   $tNotizen = "Notizen ".$i;
      // }
      // else {
      //   $tNotizen = $Notizen[$i];
      // }
      // $cell->addText($tNotizen, array('bold' => false), array('alignment' => 'left'));
      $cell->addText($Notizen[$i]." i = ".$i, array('bold' => false), array('alignment' => 'left'));
    }
  
    }

  //   for ($i = 1; $i <= $_SESSION['LehrerArrayCounter']; $i++) {
  //   $table->addRow();
  //   $cell = $table->addCell(2000);
  //   $cell->getStyle()->setGridSpan(5);
  //   $cell->addText($Column1[$i], array('bold' => true), array('alignment' => 'center'));
  // }

//   for ($i = 1; $i <= $_SESSION['LehrerArrayCounter']; $i++) {
//     $table->addRow();
//     $elementId1 = "Column1_" . $i;
//     $text1 = $_GET['Column1['.$i.']'] ?? '';
//     if ($text1 != "") {
//     //   $text1 = $_GET[$elementId1];
//       $cell = $table->addCell(2000);
//       $cell->getStyle()->setGridSpan(5);
//       $cell->addText($i." = ".$text1);
//     //   echo "Text from element $elementId1: $text1<br>";
//     }
// }


//     $elementId2 = "ZieleBeschreibung_" . $i;
//     if (isset($_POST[$elementId2])) {
//       $text2 = $_POST[$elementId2];
//       $cell = $table->addCell(2000);
//       $cell->getStyle()->setGridSpan(5);
//       $cell->addText($_POST[$elementId2]);
//     //   echo "Text from element $elementId2: $text2<br>";
//     }
//     $elementId3 = "Column3_" . $i;
//     if (isset($_POST[$elementId3])) {
//       $text3 = $_POST[$elementId3];
//       $cell = $table->addCell(2000);
//       $cell->getStyle()->setGridSpan(5);
//       $cell->addText($_POST[$elementId3]);
//     //   echo "Text from element $elementId3: $text3<br>";
//     }
//   }
  // $table->addRow();
  
  // $cell = $table->addCell(2000);
  // $cell->getStyle()->setGridSpan(5);
  // $cell->addText('This is a row with gridSpan = 5', array('bold' => true), array('alignment' => 'center'));
  // $cell = $table->addCell(5000);
  // $cell->addText('This is a new row wimbmbnmvhjmcvhmbth gridSpan = 5', array('bold' => true), array('alignment' => 'center'));
  // $cell = $table->addCell(2000);
  // $cell->addText('This is a new row with gnbmbn,m.jk.bjkj,.jk.ridSpan = 5', array('bold' => true), array('alignment' => 'center'));
  
  $writer = IOFactory::createWriter($phpWord, 'Word2007');
  $writer->save($Filename);
  }
  ?>
  <script>
        function copyDivTextToInput(divId) {
            var divText = document.getElementById(divId).innerText;
            return divText;
        }

    </script>