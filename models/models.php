<?php

require_once "db.php";

class Post extends DB
{
    public function getActivePostsWithOffset($offset, $limit=2)
    {
        $sth = $this->dbh->prepare("SELECT * FROM post WHERE is_published ORDER BY post_id DESC LIMIT ?, ?");
        $sth->bindValue(1, $offset, PDO::PARAM_INT);
        $sth->bindValue(2, $limit, PDO::PARAM_INT);
        $sth->execute();
        return $sth;
    }

    public function getPostById($id)
    {
        $sth = $this->dbh->prepare('SELECT * FROM post WHERE post_id = :post_id');
        $sth->bindValue(':post_id', $id, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetch();
    }
}


class Comment extends DB
{
    private $post_id = null;

    public function getAllActiveComments()
    {
        if (is_null($this->post_id)) {
            throw new Exception("post_id не установлен", 1);
        }

        $sth = $this->dbh->prepare(
            "SELECT id, text, date_time, is_active
            FROM comment AS C
            JOIN post AS P ON C.post_id=P.post_id
            WHERE P.post_id=:post_id AND C.is_active
        "
        );
        $sth->bindValue(":post_id", $this->post_id, PDO::PARAM_INT);
        $sth->execute();
        return $sth;
    }

    public function setPostId($id)
    {
        if (!is_int($id)) {
            throw new Exception("post_id должен быть типом integer", 1);
        }
        if ($id < 1) {
            throw new Exception("id должен быть больше или равен 1", 1);
        }
        $this->post_id = $id;
    }
}

class User extends DB
{
    public function getUserById($id)
    {
        $sth = $this->dbh->prepare("
            SELECT * FROM User
            WHERE user_id=:user_id
        ");

        $sth->bindValue(":user_id", $id, PDO::PARAM_INT);

        $sth->execute();

        return $sth->fetch();
    }

    public function getUserIdByEmail($email)
    {
        $sth = $this->dbh->prepare("
        SELECT user_id FROM User
        WHERE email=:email
        ");

        $sth->execute(array(":email" => $email));

        return $sth->fetch()[0];
    }

    public function isEmailFree($email)
    {
        $sth = $this->dbh->prepare("SELECT COUNT(*) FROM User WHERE email=:email");
        $sth->execute(array(":email" => $email));

        $count = (int) $sth->fetch()[0];

        return $count === 0;
    }

    public function save($name, $email, $phone, $password)
    {
        try {
            $sth = $this->dbh->prepare("
            INSERT INTO User (name, email, phone, password_hash) VALUES
                (:name, :email, :phone, :password_hash)
            ");

            $save_name = htmlspecialchars($name);
            $save_email = htmlspecialchars($email);
            $save_phone = htmlspecialchars($phone);

            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $sth->execute(array(":name" => $save_name, ":email" => $save_email, ":phone" => $save_phone, ":password_hash" => $password_hash));
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
        return true;
    }
}
