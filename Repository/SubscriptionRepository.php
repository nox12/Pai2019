<?php

require_once "Repository.php";
require_once __DIR__.'//..//Model//Subscription.php';

class SubscriptionRepository extends Repository {
    public function getSubs(int $id): array {
        $subs = [];
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM subscription WHERE id_parking = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();

        while($data = $stmt->fetch(PDO::FETCH_ASSOC)){
            $temp = new Subscription(
                $data['id_subscription'],
                $data['id_parking'],
                $data['name'],
                $data['duration'],
                $data['price'],
                $data['description']
            );
            array_push($subs, $temp);
        }

        return $subs;
    }

    public function getSub(int $id): Subscription {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM subscription WHERE id_subscription = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Subscription(
            $data['id_subscription'],
            $data['id_parking'],
            $data['name'],
            $data['duration'],
            $data['price'],
            $data['description']
        );
    }

    public function createSub(string $id_parking, string $name,int $duration,float $price,string $desc) {
        $stmt = $this->database->connect()->prepare('
        INSERT INTO `subscription`(`id_parking`, `name`, `duration`, `price`, `description`)
        VALUES (:id_parking,:name,:duration,:price,:description)
        ');
        $stmt->bindParam(':id_parking', $id_parking, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':duration', $duration, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->bindParam(':description', $desc, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function updateSub(string $id,string $name,int $duration,float $price,string $desc) {
        $stmt = $this->database->connect()->prepare('
        UPDATE `subscription` SET `name`=:name, `duration`=:duration, `price`=:price, `description`=:description 
        WHERE `subscription`.`id_subscription`=:id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':duration', $duration, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->bindParam(':description', $desc, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function deleteSub(string $id) {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM `subscription` WHERE `subscription`.`id_subscription` = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
    }
}