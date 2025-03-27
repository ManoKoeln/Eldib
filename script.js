let tableData = {};

document.getElementById('fileInput').addEventListener('change', handleFileSelect);

function handleFileSelect(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            tableData = JSON.parse(e.target.result);
            renderTable();
        };
        reader.readAsText(file);
    }
}

function renderTable() {
    const table = document.getElementById('dataTable');
    table.innerHTML = '';

    // Add table headers
    const headerRow = document.createElement('tr');
    ['Stufe', 'BereichID', 'ZieleStichwort', 'ZieleBeschreibung', 'Notizen', 'Auswahl'].forEach(text => {
        const th = document.createElement('th');
        th.textContent = text;
        headerRow.appendChild(th);
    });
    table.appendChild(headerRow);

    // Add table rows
    tableData.details.forEach((row, index) => {
        const tr = document.createElement('tr');

        ['Stufe', 'BereichID', 'ZieleStichwort', 'ZieleBeschreibung', 'Notizen'].forEach(key => {
            const td = document.createElement('td');
            const input = document.createElement('input');
            input.value = row[key];
            input.addEventListener('input', (e) => {
                row[key] = e.target.value;
            });
            td.appendChild(input);
            tr.appendChild(td);
        });

        const tdSelect = document.createElement('td');
        const div = document.createElement('div');
        div.textContent = row.newSelect0;
        div.style.cursor = 'pointer';
        setDivBackgroundColor(div, row.newSelect0);

        const select = document.createElement('select');
        select.classList.add('hidden');
        ['später', 'übt es jetzt', 'kann das Kind'].forEach(optionText => {
            const option = document.createElement('option');
            option.value = optionText;
            option.textContent = optionText;
            if (row.newSelect0 === optionText) {
                option.selected = true;
            }
            select.appendChild(option);
        });

        div.addEventListener('click', () => {
            div.classList.add('hidden');
            select.classList.remove('hidden');
        });

        select.addEventListener('change', () => {
            row.newSelect0 = select.value;
            div.textContent = select.value;
            setDivBackgroundColor(div, select.value);
            select.classList.add('hidden');
            div.classList.remove('hidden');
        });

        tdSelect.appendChild(div);
        tdSelect.appendChild(select);
        tr.appendChild(tdSelect);

        table.appendChild(tr);
    });
}

function setDivBackgroundColor(div, value) {
    switch (value) {
        case 'später':
            div.style.backgroundColor = '#d4edda'; // Hellgrün
            break;
        case 'übt es jetzt':
            div.style.backgroundColor = '#83e6cb'; // Mittelgrün
            break;
        case 'kann das Kind':
            div.style.backgroundColor = '#155724'; // Dunkelgrün
            div.style.color = '#ffffff'; // Weißer Text
            break;
        default:
            div.style.backgroundColor = ''; // Keine Hintergrundfarbe
            div.style.color = ''; // Standardtextfarbe
            break;
    }
}

function exportJSON() {
    const json = JSON.stringify(tableData, null, 2);
    const blob = new Blob([json], { type: 'application/json' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'exported_data.json';
    a.click();
    URL.revokeObjectURL(url);
}