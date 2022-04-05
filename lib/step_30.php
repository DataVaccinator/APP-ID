<?php
/**
 * Output support contact
 *
 * @return void
 */
function Output() {
    lgp('contactHeader');
    lgp('contactContent');

    echo "<button type=\"button\" onclick=\"window.location='?s=".STEP_START."';\">";
    echo lg('back');
    echo "</button>\n";
}
?>