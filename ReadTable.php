<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Tabelle aus JSON-Datei</title>
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
    </style>
    <script>
        let tableData = {};
        let additionalColumns = 0;

        function loadJSON() {
            const fileInput = document.getElementById('fileInput');
            fileInput.click();
        }

        function handleFileSelect(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    tableData = JSON.parse(e.target.result);
                    // Anzahl der zusätzlichen Spalten ermitteln
                    additionalColumns = getMaxAdditionalColumns(tableData.rows);
                    renderTable();
                };
                reader.readAsText(file);
            }
        }

        function getMaxAdditionalColumns(rows) {
            let maxColumns = 0;
            rows.forEach(row => {
                let columnCount = 0;
                while (row.hasOwnProperty(`newSelect${columnCount}`)) {
                    columnCount++;
                }
                if (columnCount > maxColumns) {
                    maxColumns = columnCount;
                }
            });
            return maxColumns;
        }

        function renderTable() {
            const table = document.getElementById('dataTable');
            table.innerHTML = '';

            // Optional: Anzeigen von Metadaten
            if (tableData.metadata) {
                const metadataRow = document.createElement('tr');
                const metadataCell = document.createElement('td');
                metadataCell.colSpan = 3 + additionalColumns;
                metadataCell.textContent = `Titel: ${tableData.metadata.title}, Datum: ${tableData.metadata.date}`;
                metadataRow.appendChild(metadataCell);
                table.appendChild(metadataRow);
            }

            tableData.rows.forEach((row, index) => {
                const tr = document.createElement('tr');
                if (row.fullRow) {
                    const td = document.createElement('td');
                    td.colSpan = 3 + additionalColumns;
                    td.textContent = row.fullRow;
                    tr.appendChild(td);
                } else {
                    const td1 = document.createElement('td');
                    td1.textContent = row.text1;
                    const td2 = document.createElement('td');
                    td2.textContent = row.text2;
                    const td3 = document.createElement('td');
                    const select = document.createElement('select');
                    ['später', 'übt es jetzt', 'kann das Kind'].forEach(optionText => {
                        const option = document.createElement('option');
                        option.value = optionText;
                        option.textContent = optionText;
                        if (row.select === optionText) {
                            option.selected = true;
                        }
                        select.appendChild(option);
                    });
                    select.addEventListener('change', function() {
                        row.select = select.value;
                    });
                    td3.appendChild(select);
                    tr.appendChild(td1);
                    tr.appendChild(td2);
                    tr.appendChild(td3);

                    // Dynamisch zusätzliche Spalten hinzufügen
                    for (let i = 0; i < additionalColumns; i++) {
                        const td = document.createElement('td');
                        const newSelect = document.createElement('select');
                        ['später', 'übt es jetzt', 'kann das Kind'].forEach(optionText => {
                            const option = document.createElement('option');
                            option.value = optionText;
                            option.textContent = optionText;
                            if (row[`newSelect${i}`] === optionText) {
                                option.selected = true;
                            }
                            newSelect.appendChild(option);
                        });
                        newSelect.addEventListener('change', function() {
                            row[`newSelect${i}`] = newSelect.value;
                        });
                        td.appendChild(newSelect);
                        tr.appendChild(td);
                    }
                }
                table.appendChild(tr);

            });
        }

        function saveJSON() {
            const json = JSON.stringify(tableData, null, 2);
            const blob = new Blob([json], { type: 'application/json' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'data.json';
            a.click();
            URL.revokeObjectURL(url);
        }

        function addColumn() {
            additionalColumns++;
            tableData.rows.forEach(row => {
                if (!row.fullRow) {
                    row[`newSelect${additionalColumns - 1}`] = 'später';
                }
            });
            renderTable();
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('fileInput').addEventListener('change', handleFileSelect);
        });
    </script>
</head>
<body>
    <input type="file" id="fileInput" style="display:none;">
    <table id="dataTable">
        <!-- Tabelle wird hier dynamisch eingefügt -->
    </table>
    <button onclick="loadJSON()">Lade Daten aus JSON-Datei</button>
    <button onclick="saveJSON()">Speichere Daten in eine JSON-Datei</button>
    <button onclick="addColumn()">Füge eine Spalte hinzu</button>
</body>
</html>