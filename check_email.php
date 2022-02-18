<?php

require_once "models/models.php";

if (array_key_exists("email", $_GET) && $_GET["email"]) {
    $user_obj = new User();
    $isFree = $user_obj->isEmailFree($_GET['email']) ? 'OK' : 'TAKEN';

    echo $isFree;
}
