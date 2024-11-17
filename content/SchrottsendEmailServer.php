<?php
    use PHPMailer\PHPMailer\PHPMailer;

    if (isset($_POST['email'])) {
        // if (isset($_POST['name']) && ($_POST['email'])) {
        $name = $_POST['name'];
        $name = "NoReply";
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $body = $_POST['body'];

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";

        $mail = new PHPMailer();

        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = "smtp.ionos.de";
        $mail->SMTPAuth = true;
        $mail->Username = "m6624962-158304427"; //enter you email address
        $mail->Password = 'Mano%NoReply:1926.$eRt'; //enter you email password
        $mail->Port = 465;
        $mail->SMTPSecure = "ssl";

        //Email Settings
        $mail->isHTML(true);
        // $mail->setFrom($email, $name);
        // $mail->addAddress("NoReply@manosoftware.de"); //enter you email address

        $mail->setFrom("NoReply@manosoftware.de", $name);
        $mail->addAddress($email); //enter you email address
        $mail->Subject = ("$email ($subject)");
        $mail->Body = $body;

        if ($mail->send()) {
            $status = "success";
            $response = "Email is sent!";
        $Inhalt = $status . '  ' . $response . 'email wurde versendet';
        } else {
            $status = "failed";
            $response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
            $Inhalt = $status. '  '. $response. 'email wurde nicht versendet !!!';
        }
        echo $Inhalt;
        exit(json_encode(array("status" => $status, "response" => $response)));
        
    }
?>
