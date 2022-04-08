<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

use App\Controller\BaseController;
use App\Models\Post;
use App\Auth\Utils;
use App\Validation\FormValidator;
use App\Models\Comment;
use App\Validation\CommentValidation;

class CreateCommentController extends BaseController
{
    public function create(array $parameters): Response
    {
        Utils::redirectIfUserNotLogged();
        $session = new Session();
        if (!$session->getId()) {
            $session->start();
        }
        $data = $this->request->request->all();

        if (!empty($data)) {
            $comment_validator = new FormValidator(CommentValidation::$comment_rules, CommentValidation::$comment_messages, $data);
            $comment_validator->validate();
            $errors = $comment_validator->getErrorMessages();

            if (empty($errors)) {
                $comment_obj = new Comment();
                $comment_id = $comment_obj->insertNewCommentAndReturnItId((int) $data['post_id'], $data['text'], (int) $session->get('user_id'));

                $comment = $comment_obj->getCommentById($comment_id);

                if ($comment) {
                    $response_data = [
                        "response" => "OK",
                        "comment" => [
                            "date_time" => $comment['date_time'],
                            "user"     => $comment['name'],
                            "avatar"   => $comment['avatar'],
                        ]
                    ];
                } else {
                    array_push($errors, "Не получилось создать комментарий");
                }
            }

            if (!empty($errors)) {
                $response_data = ["errors" => $errors];
            }
        } else {
            $response_data = ["errors" => "Нет переданных данных!!"];
        }

        $response = new Response();
        $response->setContent(json_encode($response_data))->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
