<?php
/**
 * IMPRINT page
 *
 * @return void
 */
function Output() {
    lgp('imprintHeader');
    lgp('imprintContent');

    echo "<button type=\"button\" onclick=\"window.location='?s=".STEP_START."';\">";
    echo lg('back');
    echo "</button>\n";
}
?>