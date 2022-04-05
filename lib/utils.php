<?php

// global constants

define('LOG_TYPE_ADD', 0);
define('LOG_TYPE_REQUEST', 1);
define('LOG_TYPE_FAIL', 2);
define('LOG_TYPE_SUSPICIOUS', 3);
define('LOG_TYPE_ERROR', 9);

/**
 * Creates a log entry
 *
 * @param integer $logType LOG_TYPE_x
 * @param integer $provId
 * @param string $message
 * @return void
 */
function DoLog(int $logType, string $message) {
    $sql = "INSERT INTO log 
              SET logtype=?, logdate=NOW(), logcomment=?";
    ExecuteSQL($sql, array($logType, $message));
}

/**
 * Generates PID suitable for this alias system.
 * Actually, it is a 128 bit random number in z32 encoding.
 */
function GeneratePID() {
    // Hint: 16Byte = 128 bit

    // try to get unique PID max 3 times
    for ($i = 1; $i <= 3; $i++) {
        $pid = cryptoc_hex_to_zb32(cryptoc_get_random_hex(16));
        $sql = "SELECT PID FROM data WHERE PID=?";
        $ret = GetOneSQLValue($sql, array($pid));
        if ($ret === 0) {
            return $pid;
        }
    }
    // Always collisions or SQL errors?
    return false;
}

/**
 * Insert some error message.
 * If $forwardUrl is given with some $forwardDelaySec, it will
 * forward to this location after time is due.
 * If $forwardUrl is given with $backButton = true, it will
 * insert a "back" button which points to $forwardUrl.
 * Both options can get combined.
 *
 * @param string $message
 * @param string $forwardUrl
 * @param integer $forwardDelaySec
 * @param boolean $backButton
 * @return void
 */
function insertError(string $message, $forwardUrl="", $forwardDelaySec = -1, $backButton = false) {
    echo "<div class=\"errorMessage\">".$message;
    echo "</div>\n";
    if ($backButton == true && $forwardUrl != "") {
        echo "<button type=\"button\" onclick=\"window.location='".$forwardUrl."';\">";
        echo lg('back');
        echo "</button>\n";
    }
    if ($forwardDelaySec > -1) {
        InsertRedirect($forwardUrl, $forwardDelaySec);
    }
}

/**
 * Generate an App-ID compliant to APP-ID service.
 * 
 * Currently: 10 random digits + last byte of SHA256 in hex.
 * Please refer APP-ID and ALIAS service documentation for details.
 *
 * @return string $app-id
 */
function generateAppId() {
    $id = generatePassword(10, array("special_chars" => true));
    $hash = substr(hash("sha256", $id), -2);
    return $id . $hash;
}

/**
 * Compares two security answers agains similarity.
 * Returns true if considered similar.
 *
 * @param string $answer1
 * @param string $answer2
 * @return boolean $identical
 */
function compareAnswer(string $answer1, string $answer2) {
    // trim and lowercase
    $answer1 = trim(strtolower($answer1));
    $answer2 = trim(strtolower($answer2));
    // remove any spaces
    $irrelevant = array(" ",".",",","?","!","'","'","`");
    $answer1 = str_replace($irrelevant, "", $answer1);
    $answer2 = str_replace($irrelevant, "", $answer2);
    return $answer1 == $answer2;
}

/**
 * Check if the time that was needed for filling the given
 * pervious step ID was to fast. In this case, it returns
 * TRUE, otherwise FALSE.
 *
 * @param integer $previousStep
 * @return boolean $wasToFast
 */
function checkToFast(int $previousStep) {
    $previousTime = getFromHash($_SESSION, "lastTime{$previousStep}", 0);
    $needed = time() - $previousTime;
    $minimumTimes = array(0 => 2, // selecting country
                          1 => 2, // entering ID information
                          2 => 2  // enter/answer security question
                         );
    
    if ($needed < $minimumTimes[$previousStep]) {
        // that was to fast!
        DoLog(LOG_TYPE_SUSPICIOUS, 
              "Page $previousStep was filled to fast ($needed sec)");
        return true;
    };
    return false;
}

/**
 * Returns the IP address of the current caller
 *
 * @return string $ip
 */
function getCallerIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

