
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script>
function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'de'
  }, 'google_translate_element');
}
</script>
<script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<header>
  <div class="row mb-2" >
    <div id="MainNavigation"  class="col-sm-2">
      <div class="dropdown ml-2 dropdown-menu-color-primary">
        <a class="btn dropdown-toggle btn-primary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Menü
        </a>

        <ul class="dropdown-menu">

            <li><a  class="dropdown-item" onclick="PostBoxSendOpen();">gesendet</a></li>
            <li><a  class="dropdown-item" onclick="PostBoxReceiveOpen();">empfangen</a></li>
            <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" onclick="UserChatFormulierungenOpen();">Formulierungen</a></li>
              <li><a class="dropdown-item" onclick="UserChatMassnahmenOpen();">Massnahmen</a></li>
              <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="https://youtu.be/vELTRqvb6Vo">Video</a></li>
            <li><a class="dropdown-item" onclick="Setup();">Einstellungen</a></li>

        <?php
        if ($_SESSION["userlevel"] == 1){
              echo '<li><a class="dropdown-item" onclick="NewUser();">Verwaltung</a></li>';
        }
              ?>
        </ul>
      </div>
    </div>

  <div class="col-sm-10">

    <div class="row rod-cols-2 row-cols-md-1">
      <div class="col-12 col-md-8">
        <div class="d-flex justify-content-between align-items-center">
        <h3 class="text-center sm-fs2">Entwicklungstherapie/ Entwicklungspädagogik</h3>
        <img src="img/ManoLogoTrans3.ico" alt="logo"></img>
        <div  id="google_translate_element"></div> 
        </div>

      </div>
    </div>



    <!-- </div> -->
    <!-- <div class="col-sm-2" id="google_translate_element"> -->

    <!-- </div> -->
  </div>
</header>
<!-- <body>





</body> -->