<?php
class usersController extends Controller
{

    public function register()
	{
		$this->render("register");

		if (isset($_POST["username"]))
        {
            require(ROOT . 'Models/User.php');

            if ($_POST['password'] == $_POST["password-confirmation"])
            {
                $hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
                $user = new User();
                $user->create($_POST["username"], $hashed_password, $_POST["email"]);
            }
            else
            {
                echo "Error in password";
            }
        }
	}

}
?>