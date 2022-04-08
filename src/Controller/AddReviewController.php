<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

use App\Controller\BaseController;
use App\Models\Post;
use App\Auth\Utils;
use App\Validation\FileValidator;
use App\Validation\ReviewValidator;

class AddReviewController extends BaseController
{
    public function show(array $parameters): Response
    {
        Utils::redirectIfUserNotLogged();
        $user = Utils::getUserIfUserLogged();

        $session = new Session();
        $errors = $session->get('errors') ?? array();

        return $this->renderTemplate('add_review.php', ['errors' => $errors, 'user' => $user]);
    }

    public function create(array $parameters): mixed
    {
        Utils::redirectIfUserNotLogged();
        $user = Utils::getUserIfUserLogged();
        $session = new Session();

        $validator = new ReviewValidator();
        $errors = $validator->validate($this->request->request->all());

        $validator_poster = new FileValidator('poster', ['image/jpeg', 'image/png'], 1);
        $errors = array_merge($errors, $validator_poster->validate());

        $response = new Response();


        if (!empty($errors)) {
            $session->remove('errors');
            $session->set('errors', $errors);

            $response->headers->set('Location', 'write-review');
            exit();
        }

        $path_info = pathinfo($_FILES['poster']['name']);
        $ext = $path_info['extension'] ?? "";
        $new_path = $this->request->server->get('DOCUMENT_ROOT') . '/upload/' . uniqid() . "." . $ext;
        $from = $_FILES['poster']['tmp_name'];

        // получаем код встроенного видео
        $url_youtube = "https://www.youtube.com/oembed?url=" . $this->request->request->get('trailer_link') . "&format=json&maxwidth=560&maxheight=315";
        $ch = curl_init($url_youtube);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_tmp = json_decode(curl_exec($ch), true);
        curl_close($ch);

        $trailer_code = $response_tmp['html'];


        if (move_uploaded_file($from, $new_path)) {
            $post_obj = new Post();
            $new_post_id = $post_obj->addPost(
                $user['user_id'],
                htmlspecialchars($_POST['title']),
                htmlspecialchars($_POST['original_title']),
                $new_path,
                $trailer_code,
                htmlspecialchars($_POST['text_post']),
                htmlspecialchars((bool) $_POST['is_publish']),
                htmlspecialchars((int) $_POST['release_year']),
                htmlspecialchars((int) $_POST['rating'])
            );

            $response->headers->set('Location', 'detail?post-id=' . $new_post_id);
        } else {
            $session->remove('errors');
            $session->set('errors', "Не удалось загрузить файл\n");

            $response->headers->set('Location', 'write-review');
        }



        return $response;
    }
}
