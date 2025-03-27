<?php
// require_once __DIR__ . '/php-word-generator/wordgenerator.php';
// require_once '.\php-word-generator\wordgenerator.php';
// require_once '../ELDiBlight/php-word-generator/wordgenerator.php';
 include "wordgenerator.php";
use WordGenerator\WordGenerator;
require 'vendor/autoload.php';
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     $title = $_POST['title'] ?? 'Dokument';
     $content = $_POST['content'] ?? 'Inhalt des Dokuments.';
    // $Section = '1';
     $Filename = 'Dokument.docx';

    // $wordGenerator = new WordGenerator();
    // $wordGenerator->createDocument();
    // $wordGenerator->addText( $Section, $content);
    // $filePath = $wordGenerator->saveDocument(filename: $Filename);

    // header('Content-Description: File Transfer');
    // header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    // header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
    // header('Expires: 0');
    // header('Cache-Control: must-revalidate');
    // header('Pragma: public');
    // header('Content-Length: ' . filesize($filePath));
    // readfile($filePath);
    // exit;




$phpWord = new PhpWord();
$section = $phpWord->addSection();
$section->addText($title , array('bold' => true));
$section->addTextBreak();
// $section->addSection();
$section->addText($content);

$tableStyle = array(
    'borderColor' => '006699',
    'borderSize'  => 6,
    'cellMargin'  => 50,
    'bgColor'     => '66BB00'
);
$firstRowStyle = array('bgColor' => 'gray');
$phpWord->addTableStyle('myTable', $tableStyle, $firstRowStyle);
$table = $section->addTable('myTable');
$table->addRow();

$cell = $table->addCell(2000);
$cell->getStyle()->setGridSpan(5);
$cell->addText('This is a row with gridSpan = 5', array('bold' => true), array('alignment' => 'center'));
$cell = $table->addCell(5000);
$cell->addText('This is a new row wimbmbnmvhjmcvhmbth gridSpan = 5', array('bold' => true), array('alignment' => 'center'));
$cell = $table->addCell(10000);
$cell->addText('This is a new row with gnbmbn,m.jk.bjkj,.jk.ridSpan = 5', array('bold' => true), array('alignment' => 'center'));
$cell = $table->addCell(10000);
$cell->addText('This is a new row with gnbmbn,m.jk.bjkj,.jk.ridSpan = 5', array('bold' => true), array('alignment' => 'center'));

$table->addRow();

$cell = $table->addCell(2000);
$cell->getStyle()->setGridSpan(5);
$cell->addText('This is a row with gridSpan = 5', array('bold' => true), array('alignment' => 'center'));
$cell = $table->addCell(5000);
$cell->addText('This is a new row wimbmbnmvhjmcvhmbth gridSpan = 5', array('bold' => true), array('alignment' => 'center'));
$cell = $table->addCell(2000);
$cell->addText('This is a new row with gnbmbn,m.jk.bjkj,.jk.ridSpan = 5', array('bold' => true), array('alignment' => 'center'));

$writer = IOFactory::createWriter($phpWord, 'Word2007');
$writer->save($Filename);
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Word-Dokument Generator</title>
</head>
<body>
    <h1>Word-Dokument Generator</h1>
    <form method="post">
        <label for="title">Titel:</label>
        <input type="text" id="title" name="title" required>
        <br>
        <label for="content">Inhalt:</label>
        <textarea id="content" name="content" required>Das ist der content der ausgedruckt werden soll</textarea>
        <br>
        <button type="submit">Dokument erstellen</button>
    </form>
</body>
</html>