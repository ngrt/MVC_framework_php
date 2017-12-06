<?php

    class Router
    {

        static public function parse($url, $request)
        {
            $url = trim($url);

            if ($url == "/PHP_Rush_MVC/")
            {
                $request->controller = "articles";
                $request->action = "index";
                $request->params = [];
            }
            else
            {
                $morceau = explode('/', $url);
                $morceau = array_slice($morceau, 2);
                $request->controller = $morceau[0];
                $request->action = $morceau[1];
                $request->params = array_slice($morceau, 2);
            }

        }
    }
?>