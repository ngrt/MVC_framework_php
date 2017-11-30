<?php
    class Controller
    {
        var $vars = [];
        var layout = 'default';

        function set($d)
        {
            $this->vars = array_merge($this->vars, $d);
        }

        function render($filename)
        {
            extract($this->vars);
            require(ROOT . "Views/" . get_class($this) . '/' . $filename . '.php');
        }
    }
?>