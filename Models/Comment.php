<?php

class Comment extends Model
{

    public function create($author_id, $article_id, $body)
    {
        $sql = 'INSERT INTO comments (author_id, article_id, body, created_at) VALUES (:author_id, :article_id, :body, :created_at)';

        $req = Database::getBdd()->prepare($sql);
        return $req->execute([
            'author_id' => $author_id,
            'body' => $body,
            'created_at' => date('Y-m-d H:i:s'),
            'article_id' => $article_id
        ]);
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

    public function commentsFromUser($user_id)
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

    public function commentsOfArticle($article_id)
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

    public function getAuthor($id)
    {
        $sql = "SELECT username FROM users JOIN articles ON users.id = articles.author_id WHERE articles.id = ?";
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
}
?>