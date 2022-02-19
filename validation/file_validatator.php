<?php

namespace App\Validator;

class FileValidator
{
    protected string $filename;
    protected array $mime_types;
    protected array $errors = [];

    public function __construct(string $filename, array $mime_types, int $max_size_mb)
    {
        $this->filename = $filename;
        $this->mime_types = $mime_types;
        $this->max_size_mb = $max_size_mb;
    }

    public function notBlank()
    {
        if (array_key_exists($this->filename, $_FILES) && $_FILES[$this->filename]['size'] === 0) {
            array_push($this->errors, "Не загружен файл\n");
        }
    }

    public function checkMimeType()
    {
        $is_ok_type = false;
        foreach ($this->mime_types as $type) {
            if ($_FILES[$this->filename]['type'] === $type) {
                $is_ok_type = true;
                break;
            }
        }

        if (!$is_ok_type) {
            array_push($this->errors, "Файл неправильного типа\n");
        }
    }

    public function checkMaxSize()
    {
        $file_size = $_FILES[$this->filename]['size'];
        if ($file_size > $this->max_size_mb * 1_000_000) {
            array_push($this->errors, "Размер файла превышает максимальный раземр в " . $this->max_size_mb . " мегабайт\n");
        }
    }

    public function validate()
    {
        $this->notBlank();
        $this->checkMimeType();
        $this->checkMaxSize();
        return $this->errors;
    }
}
