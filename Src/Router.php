<?php

    class Router
    {

        static public function parse($url, $request)
        {
            $url = trim($url);
            $morceau = explode('/', $url);
            $morceau = array_slice($morceau, 2);
            $request->controller = $morceau[0];
            $request->action = $morceau[1];
            $request->params = array_slice($morceau, 2);
        }
    }
?>