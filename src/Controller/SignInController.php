<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

use App\Controller\BaseController;
use App\Auth\Utils;
use App\Validation\FormValidator;
use App\Validation\SignInValidation;
use App\Models\User;

class SignInController extends BaseController
{
    public function signIn(array $parameters): Response
    {
        Utils::redirectIfUserLogged();

        $data = $this->request->request->all();

        $validation_obj = new FormValidator(SignInValidation::$sign_in_rules, SignInValidation::$sign_in_messages, $data);
        $validation_obj->validate();

        $errors = $validation_obj->getErrorMessages();

        if (empty($errors)) {
            $user_obj = new User();
            $user = $user_obj->getUserIfPasswordVerify($data['email'], $data['password']);

            $session = new Session();
            if ($user) {
                if (!$session->getId()) {
                    $session->start();
                }

                $session->set('user_id', $user['user_id']);
            } else {
                array_push($errors, "Неверный логин или пароль");
            }
        }

        if (!empty($errors)) {
            $response_data = ["errors" => $errors];
        } else {
            $response_data = ["response" => "OK"];
        }

        $response = new Response();
        $response->setContent(json_encode($response_data))->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
