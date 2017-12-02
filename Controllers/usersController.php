<?php
class usersController extends Controller
{

    public function register()
	{
        session_start();

		if (isset($_POST["username"]))
        {
            $errors = $this->verifyRegisterForm($_POST);

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
        }

        $this->render("register");

	}

    public function login()
    {
        session_start();

        if (isset($_SESSION["email"]))
        {
            header("Location: " . WEBROOT . "articles/index");
        }

        $this->render("login");

        if (isset($_POST["email"]) && isset($_POST["password"]))
        {
            require(ROOT . 'Models/User.php');
            $user = new User();

            if ($user->verify_password($_POST["email"], $_POST["password"]))
            {
                $_SESSION["email"] = $_POST["email"];
            }
            else
            {
                echo "Error in credentials";
            }
        }
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

}
?>