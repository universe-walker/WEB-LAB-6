<?php


namespace App\Models;

use App\Models\DB;
use PDO;

class Post extends DB
{
    public function getActivePostsWithOffset($offset, $limit=2)
    {
        $sth = $this->dbh->prepare("
        SELECT P.post_id, P.title, P.original_title, P.poster, P.text_post, P.date, U.name
            FROM Post AS P
            JOIN `User` AS U ON P.user_id=U.user_id
            WHERE P.is_published
            ORDER BY P.post_id DESC
            LIMIT ?, ?
        ");
        $sth->bindValue(1, $offset, PDO::PARAM_INT);
        $sth->bindValue(2, $limit, PDO::PARAM_INT);
        $sth->execute();
        return $sth;
    }

    public function getPostById($id)
    {
        $sth = $this->dbh->prepare("
        SELECT P.post_id, P.title, P.original_title, P.poster, P.trailer_link, 
               P.release_year, P.text_post, P.rating, P.date, U.name
                FROM Post AS P
                JOIN `User` AS U ON P.user_id=U.user_id
                WHERE P.is_published AND P.post_id=:post_id;
        ");
        $sth->bindValue(':post_id', $id, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetch();
    }

    public function addPost(
        int $user_id,
        string $title,
        string $original_title,
        string $poster_path,
        string $trailer_link,
        string $text_post,
        bool $is_published,
        int $release_year,
        int $rating
    ): int {
        $sth = $this->dbh->prepare(
            "INSERT INTO Post 
            (user_id,
            title,
            original_title,
            poster,
            trailer_link,
            text_post,
            DATE,
            is_published,
            release_year,
            rating)
         VALUES
            (:user_id,
             :title,
             :original_title,
             :poster,
             :trailer_link,
             :text_post,
             NOW(),
             :is_published,
             :release_year,
             :rating);
        "
        );
        $sth->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        $sth->bindValue(":title", $title);
        $sth->bindValue(":original_title", $original_title);
        $sth->bindValue(":poster", $poster_path);
        $sth->bindValue(":trailer_link", $trailer_link);
        $sth->bindValue(":text_post", $text_post);
        $sth->bindValue(":is_published", $is_published, PDO::PARAM_BOOL);
        $sth->bindValue(":release_year", $release_year, PDO::PARAM_INT);
        $sth->bindValue(":rating", $rating, PDO::PARAM_INT);

        $sth->execute();

        return $this->dbh->lastInsertId();
    }
}
