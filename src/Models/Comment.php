<?php

namespace App\Models;

class Comment extends DB
{
    public function getAllActiveComments($post_id)
    {
        $sth = $this->dbh->prepare(
            "SELECT
                C.id,
                C.text,
                C.date_time,
                C.is_active,
                U.name,
                U.avatar
            FROM
                `Comment` AS C
            JOIN Post AS P
            ON
                C.post_id = P.post_id
            JOIN `User` AS U
            ON
                C.user_id = U.user_id
            WHERE
                P.post_id = :post_id AND C.is_active
        "
        );
        $sth->bindValue(":post_id", $post_id, \PDO::PARAM_INT);
        $sth->execute();
        return $sth;
    }

    public function insertNewCommentAndReturnItId($post_id, $text, $user_id)
    {
        try {
            $sth = $this->dbh->prepare(
                "INSERT INTO Comment (post_id, user_id, text, date_time, is_active) VALUES
                    (:post_id, :user_id, :text, NOW(), 1) 
            "
            );
            $sth->bindValue(":post_id", $post_id, \PDO::PARAM_INT);
            $sth->bindValue(":user_id", $user_id, \PDO::PARAM_INT);
            $sth->bindValue(":text", htmlspecialchars($text));

            $sth->execute();
        } catch (\PDOException $e) {
            return false;
        }

        return $this->dbh->lastInsertId();
    }

    public function getCommentById($id)
    {
        $sth = $this->dbh->prepare(
            "SELECT
                C.id,
                C.text,
                C.date_time,
                U.name,
                U.avatar
            FROM
                `Comment` AS C
            JOIN User AS U
            ON
                C.user_id = U.user_id
            WHERE
                C.id = :comment_id
        "
        );

        $sth->bindValue(":comment_id", $id, \PDO::PARAM_INT);
        $sth->execute();

        return $sth->fetch();
    }
}
