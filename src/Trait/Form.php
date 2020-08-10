<?php

namespace App\Traits;

trait Form
{
    public function validateRegisterForm(array $params = [])
    : bool {
        $errors = [];

        if ( ! isset($params['full_name'])
            || empty(trim($params['full_name']))
            || mb_strlen(trim($params['full_name'])) > 250) {
            $errors[] = 'Поле ФИО должно содержать от 1 до 250 символов.';
        }
        if ( ! isset($params['email'])
            || empty(trim($params['email']))
            || mb_strlen(trim($params['email'])) > 55
            || mb_strlen(trim($params['email'])) < 5) {
            $errors[] = 'Поле Email должно содержать от 5 до 55 символов.';
        }
        if ( ! isset($params['login'])
            || empty(trim($params['login']))
            || mb_strlen(trim($params['login'])) > 250
            || mb_strlen(trim($params['login'])) < 5) {
            $errors[] = 'Поле Логин должно содержать от 1 до 55 символов.';
        }
        if ( ! isset($params['password'])
            || empty(trim($params['password']))
            || mb_strlen(trim($params['password'])) > 250
            || mb_strlen(trim($params['password'])) < 5) {
            $errors[] = 'Поле Пароль должно содержать от 5 до 55 символов.';
        }

        if (count($errors) > 0) {
            $this->render('User/registration', ['errors' => $errors]);
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param array $params
     */
    public function clearForm(array &$params = []) : void
    {
        foreach ($params as &$value){
            $value = trim($value);
            $value = stripslashes($value);
            $value = strip_tags($value);
            $value = htmlspecialchars($value);
        }
    }

    public function validateProfileForm($params)
    {
        $errors = [];

        if ( ! isset($params['full_name'])
            || empty(trim($params['full_name']))
            || mb_strlen(trim($params['full_name'])) > 250) {
            $errors[] = 'Поле ФИО должно содержать от 1 до 250 символов.';
        }

        if (count($errors) > 0) {
            $this->render('User/profile', ['errors' => $errors]);
            return false;
        } else {
            return true;
        }

    }
}