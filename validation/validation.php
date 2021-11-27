<?php

require "exceptions.php";

class FormValidator
{
    protected $errors = [];

    public function __construct($rules, $messages, $data)
    {
        $this->checkMessagesAppropriate($rules, $messages);

        $this->rules = $rules;
        $this->messages = $messages;
        $this->data = $data;
    }

    protected function checkMessagesAppropriate($rules, $messages)
    {
        if (count($rules) !== count($messages)) {
            throw new FormValidatorExeption("Не совпадает количество полей правил с количеством полей сообщений");
        }

        // если отличаются поля для которых задаются правила и сообщения -> exc
        if (!empty(array_diff_key($rules, $messages))) {
            throw new FormValidatorExeption("Отличаются поля в правилах и сообщениях");
        }

        // если правила поля не находят соответствия с правилами ошибок -> exc
        foreach ($rules as $field => $field_rules) {
            if (!empty(array_diff_key($rules[$field], $messages[$field]))) {
                throw new FormValidatorExeption("Нет соотвествия сообщения правилу");
            }
        }
    }

    protected function switchValidationMethod($field, $field_rule, $rule_value)
    {
        try {
            switch ($field_rule) {
                case "required":
                    $this->required($field);
                    break;
                case "isTrue":
                    $this->isTrue($field);
                    break;
                case "maxLength":
                    $this->maxLength($field, $rule_value);
                    break;
                case "minLength":
                    $this->minLength($field, $rule_value);
                    break;
                case "passwordConfirmation":
                    $this->passwordConfirmation($field, $rule_value);
                    break;
                case "regexpCheck":
                    $this->regexpCheck($field, $rule_value);
                    break;
            }
        } catch (ValidatorException $e) {
            $error = $this->getErrorMessage($field, $field_rule);
            array_push($this->errors, $error);
        }
    }

    public function validate()
    {
        foreach ($this->rules as $field => $field_rules) {
            foreach ($field_rules as $field_rule => $rule_value) {
                $this->switchValidationMethod($field, $field_rule, $rule_value);
            }
        }
    }

    protected function required($field_name)
    {
        if (!array_key_exists($field_name, $this->data) || !$this->data[$field_name]) {
            throw new ValidatorException();
        }
    }

    protected function isTrue($field_name)
    {
        if ($this->data[$field_name] === "true" || $this->data[$field_name] === true) {
            return;
        }
        throw new ValidatorException();
    }

    protected function maxLength($field_name, $rule_value)
    {
        if (mb_strlen($this->data[$field_name]) > $rule_value) {
            throw new ValidatorException();
        }
    }

    protected function minLength($field_name, $rule_value)
    {
        if (mb_strlen($this->data[$field_name]) < $rule_value) {
            throw new ValidatorException();
        }
    }

    protected function passwordConfirmation($field_name, $rule_value)
    {
        $password = $this->data[$field_name];
        $password_repeat = $this->data[$rule_value];
        if ($password !== $password_repeat) {
            throw new ValidatorException();
        }
    }

    protected function regexpCheck($field_name, $rule_value)
    {
        if (!preg_match($rule_value, $this->data[$field_name])) {
            throw new ValidatorException();
        }
    }

    protected function getErrorMessage($field_name, $rule)
    {
        return $this->messages[$field_name][$rule];
    }

    public function getErrorMessages()
    {
        return $this->errors;
    }
}
