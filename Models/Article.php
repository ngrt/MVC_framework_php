<?php

class Article extends Model
{

    public function create($title, $body = null, $author_id)
    {
        $sql = 'INSERT INTO articles (title, body, created_at, author_id) VALUES (:title, :body, :created_at, :author_id)';

        $req = Database::getBdd()->prepare($sql);
        return $req->execute([
            'title' => $title,
            'body' => $body,
            'created_at' => date('Y-m-d H:i:s'),
            'author_id' => $author_id
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

    public function update($id, $title = null, $body = null)
    {
        if ($title == null)
        {
            $sql = 'UPDATE articles SET body = :body WHERE id = :id';

            $req = Database::getBdd()->prepare($sql);
            return $req->execute([
                'body' => $body,
                'id' => $id,
            ]);
        }
        else
        {
            $sql = 'UPDATE articles SET title = :title, body = :body WHERE id = :id';

            $req = Database::getBdd()->prepare($sql);
            return $req->execute([
                'title' => $title,
                'body' => $body,
                'id' => $id
            ]);
        }
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