<?
require_once "db.php";

class Post extends DB 
{
    public function getPostsWithOffset($offset, $limit=2) 
    {
        $sth = $this->dbh->prepare("SELECT * FROM post ORDER BY post_id DESC LIMIT ?, ?");
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
        return $sth;
    }
}