<?php


namespace App\System;


class CSRF
{
    /**
     * Формирование csrf токена
     *
     * @return mixed
     */
    public static function makeToken()
    {
        $max_time = 60 * 60 * 24;
        $stored_time = Session::get('csrf_token_time');
        $csrf_token = Session::get('csrf_token');

        if ($max_time + $stored_time <= time() || empty($csrf_token)) {
            Session::set('csrf_token', md5(uniqid(rand(), true)));
            Session::set('csrf_token_time', time());
        }

        return Session::get('csrf_token');
    }


    /**
     * Проверка токена
     *
     * @return bool
     */
    public static function isTokenValid()
    {
        $token = $_POST['csrf_token'];
        return $token === Session::get('csrf_token') && ! empty($token);
    }
}