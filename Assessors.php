<script src="Myjs.js"></script>
<body>
    <div class="Assessors" id="Assessors">
        <form method="post" enctype="multipart/form-data" action="process-form.php">

            <!-- <input type="hidden" name="MAX_FILE_SIZE" value="1048576"> -->

            <!-- <label for="image">AWL Quelle</label>
            <input type="file" id="image" name="image"> -->

            <div class="FormContent">Namen  des Einschätzenden:<output type="text" name="AssessorsName" id="Name">Frau Müller</div><br>
            <div class="FormContent">Funktion des Einschätzenden:<output type="text" name="Vorname" id="AssessorsVorname">Sonderpädagogin</div><br>
            <!-- <div class="FormContent">Geburtstag:<output type="date" name="Birthday" id="Birthday"></div><br> -->

            <button type="button" onclick="AssessorsClose();">schliessen</button>

        </form>
    </div>
</body>
