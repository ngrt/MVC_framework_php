<?php
    class articlesController extends Controller
    {
        function index()
        {
            require(ROOT . 'Models/Article.php');
            $article = new Article();
            $d['article'] = $article->show();

            $this->set($d);
            $this->render('index');
        }

        function create()
        {
            session_start();

            if (isset($_POST["title"]) && isset($_POST["body"]))
            {
                require(ROOT . 'Models/Article.php');
                require(ROOT . 'Models/User.php');
                $user = new User();

                if (count($this->verifyPostForm($_POST)) == 0)
                {
                    $this->secure_form($_POST);

                    $article = new Article();
                    $article->create($_POST["title"], $_POST["body"], $user->getIdFromEmail($_SESSION["email"]));
                    //var_dump($article->getIdLastArticle());
                    header("Location: " . WEBROOT . "articles/show/" . $article->getIdLastArticle());
                }
            }

            $this->render('create');
        }

        function show($id)
        {
            require(ROOT . 'Models/Article.php');
            $article = new Article();
            $article->show($id);
            $d['article'] = $article->show($id);

            $this->set($d);
            $this->render('show');
        }

        function verifyPostForm($post)
        {
            $errors = [];

            if (isset($post))
            {
                if (strlen($post["title"]) == 0)
                {
                    $errors["title"] = "Invalid title";
                }
            }
            return $errors;
        }
    }
?>