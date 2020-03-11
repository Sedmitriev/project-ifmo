<?php
namespace Sedmit\Ronda\Models;

use Exception;
use Sedmit\Ronda\Core\DBConnection;

class LoginModel
{
    private $db;
    const USER_EXISTS = "Пользователь с таким логином уже существует";
    const REGISTRATION_FAILED = "Регистрация не удалась. Попробуйте еще раз";
    const REGISTRATION_SUCCESS = "Пользователь успешно зарегистрирован";
    const SUCCESS = "Авторизация прошла успешно";
    const ERROR = "Ошибка авторизвции";

    public function __construct()
    {
        $this->db = DBConnection::getInstance();
    }

    public function addUser(array $user_data) {
        $login = $user_data['users_login'];
        if ($this->isUser($login)) return;
        // password_hash()
        $pwd = $user_data['users_password'];
        $pwd = password_hash($pwd, PASSWORD_DEFAULT);
        $user_sql = "INSERT INTO users (users_login, users_password) VALUES (:login, :password)";
        $user_info_sql = "INSERT INTO users_info (fio, position, users_id) VALUES (:fio, :position, :user_id)";
        try {
            $this->db->getConnection()->beginTransaction();
            $user_params = [
                "login" => $login,
                "password" => $pwd
            ];
            $this->db->executeSql($user_sql, $user_params);

            $user_info_params = [
                "fio" => $user_data['users_fio'],
                "position" => $user_data['users_position'],
                "user_id" => $this->db->getConnection()->lastInsertId()
            ];

            $this->db->executeSql($user_info_sql, $user_info_params);

            $this->db->getConnection()->commit();
            return self::REGISTRATION_SUCCESS;

        } catch(Exception $e) {
            $this->db->getConnection()->rollBack();
            return self::REGISTRATION_FAILED;
        }
    }

    public function login(array $formData)
    {
        $login = $formData['users_login'];
        $pwd = $formData['users_password'];
        $user = $this->isUser($login);
        if(!$user) {
            return self::ERROR;
        }
        if(!password_verify($pwd, $user['users_password'])) {
            return self::ERROR;
        }
        return self::SUCCESS;
    }

    private function isUser(string $login) {
        // проверка уникальности логина
        
        $sql = "SELECT * FROM users WHERE users_login = :login";
        $user = $this->db->execute($sql, ["login" => $login], false);
        //var_dump($user);
        return $user;
    }
}