<?php
require 'vendor/autoload.php';

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tableData = json_decode($_POST['tableData'], true);

    $phpWord = new PhpWord();
    $section = $phpWord->addSection();

    // Optional: Metadaten hinzufügen
    if (isset($tableData['title'])) {
        $section->addText("Titel: " . $tableData['title'], ['bold' => true]);
    }
    if (isset($tableData['Vorname']) && isset($tableData['Nachname'])) {
        $section->addText("Vorname: " . $tableData['Vorname'] . ", Name: " . $tableData['Nachname'], ['bold' => true]);
    }
    $section->addTextBreak(1);

    // Tabelle hinzufügen
    $tableStyle = [
        'borderSize' => 6,
        'borderColor' => '000000',
        'cellMargin' => 50,
        'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER,
        'cantSplit' => true,
    ];
    $phpWord->addTableStyle('myTable', $tableStyle);
    $table = $section->addTable('myTable');

    // Tabellenüberschriften hinzufügen
    $headerRow = $table->addRow();
    $headerRow->addCell(2000)->addText('Stufe', ['bold' => true]);
    // $headerRow->addCell(2000)->addText('ZieleNummer', ['bold' => true]);
    $headerRow->addCell(4000)->addText('ZieleStichwort', ['bold' => true]);
    $headerRow->addCell(6000)->addText('ZieleBeschreibung', ['bold' => true]);
    $headerRow->addCell(2000)->addText('Select', ['bold' => true]);

    // Dynamisch Überschriften für newSelect hinzufügen
    $maxAdditionalColumns = 0;
    foreach ($tableData['details'] as $row) {
        $additionalColumns = 0;
        while (isset($row["newSelect$additionalColumns"])) {
            $additionalColumns++;
        }
        if ($additionalColumns > $maxAdditionalColumns) {
            $maxAdditionalColumns = $additionalColumns;
        }
    }
    for ($i = 0; $i < $maxAdditionalColumns; $i++) {
        $headerRow->addCell(2000)->addText("newSelect$i", ['bold' => true]);
    }

    foreach ($tableData['details'] as $row) {
        $tableRow = $table->addRow();
        if ($row['ZieleBeschreibung'] === "") {
            // Alle Spalten verbinden, wenn ZieleBeschreibung leer ist
            $tableRow->addCell(12000, ['gridSpan' => 6 + $maxAdditionalColumns])->addText($row['ZieleStichwort'], ['bold' => true]);
        } else {
            $tableRow->addCell(2000)->addText($row['Stufe'], ['valign' => 'center']);
            // $tableRow->addCell(2000)->addText($row['ZieleNummer'] . ' ' . $row['ZieleStichwort'], ['valign' => 'center']);
            $tableRow->addCell(6000)->addText($row['ZieleBeschreibung'], ['valign' => 'center']);
            if (isset($row['select'])) {
                $tableRow->addCell(2000)->addText($row['select'], ['valign' => 'center']);
            }
            for ($i = 0; $i < $maxAdditionalColumns; $i++) {
                if (isset($row["newSelect$i"])) {
                    $tableRow->addCell(2000)->addText($row["newSelect$i"], ['valign' => 'center']);
                } else {
                    $tableRow->addCell(2000)->addText('', ['valign' => 'center']);
                }
            }
        }
    }

    $filename = "Tabelle.docx";
    $temp_file = tempnam(sys_get_temp_dir(), $filename);
    $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save($temp_file);

    header('Content-Description: File Transfer');
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    header('Content-Disposition: attachment; filename=' . $filename);
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($temp_file));
    flush();
    readfile($temp_file);
    unlink($temp_file);
    exit;
}
?>