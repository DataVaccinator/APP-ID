<?php

// ###  other special entries needed by   ###
// ### this include (to stay independent) ###
$lang["intPleaseChoose"]["FR"] = "Veuillez choisir...";
$lang["intPleaseChoose"]["DE"] = "Bitte wählen...";
$lang["intPleaseChoose"]["CN"] = "请选择...";
$lang["intPleaseChoose"]["EN"] = "Please choose...";

/**
* @return Array: the array should contain the following (key/value) paires (LanguageCode => value, Result => value)
* @param LangID it represents an entry in the lang array (Used for translation/localization)
* @param $LanguageCode String: Language code like EN for English, FR for French, DE for German.
*/
function GetLgEntry($LangID, $LanguageCode){

    global $lang;

    $data["LanguageCode"] = !empty($LanguageCode)?$LanguageCode:null;
    $data["Result"      ] = isset ($lang[$LangID][$LanguageCode])?$lang[$LangID][$LanguageCode]:null;

    //English entries are the default values if an entry in the desired language is not found.
    if (empty($data["Result"])){
        $data["LanguageCode"] = "EN";   // not translated? try english...
        $data["Result"      ] = isset ($lang[$LangID]["EN"])?$lang[$LangID]["EN"]:"";
    }

    return $data;
}
/**
* returns the translated value if available otherwise it defaults to english
* @return String
* @param LangID it represents an entry in the lang array (Used for translation/localization)
* @param $LanguageCode String: Language code like EN for English, FR for French, DE for German.
*/
function Translate($LangID, $LanguageCode){
    $res = GetLgEntry($LangID, $LanguageCode);
    return getFromHash($res, "Result");
}

/**
* returns the currently used languagecode (short like DE or EN)
*/
function GetLanguage() {

    global $lang;
    $Sprache = "";
    if (getFromHash($_SESSION, "sess_Language") != "") {
        $Sprache = $_SESSION["sess_Language"];
    }
    
    // "language" and "lg" allow override!
    if (($val = getFromHash($_GET, "language")) != "") {
        $Sprache = strtoupper($val);
    }
    if (($val = getFromHash($_GET, "lg")) != "") {
        $Sprache = strtoupper($val);
    }
    if ($Sprache == "") {
        $Sprache = strtoupper(substr(getFromHash($_SERVER, "HTTP_ACCEPT_LANGUAGE"), 0, 2));
        if ($Sprache == "ZH") { $Sprache = "CN"; }
    }
    if (getFromHash(getFromHash($lang, -1, null), $Sprache) == "") {
        $Sprache = "EN"; // default is english, because I dont know this language
    }
    // check session variables
    $Default = GetFromHash($_SESSION, "prov_ProviderLanguage", "");
    $Allowed = GetFromHash($_SESSION, "prov_AllowedLanguages", "");
    if ($Allowed != "") {
        if (strpos($Allowed, $Sprache) === false && 
            getFromHash($_SESSION, "admin_UserID", 0) < 1) {
            // language not allowed and not logged in to administration
            $Sprache = $Default;
        }
    }

    // save for later use (override only using lg=xx or language=xx)
    setLanguage($Sprache);

    return $Sprache;
}
/**
 * Sets the value of the user language in the session.
 * @param string $language
 */
function setLanguage($language) {
    
    if(isLanguageAvailable($language)) {
        $_SESSION["sess_Language"] = $language;
    }
}
/**
 * Checks if the system supports the language that is given.
 * 
 * @param string $language: characters string like EN, DE, FR or CN
 * @return bool
 */
function isLanguageAvailable($language = "") {
    global $lang;
    
    if(!is_string($language) || $language == "") {
        return false;
    }
    
    $l = getFromHash($lang, -1);
    if (!is_array($l)) {
        return false;
    }
    if (getFromHash($l, $language, "-!-") != "-!-") {
        return true;
    }
    return false;
}

/**
* Return language specific text with five optional replacements (max. 5)
* 
* If the $Find begins with '[', the $Replace content is
* not secured for output! All other beginnings are secured!
* Use this for output that needs to keep html tags (but
* make shure to not output any user data with such tags).
* 
* Examples:
* echo lg(123)
* echo lg(123, "<NAME>", $FullName)
* echo lg(123, "<NAME>", $FullName, "<ALTER>", $Alter)
*
* @param mixed $LangID
* @param mixed $Find
* @param mixed $Replace
* @param mixed $Find2
* @param mixed $Replace2
* @param mixed $Find3
* @param mixed $Replace3
* @param mixed $Find4
* @param mixed $Replace4
* @param mixed $Find5
* @param mixed $Replace5
* @return string
*/
function lg($LangID, $Find = "", $Replace = "", $Find2 = "", $Replace2 = "", $Find3 = "", $Replace3 = "", $Find4 = "", $Replace4 = "", $Find5 = "", $Replace5 = "") {

    $S = GetLanguage(); // get currently used language (using session, url parameter etc.)

    return lgs($LangID, $S, $Find, $Replace, $Find2, $Replace2, $Find3, $Replace3, $Find4, $Replace4, $Find5, $Replace5);
}

