<?php

class Category extends Model
{

    public function showCategories()
    {
        $sql = 'SELECT * FROM categories';
        $req = Database::getBdd()->prepare($sql);
        $req->execute();

        return $req->fetchAll();
    }

    public function getArticlesOfCategory($cat_id)
    {
        $sql = 'SELECT articles.* FROM articles JOIN categories ON categories.id = articles.cat_id WHERE articles.cat_id =  ?';
        $req = Database::getBdd()->prepare($sql);
        $req->execute([$cat_id]);

        return $req->fetchAll();
    }

    public function getArticlesNotOfCategory($cat_id)
    {
        $sql = 'SELECT articles.* FROM articles JOIN categories ON categories.id = articles.cat_id WHERE articles.cat_id !=  ?';
        $req = Database::getBdd()->prepare($sql);
        $req->execute([$cat_id]);

        return $req->fetchAll();
    }

    public function getCatNameFromArticleId($article_id)
    {
        $sql = 'SELECT categories.title FROM articles JOIN categories ON categories.id = articles.cat_id WHERE articles.id =  ?';
        $req = Database::getBdd()->prepare($sql);
        $req->execute([$article_id]);

        return $req->fetchAll()[0][0];
    }

    public function delete($category_id)
    {
        $sql = 'DELETE FROM categories WHERE id = ?';
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([$category_id]);
    }


}

?>