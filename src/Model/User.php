<?php

/**
 * Класс работы с пользователями
 *
 * PHP version 7.3
 *
 * @author   Aleksei Nikolaev <madd.niko@gmail.com>
 */


namespace App\Model;


use App\System\Session;

class User extends Core
{
    public $id;
    public $login;
    public $full_name;
    public $email;

    private $password;


    /**
     * Добавление нового пользователя
     *
     * @param $params
     * @return bool
     */
    public function add($params)
    : bool {
        $params['password'] = $this->genPassword($params['password']);

        $sql =
            " INSERT INTO users (full_name, email, login, password) "
            . " VALUES (:full_name, :email, :login, :password)";
        $query = $this->DB->prepare($sql);

        return $query->execute($params);
    }

    /**
     * Получение данных пользователя по логину
     * @param $login
     * @return int|bool
     */
    public function getUserByLogin($login)
    {
        $sql =
            " SELECT * FROM users "
            . " WHERE login = :login ";
        $query = $this->DB->prepare($sql);
        $query->execute([':login' => $login]);

        return $query->rowCount();
    }

    /**
     * Получение данных пользователя, если он зарегистрирован
     *
     * @param string $login
     * @param string $password
     * @return User|bool
     */
    public function getUserIfExists(string $login, string $password)
    {
        $sql =
            " SELECT * FROM users "
            . " WHERE login = :login AND password = :password ";

        $query = $this->DB->prepare($sql);
        $query->execute(
            [
                ':login' => $login,
                ':password' => $this->genPassword($password)
            ]
        );

        return $query->fetchObject(__CLASS__);
    }

    /**
     * Генератор хэша пароля
     *
     * @param $password
     * @return string
     */
    public function genPassword($password)
    {
        return md5(md5($password . SECRET));
    }

    /**
     * Обновление данных пользователя
     *
     * @param array $params - full_nam, password
     * @return bool
     */
    public function update(array $params)
    {
        $sql =
            " UPDATE users " .
            " SET full_name = :full_name ";
        if (isset($params['password'])) {
            $params['password'] = $this->genPassword($params['password']);
            $sql .= ', password = :password ';
        }

        $sql .= ' WHERE id = ' . Session::get('user_id');

        $query = $this->DB->prepare($sql);
        return $query->execute($params);
    }
}