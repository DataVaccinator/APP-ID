<?php
/**
 * Job:
 * Initial question about the citizens country
 *
 * @return void
 */
function output() { 
    $_SESSION["appId"] = ""; // init
    $_SESSION["country"] = ""; // init
    $_SESSION["id"] = ""; // init
    $_SESSION["idValid"] = false; // init
    $_SESSION["questionId"] = 0; // init

    $rnd = generatePassword(12);
    $_SESSION["rnd"] = $rnd;
    ?>

    <form class="grid-100" action="?s=<?php echo STEP_ASK_ID;?>" method="post">
        <?php
        lgp('request');
        InsertCountries("lstCountry", "", "");
        ?>
        <div class="botDetect">
            If you can read this, please urgently update your old webbrowser!
            <!-- fields for bot detection: -->
            <input type="text" name="firstName" value="" />
            <input type="text" name="lastName" value="" />
        </div>
        <input type="submit" class="main-button" value="<?php lgp('next'); ?>" />
    </form>
    <script>
        document.getElementsByName('lstCountry')[0].focus();
        // bot detection:
        document.getElementsByName('lastName')[0].value="<?php echo $rnd; ?>";
    </script>

<?php } ?>