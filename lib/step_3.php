<?php
/**
 * Job:
 * * Display new AppID
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
              "Invalid session (step 3) from IP " . getCallerIP());
        insertError(lg('invalidSession'), "?s=".STEP_START, 15);
        return;
    }

    $questionId = intval(getFromHash($_POST, "lstQuestion"));
    $_SESSION["questionId"] = $questionId;
    $l = GetLanguage();
    $question = $lang['secQuestion'][$l][$questionId];
    $answer = getFromHash($_POST, "txtAnswer");

    if (strlen($answer) < 2 || strlen($answer) > 100) {
        insertError(lg('invalidSecAnswer'), "?s=".STEP_ASK_SECURITY, 5, true);
        return;
    }

    if (checkToFast(2)) {
        insertError(lg('youWereToFast'), "?s=".STEP_START, -1, true);
        return;
    }

    $oldAppId = getFromHash($_SESSION, "appId");
    if ($oldAppId != "") {
        $newAppId = $oldAppId; // display the same again!
    } else {
        $newAppId = generateAppId(); // generate new one!
        $sql = "INSERT INTO data SET PID=?, APPID=?, COUNTRY=?, SECURITYQUESTION=?, 
                                     SECURITYANSWER=?, CREATIONDATE=NOW()";
        $ret = ExecuteSQL($sql, array($id, $newAppId, $country, $question, $answer));
        if (!$ret) {
            // error!
            insertError(lg('genericError'));
            return;
        }
        $_SESSION["appId"] = $newAppId;
        DoLog(LOG_TYPE_ADD, "User $id successfully created an APP-ID");
    }
    ?>
    
    <div class="grid-50">
        <!-- left -->
        <?php
            lgp('yourAppId', "<APPID>", $newAppId);
        ?>
    </div>
    <div class="grid-50">
        <!-- right -->
        <div class="helpText"><?php lgp('idFinalHelp'); ?>
        </div>
    </div>
<?php } 

// Doing some maintenance here and check if MySQL 
// event scheduler is running. 
// You may ask, WHY THE HECK HERE?
// Because this location is called often enough to warn early and
// not often enough to remarkable slow down the system.
$sql = "SELECT @@global.event_scheduler = 'on' AS t;";
$ret = GetOneSQLValue($sql);
if (intval($ret["t"]) != 1) {
    error_log("WARNING: MySQL event scheduler not running! Add event_scheduler = ON to your my.conf.");
}
?>