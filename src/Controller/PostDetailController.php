<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

use App\Controller\BaseController;
use App\Models\Post;
use App\Auth\Utils;
use App\Models\Comment;

class PostDetailController extends BaseController
{
    public function show(array $parameters): Response
    {
        $user = Utils::getUserIfUserLogged();
        $post_obj = new Post();
        $post_id = (int) $_GET['post-id'];
        $post = $post_obj->getPostById($post_id);

        $comment_obj = new Comment();
        $comments = $comment_obj->getAllActiveComments($post_id);

        $params = ['post' => $post,
                   'comments' => $comments,
                   'user' => $user];

        return $this->renderTemplate('detail.php', $params);
    }
}
