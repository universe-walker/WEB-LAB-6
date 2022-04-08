<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

use App\Controller\BaseController;
use App\Models\User;
use App\Auth\Utils;
use App\Validation\FormValidator;
use App\Validation\SignUpValidation;

class SignUpController extends BaseController
{
    public function signUp(array $parameters): Response
    {
        Utils::redirectIfUserLogged();

        $session = new Session();
        $data = $this->request->request->all();
        $validation_obj = new FormValidator(SignUpValidation::$sign_up_rules, SignUpValidation::$sign_up_messages, $data);
        $validation_obj->validate();

        $errors = $validation_obj->getErrorMessages();

        if (!$errors) {
            $user_obj = new User();

            if ($user_obj->isEmailFree($data['email'])) {
                $save_result = $user_obj->save($data['name'], $data['email'], $data['phone'], $data['password']);

                if ($save_result) {
                    $session->set('user_id', $user_obj->getUserIdByEmail($data['email']));
                } else {
                    array_push($errors, "Не удалось создать пользователя");
                }
            } else {
                array_push($errors, "Пользователь с таким email уже существует");
            }
        }

        if (!empty($errors)) {
            $response_data = ["errors" => $errors];
        } else {
            $response_data = ['response' => 'OK'];
        }

        $response = new Response();
        $response->setContent(json_encode($response_data))->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
