<?php

/**
 * Класс работы с сессиями
 *
 * PHP version 7.3
 *
 * @author   Aleksei Nikolaev <madd.niko@gmail.com>
 */

namespace App\System;

use App\Model\DB;

class Session
{

    /**
     * Инициализация сессии, если ее нет
     */
    public static function init()
    {
        if (session_id() == '') {
            session_start();
        }
    }

    /**
     * Добавить значение в сессию
     *
     * @param $key
     * @param $value
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }


    /**
     * Получить значение по ключу
     *
     * @param $key
     * @return mixed
     */
    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }

    /**
     * Уничтожить сессию
     */
    public static function destroy()
    {
        session_destroy();
    }

    /**
     * Обновить поле session_id в БД для пользователя
     *
     * @param $userId
     * @param null $sessionId
     */
    public static function updateSessionId($userId, $sessionId = null)
    {
        $sql =
            " UPDATE users "
            . " SET session_id = :session_id "
            . " WHERE user_id = :user_id";

        $query = DB::getInstance()->prepare($sql);
        $query->execute([':session_id' => $sessionId, ":user_id" => $userId]);
    }

    /**
     * Проверка, залогинен ли пользователь
     *
     * @return bool
     */
    public static function userIsLoggedIn()
    {
        return (self::get('user_logged_in') ? true : false);
    }
}