<?php
    class articlesController extends Controller
    {
        function index($page)
        {
            session_start();
            if (isset($_SESSION["email"]))
            {
                require(ROOT . 'Models/User.php');
                $user = new User();
                $id = $user->getIdFromEmail($_SESSION["email"]);
                $group = $user->getGroup($id);
            }
            else
            {
                $group = 0;
            }
            require(ROOT . 'Models/Article.php');

            $article = new Article();

            $page = ($page > 0) ? (int)$page : 1;
            $start = ($page > 1) ? ($page * 10) - 10 : 0;
            $results = $article->index($start);
            $total = $results[1];
            $pages = ceil($total / 10);
            $d['page'] = $page;
            $d['pages'] = $pages;
            $d['article'] = $results[0];
            $d['group_user'] = $group;
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
                    header("Location: " . WEBROOT . "articles/show/" . $article->getIdLastArticle());
                }
            }

            $this->render('create');
        }

        function show($id)
        {
            session_start();

            require(ROOT . 'Models/Article.php');
            $article = new Article();
            $article->show($id);
            $d['article'] = $article->show($id);

            $this->set($d);
            $this->render('show');
        }

        function management()
        {
            session_start();

            require(ROOT . 'Models/User.php');

            $user = new User();

            $user_id = $user->getIdFromEmail($_SESSION["email"]);

            $user_group = $user->getGroup($user_id);

            require(ROOT . 'Models/Article.php');
            $article = new Article();

            if ($user_group == 2)
            {
                $d['article'] = $article->articlesFromUser($user_id);
            }
            else if ($user_group == 3)
            {
                $d['article'] = $article->articlesFromUser();
            }

            $this->set($d);
            $this->render('management');
        }

        function edit($id)
        {

            session_start();

            require(ROOT . 'Models/Article.php');
            $article = new Article();

            $d['article'] = $article->show($id);
            $this->set($d);

            if (isset($_POST["title"]))
            {
                if (count($this->verifyPostForm($_POST)) == 0)
                {
                    $this->secure_form($_POST);
                    $article->update($id, $_POST["title"], $_POST["body"]);
                    header("Location: " . WEBROOT . "articles/show/" . $id);
                }
            }
            $this->render('edit');
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