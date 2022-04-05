<?php 
require_once(__DIR__ . "/../lib/init.php");  // include configuration
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
    <title>APP-ID</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"/>
    <!-- include CSS stylesheet -->
    <link rel="stylesheet" href="style/unsemantic-grid-responsive-no-ie7.css" type="text/css">
    <link rel="stylesheet" href="style/main.css" type="text/css">
    <!-- FRAMEBUSTER (http://seclab.stanford.edu/websec/framebusting/) -->
    <style>html { display:none }</style>
    <script type="text/javascript">
        if (self == top) {
            document.documentElement.style.display = 'block';
        } else {
            top.location = self.location;
        }
    </script>
    <!-- Include some fonts (from google open fonts) -->
    <style>
        @font-face {
            font-family: 'Playfair Display';
            src: url('style/PlayfairDisplay-Regular.ttf')  format('truetype')
        }
        @font-face {
            font-family: 'Fira Code';
            src: url('style/FiraCode-Regular.ttf')  format('truetype')
        }
    </style>
    </head>
    
    <body>
    <div class="grid-container">
        <div class="header grid-100 grid-parent">
            <?php include("../lib/header.php"); ?>
        </div>
    </div>

    <div class="grid-container">
        <div class="main grid-100 grid-parent">
        <?php
        
        $step = intval(getFromHash($_GET, "s", STEP_START)); // numeric step
        $file = "../lib/step_{$step}.php";
        if (!file_exists($file)) {
            $file = "../lib/step_".STEP_START.".php"; // fallback STEP_START
            $step = 0;
        }
        $_SESSION["lastTime{$step}"] = time(); // remember time this dialog was loaded
        require($file);
        output(); // run included function

        ?>
        </div>
    </div>
    <div class="grid-container">
        <div class="footer grid-100 grid-parent">
            <?php include("../lib/footer.php"); ?>
        </div>
    </div>
    </body>
</html>