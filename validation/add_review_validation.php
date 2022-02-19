<?php

namespace App\Validator;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

require 'vendor/autoload.php';

class ReviewValidator
{
    public function getConstraints()
    {
        return new Assert\Collection([
            'title' => [
                new Assert\NotBlank(['message' => "Добавьте название фильмы\n"]),
                new Assert\Length([
                    'max' => 150,
                    'maxMessage' => "Длина названия должна быть не более {{ limit }} символов\n",
                ]),
            ],
            'original_title' => [
                new Assert\Length([
                    'max' => 150,
                    'maxMessage' => "Длина оригинального названия должна быть не более {{ limit }} символов\n",
                ])
            ],
            'release_year' => [
                new Assert\NotBlank(['message' => "Добавьте год выхода\n"]),
                new Assert\GreaterThanOrEqual([
                    'value' => 1895,
                    'message' => "Год выхода не может быть меньше {{ compared_value }}\n"
                ]),
            ],
            'trailer_code' => [
                new Assert\Length([
                    'max' => 1000,
                    'maxMessage' => "Длина встроенного кода ролика не может превышать {{ length }}\n"
                ])
            ],
            'text_post' => [
                new Assert\NotBlank(['message' => "Добавьте текст обзора\n"])
            ],
            'is_publish' => [],
            'rating' => [
                new Assert\GreaterThanOrEqual([
                    'value' => 0,
                    'message' => "Оценка не может быть меньше 0"
                ]),
                new Assert\LessThanOrEqual([
                    'value' => 10,
                    'message' => "Оценка не может быть больше 10"
                ])
            ]
        ]);
    }

    public function validate($data)
    {
        var_dump($data);
        $validator = Validation::createValidator();
        $constraints = $this->getConstraints();
        $violations = $validator->validate($data, $constraints);

        $errors = [];
        if (0 !== count($violations)) {
            foreach ($violations as $violation) {
                $errors[] = $violation->getMessage();
            }
        }
        return $errors;
    }
}
