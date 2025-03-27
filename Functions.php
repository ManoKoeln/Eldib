    <script src="Myjs.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
    <!-- <link href="CSS/header.css" rel="stylesheet" type="text/css"> -->
<!-- <link rel="stylesheet" media="screen and (max-aspect-ratio: 4/3)" href="CSS/headerSmal.css" /> -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="Myjs.js"></script>
    <script src="Operator.js"></script>
    <script src="ELDiBEltern.js"></script>
    <script src="JScript/ELDiBLehrer_New.js"></script>
    <script src="ELDiBKind.js"></script>
    <script src="ELDiBLehrer.js"></script>
    <script src="SupportPlan.js"></script>
    <script src="EmailKind.js"></script>
    <script src="EmailEltern.js"></script>

    <?php
      //   require "content/db.php";
      //   include "content/helpers.php";
      //   include "NewClient.php";
      //   include "NewUser.php";
      //   include "ELDiBEltern.php";
      //   include "ELDiBLehrer.php";
      //   include "ELDiBLehrer_New.php";
      //  include "ELDiBKind.php";
       
if (session_status() == PHP_SESSION_NONE) {
  session_start(); // Starten der Session nur, wenn keine Session aktiv ist
}
if ( isset($_GET['Start']) ){
$Inhalt = '';
    $Inhalt.= '<div  >' ; //class="absolute -relativ top-20 start-0"
  $Inhalt.='<div  id="rightSite" >  <!-- class="rightSite" -->';
  $Inhalt.= '<hr class="featurette-divider">';
  $Inhalt.= '<table class="table table-sm table-borderless">';
    $Inhalt.= '<tr>';
    $Inhalt.= '<td><button typ="button" class="btn-primary "  style="display: none;" onclick="ShowELDiBLehrerNew(\'JSON/VorlageEltern.json\',true);">ELDiB Lehrer</button></td>';    
    $Inhalt.= '</tr>';
    $Inhalt.= '<tr>';
    $Inhalt.= '<td>
    <button typ="button" class="btn-primary "  style="display: none;" onclick="ELDiBLehrerNew();">ELDiB Lehrerneu </button>
    <button typ="button" class="btn-primary "  style="display: none;" onclick="ELDiBLehrerFirstTemplate();" >ELDiB Lehrer erste Vorlage Stufendaten aus Datenbank</button> 
    <button typ="button" class="btn-primary "  style="display: none;" onclick="ELDiBLehrerOpen();">ELDiB Lehrer öffnen</button>
    <button typ="button" class="btn-primary "  onclick="ShowELDiBLehrer_JSON();">ELDiB Lehrer Bewertungsbogen</button>
    </td>';    //style="display:none;"
    $Inhalt.= '</tr>';
    $Inhalt.= '<tr>';
      $Inhalt.= '<td><button typ="button" class="btn-primary "  style="display: none;" onclick="ShowELDiBKind();">ELDiB Kind</button></td>';
    $Inhalt.= '</tr>';
    $Inhalt.= '<tr>';
      $Inhalt.= '<td><button typ="button" class="btn-primary "  style="display: none;" onclick="ShowELDiBEltern();">ELDiB Eltern</button></td>';
    $Inhalt.= '</tr>';
    $Inhalt.= '<tr>';
    $Inhalt.= '<td><button typ="button" class="btn-primary "  style="display: none;" onclick="ShowSupportPlan();">Förderplan</button></td>';
    $Inhalt.= '</tr>';
  $Inhalt.= '</table>';
  $Inhalt.= '</div>';

  $Inhalt.= '</div>';

  $Inhalt.='</div>';
  echo $Inhalt;
}
?>