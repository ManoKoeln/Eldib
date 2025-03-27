<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JSON Editor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        input, select, div {
            width: auto;
            height: auto;
            white-space: normal;
            min-width: 100px;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <h1>JSON Editor</h1>
    <input type="file" id="fileInput" accept=".json">
    <button onclick="exportJSON()">Export JSON</button>
    <table id="dataTable"></table>
    <script src="script.js"></script>
</body>
</html>