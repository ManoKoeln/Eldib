<link href="CSS/changePW.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" media="screen and (max-aspect-ratio: 4/3)" href="CSS/changePWSmal.css" />
  <!-- <script src="content/changePW.js"></script> -->

  <div id="changePW">
  </div>


<?php

$return_message = "";

if ( isset($_GET['changePW'])){

    $Inhalt = '<h1>Passwort ändern !!!</h1>';
    $Inhalt = $Inhalt.'<form class="FormchangePW" method="POST" action="../ELDiB/content/changePWFunction.php" >'; //
    $Inhalt = $Inhalt.'<input type="password" name="pw" placeholder="Passwort" required><br>';
    $Inhalt = $Inhalt.'<input type="password" name="pw2" placeholder="Passwort wiederholen" required><br>';
    $Inhalt = $Inhalt.'<button class="button-send" name="change_password">Passwort Ändern</button>';
    // $Inhalt = $Inhalt.'<input type="submit" name="submit" value="Go"></input>';
    // $Inhalt = $Inhalt.'<button class="button" name="change_password">Passwort Ändern</button>';
    $Inhalt = $Inhalt.'<br><br>'.$return_message;
    $Inhalt = $Inhalt.'</form>';
    $Inhalt = $Inhalt.'<br>';
    $Inhalt = $Inhalt.'<button class="changePWButtonClose" onclick="NoDisplayChangePW();">schliessen</button>';
    echo $Inhalt;
}
    ?>