<?php
/**
 * Job:
 * * Ask for the AppId
 * 
 * Validations:
 * * validate country information)
 *
 * @return void
 */
function output() {
    global $lang;
    
    $country = getFromHash($_POST, "lstCountry");
    if ($country == "") { $country = getFromHash($_SESSION, "country"); }

    $botTest = getFromHash($_POST, "firstName", "");
    if ($botTest != "") {
        DoLog(LOG_TYPE_SUSPICIOUS, "firstName was filled with [$botTest]");
        insertError(lg('youWereToFast'), "?s=".STEP_START, -1, true);
        return;
    }
    $rnd = getFromHash($_SESSION, "rnd");
    $botTest2 = getFromHash($_POST, "lastName", $rnd); // default in case of coming back
    if ($rnd != $botTest2) {
        DoLog(LOG_TYPE_SUSPICIOUS, "lastName was filled with wrong session val (JS)");
        insertError(lg('invalidSession'), "?s=".STEP_START, -1, true);
        return;
    }

    $country = str_replace(array("+", "-", "_"), "", $country);
    if (GetCountryNameFromIOC($country) == "" || $country == "") {
        insertError(lg('invalidCountry'), "?s=".STEP_START, 5, true);
        return;
    }
    if (strpos(" ".SUPPORTED_COUNTRIES." ", " ".$country." ") === false) {
        // not supported country
        DoLog(LOG_TYPE_FAIL, "Someone wanted to get APP-ID for country $country");
        insertError(lg('countryNotSupported'), "?s=".STEP_START, 20, true);
        return;
    }

    if (checkToFast(0)) {
        insertError(lg('youWereToFast'), "?s=".STEP_START, -1, true);
        return;
    }

    $_SESSION["country"] = $country;

    $l = GetLanguage();
    $caption = $lang['idQuestion'][$l][$country];
    $id = getFromHash($_SESSION, "id"); // from previous try
    ?>
    
    <div class="grid-50">
        <!-- left -->
        <form action="?s=<?php echo STEP_ASK_SECURITY; ?>" method="post">
            <?php echo $caption; ?>

            <input type="text" name="txtPersonID" value="<?php echo $id; ?>" autocomplete="off" />
            <br/>
            <?php
            echo "<button type=\"button\" onclick=\"window.location='?s=".STEP_START."';\">";
            echo lg('back');
            echo "</button>\n";
            ?>
            <input type="submit" class="main-button" value="<?php lgp('next'); ?>" />
        </form>
    </div>
    <div class="grid-50">
        <!-- right -->
        <div class="helpText"><?php echo $lang['idHelp'][$l][$country]; ?>
        </div>
        <img class="helpImage" src="style/help_<?php echo $country; ?>.png">
    </div>
    <script>
        document.getElementsByName('txtPersonID')[0].focus();
    </script>
    
<?php } ?>