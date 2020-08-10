<?php

/**
 * Класс работы с БД
 *
 * PHP version 7.3
 *
 * @author   Aleksei Nikolaev <madd.niko@gmail.com>
 */

namespace App\Model;


class DB
{
    private static $instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * Подключение к БД
     *
     * @return \PDO
     */
    public static function getInstance()
    {
        if ( ! isset(self::$instance)) {
            try {
                self::$instance = new \PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_LOGIN, DB_PASSWORD);
            } catch (\PDOException  $error) {
                throw new \PDOException('Ошибка подключения к базе данных');
            }
        }

        return self::$instance;
    }
}