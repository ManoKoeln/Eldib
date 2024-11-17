<link href="CSS/header.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" media="screen and (max-aspect-ratio: 4/3)" href="CSS/headerSmal.css" />
<script>
function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'de'
  }, 'google_translate_element');
}
</script><script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<header >
  <div class="HeaderIndex" >

      
    <div class="HeaderIndex1">
    <h2>Entwicklungstherapie/ Entwicklungspädagogik</h2>
      <!-- <h2>Softwareentwicklung</h2> -->
      <img class="Logo" src="CSS/ManoLogoTrans3.ico" alt="logo"></img>
      <div id="google_translate_element"></div>
    </div>
  </div>
</header>
<body>
  <div id="MainNavigation">

    <!-- <nav id="navi">
      <ul>
        <li> -->
    <input type="checkbox" id="click">
    <label for="click">
      <div class="Rahmen">
        <div class="Linie eins"></div>
        <div class="Linie zwei"></div>
        <div class="Linie drei"></div>
      </div>
    </label>
  <nav class="navigation">
    <ul class="mainmenu">
    <li><button  class="MenuButton">Post >> </button>
        <ul class="submenu"> 
      <li><a  onclick="PostBoxSendOpen();">gesendet</a></li>
      <li><a  onclick="PostBoxReceiveOpen();">empfangen</a></li>
      </ul>
      </li>

      <!-- <li><a href="">Products</a> -->
      <li><button  class="MenuButton">Chats >> </button>
        <ul class="submenu">
        <li><a  onclick="UserChatFormulierungenOpen();">Formulierungen</a></li>
        <li><a  onclick="UserChatMassnahmenOpen();">Massnahmen</a></li>

        </ul>
      </li>
      <li><a href="https://youtu.be/vELTRqvb6Vo">Video</a></li>
      <li><a  onclick="Setup();">Einstellungen</a></li>

      <?php
if ($_SESSION["userlevel"] == 1){
      echo '<li><a  onclick="NewUser();">Verwaltung</a></li>';
}
      ?>
    </ul>
</nav>
        <!-- </li>
      </ul>
    </nav> -->
  </div>

  <!-- <div id="SetFontSize">
    <div id="FontSizeBigger" onclick="myFunction_Bigger();">B</div><div id="FontSizeSmaller" onclick="myFunction_Smaller();">b</div>
</div> -->


  <div class="welcome">
    <!-- <div > -->

    <?php
          require("content/db.php");
          //Schule eintragen
          $db_link = new mysqli($host_name, $user_name, $password, $database);
        
          $sql = "SELECT * FROM school WHERE id = ".$_SESSION["SelectionSchool"]." ";
          $db_erg = mysqli_query( $db_link, $sql );
          if ( ! $db_erg )
          {
            $Inhalt = 'ungültige Bereich Abfrage School: Error message: %s\n'. $db_link->error;
          }
            while ($zeile = mysqli_fetch_assoc( $db_erg))
          {
            echo '<div class="WelcomeSchool">'.$zeile['Name'].', '.$zeile['Straße'].', '.$zeile['Ort'].' - '.$zeile['PLZ'].'</div>';
          }

    echo '<div class="WelcomeName">Willkommen      '.$_SESSION["Vorname"].','.$_SESSION["Nachname"].'   </div>';
    ?> 
    <br>
    <a href="abmelden.php">abmelden</a>
    <!-- </div> -->
    </div>
    <!-- <div id="google_translate_element"></div> -->

  <!-- <div class="HeaderL2">
    <h1>Lehrerhilfe ETEP !</h1> 
   <img class="Logo" src="ManoLogoTrans3.ico" alt="logo"></img>
  </div> -->
  
  <!-- <div class="column2">
    <form class="HeaderL2a">
      <div class="ClipHead">Diesen Text kannst du mit den Tasten "Strg" + "c" in dein Formular einfügen</div>
      <img class="Pfeil" src="content/Pfeil.jpg" alt="Pfeil" >
      <div id="DivClipBoard"  >DivClipBoard</div>
    </form>
  </div> -->
</body>