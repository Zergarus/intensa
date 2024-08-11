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

    public function getList($sort = null){}

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

    public function add($data): array
    {
        try {
            $sql = "INSERT INTO `reviews` (`title`, `description`, `item_id`, `author_id`, `rate`, `date_create`) VALUES (:title, :description, :item_id, :author_id, :rate, :date_create)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":title", $data["title"]);
            $stmt->bindValue(":description", $data["description"]);
            $stmt->bindValue(":item_id", $data["item_id"]);
            $stmt->bindValue(":author_id", $data["author_id"]);
            $stmt->bindValue(":rate", $data["rate"]);
            $stmt->bindValue(":date_create", date("Y-m-d H:i:s"));
            $stmt->execute();
            $this->setItemAvgRating($data["item_id"]);
            return ["success" => true];
        } catch (\PDOException $e) {
            file_put_contents(__DIR__ . '/logDB.txt', $e->getMessage() . PHP_EOL, FILE_APPEND);
            return ["success" => false];
        }
    }
    public function update(array $data): array
    {
        if (\App\User::isLogin() != $data["author_id"]) {
            return ["success" => false];
        }
        try {
            $sql = "UPDATE reviews SET title = :title, description = :description, rate = :rate WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":title", $data["title"]);
            $stmt->bindValue(":description", $data["description"]);
            $stmt->bindValue(":rate", $data["rate"]);
            $stmt->bindValue(":id", $data["review_id"]);
            $stmt->execute();
            $this->setItemAvgRating($data["item_id"]);
            return ["success" => true];
        } catch (\PDOException $e) {
            file_put_contents(__DIR__ . '/logDB.txt', $e->getMessage() . PHP_EOL, FILE_APPEND);
            return ["success" => false];
        }
    }
    public function remove($data): array
    {
        try {
            $sql = "DELETE FROM reviews WHERE id=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":id", $data["id"]);
            $stmt->execute();
            $this->setItemAvgRating($data["item_id"]);
            return ["success" => true];
        } catch (\PDOException $e) {
            file_put_contents(__DIR__ . '/logDB.txt', $e->getMessage() . PHP_EOL, FILE_APPEND);
            return ["success" => false];
        }
    }

    public function setItemAvgRating(int $itemId)
    {
        $sql = "UPDATE items
                INNER JOIN (
                  SELECT item_id, AVG(rate) AS avg_rating
                  FROM reviews
                  GROUP BY item_id
                ) AS reviews ON items.id = reviews.item_id
                SET items.rating = reviews.avg_rating
                WHERE items.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":id", $itemId);
        $stmt->execute();
    }
}