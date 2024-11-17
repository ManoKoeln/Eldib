<script src="EmailEltern.js"></script>
<link href="CSS/EmailEltern.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" media="screen and (max-aspect-ratio: 4/3)" href="CSS/EmailElternSmal.css" />
<div id="EmailElterncontent">
    <div class="EmailElterncontentInside">
        <h3>hier bitte den Begleittext für die email eigeben</h3>
        <form class="EmailElternForm">
            <textarea class="EmailElternTextArea" value="hier bitte den Begleittext für die email eigeben"></textarea>
            <div class="EmailElternRestText">mit dieser email erhalten Sie einen Benutzernamen und ein Passwort mit dem Sie sich einloggen können</div>
            <button onclick="SendEmailEltern();" class="EmailElternButtonSend">abschicken</button><br>
            <button onclick="HideEmailEltern();" class="EmailElternButtonClose">schliessen</button>
        </form>
    </div>
</div>