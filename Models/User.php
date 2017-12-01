<?php

class User extends Model
{
    public function create($username, $hashed_password, $email, $group = 0, $status = 1)
    {
        $sql = "INSERT INTO users (username, hashed_password, email, group_rush, status, created_at, updated_at) VALUES (:username, :hashed_password, :email, :group_rush, :status, :created_at, :updated_at)";
        //echo $sql;
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([
            'username' => $username,
            'hashed_password' => $hashed_password,
            'email' => $email,
            'group_rush' => $group,
            'status' => $status,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')

        ]);
    }

    public function update($id, $username, $hashed_password, $email, $group, $status)
    {
        $sql = 'UPDATE users SET username = :username, hashed_password = :hashed_password, email = :email, users.group = :users.group, status = :status, updated_at = :updated_at WHERE id = :id';
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([
            'username' => $username,
            'hashed_password' => $hashed_password,
            'email' => $email,
            'user.group' => $group,
            'status' => $status,
            'updated_at'  => date('Y-m-d H:i:s'),
            'id' => $id
        ]);
    }

    public function getGroup($id)
    {
        $sql = 'SELECT users.group FROM users WHERE id = ?';

        $req = Database::getBdd()->prepare($sql);
        $req->execute([$id]);

        return $req->fetchAll();
    }

    public function showUser($id)
    {
        $sql = "SELECT * FROM users WHERE $id = ?";
        $req = Database::getBdd()->prepare($sql);
        $req->execute([$id]);

        return $req->fetchAll();
    }

    public function showAllUsers()
    {
        $sql = "SELECT * FROM users";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();

        return $req->fetchAll();
    }

    public function deleteUser($id)
    {
        $sql = 'DELETE FROM users WHERE id = ?';
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([$id]);
    }

    public function verify_password($email, $password)
    {
        $sql = "SELECT id FROM users WHERE email = ?";
        $req = Database::getBdd()->prepare($sql);
        $req->execute([$email]);
        $id = $req->fetch()[0];

        $sql = "SELECT hashed_password FROM users WHERE id = ?";
        $req = Database::getBdd()->prepare($sql);
        $req->execute([$id]);
        $hashed_password = $req->fetch()[0];

        return password_verify($password, $hashed_password);

    }
}
?>