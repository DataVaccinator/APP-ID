<?php
/**
 * PRIVACY page
 *
 * @return void
 */
function Output() {
    lgp('privacyHeader');
    lgp('privacyContent');

    echo "<button type=\"button\" onclick=\"window.location='?s=".STEP_START."';\">";
    echo lg('back');
    echo "</button>\n";
}
?>