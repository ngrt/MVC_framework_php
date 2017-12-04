<?php
class categoriesController extends Controller
{
    function management()
    {
        session_start();
        require (ROOT . "Models/Category.php");


        require(ROOT . 'Models/User.php');

        $category = new Category();

        $d['categories'] = $category->showCategories();

        $this->set($d);
        $this->render("management");
    }

    function delete($id)
    {
        session_start();
        require (ROOT . "Models/Category.php");

        $category = new Category();

        $category->delete($id);

        header("Location: " . WEBROOT . "categories/management");
    }

    function edit($id)
    {
        session_start();
        require (ROOT . "Models/Category.php");
        require (ROOT . "Models/Article.php");
        $category = new Category();
        $article = new Article();

        $d['articles'] = $category->getArticlesOfCategory($id);

        $d['articlesNotInCat'] = $category->getArticlesNotOfCategory($id);

        if (isset($_POST["article_id"]))
        {
            $article->addCategory($_POST["article_id"], $id);
            header("Location: " . WEBROOT . "categories/edit/" . $id);
        }

        $this->set($d);
        $this->render("edit");
    }
}
?>