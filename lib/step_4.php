<?php
/**
 * Job:
 * * Display existing App-ID
 * 
 * Validations:
 * * validate country, 
 * * validate id 
 * * validate security answer
 *
 * @return void
 */
function output() {
    global $lang;

    $country = getFromHash($_SESSION, "country");
    if (GetCountryNameFromIOC($country) == "" || $country == "") {
        insertError(lg('invalidCountry'), "?s=".STEP_START, 5, true);
        return;
    }
    
    $id = getFromHash($_SESSION, "id");
    if ($id == "" || $_SESSION["idValid"] != true) {
        DoLog(LOG_TYPE_SUSPICIOUS, 
              "Invalid session (step 4) from IP " . getCallerIP());
        insertError(lg('invalidSession'), "?s=".STEP_START, 15);
        return;
    }

    if (checkToFast(2)) {
        insertError(lg('youWereToFast'), "?s=".STEP_START, -1, true);
        return;
    }
    if (PIDIsLocked($id)) {
        insertError(lg('pidIsLocked'), "?s=".STEP_START, -1, true);
        return;
    }

    $answer = getFromHash($_POST, "txtAnswer");

    $sql = "SELECT APPID, SECURITYANSWER FROM data WHERE PID=?";
    $ret = GetOneSQLValue($sql, array($id));
    if ($ret == 0) {
        // error!
        insertError(lg('genericError'));
        return;
    }
    if (!compareAnswer($answer, $ret["SECURITYANSWER"])) {
        HandleFailedRequest($id); // remember failed attempts!
        DoLog(LOG_TYPE_FAIL, "User $id failed with his security answer");
        insertError(lg('invalidAnswer'), "?s=".STEP_ASK_SECURITY, 15, true);
        return;
    }

    DoLog(LOG_TYPE_REQUEST, "User $id successfully requested his APP-ID");

    $newAppId = $ret["APPID"];
    
    ?>
    
    <div class="grid-50">
        <!-- left -->
        <?php
            lgp('yourExistingAppId', "<APPID>", $newAppId);
        ?>
    </div>
    <div class="grid-50">
        <!-- right -->
        <div class="helpText"><?php lgp('idFinalHelp'); ?>
        </div>
    </div>
    <div class="grid-100">
        <?php
        echo "<button type=\"button\" onclick=\"window.location='?s=".STEP_START."';\">";
        echo lg('restart');
        echo "</button>\n";
        ?>
    </div>
<?php } ?>