/**
 * Handle failed user logins where the affected userid is known.
 * This is to stop users from login after more than 10 wrong logins
 * in the last 10 minutes.
 * 
 * Call CheckFailedLogins($UserID) to check if the user is allowed
 * to login any more.
 * 
 * @param mixed $UserID
 */
function HandleFailedRequest($pid) {
    if ($pid == "" || LOCK_AFTER_FAILED_ATTEMPTS == 0) {
        return;
    }
    $SQL = "INSERT INTO fail SET PID=?, LOGINDATE=NOW()";
    ExecuteSQL($SQL, array($pid));
    return;
}

/**
 * Check if a given UserID is locked. If this function returns TRUE, please
 * do not allow the user to login (even if password is correct!)
 * 
 * @param mixed $UserID
 * @return bool User is locked (do not allow login!)
 */
function PIDIsLocked($pid) {
    if ($pid == "" || LOCK_AFTER_FAILED_ATTEMPTS == 0) {
        return;
    }
    $SQL = "SELECT COUNT(*) AS CNT FROM fail WHERE PID=?";
    $Ret = GetOneSQLValue($SQL, array($pid));
    $Count = intval(getFromHash($Ret, "CNT", 0));
    if ($Count >= LOCK_AFTER_FAILED_ATTEMPTS) {
        if ($Count == LOCK_AFTER_FAILED_ATTEMPTS) {
            HandleFailedRequest($pid); // inc to prevent to much further log entries
            DoLog(LOG_TYPE_SUSPICIOUS, "Locked PID $pid from IP ".GetCallerIP().
                      " because of to much failed answering attempts");
        }
        return true;
    }
    return false;
}

/**
* Output the HTML code for the language
* switching flags.
* 
*/
function InsertLanguageFlags() {
    global $lang;
    $url = GetFullURLComplete();
    echo "\n<div class=\"flags\">";
    foreach ($lang['language'] as $ln=>$name) {
        if (strpos($url, "lg=")) {
            $dUrl = preg_replace("/lg=\S{2,3}/", "lg=$ln", $url, -1);
        } else {
            if (strpos($url, "?")) {
              $dUrl = "$url&lg=$ln";
            } else {
              $dUrl = "$url?lg=$ln";
            }
        }
        $img = "style/$ln.png";
        echo "\n<img src=\"$img\" border=\"0\" title=\"$name\" ".
             "onclick=\"event.stopPropagation(); window.location='$dUrl';\">";
    }
    echo "\n</div>\n";
}

/**
* Returns the complete URL that has been called to open this page!
* If $PathOnly = TRUE, it returns only the path with no page and
* parameters (like "https://portal.regify.com")
*
* @param mixed $PathOnly
* @return string
*/
function GetFullURLComplete($PathOnly = false) {
    $port = "";
    if(isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"]=="on") {
        $FullURL = "https://";
        if($_SERVER["SERVER_PORT"] != "443") {
            $port = ":" . $_SERVER["SERVER_PORT"];
        }
    } else {
        $FullURL = "http://";
        if($_SERVER["SERVER_PORT"] != "80") {
            $port = ":" . $_SERVER["SERVER_PORT"];
        }
    }
    if(isset($_SERVER["REQUEST_URI"])) {
        $script_name = $_SERVER["REQUEST_URI"];
    } else {
        $script_name = $_SERVER["PHP_SELF"];
        if($_SERVER["QUERY_STRING"] > " ") {
            $script_name .= "?".$_SERVER["QUERY_STRING"];
        }
    }
    if (isset($_SERVER["HTTP_HOST"])) {
        $FullURL .= $_SERVER["HTTP_HOST"].$port.$script_name;
    } else {
        $FullURL .= $_SERVER["SERVER_NAME"].$port.$script_name;
    }
    if ($PathOnly === true) {
        // strip everything to the last slash
        $Pos = strrpos($FullURL, "/");
        if ($Pos > 0) {
            $FullURL = substr($FullURL, 0, $Pos + 1);
        }
    }
    $FullURL = urldecode($FullURL); // decode url-encoded parts

    $TestFullURL = strip_tags($FullURL);
    if ($TestFullURL != $FullURL) {
        // We obviously found some html-tags! This is definitely not allowed!
        // Remove all parameters from URL!
        $ParsedURL = parse_url($FullURL);
        return $ParsedURL["path"];
    }
    return $FullURL;
}
?>