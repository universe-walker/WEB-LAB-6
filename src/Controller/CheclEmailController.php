<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

use App\Controller\BaseController;
use App\Models\User;

class AddReviewController extends BaseController
{
    public function show(array $parameters): Response
    {
        $session = new Session();
        if ($this->request->query->has('email') && $this->request->query->get('email')) {
            $user_obj = new User();
            $isFree = $user_obj->isEmailFree($_GET['email']) ? 'OK' : 'TAKEN';

            $response = new Response();
            $response->setContent(json_encode($response))->headers->set('Content-Type', 'application/json');
            return $response;
        }
    }
}
