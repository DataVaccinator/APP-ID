<?php
/**
 * FAQ page
 *
 * @return void
 */
function Output() {
    lgp('faqHeader');
    lgp('faqContent');

    echo "<button type=\"button\" onclick=\"window.location='?s=".STEP_START."';\">";
    echo lg('back');
    echo "</button>\n";
}
?>