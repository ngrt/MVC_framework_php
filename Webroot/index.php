<?php
    /*
    define('WEBROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_NAME"]));


    require(ROOT . "Core/Controller.php");

    require(ROOT . "Src/Router.php");
    */

    define('ROOT', str_replace("Webroot/index.php", "", $_SERVER["SCRIPT_FILENAME"]));

    require(ROOT . "Core/Controller.php");
    require(ROOT . 'Src/Router.php');
    require(ROOT . 'Request.php');
    require(ROOT . 'Dispatcher.php');

    $dispatch = new Dispatcher();
    $dispatch->dispatch();
?>