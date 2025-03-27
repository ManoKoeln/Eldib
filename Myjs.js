

function WriteHeadData()
{
  vorname = document.getElementById("validationVorname").value;
  nachname = document.getElementById("validationName").value;
  klasse = document.getElementById("validationKlasse").value;
  lehrer = document.getElementById("validationLehrer").value;
  if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {

    }
  }
  xmlhttp.open("POST","ELDiBLehrer.php?WriteHeadData&vorname="+vorname+"&nachname="+nachname+"&klasse="+klasse+"&lehrer="+lehrer,false);
  xmlhttp.send();
}
function ELDiBLehrerOpen() {
  document.getElementById('fileInput').click();
}
// // in ELDiBLehrer.js
// function ShowELDiBLehrer_JSON(){
//   console.log("Start ShowELDiBLehrer_JSON");
//     document.getElementById("ELDiBLehrercontent_New").style.display = "block"; 
//     document.getElementById("AktualClient").style.display = "flex";
//     document.getElementById("MainNavigation").style.display = "none";
//     let MyVal = document.getElementById("SelectClient").value;
//     if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
//   xmlhttp.onreadystatechange=function()
//   {
//   if (xmlhttp.readyState==4 && xmlhttp.status==200)
//     {
//         document.getElementById("ELDiBLehrercontent_New").innerHTML=xmlhttp.responseText;
//     }
//   }

// xmlhttp.open("POST","ReadELDiBTable.php",false);
// xmlhttp.send();
// }

function handleFileSelect(event) {
  var file = event.target.files[0];
  if (file) {
      var reader = new FileReader();
      reader.onload = function(e) {
          var fileContent = e.target.result;
                      // JSON-Daten parsen
                      var jsonData = JSON.parse(fileContent);
          document.getElementById('fileContent').value = fileContent;
          // Hier können Sie den Inhalt der Datei weiterverarbeiten
          // console.log("Dateiinhalt:", fileContent);


        if (jsonData.Vorname && jsonData.Vorname.length > 0) {
            // console.log("Erstes Detail:", jsonData.Vorname);
            document.getElementById("validationVorname").value = jsonData.Vorname;
        }
        else{
          document.getElementById("validationVorname").value = "Vorname";
        }
        console.log("handleFileSelect -> Erstes Detail:", jsonData.Nachname);
        if (jsonData.Nachname && jsonData.Nachname.length > 0) {
          
          document.getElementById("validationName").value = jsonData.Nachname;
      }
      else{
        document.getElementById("validationName").value = "Name";
      }

      if (jsonData.Lehrer && jsonData.Lehrer.length > 0) {
        // console.log("Erstes Detail:", jsonData.Lehrer);
        document.getElementById("validationLehrer").value = jsonData.Lehrer;
    }
    else{
      document.getElementById("validationLehrer").value = "Lehrer";
    }

      if (jsonData.Klasse && jsonData.Klasse.length > 0) {
        // console.log("Erstes Detail:", jsonData.Klasse);
        document.getElementById("validationKlasse").value = jsonData.Klasse;
    }
    else{
      document.getElementById("validationKlasse").value = "Klasse";
    }


        // document.getElementById("validationName").value = jsonData.Nachname;
        // document.getElementById("validationKlasse").value = jsonData.Klasse;
        // document.getElementById("validationLehrer").value = jsonData.Lehrer;
          sendJSONToServer(fileContent,file.name);
      };
      reader.readAsText(file);
  }
}

function sendJSONToServer(jsonData, fileName) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "Start2.php", true);
  xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
          console.log("sendJSONToServer - fileName:", fileName);
          // document.getElementById("Startseite").innerHTML = xhr.responseText;
          // ReadHeadData();
          ShowELDiBLehrerNew(fileName,false);
      }
  };
  xhr.send(jsonData);
}

function setSessionVariable(variableName, value) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "set_session_variable.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
          console.log("Session variable set successfully");
      }
  };
  xhr.send("variableName=" + encodeURIComponent(variableName) + "&value=" + encodeURIComponent(value));
}
function autoResize(textarea) {
  textarea.style.height = 'auto';
  textarea.style.height = textarea.scrollHeight + 'px';
}

