<?php

class Article extends Model
{

    public function create($title, $body = null, $author_id)
    {
        $sql = 'INSERT INTO articles (title, body, created_at, author_id, updated_at) VALUES (:title, :body, :created_at, :author_id, :updated_at)';

        $req = Database::getBdd()->prepare($sql);
        return $req->execute([
            'title' => $title,
            'body' => $body,
            'created_at' => date('Y-m-d H:i:s'),
            'author_id' => $author_id,
            'updated_at' => date('Y-m-d H:i:s')
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

    public function update($id, $title = null, $body = null)
    {
        if ($title == null)
        {
            $sql = 'UPDATE articles SET body = :body, updated_at = :updated_at WHERE id = :id';

            $req = Database::getBdd()->prepare($sql);
            return $req->execute([
                'body' => $body,
                'id' => $id,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
        else
        {
            $sql = 'UPDATE articles SET title = :title, body = :body, updated_at = :updated_at WHERE id = :id';

            $req = Database::getBdd()->prepare($sql);
            return $req->execute([
                'title' => $title,
                'body' => $body,
                'id' => $id,
                'updated_at' => date('Y-m-d H:i:s')
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

    public function getIdLastArticle()
    {
        $sql = 'SELECT id FROM articles ORDER BY id DESC LIMIT 1';
        $req = Database::getBdd()->prepare($sql);
        $req->execute();

        return $req->fetchAll()[0][0];

    }
}

?>