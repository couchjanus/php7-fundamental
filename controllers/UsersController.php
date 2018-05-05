<?php

/**
 * Class UserController для работы с пользователем
 */

class UsersController extends Controller
{
    protected $userId;
    protected $user;

    /**
     * Class UserController для работы с пользователем
    */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Регистрация пользователя
     *
     * @return bool
     */
    public function signup()
    {

        $result = false;
        $name = '';
        $email = '';
        $password = '';

        if (isset($_POST) and (!empty($_POST))) {

            $name = trim(strip_tags($_POST['name']));
            $email = trim(strip_tags($_POST['email']));
            $password = trim(strip_tags($_POST['password']));

            //Флаг ошибок
            $data['errors'] = false;

            //Валидация полей
            if (!User::checkName($name)) {
                $data['errors'][] = "Имя не может быть короче 2-х символов";
            }

            if (!User::checkEmail($email)) {
                $data['errors'][] = "Некорректный Email";
            }

            if (!User::checkPassword($password)) {
                $data['errors'][] = "Пароль не может быть короче 6-ти символов";
            }

            if (User::checkEmailExists($email)) {
                $data['errors'][] = "Такой email уже используется";
            }

            if ($data['errors'] == false) {
                $result = User::register($name, $email, password_hash($password, PASSWORD_DEFAULT));

                header("Location: /login");
            }
        }

        $data['success'] = $result;
        $data['title'] = 'Signup Page ';
        
        $this->_view->render('user/signup', $data);

    }


    public function actionCheck()
    {
        if (!Session::get('logged') == true) {
            $response = array(
                    'r' => 'fail',
                    'url' => 'login'
                );
        } else {
   
            $this->userId = User::checkLog();
            $this->user = User::getUserById($this->userId);

            $response = array(
                'phone_number' => $this->user['phone_number'],
                'last_name' => $this->user['last_name'],
                'first_name' => $this->user['first_name']
            );
        }

        echo json_encode($response);
        exit;
    }

    /**
     * Авторизация пользователя
     *
     * @return bool
     */
    public function login()
    {

        $email = '';
        $password = '';

        if (Session::get('logged') == true) {
            header("Location: /profile"); //перенаправляем в личный кабинет
        }

        if (isset($_POST) and (!empty($_POST))) {

            $email = trim(strip_tags($_POST['email']));
            $password = $_POST['password'];

            //Флаг ошибок
            $data['errors'] = false;

            //Валидация полей
            if (!User::checkEmail($email)) {
                $data['errors'][] = "Некорректный Email";
            }

            //Проверяем, существует ли пользователь
            $userId = User::checkUserData($email, $password);

            if ($userId == false) {
                $data['errors'][] = "Пользователя с таким email или паролем не существует";
            } else {
                $this->user = User::getUserById($userId);

                User::auth($userId); //записываем пользователя в сессию

                header("Location: /profile"); //перенаправляем в личный кабинет
            }
        }
        $data['title'] = 'Login Page ';

        $this->_view->render('user/login', $data);

    }

    /**
     * Выход из учетной записи
     *
     * @return bool
     */
    public function logout()
    {
        Session::destroy();
        header('Location: /');
        return true;
    }
}
