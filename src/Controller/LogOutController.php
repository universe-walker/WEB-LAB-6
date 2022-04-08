<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

use App\Controller\BaseController;

class LogOutController extends BaseController
{
    public function logOut(array $parameters): Response
    {
        $session = new Session();
        if (!$session->getId()) {
            $session->start();
        }

        if ($session->has('user_id')) {
            $session->remove('user_id');
        }

        $next = $this->request->query->get('next');

        // $next = $_GET['next'];
        $response = new Response();
        $response->headers->set('Location', $next);
        // header("Location: " . $next);

        return $response;
    }
}
