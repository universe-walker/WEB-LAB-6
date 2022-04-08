<?php

namespace App\Models;

use App\Models\DB;
use PDO;
use PDOException;

class User extends DB
{
    public function __construct()
    {
        $tmp_db_obj = new DB();
        $this->dbh = $tmp_db_obj->dbh;
    }

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

    public function getUserByEmail($email)
    {
        $sth = $this->dbh->prepare("
        SELECT * FROM User
        WHERE email=:email
        ");

        $sth->execute(array(":email" => $email));

        return $sth->fetch();
    }

    public function getUserIfPasswordVerify($email, $password)
    {
        $user = $this->getUserByEmail($email);
        if ($user) {
            if (password_verify($password, $user['password_hash'])) {
                return $user;
            }
        }

        return false;
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
