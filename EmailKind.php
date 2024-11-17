<script src="EmailKind.js"></script>
<link href="CSS/EmailKind.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" media="screen and (max-aspect-ratio: 4/3)" href="CSS/EmailKindSmal.css" />
<div id="EmailKindcontent">
    <div class="EmailKindcontentInside">
        <h3>hier bitte den Begleittext für die email eigeben</h3>
        <form class="EmailKindForm">
            <textarea class="EmailKindTextArea" value="hier bitte den Begleittext für die email eigeben"></textarea>
            <div class="EmailKindRestText">mit dieser email erhältst du auch einen Benutzernamen und das
                 Passwort mit dem du dich einloggen kannst</div>
            <button onclick="SendEmailKind();" class="EmailKindButtonSend">abschicken</button><br>
            <button onclick="HideEmailKind();" class="EmailKindButtonClose">schliessen</button>
        </form>
    </div>
</div>