function Start()
{
  // let MyVal = document.getElementById("SelectClient").value;

  // alert("Start1");
  if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
  {
      document.getElementById("Startseite").innerHTML=xmlhttp.responseText;
  }
}

xmlhttp.open("POST","Functions.php?Start=True",false);
xmlhttp.send();
}

function StartHead()
{
  // let MyVal = document.getElementById("SelectClient").value;

  // alert("Start1");
  if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
  {
    //  alert("StartHead :"+xmlhttp.responseText);
      document.getElementById("Header").innerHTML=xmlhttp.responseText;
  }
}

xmlhttp.open("POST","headerMain.php?StartHead=True",false);
xmlhttp.send();
Start();
}

function ChangedSelection()
{
  alert("ChangedSelection");
    let MyVal = document.getElementById("SelectClient").value;
    //  alert("MyVal = "+ MyVal);
    if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
        document.getElementById("AktualClient").innerHTML=xmlhttp.responseText;
        SetRightSite();
    }
  }

xmlhttp.open("POST","Functions.php?SetClient="+MyVal,false);
xmlhttp.send();
}



// function ShowELDiBEltern(){
//     document.getElementById("ELDiBElterncontent").style.display = "block"; 
//     let MyVal = document.getElementById("SelectClient").value;
//     if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
//   xmlhttp.onreadystatechange=function()
//   {
//   if (xmlhttp.readyState==4 && xmlhttp.status==200)
//     {
//         document.getElementById("ELDiBElterncontent").innerHTML=xmlhttp.responseText;
//     }
//   }

// xmlhttp.open("POST","ELDiBEltern.php?SetELDiBEltern="+MyVal,false);
// xmlhttp.send();
// }


function Assessors(){
    document.getElementById("Assessors").style.display = "block"; 
}
function AssessorsClose(){
    document.getElementById("Assessors").style.display = "none"; 
}
function readText(element) {
  var language = document.getElementsByTagName('html')[0].getAttribute('lang');

 
  // alert("Sprache = "+ document.lang);
console.log("Sprache = "+ language);
 console.log(element.textContent);
 
//  console.log("goog-te-combo = "+ document.getElementsByClassName("goog-te-combo").value);
//  console.log("goog-te-combo ChangedSelection = "+ document.getElementsByClassName("goog-te-combo").ChangedSelection);

//  console.log("targetLanguage = "+ document.getElementById(":0.targetLanguage").ChangedSelection);
//  console.log("finishTargetLang = "+ document.getElementById(":1.finishTargetLang").ChangedSelection);

  // https://cloud.google.com/translate/docs/basic/detecting-language?hl=de

  
  // console.log(google.translate.innerHTML.lang);
  const text = element.textContent;
  const speech = new SpeechSynthesisUtterance(text);
  // var actlang = main(element.textContent);
//   if (window.XMLHttpRequest){ xmlhttp=new XMLHttpRequest(); } else { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
//   xmlhttp.onreadystatechange=function()
//   {
//   if (xmlhttp.readyState==4 && xmlhttp.status==200)
//     {

//         document.getElementById("ELDiBElterncontent").innerHTML=xmlhttp.responseText;
//         console.log("Sprache = " + xmlhttp.responseText);
        // speech.lang = xmlhttp.responseText//'ar'; // Hier können Sie die Sprache einstellen.
        speech.lang = language; // Hier können Sie die Sprache einstellen.
        speech.volume = 1; // Lautstärke einstellen (zwischen 0 und 1).
        speech.rate = 1; // Sprechgeschwindigkeit einstellen (zwischen 0.1 und 10).
        speech.pitch = 1; // Tonhöhe einstellen (zwischen 0 und 2).
        window.speechSynthesis.speak(speech);
//     }
//   }

// xmlhttp.open("POST","https://translation.googleapis.com/language/translate/v2/detect="+element.textContent,false);
// xmlhttp.send();
}



