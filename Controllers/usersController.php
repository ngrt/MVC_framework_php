<?php

class usersController extends Controller
{

    public function register()
    {
        session_start();

        if (isset($_POST["username"]))
        {
            $errors = $this->verifyRegisterForm($_POST);
            $d['errors'] = $this->verifyRegisterForm($_POST);

            require(ROOT . 'Models/User.php');

            if (count($errors) == 0)
            {
                $this->secure_form($_POST);
                $hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
                $user = new User();
                if ($user->create($_POST["username"], $hashed_password, $_POST["email"]))
                {
                    $_SESSION["email"] = $_POST["email"];
                    header("Location: " . WEBROOT . "articles/index");
                }
            }
            $this->set($d);
        }

        $this->render("register");
    }

    public function login()
    {
        session_start();

        if (isset($_COOKIE["email"]))
        {
            $_SESSION["email"] = $_COOKIE["email"];
        }

        if (isset($_SESSION["email"]))
        {
            header("Location: " . WEBROOT . "articles/index");
        }

        if (isset($_POST["email"]) && isset($_POST["password"]))
        {
            require(ROOT . 'Models/User.php');
            $user = new User();

            if ($user->verify_password($_POST["email"], $_POST["password"]))
            {
                $_SESSION["email"] = $_POST["email"];
                if (isset($_POST["remember_me"]))
                {
                    setcookie("email", $_SESSION["email"], time()+3600*24);
                }
                header("Location: " . WEBROOT . "articles/index");
            }
            else
            {
                echo "Error in credentials";
            }
        }
        $this->render("login");

    }

    function account($id)
    {
        session_start();
        require(ROOT . 'Models/User.php');
        require(ROOT . 'Models/Article.php');
        require(ROOT . 'Models/Comment.php');
        $user = new User();
        $d["user"] = $user->showUser($id);

        if (isset($_POST))
        {
            if (isset($_POST["password"]))
            {
                $errors = $this->verifyUpdatePasswordForm($_POST);
                $d["errors"] = $this->verifyUpdatePasswordForm($_POST);
                if (count($errors) == 0)
                {
                    $this->secure_form($_POST);
                    $hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
                    $user = new User();
                    $user->updatePassword($id, $hashed_password);
                    header("Refresh:0");
                }
            }
            else if (isset($_POST["username"]))
            {
                $errors = $this->verifyUpdateUserForm($_POST);
                $d["errors"] = $this->verifyUpdateUserForm($_POST);
                if (count($errors) == 0)
                {
                    $this->secure_form($_POST);
                    $user = new User();
                    $user->updateUsername($id, $_POST["username"]);
                    header("Refresh:0");
                }
            }
            else if (isset($_POST["delete"]))
            {
                $user = new User();
                $article = new Article();
                $comment = new Comment();
                $user->deleteUser($id);
                $article->deleteArticlesFromUser($id);
                $comment->deleteCommentsFromUser($id);
                $_SESSION = array();
                session_destroy();
                unset($_COOKIE["email"]);
                setcookie("email", $_SESSION["email"], -1);
                header("Location: " . WEBROOT . "articles/index");
            }
        }
        $this->set($d);
        $this->render('account');
    }

    public function management($id)
    {
        session_start();

        require(ROOT . 'Models/User.php');

        $user = new User();

        $d['users'] = $user->showAllUsers();


        foreach ($d['users'] as $key => $user)
        {
            if ($user["id"] == $id)
            {
                unset($d['users'][$key]);
            }
        }

        foreach ($d['users'] as $key => $user)
        {
            $d['users'][$key]["group_rush_string"] = $this->groupTranslation($d['users'][$key]["group_rush"]);
            $d['users'][$key]["status_string"] = $this->statusTranslation($d['users'][$key]["status"]);
        }

        $this->set($d);
        $this->render('management');
    }

    public function groupTranslation($group)
    {
        $value = '';
        if ($group == 1)
        {
            $value = "Normal user";
        }
        else if ($group == 2)
        {
            $value = "Writer";
        }
        else if ($group == 3)
        {
            $value = "Admin";
        }
        return $value;
    }

    public function statusTranslation($status)
    {
        return ($status == 0) ? "Disactivated" : "Activated";
    }

    public function edit($id)
    {
        session_start();
        require(ROOT . 'Models/User.php');
        require(ROOT . 'Models/Article.php');
        require(ROOT . 'Models/Comment.php');
        $user = new User();
        $d["user"] = $user->showUser($id);

        if (isset($_POST["username"]))
        {
            $errors = $this->verifyUpdateUserForm($_POST);
            $d["errors"] = $this->verifyUpdateUserForm($_POST);
            if (count($errors) == 0)
            {
                $this->secure_form($_POST);
                $user->updateFromAdmin($id, $_POST["username"], (int)$_POST["group"], (int)$_POST["status"]);
                header("Location: " . WEBROOT . "users/management/" . $user->getIdFromEmail($_SESSION["email"]));
            }
        }

        $this->set($d);
        $this->render('edit');
    }


    public function delete($id)
    {
        session_start();
        require(ROOT . 'Models/User.php');
        require(ROOT . 'Models/Article.php');
        require(ROOT . 'Models/Comment.php');
        $user = new User();
        $article = new Article();
        $comment = new Comment();
        $user->deleteUser($id);
        $article->deleteArticlesFromUser($id);
        $comment->deleteCommentsFromUser($id);
        //$_SESSION = array();
        //session_destroy();
        header("Location: " . WEBROOT . "users/management/" . $id);
    }

    public function logout()
    {
        session_start();
        $_SESSION = array();
        session_destroy();
        if (isset($_COOKIE["email"]))
        {
            unset($_COOKIE["email"]);
            setcookie("email", $_SESSION["email"], -1);
        }

        header("Location: " . WEBROOT . "articles/index");
    }

    public function verifyRegisterForm($post)
    {
        $errors = [];

        if (isset($post))
        {
            if (strlen($post["username"]) < 3 || strlen($post["username"]) > 10)
            {
                $errors["username"] = "Invalid username";
            }

            if (strlen($post["password"]) < 8 || strlen($post["password"]) > 20 || $post["password"] != $post["password-confirmation"])
            {
                $errors["password"] = "Invalid password";
            }

            if (!filter_var($post["email"], FILTER_VALIDATE_EMAIL))
            {
                $errors["email"] = "Invalid email";
            }
        }
        return $errors;
    }

    public function verifyUpdateUserForm($post)
    {
        $errors = [];

        if (isset($post["username"]))
        {
            if (strlen($post["username"]) < 3 || strlen($post["username"]) > 10)
            {
                $errors["username"] = "Invalid username";
            }
        }
        return $errors;
    }

    public function verifyUpdatePasswordForm($post)
    {
        $errors = [];

        if (isset($post))
        {
            if (strlen($post["password"]) < 8 || strlen($post["password"]) > 20 || $post["password"] != $post["password-confirmation"])
            {
                $errors["password"] = "Invalid password";
            }
        }
        return $errors;
    }



}
?>