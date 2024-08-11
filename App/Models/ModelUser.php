<?php

namespace App\Models;

use \Core\Model;

class ModelUser extends Model
{

    private \PDO $db;

    public function __construct()
    {
        $this->db = new \PDO("mysql:host=db;dbname=php_docker", "php_docker", "password");
    }

    public function getList($sort = null)
    {

    }

    public function add(array $data): bool|array
    {
        try {
            $sql = "SELECT * FROM users WHERE email=:email";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":email", $data["email"]);
            $stmt->execute();

            if ($stmt->rowCount()) {
                return ["success" => false, "message" => "Данный Email уже зарегистрирован"];
            }

            $sql = "INSERT INTO `users` (`email`, `password`) VALUES (:email, :password)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":email", $data["email"]);
            $stmt->bindValue(":password", password_hash($data["password"], PASSWORD_BCRYPT, ["cost" => 12]));
            $stmt->execute();
            $stmt->errorInfo();
            return ["success" => true];
        } catch (\PDOException $e) {
            file_put_contents(__DIR__ . '/logDB.txt', $e->getMessage() . PHP_EOL, FILE_APPEND);
            return false;
        }
    }

    public function login(array $data): array
    {
        try {
            $sql = "SELECT * FROM users WHERE email=:email";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":email", $data["email"]);
            $stmt->execute();

            if (!$stmt->rowCount()) {
                return ["success" => false, "message" => "Пользователь не найден"];
            }
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);
            // проверяем пароль
            if (password_verify($data['password'], $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                return ["success" => true];
            } else {
                return ["success" => false, "message" => "Неверный пароль"];
            }
        } catch (\PDOException $e) {
            file_put_contents(__DIR__ . '/logDB.txt', $e->getMessage() . PHP_EOL, FILE_APPEND);
            return ["success" => false, "message" => "Ошибка базы данных"];
        }
    }

    public function getUserEmailById(int $id): string|bool
    {
        try {
            $sql = "SELECT * FROM users WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC)["email"];
        } catch (\PDOException $e) {
            file_put_contents(__DIR__ . '/logDB.txt', $e->getMessage() . PHP_EOL, FILE_APPEND);
            return false;
        }
    }
}