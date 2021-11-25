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
