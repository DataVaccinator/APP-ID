<?php
/**
 * ABOUT page
 *
 * @return void
 */
function Output() {
    lgp('aboutHeader');
    lgp('aboutContent');

    echo "<button type=\"button\" onclick=\"window.location='?s=".STEP_START."';\">";
    echo lg('back');
    echo "</button>\n";
}
?>