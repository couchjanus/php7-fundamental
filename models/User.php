<?php

/**
 * Модель для работы с пользователями
*/

class User
{
   
    private $role;

    public static function index()
    {
        $con = Connection::makeConnection();
        $sql = "SELECT * FROM users ORDER BY id ASC";
        $res = $con->query($sql);
        $users = $res->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    public static function store($options)
    {

        $db = Connection::makeConnection();

        $sql = "INSERT INTO users(name, email, password, role_id)
                VALUES(:name, :email, :password, :role)";

        $res = $db->prepare($sql);
        $res->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $res->bindParam(':email', $options['email'], PDO::PARAM_STR);
        // generate new password
        $hash = password_hash($options['password'], PASSWORD_DEFAULT, ["cost" => 12]);
        $res->bindParam(':password', $hash, PDO::PARAM_STR);
        $res->bindParam(':role', $options['role'], PDO::PARAM_INT);
        return $res->execute();
    }

    /**
     * Вытягиваем информацию о пользователе по id
     *
     * @param $userId
     * @return mixed
     */
    public static function getUserById($userId)
    {

        $db = Connection::makeConnection();
        $sql = "SELECT *
                  FROM users
                    WHERE id = :id
                ";

        $res = $db->prepare($sql);
        $res->bindParam(':id', $userId);
        $res->execute();
        $user = $res->fetch(PDO::FETCH_ASSOC);
        return $user;
    }


    public static function update($userId, $options)
    {

        $db = Connection::makeConnection();

        $sql = "SELECT password FROM users WHERE id = :userId";

        $res = $db->prepare($sql);
        $res->bindParam(':userId', $userId, PDO::PARAM_INT);
        $res->execute();

        $passwordFromDatabase = $res->fetch(PDO::FETCH_ASSOC)['password'];

        $password = $options['password'];

        if (!password_verify($password, $passwordFromDatabase)) {
          // update hash from databse - replace old hash $passwordFromDatabase with new hash $newPasswordHash
            $password = password_hash($options['password'], PASSWORD_DEFAULT, ["cost" => 12]);
        }

        $sql = "UPDATE users
                    SET name = :name, password = :password, email = :email, role_id = :role, status = :status
                      WHERE id = :id
               ";

        $res = $db->prepare($sql);

        $res->bindParam(':password', $password, PDO::PARAM_STR);

        $res->bindParam(':name', $options['name'], PDO::PARAM_STR);

        $res->bindParam(':email', $options['email'], PDO::PARAM_STR);
        $res->bindParam(':role', $options['role'], PDO::PARAM_INT);
        
        $status = $options['status']? 1:0;
        $res->bindParam(':status', $status, PDO::PARAM_INT);
        $res->bindParam(':id', $userId, PDO::PARAM_INT);

        return $res->execute();
    }

    // check if user has a specific privilege
    
    public function hasPrivilege($perm)
    {
        if ($this->role->hasPerm($perm)) {
            return true;
        }
        return false;
    }
      
    /**
     * Если в контроллере все ОК, принимаем данные и записываем в БД
     * Регистрация пользователя
     * @param $name имя
     * @param $email email
     * @param $password пароль
     * @return bool  возвращает true/false
     */
    public static function register($name, $email, $password)
    {

        $db = Connection::makeConnection();

        $sql = "INSERT INTO users(name, email, password)
                VALUES(:name, :email, :password)
                ";

        $res = $db->prepare($sql);
        $res->bindParam(':name', $name, PDO::PARAM_STR);
        $res->bindParam(':email', $email, PDO::PARAM_STR);
        $res->bindParam(':password', $password, PDO::PARAM_STR);

        return $res->execute();
    }

    /**
     * Проверяем поле name на корректность
     *
     * @param $name
     * @return bool
     */
    public static function checkName($name)
    {
        if (strlen($name) > 2) {
            return true;
        }
        return false;
    }


    /**
     * Проверяем поле Пароль на корректность
     *
     * @param $password
     * @return bool
     */
    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    /**
     * Проверяем поле Email на корректность
     *
     * @param $email
     * @return bool
     */
    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    /**
     * Проверем email на доступность
     *
     * @param $email
     * @return bool
     */
    public static function checkEmailExists($email)
    {

        $db = Connection::makeConnection();

        $sql = "SELECT count(*) FROM users
                    WHERE email = :email
               ";

        $res = $db->prepare($sql);
        $res->bindParam(':email', $email, PDO::PARAM_STR);
        $res->execute();

        if ($res->fetchColumn())
            return true;
        return false;
    }

    public static function checkPhoneNumber($id)
    {
        $db = Connection::makeConnection();
        $sql = "SELECT phone_number FROM users
                    WHERE id = :id";
        $res = $db->prepare($sql);
        $res->bindParam(':id', $id, PDO::PARAM_INT);
        $res->execute();

        if ($res->fetchColumn())
            return $res->fetchColumn();
        return false;
    }

    /**
     * Проверка на существовние введенных данных при ааторизации
     *
     * @param $email
     * @param $password
     * @return bool
     */
    public static function checkUserData($email, $password)
    {

        $db = Connection::makeConnection();

        $sql = "SELECT *
                FROM users
                WHERE email = :email
                ";

        $res = $db->prepare($sql);

        $res->bindParam(':email', $email, PDO::PARAM_INT);

        $res->execute();

        $user = $res->fetch();

        if (password_verify($password, $user['password'])) {
            return $user['id'];
        }
        return false;
    }

    /**
     *Запись пользователя в сессию
     *
     * @param $userId
     */
    public static function auth($userId)
    {
        Session::set('userId', $userId);
        Session::set('logged', true);
    }

    /**
     * Проверяем, авторизован ли пользователь при переходе в личный кабинет
     *
     * @return mixed
     */
    public static function checkLog()
    {
         //Если сессия есть, то возвращаем id пользователя
        if ((Session::get('userId'))) {
            return Session::get('userId');
        }
        header('Location: user/login');
    }

    /**
     * Проверяем наличие открытой сессии у пользователя для
     * отображения на сайте необходимой информации
     *
     * @return bool
     */
    public static function isGuest()
    {
        if (Session::get('logged') == true) {
            return false;
        }
        return true;
    }

    /**
     * Destroy информацию о пользователе по id
     *
     * @param $userId
     * @return mixed
     */
    public static function destroy($userId)
    {
        $db = Connection::makeConnection();
        $sql = "DELETE 
                FROM users
                WHERE id = :id
                ";
        $res = $db->prepare($sql);
        $res->bindParam(':id', $userId);
        $res->execute();
    }


    public static function updateProfile($userId, $options)
    {
        $db = Connection::makeConnection();
        $sql = "UPDATE users
                    SET phone_number = :phone_number, first_name = :first_name, last_name = :last_name
                    WHERE id = :id";
        $res = $db->prepare($sql);
        // $res->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $res->bindParam(':phone_number', $options['phone_number'], PDO::PARAM_STR);
        $res->bindParam(':first_name', $options['first_name'], PDO::PARAM_STR);
        $res->bindParam(':last_name', $options['last_name'], PDO::PARAM_STR);
        $res->bindParam(':id', $userId, PDO::PARAM_INT);
        return $res->execute();
    }
    
}
