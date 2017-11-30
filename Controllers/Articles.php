<?php
    class Articles extends Controller
    {
        function index()
        {
            $d['article'] = array(
                'titre' => "Salut pendejo",
                'description' => 'Example de description'
            );
            $this->set($d);
            $this->render('index');
        }
    }
?>