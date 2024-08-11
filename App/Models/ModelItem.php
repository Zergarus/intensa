<?php

namespace App\Models;

use \Core\Model;

class ModelItem extends Model
{

    private \PDO $db;

    public function __construct()
    {
        $this->db = new \PDO("mysql:host=db;dbname=php_docker", "php_docker", "password");
    }

    public function getList($sort = null)
    {
        $arResult = [];
        try {
            switch ($sort) {
                case 'rate':
                    $sql = "SELECT * FROM items ORDER BY rating DESC";
                    break;
                case 'date':
                    $sql = "SELECT * FROM items ORDER BY date_create DESC";
                    break;
                default:
                    $sql = "SELECT * FROM items";
                    break;
            }
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                while ($arItem = $stmt->fetch()) {
                    $arResult["ITEMS"][] = [
                        "ID" => $arItem["id"],
                        "TITLE" => $arItem["title"],
                        "TITLE_DESCRIPTION" => $arItem["title_description"],
                        "PHOTO" => $arItem["photo"],
                        "RATING" => $arItem["rating"],
                    ];
                }
            }
        } catch (\PDOException $e) {
            file_put_contents(__DIR__ . '/logDB.txt', $e->getMessage() . PHP_EOL, FILE_APPEND);
        }

        return $arResult;
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