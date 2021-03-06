<?php

class Article extends Model
{

    public function create($title, $body = null, $author_id, $cat_id = null)
    {
        $sql = 'INSERT INTO articles (title, body, created_at, author_id, updated_at, cat_id) VALUES (:title, :body, :created_at, :author_id, :updated_at, :cat_id)';

        $req = Database::getBdd()->prepare($sql);
        return $req->execute([
            'title' => $title,
            'body' => $body,
            'created_at' => date('Y-m-d H:i:s'),
            'author_id' => $author_id,
            'updated_at' => date('Y-m-d H:i:s'),
            'cat_id' => $cat_id
        ]);
    }

    public function index($start)
    {
        $results = [];
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM articles LIMIT " . $start . ", 10";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        $results[0] =  $req->fetchAll(PDO::FETCH_ASSOC);

        $req = Database::getBdd()->query('SELECT FOUND_ROWS() as total');
        $results[1] = $req->fetch()['total'];

        return $results;
    }

    public function show($id = null)
    {
        if ($id == null)
        {
            $sql = 'SELECT * FROM articles';
            $req = Database::getBdd()->prepare($sql);
            $req->execute();
        }
        else
        {
            $sql = 'SELECT * FROM articles WHERE id = ?';
            $req = Database::getBdd()->prepare($sql);
            $req->execute([$id]);
        }
        return $req->fetchAll();
    }

    public function articlesFromUser($user_id = null)
    {
        if ($user_id == null)
        {
            $sql = 'SELECT * FROM articles';
            $req = Database::getBdd()->prepare($sql);
            $req->execute();
        }
        else
        {
            $sql = 'SELECT * FROM articles WHERE author_id = ?';
            $req = Database::getBdd()->prepare($sql);
            $req->execute([$user_id]);
        }

        return $req->fetchAll();
    }

    public function update($id, $title = null, $body = null, $cat_id = null)
    {
        if ($title == null)
        {
            $sql = 'UPDATE articles SET body = :body, updated_at = :updated_at, cat_id = :cat_id WHERE id = :id';

            $req = Database::getBdd()->prepare($sql);
            return $req->execute([
                'body' => $body,
                'id' => $id,
                'updated_at' => date('Y-m-d H:i:s'),
                'cat_id' => $cat_id
            ]);
        }
        else
        {
            $sql = 'UPDATE articles SET title = :title, body = :body, updated_at = :updated_at, cat_id = :cat_id WHERE id = :id';

            $req = Database::getBdd()->prepare($sql);
            return $req->execute([
                'title' => $title,
                'body' => $body,
                'id' => $id,
                'updated_at' => date('Y-m-d H:i:s'),
                'cat_id' => $cat_id
            ]);
        }
    }

    public function getAuthor($id)
    {
        $sql = "SELECT users.id AS user_id, username FROM users JOIN articles ON users.id = articles.author_id WHERE articles.id = ?";
        $req = Database::getBdd()->prepare($sql);
        $req->execute([$id]);

        return $req->fetchAll()[0];
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM articles WHERE id = ?';

        $req = Database::getBdd()->prepare($sql);
        return $req->execute([$id]);
    }

    public function deleteArticlesFromUser($author_id)
    {
        $sql = 'DELETE FROM articles WHERE author_id = ?';

        $req = Database::getBdd()->prepare($sql);
        return $req->execute([$author_id]);
    }

    public function getIdLastArticle()
    {
        $sql = 'SELECT id FROM articles ORDER BY id DESC LIMIT 1';
        $req = Database::getBdd()->prepare($sql);
        $req->execute();

        return $req->fetchAll()[0][0];
    }

    public function addCategory($article_id, $cat_id)
    {
        $sql = 'UPDATE articles SET cat_id = :cat_id WHERE id = :article_id';

        $req = Database::getBdd()->prepare($sql);
        return $req->execute([
            'article_id' => $article_id,
            'cat_id' => $cat_id
        ]);
    }

    public function setCategoryToNull($cat_id)
    {
        $sql = 'UPDATE articles SET cat_id = NULL WHERE cat_id = :cat_id';

        $req = Database::getBdd()->prepare($sql);
        return $req->execute([
            'cat_id' => $cat_id
        ]);
    }
}

?>