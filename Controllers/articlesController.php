<?php
    class articlesController extends Controller
    {
        function index($page = 1)
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

            require(ROOT . 'Models/Category.php');

            $category = new Category();

            $d["categories"] = $category->showCategories();

            if (isset($_POST["title"]) && isset($_POST["body"]))
            {
                require(ROOT . 'Models/Article.php');
                require(ROOT . 'Models/User.php');

                $user = new User();

                $d["errors"] = $this->verifyPostForm($_POST);
                $this->set($d);

                if (count($this->verifyPostForm($_POST)) == 0)
                {
                    $this->secure_form($_POST);

                    $article = new Article();
                    $article->create($_POST["title"], $_POST["body"], $user->getIdFromEmail($_SESSION["email"]), $_POST["category"]);
                    header("Location: " . WEBROOT . "articles/show/" . $article->getIdLastArticle());
                }
            }
            $this->set($d);
            $this->render('create');
        }

        function show($id)
        {
            session_start();

            require(ROOT . 'Models/Article.php');
            require(ROOT . 'Models/User.php');
            require(ROOT . 'Models/Comment.php');

            $article = new Article();
            $comment = new Comment();
            $article->show($id);
            $d['article'] = $article->show($id);
            $d['author'] = $article->getAuthor($id)["username"];
            $d['comments'] = $comment->commentsOfArticle($id);

            if (isset($_POST["body"])) {
                if (count($this->verifyCommentForm($_POST)) == 0) {
                    $this->secure_form($_POST);

                    $user = new User();
                    $comment->create($user->getIdFromEmail($_SESSION["email"]), $id, $_POST["body"]);
                    header("Location: " . WEBROOT . "articles/show/" . $id);
                }
            }

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
            require(ROOT . 'Models/Category.php');
            $category = new Category();

            $d["categories"] = $category->showCategories();
            $d["category_article"] = $category->getCatNameFromArticleId($id);
            $article = new Article();

            $d['article'] = $article->show($id);
            $this->set($d);

            if (isset($_POST["title"]))
            {
                $d["errors"] = $this->verifyPostForm($_POST);
                $this->set($d);
                if (count($this->verifyPostForm($_POST)) == 0)
                {
                    $this->secure_form($_POST);
                    $article->update($id, $_POST["title"], $_POST["body"], $_POST["category"]);
                    header("Location: " . WEBROOT . "articles/show/" . $id);
                }
            }
            $this->set($d);
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

        function verifyCommentForm($post)
        {
            $errors = [];

            if (isset($post))
            {
                if (strlen($post["body"]) == 0)
                {
                    $errors["body"] = "Invalid body";
                }
            }
            return $errors;
        }
    }
?>