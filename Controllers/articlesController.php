<?php
    class articlesController extends Controller
    {
        function index($id = null)
        {
            require(ROOT . 'Models/Article.php');
            $article = new Article();
            $d['article'] = $article->show($id);

            $this->set($d);
            $this->render('index');
        }
    }
?>