function readTextGoogle(element) {
  // const text = document.getElementById("google_translate_element").textContent;
  const text = element;
  const audioPlayer = document.getElementById("audioPlayer");
  const synthesisUrl = `https://texttospeech.googleapis.com/v1beta1/text:synthesize?key=YOUR_API_KEY`;
 
  fetch(synthesisUrl, {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify({
      input: { text: text },
      voice: { languageCode: "en-US", ssmlGender: "FEMALE" },
      audioConfig: { audioEncoding: "MP3" }
    })
  })
  .then(response => response.arrayBuffer())
  .then(buffer => {
    const blob = new Blob([buffer], { type: "audio/mp3" });
    const url = URL.createObjectURL(blob);
    audioPlayer.src = url;
    audioPlayer.play();
  });
}
// // Copyright 2023 Google LLC
// //
// // Licensed under the Apache License, Version 2.0 (the "License");
// // you may not use this file except in compliance with the License.
// // You may obtain a copy of the License at
// //
// //     https://www.apache.org/licenses/LICENSE-2.0
// //
// // Unless required by applicable law or agreed to in writing, software
// // distributed under the License is distributed on an "AS IS" BASIS,
// // WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// // See the License for the specific language governing permissions and
// // limitations under the License.
// //
// // ** This file is automatically generated by gapic-generator-typescript. **
// // ** https://github.com/googleapis/gapic-generator-typescript **
// // ** All changes to this file may be overwritten. **



// 'use strict';

// function main(parent) {
//   // [START translate_v3_generated_TranslationService_DetectLanguage_async]
//   /**
//    * This snippet has been automatically generated and should be regarded as a code template only.
//    * It will require modifications to work.
//    * It may require correct/in-range values for request initialization.
//    * TODO(developer): Uncomment these variables before running the sample.
//    */
//   /**
//    *  Required. Project or location to make a call. Must refer to a caller's
//    *  project.
//    *  Format: `projects/{project-number-or-id}/locations/{location-id}` or
//    *  `projects/{project-number-or-id}`.
//    *  For global calls, use `projects/{project-number-or-id}/locations/global` or
//    *  `projects/{project-number-or-id}`.
//    *  Only models within the same region (has same location-id) can be used.
//    *  Otherwise an INVALID_ARGUMENT (400) error is returned.
//    */
//   // const parent = 'abc123'
//   /**
//    *  Optional. The language detection model to be used.
//    *  Format:
//    *  `projects/{project-number-or-id}/locations/{location-id}/models/language-detection/{model-id}`
//    *  Only one language detection model is currently supported:
//    *  `projects/{project-number-or-id}/locations/{location-id}/models/language-detection/default`.
//    *  If not specified, the default model is used.
//    */
//   // const model = 'abc123'
//   /**
//    *  The content of the input stored as a string.
//    */
//   // const content = 'abc123'
//   /**
//    *  Optional. The format of the source text, for example, "text/html",
//    *  "text/plain". If left blank, the MIME type defaults to "text/html".
//    */
//   // const mimeType = 'abc123'
//   /**
//    *  Optional. The labels with user-defined metadata for the request.
//    *  Label keys and values can be no longer than 63 characters
//    *  (Unicode codepoints), can only contain lowercase letters, numeric
//    *  characters, underscores and dashes. International characters are allowed.
//    *  Label values are optional. Label keys must start with a letter.
//    *  See https://cloud.google.com/translate/docs/advanced/labels for more
//    *  information.
//    */
//   // const labels = 1234

//   // Imports the Translation library
//   const {TranslationServiceClient} = require('@google-cloud/translate').v3;

//   // Instantiates a client
//   const translationClient = new TranslationServiceClient();

//   async function callDetectLanguage() {
//     // Construct request
//     const request = {
//       parent,
//     };

//     // Run request
//     const response = await translationClient.detectLanguage(request);
//     console.log(response);
//   }

//   callDetectLanguage();
//   // [END translate_v3_generated_TranslationService_DetectLanguage_async]
// }

// process.on('unhandledRejection', err => {
//   console.error(err.message);
//   process.exitCode = 1;
// });
// main(...process.argv.slice(2));



