<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Account erstellen</title>
  </head>
  <body>
    <?php
    if(isset($_POST["submit"])){
      require("db.php");
      $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user"); //Username überprüfen
      $stmt->bindParam(":user", $_POST["username"]);
      $stmt->execute();
      $count = $stmt->rowCount();
      if ($count == 0) {
        $stmt1 = $mysql->prepare("SELECT * FROM accounts WHERE EMAIL = :email"); //email überprüfen
        $stmt1->bindParam(":email", $_POST[ "email1"]);
        $stmt1->execute();
        $count = $stmt1->rowCount();
        if ($count == 0) {
          //Username ist content
          if ($_POST["pw"] == $_POST["pw2"]) {
            //User anlegen
            $stmt = $mysql->prepare("INSERT INTO accounts (USERNAME, PASSWORD, Vorname, Nachname, EMAIL) VALUES (:user, :pw, :Vorname, :Nachname , :email )");
            $stmt->bindParam(":user", $_POST["username"]);
            $stmt->bindParam(":Vorname", $_POST["Vorname"]);
            $stmt->bindParam(":Nachname", $_POST["Nachname"]);
            $stmt->bindParam(":email", $_POST[ "email1"]);
            $hash = password_hash($_POST["pw"], PASSWORD_BCRYPT);
            $stmt->bindParam(":pw", $hash);
            $stmt->execute();
            echo "Dein Account wurde angelegt";
          } else {
            echo "Die Passwörter stimmen nicht überein";
          }
        }
        else{
          echo "Der Email ist bereits vergeben";
        }
      } else {
        echo "Der Username ist bereits vergeben";
      }
    }
     ?>
    <h1>Account erstellen</h1>
    <form action="register.php" method="post">
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="text" name="Vorname" placeholder="Vorname" required><br>
      <input type="text" name="Nachname" placeholder="Nachname" required><br>
      <input type= "email" name= "email1" placeholder="email" required><br>
      <input type="password" name="pw" placeholder="Passwort" required [autocomplete](https://html.spec.whatwg.org/multipage/forms.html#autofilling-form-controls:-the-autocomplete-attribute)password><br>
      <input type="password" name="pw2" placeholder="Passwort wiederholen" required [autocomplete](https://html.spec.whatwg.org/multipage/forms.html#autofilling-form-controls:-the-autocomplete-attribute)password><br>
      <button type="submit" name="submit">Erstellen</button>
    </form>
    <br>
    <a href="../index.php">Hast du bereits einen Account?</a>
  </body>
</html>