/**
* Same as lg(), but directly outputs the text using echo.
*
* @param mixed $LangID
* @param mixed $Find
* @param mixed $Replace
* @param mixed $Find2
* @param mixed $Replace2
* @param mixed $Find3
* @param mixed $Replace3
* @param mixed $Find4
* @param mixed $Replace4
* @param mixed $Find5
* @param mixed $Replace5
*/
function lgp($LangID, $Find = "", $Replace = "", $Find2 = "", $Replace2 = "", $Find3 = "", $Replace3 = "", $Find4 = "", $Replace4 = "", $Find5 = "", $Replace5 = "") {

    echo lg($LangID, $Find, $Replace, $Find2, $Replace2, $Find3, $Replace3, $Find4, $Replace4, $Find5, $Replace5);
}

/**
* Same as lg(), but allows the selection of the
* used language-code as second parameter.
* 
* If the $Find begins with '[', the $Replace content is
* not secured for output! All other beginnings are secured!
* Use this for output that needs to keep html tags (but
* make shure to not output any user data with such tags).
*
* example to get the german text of ID 300:
* echo lgs(300, "DE", "<TEST>", $Test);
*
* @param mixed $LangID
* @param mixed $LanguageCode
* @param mixed $Find
* @param mixed $Replace
* @param mixed $Find2
* @param mixed $Replace2
* @param mixed $Find3
* @param mixed $Replace3
* @param mixed $Find4
* @param mixed $Replace4
* @param mixed $Find5
* @param mixed $Replace5
* @return string
*/
function lgs($LangID, $LanguageCode, $Find = "", $Replace = "", $Find2 = "", $Replace2 = "", $Find3 = "", $Replace3 = "", $Find4 = "", $Replace4 = "", $Find5 = "", $Replace5 = "") {
    global $lang;

    // return the language code and result
    $res = GetLgEntry($LangID, $LanguageCode);
    
    $LanguageCode = getFromHash($res, "LanguageCode");
    $Result       = getFromHash($res, "Result"      );
    
    if ($Result == "") { 
        error_log("INFO: Unknown translated string for LangID $LangID");
        return ""; 
    }

    if (substr($Find, 0, 1) == "[") {
        $Result = str_replace($Find, $Replace, $Result);
    } else {
        $Result = str_replace($Find, so($Replace), $Result);
    }
    if ($Find2 != "") {
        if (substr($Find2, 0, 1) == "[") {
            $Result = str_replace($Find2, $Replace2, $Result);
        } else {
            $Result = str_replace($Find2, so($Replace2), $Result);
        }
    }
    if ($Find3 != "") {
        if (substr($Find3, 0, 1) == "[") {
            $Result = str_replace($Find3, $Replace3, $Result);
        } else {
            $Result = str_replace($Find3, so($Replace3), $Result);
        }
    }
    if ($Find4 != "") {
        if (substr($Find4, 0, 1) == "[") {
            $Result = str_replace($Find4, $Replace4, $Result);
        } else {
            $Result = str_replace($Find4, so($Replace4), $Result);
        }
    }
    if ($Find5 != "") {
        if (substr($Find5, 0, 1) == "[") {
            $Result = str_replace($Find5, $Replace5, $Result);
        } else {
            $Result = str_replace($Find5, so($Replace5), $Result);
        }
    }
    if ($Result == "") {
        error_log("INFO: Unknown translated string for LangID $LangID (2)");
    }
    return $Result;
}

/**
* Generates a selection box with countries.
* If $Selected is found, it will get marked as the selected one.
* Please take care:
* - The values "_" and " " do not count!!!!
* - Some of the pre-select bvalues might start with a "+" like in "+GER"
*
* @param mixed $FieldName
* @param mixed $Selected
* @param mixed $Style
* @param mixed $Rows
*/
function InsertCountries($FieldName, $Selected, $Style = "", $Rows = 1, $tabindex = 0) {
    if ($Selected == "" AND isset($_REQUEST[$FieldName]) == TRUE) {
        // use POST value
        $Selected = getFromHash($_REQUEST, $FieldName);
        $Selected = str_replace(Array("+","-","_"), "", $Selected);
    }
    
    $Countries2 = GetCountryArray(COMMON_COUNTRIES, 
                    Array("_" => "-----------------------------------------")
                  );
    
    $Countries = array_merge(Array(" " => lg("intPleaseChoose")), $Countries2);
    
    echo "\n<select id=\"$FieldName\" name=\"$FieldName\" size=\"$Rows\" style=\"$Style\" tabindex=\"$tabindex\">\n";
    foreach ($Countries as $IOC => $Country) {
        $Country = so($Country);
        if ($IOC == $Selected && $IOC != "") {
            echo "  <option selected value=\"$IOC\">$Country</option>\n";
            $Selected = "bhfdsabhjfdsahbjfkdsabhjfdsabhkj"; // to avoid any further re-selection            
        } else {
            echo "  <option value=\"$IOC\">$Country</option>\n";
        }
    }
    echo "</select>";
}

