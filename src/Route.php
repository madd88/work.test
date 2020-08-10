<?php

/**
 * Класс работы с роутингом страниц
 *
 * PHP version 7.3
 *
 * @author   Aleksei Nikolaev <madd.niko@gmail.com>
 */

namespace App;

class Route
{
    public static function start()
    {
        $controller_name = 'Base';
        $action_name = 'index';

        $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        $routes = explode('/', parse_url($url, PHP_URL_PATH));

        if ( ! empty($routes[1])) {
            $controller_name = $routes[1];
        }
        if ( ! empty($routes[2])) {
            $action_name = $routes[2];
        }

        $controller_name = 'App\\Controller\\' . $controller_name . 'Controller';
        $controller = new $controller_name();
        $action = $action_name;

        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            echo 'Ошибка: ';
            var_dump($controller, $action);
        }
    }
}