<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

use App\Controller\BaseController;
use App\Models\Post;
use App\Auth\Utils;

class MainController extends BaseController
{
    public function show(array $parameters): Response
    {
        $user = Utils::getUserIfUserLogged();
        $post_obj = new Post();
        $posts = $post_obj->getActivePostsWithOffset(0)->fetchAll();
        return $this->renderTemplate('index.php', ['user' => $user, 'posts' => $posts]);
    }

    public function morePosts(array $parameters): Response
    {
        if (!array_key_exists('page', $_GET)) {
            exit();
        }
        $page_num = (int)$_GET['page'];

        $posts_per_page = parse_ini_file('config/site.ini')['posts_per_page'];
        if (!$posts_per_page) {
            $posts_per_page = 2;
        }

        $offset = $page_num * $posts_per_page;

        $post_obj = new Post();
        $posts = $post_obj->getActivePostsWithOffset($offset);
        return $this->renderTemplate('review_items_loader.php', ['posts' => $posts]);
    }
}
