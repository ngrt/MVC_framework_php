<?php

    $params = explode('/', $_GET['p']);

    $controller = $params[0];
    $action = isset($params[1]) ? $params[1] : 'index';

    require(ROOT . "dispatcher.php");
?>