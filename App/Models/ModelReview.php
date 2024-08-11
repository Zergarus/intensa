<?php

namespace App\Models;

use \Core\Model;

class ModelReview extends Model
{

    private \PDO $db;

    public function __construct()
    {
        $this->db = new \PDO("mysql:host=db;dbname=php_docker", "php_docker", "password");
    }

    public function getList()
    {
    }

    public function getReviewsByItemId(int $id)
    {
        try {
            $sql = "SELECT * FROM reviews WHERE item_id = :item_id ORDER BY date_create DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":item_id", $id);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll();
            } else {
                return [];
            }
        } catch (\PDOException $e) {
            file_put_contents(__DIR__ . '/logDB.txt', $e->getMessage() . PHP_EOL, FILE_APPEND);
        }
    }

    public function getProductById(int $id): array|bool
    {
        try {
            $sql = "SELECT * FROM items WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":id", $id);
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            file_put_contents(__DIR__ . '/logDB.txt', $e->getMessage() . PHP_EOL, FILE_APPEND);
            return false;
        }
    }
}