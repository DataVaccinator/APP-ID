<?php
/**
* ################################################################################
*
* APP-ID CONFIGURATION INITIALISATION
* ===============================================
*
* This file contains loads the custom configuration followed by the defaults
*
* @copyright 2019
* ################################################################################
*/

// standards
// TODO store in separate configuration file (outside of GIT)
define('DBHOST', "127.0.0.1");
define('DBUSER', "root");
define('DBPASSWORD', "regify");
define('DBDATABASE', "appid"); // schema name

// page steps
define('STEP_START', "0");
define('STEP_ASK_ID', "1");
define('STEP_ASK_SECURITY', "2");
define('STEP_DISPLAY_NEW', "3");
define('STEP_DISPLAY_EXISTING', "4");
define('STEP_ABOUT', "10");
define('STEP_FAQ', "20");
define('STEP_CONTACT', "30");
define('STEP_IMPRINT', "40");
define('STEP_PRIVACY', "50");

// >>>>>>>>>>> SERVICE VALUES <<<<<<<<<<<<<

// Which countries to show on top of country selection
define('COMMON_COUNTRIES', "LUX GER");

// which countries are supported by this instance (IOC)
// make sure that $lang['idQuestion'] is set for the given!
define('SUPPORTED_COUNTRIES', "LUX GER"); // default is "LUX GER"
// Validation RegEx for the id numbers:
$validation["GER"] = '/^[0-9LMNPRTVWXY]{1}[0-9CFGHJKLMNPRTVWXYZ]{8,9}$/';
$validation["LUX"] = '/^[A-Z0-9]{9,10}$/';

// set the email address shown for support.
define('SUPPORT_EMAIL', "support@app-id.eu");

// how many tries are allowed for security question until
// the pid gets locked for a while.
define('LOCK_AFTER_FAILED_ATTEMPTS', 5); // default is 5

// init session
session_name("APPID");
session_start();

// global requirements
require_once('incDatabase.php'); // include regify database functions
require_once('incSecurity.php'); // include regify security functions
require_once('language.php'); // include regify database functions
require_once('utils.php'); // include regify database functions 

?>