<?php

function redirectIfUserLogged($user_var='user_id', $redirect_to='/')
{
    session_start();

    if (array_key_exists($user_var, $_SESSION)) {
        header("Location: " . $redirect_to);
    }
}

function getUserIfUserLogged()
{
    session_start();

    if (array_key_exists('user_id', $_SESSION)) {
        $user_id = (int) $_SESSION['user_id'];

        require_once "models/models.php";

        $user_obj = new User();
        return $user_obj->getUserById($user_id);
    }

    return false;
}

function redirectIfUserNotLogged($user_var='user_id', $redirect_to='/')
{
    session_start();
    
    if (!array_key_exists($user_var, $_SESSION)) {
        header("Location: " . $redirect_to);
    }
}
