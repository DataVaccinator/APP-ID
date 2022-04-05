<?php
/**
 * Job:
 * * New ID: Ask for a security question and respective answer
 * * Existing ID: Ask security question and answer
 * 
 * Validation:
 * * validate country
 * * validate session
 * * validate person ID
 *
 * @return void
 */
function output() {
    global $lang, $validation;

    $country = getFromHash($_SESSION, "country");
    if (getFromHash($validation, $country) == "") {
        insertError(lg('invalidSession'), "?s=".STEP_START, 15);
        return;
    }
    $id = trim(getFromHash($_POST, "txtPersonID", ""));
    if ($id == "" && $_SESSION["idValid"] == true) {
        $id = $_SESSION["id"];
    }
    $_SESSION["id"] = $id;
    $_SESSION["idValid"] = false; // init, validate each time!
    $matches = array();
    preg_match_all($validation[$country], $id, $matches, PREG_SET_ORDER, 0);
    if (count($matches) != 1) {
        insertError(lg('invalidId'), "?s=".STEP_ASK_ID, 5, true);
        return;
    }
    if (checkToFast(1)) {
        insertError(lg('youWereToFast'), "?s=".STEP_START, -1, true);
        return;
    }
    if (PIDIsLocked($id)) {
        insertError(lg('pidIsLocked'), "?s=".STEP_START, -1, true);
        return;
    }
    $_SESSION["idValid"] = true;

    // check if ID already exists
    $sql = "SELECT * FROM data WHERE PID=?";
    $ret = GetOneSQLValue($sql, array($id));
    if ($ret === false) {
        // error!
        insertError(lg('genericError'));
        return;
    }
    if ($ret === 0) {
        // not found
        _newAppId();
        return;
    }
    _askAppId($ret);

    ?>
    
    <div class="grid-parent">
        
    </div>

<?php } 

function _newAppId() {
    global $lang;
    $l = GetLanguage();
    ?>
    <form class="grid-100" action="?s=<?php echo STEP_DISPLAY_NEW; ?>" method="post">
        <?php lgp('introNewIdentity'); ?>
        <div class="grid-50 grid-parent">
            <!-- left -->
            <select name="lstQuestion" style="">
            <?php
            $qid = getFromHash($_SESSION, "questionId", 0);
            foreach ($lang['secQuestion'][$l] as $id => $question) {
                if ($id == $qid) {
                    echo "  <option selected value=\"$id\">$question</option>\n";
                } else {
                    echo "  <option value=\"$id\">$question</option>\n";
                }
            } ?>
            </select>
            <?php lgp('secAnswer'); ?>
            <input type="text" name="txtAnswer" value="" autocomplete="off" />
        </div>
        <div class="grid-50 grid-parent">
            <!-- right -->
            <div class="helpText"><?php lgp('secAnswerHint'); ?></div>
        </div>
        <div class="grid-100">
            <?php
            echo "<button type=\"button\" onclick=\"window.location='?s=".STEP_ASK_ID."';\">";
            echo lg('back');
            echo "</button>\n";
            ?>
            <input type="submit" class="main-button" value="<?php lgp('next'); ?>" />
        </div>
    </form>
    <script>
        document.getElementsByName('lstQuestion')[0].focus();
    </script>
    <?php
}

function _askAppId($ret) {
    global $lang;
    ?>
    <form class="grid-100" action="?s=<?php echo STEP_DISPLAY_EXISTING; ?>" method="post">
        <?php lgp('introExistingIdentity'); ?>
        <div class="grid-50 grid-parent">
            <!-- left -->
            <?php 
            echo "<p class=\"question\">".so($ret["SECURITYQUESTION"])."</p>";
            ?>
            <input type="text" name="txtAnswer" value="" placeholder="<?php lgp('answerDefault'); ?>" autocomplete="off" />
        </div>
        <div class="grid-50 grid-parent">
            <!-- right -->
            <div class="helpText"><?php lgp('secAnswerHintSimple'); ?></div>
        </div>
        <div class="grid-100 grid-parent">
            <?php
            echo "<button type=\"button\" onclick=\"window.location='?s=".STEP_ASK_ID."';\">";
            echo lg('back');
            echo "</button>\n";
            ?>
            <input type="submit" class="main-button" value="<?php lgp('next'); ?>" />
        </div>
    </form>
    <script>
        document.getElementsByName('txtAnswer')[0].focus();
    </script>
    <?php

}

?>