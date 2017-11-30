<?php
    require(ROOT . 'Controllers/' . $controller . '.php');

    $controller = new $controller();

    if (method_exists($controller, $action)){
        $controller->$action();
    }
    else{
        echo "Error 404";
    }
?>