/**
* Returns the IOC code of a named country name.
* Returns FALSE in case of no found value.
* 
* @param mixed $CountryName
* @return string IOC
*/
function GetIOCFromCountryName($CountryName) {
    $CountryName = strtolower($CountryName);
    $cData = LoadCountryData();
    foreach ($cData as $Country) {
        foreach ($Country["translations"] as $Name) {
            if (strtolower($Name) == $CountryName) {
                return $Country["ioc"];
            } 
        }
    }
    return FALSE;
}

/**
* Returns the IOC code of a country unLocode.
* http://www.unece.org/cefact/locode/service/location.html
* Returns default value if not found.
* 
* @param mixed $CountryCode
* @param mixed $Default
*/
function GetIOCFromCountryCode($CountryCode, $Default) {
    $CountryCode = strtoupper($CountryCode);
    $cData = LoadCountryData();
    foreach ($cData as $Country) {
        if ($Country["unLocode"] == $CountryCode) {
            return $Country["ioc"];
        } 
    }
    return $Default;
}

/**
* Returns the name of a country by the given IOC.
* If the optional $LanguageCode is not given, it uses the current
* session based language.
* 
* Returns empty string in case of no hit.
* 
* @param mixed $IOC
* @param mixed $LanguageCode
* @return string CountryName
*/
function GetCountryNameFromIOC($IOC, $LanguageCode = "") {
    $IOC = strtoupper($IOC);
    if ($LanguageCode == "") {
        $LanguageCode = GetLanguage();
    }
    $LanguageCode = strtolower($LanguageCode);
    $cData = LoadCountryData();
    foreach ($cData as $Country) {
        if ($Country["ioc"] == $IOC) {
            $Name = getFromHash($Country["translations"], $LanguageCode, "");
            if ($Name == "") {
                $Name = getFromHash($Country["translations"], "en", ""); // fallback english
            }
            return $Name;
        }
    }
    return "";
}

/**
* Ensure, that a value is threaten as correct decimal value - no matter
* if the decimal point is . or ,. Remove all '.
* If $OnlyPositive == TRUE, all negative values are seen as null (0).
*
* @param string $Value To get parsed
* @param boolean $OnlyPositive
* @return float
*/
function ParseValue($Value, $OnlyPositive = FALSE) {
    $Value = str_replace(",", ".", $Value); // switch , to .
    $Value = str_replace("'", "", $Value); // remove '
    $Result = floatval($Value);
    if ($Result < 0 && $OnlyPositive == TRUE) {
        return 0;
    }
    return $Result;
}

/**
* Returns an array with all country data.
* @return array CountryData
*/
function LoadCountryData() {
    $cData = getFromHash($_SESSION, "inc_CountryCache", Array());
    if (count($cData) > 0) {
        return $cData; // use cached value 
    }
    $Path =  dirname(__FILE__). "/";
    $Path = str_replace("\\", "/", $Path);
    $CJSON = file_get_contents($Path. "countryData.js");
    if ($CJSON == "") {
        return Array();
    }
    $cData = json_decode($CJSON, true);
    if (isset($_SESSION)) {
        $_SESSION["inc_CountryCache"] = $cData;
    }
    return $cData;
}

/**
* Returns an array of country names and IOC code as key.
* "Germany" => "GER"
* 
* The keys are the IOC code (like "GER")
* Special entries:
* You can set $CommonCountries with space delimited IOC codes.
* The common countries have different keys. Instead of the "GER" code,
* they get a plus before ("+GER"). Example: "+GER" for "GER" entry.
* 
* @param string $CommonCountries - Common countries IOC codes (space or comma separated)
* @param array $Divider - divider entry with key/value as divider
* @return array
*/
function GetCountryArray($CommonCountries = "", $Divider = Array() ) {
    $cData = LoadCountryData();
    $LanguageCode = strtolower(GetLanguage());
    $CommonCountries = str_replace(",", " ", $CommonCountries); // replace commas by blank
    $Common = explode(" ", $CommonCountries); // get array of IOC codes for common countries
    $CommonEntries = Array();
    $Countries = Array();
    foreach ($cData as $Country) {
        $Name = getFromHash($Country["translations"], $LanguageCode, "");
        if ($Name == "") {
            $Name = getFromHash($Country["translations"], "en", ""); // fallback english
        }
        
        $Countries[$Country["ioc"]] = $Name;
        if (array_search(strtoupper($Country["ioc"]), $Common) !== FALSE &&
            $Country["ioc"] != "") {
            $CommonEntries["+".$Country["ioc"]] = $Name;
        }
    }
    asort($Countries, SORT_STRING);
    asort($CommonEntries, SORT_STRING);
    $Values = array_merge($CommonEntries, $Divider, $Countries);
    return $Values;
}
?>