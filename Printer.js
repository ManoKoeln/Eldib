function PrintLehrerHTML() {
    // Print Lehrer HTML
    var printContent = document.getElementById('ELDiBLehrercontainer').innerHTML;
    var WinPrint = window.open('', '', 'width=900,height=650');
    WinPrint.document.write(printContent);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();

};
function PrintLehrer(ArrayCount) {
    // Print Lehrer
    console.log("PrintLehrer" + ArrayCount);
    var Vorname = document.getElementById("validationVorname").value;
    var Nachname = document.getElementById("validationName").value;
    var Klasse = document.getElementById("validationKlasse").value;
    var Lehrer = document.getElementById("validationLehrer").value;
    var Column1 = [];
    var Column2 = [];
    var Column3 = [];
    var Notizen = [];
    var Column2Empty = false;
    console.log("PrintLehrer : ArrayCount= " + ArrayCount);
    for (i = 0; i <= ArrayCount ; i++) {
        console.log("PrintLehrer : i= " + i);
        Column2Empty = false;
        if( document.getElementById("ZieleStichwort_" + i)){
            if( document.getElementById("ZieleNummer_" + i)){
                Column1.push(document.getElementById("ZieleNummer_" + i).innerText +" "+ document.getElementById("ZieleStichwort_" + i).innerText);       
            }
            else {
                Column1.push(document.getElementById("ZieleStichwort_" + i).innerText); // or handle the missing element case as needed
            }
        } 
        if( document.getElementById("ZieleBeschreibung_" + i)){
            Column2Empty = false;
            Column2.push(document.getElementById("ZieleBeschreibung_" + i).innerText);
        }
        else {
            Column2.push(""); // or handle the missing element case as needed
            Column2Empty = true;
        }

        if( document.getElementById("output_" + i)){
        Column3.push(document.getElementById("output_" + i).innerText);
        } 
        else {
            if (Column2Empty){
                Column3.push(""); // or handle the missing element case as needed
            }
            else {
                Column3.push("später"); // or handle the missing element case as needed
            }
        }
        if( document.getElementById("Notizen_" + (i))){
            console.log("PrintLehrer : " + document.getElementById("Notizen_" + (i)).value);
            Notizen.push(document.getElementById("Notizen_" + (i)).value);
            } 
            else
            {
                Notizen.push(""); // or handle the missing element case as needed
            }
    }

    var data = {
        Vorname: Vorname,
        Nachname: Nachname,
        Klasse: Klasse,
        Lehrer: Lehrer,
        Column1: Column1,
        Column2: Column2,
        Column3: Column3,
        Notizen: Notizen
    };

    var jsonData = JSON.stringify(data);

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "Printer.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    // xmlhttp.onreadystatechange = function() {
    //     if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
    //         document.getElementById("Startseite").innerHTML = xmlhttp.responseText;
    //     }
    // };
    xmlhttp.send(jsonData);
}

function copyDivTextToInput(divId) {
    var divText = document.getElementById(divId).innerText;
    return divText;
}

function submitForm() {
    var divText = copyDivTextToInput('myDiv');
    document.getElementById('divTextInput').value = divText;
}

function getSelectedOption(ArrayCounter) {
    var selectElement = document.getElementById("Selected_" + ArrayCounter);
    console.log(selectElement);
    var selectedValue = selectElement.value;
    document.getElementById("output_" + ArrayCounter).innerText = selectedValue;
}