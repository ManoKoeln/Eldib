<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Tabelle aus JSON-Datei</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .Stufe {
            font-weight: bold;
            background-color: lightgray;
        }
    </style>

</head>
<body>
<?PHP
$Inhalt = '';
$Inhalt.= '    <table id="dataTable" class="table table-bordered table-striped table-hover table-sm">';
        // <!-- Tabelle wird hier dynamisch eingefügt -->
        $Inhalt.= '     </table>';
        $Inhalt.= '<script src="JSON_Handling.js"></script>';
        echo $Inhalt;
?>
</body>
</html>