<?php
    define('WEBROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_NAME"]));
    define('ROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_FILENAME"]));

    require(ROOT . "Core/Controller.php");

    require(ROOT . "Src/router.php");
?>