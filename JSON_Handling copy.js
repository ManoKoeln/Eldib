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
            additionalColumns = getMaxAdditionalColumns(tableData.details);
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
    let ColumnIndex = 0;  

    // Optional: Anzeigen von Metadaten
    if (tableData.title) {
        const metadataRow = document.createElement('tr');
        const metadataCell = document.createElement('td');
        metadataCell.colSpan = 4 + additionalColumns;
        metadataCell.textContent = `Titel: ${tableData.title}`;
        metadataRow.appendChild(metadataCell);
        table.appendChild(metadataRow);
        const metadataRow2 = document.createElement('tr');
        const metadataCell2 = document.createElement('td');
        metadataCell2.colSpan = 4 + additionalColumns;
        metadataCell2.textContent = `Vorname: ${tableData.Vorname}, Name: ${tableData.Name}   additionalColumns =  ${additionalColumns}`;
        metadataRow2.appendChild(metadataCell2);
        table.appendChild(metadataRow2);            
         
    }

    tableData.details.forEach((row, index) => {
        ColumnIndex = ColumnIndex +1;    

        const tr = document.createElement('tr');
        if (row.ZieleBeschreibung === "") {
            const td = document.createElement('td');
            td.colSpan = 4 + additionalColumns;
            td.textContent = row.ZieleStichwort;
            td.classList.add('Stufe');
            td.id = `Stufe${ColumnIndex}`;
            tr.appendChild(td);
        } else {
            const tdStufe = document.createElement('td');
            tdStufe.textContent = row.Stufe;
            tdStufe.id = `Stufe_${ColumnIndex}`;
            const tdZieleStichwort = document.createElement('td');
            tdZieleStichwort.textContent = row.ZieleStichwort;
            tdZieleStichwort.classList.add(`TabContent${row.BereichID}`);
            tdZieleStichwort.id = `ZieleStichwort_${ColumnIndex}`;
            const tdZieleNummer = document.createElement('td');
            tdZieleNummer.textContent = row.ZieleNummer;
            tdZieleNummer.classList.add(`TabContent${row.BereichID}`);
            tdZieleNummer.id = `ZieleNummer_${ColumnIndex}`;
            const tdZieleBeschreibung = document.createElement('td');
            tdZieleBeschreibung.textContent = row.ZieleBeschreibung;
            tdZieleBeschreibung.classList.add(`TabContent${row.BereichID}`);
            tdZieleBeschreibung.id = `ZieleBeschreibung_${ColumnIndex}`;

            // const td3 = document.createElement('td');
            // const select = document.createElement('newSelect0');
            // ['später', 'übt es jetzt', 'kann das Kind'].forEach(optionText => {
            //     const option = document.createElement('option');
            //     option.value = optionText;
            //     option.textContent = optionText;
            //     if (row.select === optionText) {
            //         option.selected = true;
            //     }
            //     select.id = `newSelect${ColumnIndex}`;
            //     select.appendChild(option);
            // });
            // select.addEventListener('change', function() {
            //     row.select = select.value;
            // });
            // td3.appendChild(select);
            // td3.id = `tdSelect_${index}`;

            // tr.appendChild(tdStufe);
            tr.appendChild(tdZieleNummer);
            tr.appendChild(tdZieleStichwort);
            tr.appendChild(tdZieleBeschreibung);
            // tr.appendChild(td3);

                    // Dynamisch zusätzliche Spalten hinzufügen
                    for (let i = 0; i < additionalColumns; i++) {
                        const td = document.createElement('td');
                        // if (row.hasOwnProperty(`newSelect${i}`)) {
                        //     td.textContent = row[`newSelect${i}`];
                        // } else {
                            const newSelect = document.createElement(`select`);
                            ['später', 'übt es jetzt', 'kann das Kind'].forEach(optionText => {
                                const option = document.createElement('option');
                                option.value = optionText;
                                option.textContent = optionText;
                                if (row.newSelect === optionText) {
                                    option.selected = true;
                                }
                                newSelect.appendChild(option);
                            });
                            newSelect.addEventListener('change', function() {
                                row[`newSelect${i}`] = newSelect.value;
                            });
                            td.appendChild(newSelect);
                        // }
                        td.id = `newSelect_${index}_${i}`;
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
    tableData.details.forEach(row => {
        if (!row.fullRow) {
            row[`newSelect${additionalColumns - 1}`] = 'später';
        }
    });
    renderTable();
}

function exportToWord() {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'exportToWord.php';

    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'tableData';
    input.value = JSON.stringify(tableData);

    form.appendChild(input);
    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
}
function exportTableToWord() {
    const tableData = [];
    const rows = document.querySelectorAll('#dataTable tr');
    rows.forEach((row, rowIndex) => {
        const rowData = [];
        row.querySelectorAll('td').forEach((cell, cellIndex) => {
            if (cell.querySelector('select')) {
                rowData.push({
                    id: cell.id,
                    text: cell.querySelector('select').value
                });
            } else {
                rowData.push({
                    id: cell.id,
                    text: cell.textContent
                });
            }
        });
        tableData.push(rowData);
    });

    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'exportTableToWord.php';

    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'tableData';
    input.value = JSON.stringify(tableData);

    form.appendChild(input);
    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
}
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('fileInput').addEventListener('change', handleFileSelect);
});