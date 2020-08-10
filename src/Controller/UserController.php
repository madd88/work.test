<?php


namespace App\Controller;

use App\Model\User;
use App\Traits\Form;
use App\System\Session;

class UserController extends BaseController
{
    use Form;

    private $UserModel = null;

    public function __construct()
    {
        $this->UserModel = new User();
    }

    /**
     * Авторизация пользователя
     */
    public function auth()
    {
        if ($_POST) {
            $User = $this->UserModel->getUserIfExists($_POST['login'], $_POST['password']);
            if ( ! $User) {
                self::render('User/auth', ['errors'=> ['Пользователь не найден или неверный пароль.']]);
                exit;
            }

            $this->logIn($User->id, $User->login, $User->email, $User->full_name);
            header('Location: /user/profile');
        }

        self::render('User/auth', []);
    }

    /**
     * Регистрация пользователя
     */
    public function registration()
    {
        if ($_POST && $this->validateRegisterForm($_POST)) {
            $this->clearForm($_POST);
            if ($this->UserModel->getUserByLogin($_POST['login']) > 0) {
                self::render('User/registration', ['errors' => ['Такой пользователь уже существует.']]);
            } elseif ( ! $this->UserModel->add($_POST)) {
                self::render('User/registration', ['errors' => ['Ошибка при добавлении пользователя.']]);
            } else {
                header('Location: /user/auth?&message=Регистрация успешно завершена');
            }
        } else {
            self::render('User/registration', []);
        }
    }

    /**
     * Запись данных пользователя в сессию при авторизации
     *
     * @param int $userId
     * @param string $userLogin
     * @param string $userEmail
     * @param string $userFullName
     * @return bool
     */
    public static function logIn(int $userId, string $userLogin, string $userEmail, string $userFullName)
    : bool {
        Session::init();
        session_regenerate_id(true);

        $_SESSION = [];

        Session::set('user_id', $userId);
        Session::set('user_login', $userLogin);
        Session::set('user_email', $userEmail);
        Session::set('user_full_name', $userFullName);
        Session::set('user_logged_in', true);

        Session::updateSessionId($userId, session_id());

        return true;
    }

    /**
     * Профиль пользователя
     */
    public function profile()
    {
        if ( ! Session::userIsLoggedIn()) {
            $this->error403();
        }

        $User = $this->UserModel->getUserByLogin(Session::get('user_login'));
        $this->clearForm($_POST);
        if ($_POST) {
            if (
                isset($_POST['password'])
                && (empty($_POST['password']) || $this->UserModel->genPassword(
                        $_POST['password']
                    ) === $User->password)) {
                unset($_POST['password']);
            }
            if ($this->validateProfileForm($_POST)) {
                if ($this->UserModel->update($_POST)) {
                    self::logIn(
                        (int)Session::get('user_id'),
                        Session::get('user_login'),
                        Session::get('user_email'),
                        $_POST['full_name'],
                    );
                    self::render(
                        'User/profile',
                        [
                            'messages' => ['Профиль обновлен.'],
                            'full_name' => $_POST['full_name'],
                            'login' => Session::get('user_login'),
                            'email' => Session::get('user_email')
                        ]
                    );
                } else {
                    self::render('User/profile', ['errors' => ['Ошибка обновления данных.']]);
                }
            }
        } else {
            self::render(
                'User/profile',
                [
                    'full_name' => Session::get('user_full_name'),
                    'login' => Session::get('user_login'),
                    'email' => Session::get('user_email'),
                ]
            );
        }
    }

    /**
     * Выход из системы
     */
    public function logOut()
    {
        Session::updateSessionId(Session::get('user_id'));
        Session::destroy();
        header('Location: /');
    }
}