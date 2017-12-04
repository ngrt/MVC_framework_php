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

    public function commentsFromUser($author_id)
    {

        $sql = 'SELECT * FROM comments WHERE author_id = ?';
        $req = Database::getBdd()->prepare($sql);
        $req->execute([$author_id]);

        return $req->fetchAll();
    }

    public function commentsOfArticle($article_id)
    {
        $sql = 'SELECT comments.*, users.username AS username FROM comments JOIN users on users.id = comments.author_id WHERE article_id = ? ORDER BY created_at DESC';
        $req = Database::getBdd()->prepare($sql);
        $req->execute([$article_id]);
        return $req->fetchAll();
    }

    public function getAuthor($id)
    {
        $sql = "SELECT username FROM users JOIN articles ON users.id = articles.author_id WHERE articles.id = ?";
        $req = Database::getBdd()->prepare($sql);
        $req->execute([$id]);

        return $req->fetchAll()[0];
    }

    public function deleteComment($id)
    {
        $sql = 'DELETE FROM comments WHERE id = ?';

        $req = Database::getBdd()->prepare($sql);
        return $req->execute([$id]);
    }

    public function deleteCommentsofArticle($article_id)
    {
        $sql = 'DELETE FROM comments WHERE article_id = ?';

        $req = Database::getBdd()->prepare($sql);
        return $req->execute([$article_id]);
    }
}
?>