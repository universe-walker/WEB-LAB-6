<?php

namespace App\Auth;

use Symfony\Component\HttpFoundation\Session\Session;

use App\Models\User;

class Utils
{
    public static function redirectIfUserLogged(string $user_var='user_id', string $redirect_to='/'): void
    {
        $session = new Session();
        if (!$session->getId()) {
            $session->start();
        }

        if ($session->has($user_var)) {
            header("Location: " . $redirect_to);
        }
    }

    public static function getUserIfUserLogged(): array|false
    {
        $session = new Session();
        if (!$session->getId()) {
            $session->start();
        }

        if ($session->has('user_id')) {
            $user_id = (int) $session->get('user_id');
            $user_obj = new User();
            return $user_obj->getUserById($user_id);
        }

        return false;
    }

    public static function redirectIfUserNotLogged(string $user_var='user_id', string $redirect_to='/'): void
    {
        $session = new Session();
        if (!$session->getId()) {
            $session->start();
        }

        if (!$session->has($user_var)) {
            header("Location: " . $redirect_to);
        }
    }
}
