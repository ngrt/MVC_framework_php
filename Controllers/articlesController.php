<?php
    class articlesController extends Controller
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

        public function show()
        {
            $d['message'] = "Pendejo";

            $this->set($d);
            $this->render('show');
        }
    }
?>