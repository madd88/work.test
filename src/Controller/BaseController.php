<?php

namespace App\Controller;

use App\System\Session;

class BaseController
{

    /**
     * Главная страница
     */
    public function index()
    {
        $UserCtrl = new UserController();

        if ( ! Session::userIsLoggedIn()) {
            $UserCtrl->auth();
        } else {
            header('Location: /user/profile');
        }
    }

    /**
     * Рендер шаблона с параметрами
     *
     * @param $name   - Имя шаблона
     * @param $params - параметры шаблона
     */
    public static function render($name, $params = []) {

        extract($params, EXTR_SKIP);
        $template = __DIR__."/../View/" . $name . ".php";
        if (is_readable($template)) {
            require_once __DIR__ . '/../View/MainLayout.php';
        } else {
            echo $template . ' Not Found';
        }
    }

    public function error403()
    {
        http_response_code(403);
        echo 'Доступ запрещен';
        exit;
    }

}