<?php
require_once "Repository.php";
require_once __DIR__.'//..//Model//Parking.php';

class ParkingRepository extends Repository{
    //gets all parkings data from DB
    public function getParkings(string $id_user): array {
        $parkings = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM parking WHERE id_user = :id
        ');
        $stmt->bindParam(':id', $id_user, PDO::PARAM_STR);
        $stmt->execute();

        while($data = $stmt->fetch(PDO::FETCH_ASSOC)){
            $temp = new Parking(
                $data['id_parking'],
                $data['name'],
                $data['spaces'],
                $data['tags'],
                $data['hours'],
                $data['price'],
                $data['address'],
                $data['city'],
                $data['description']
            );
            array_push($parkings, $temp);
        }

        return $parkings;
    }
    /* gets parking data from DB by @id
    * @param id is id of parking
    */ 
    public function getParking(int $id): Parking {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM parking WHERE id_parking = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Parking(
            $data['id_parking'],
            $data['name'],
            $data['spaces'],
            $data['tags'],
            $data['hours'],
            $data['price'],
            $data['address'],
            $data['city'],
            $data['description']
        );
    }
    //adds new parking to DB
    public function createParking(string $name, string $tags=null,int $spaces,int $hours,float $price,
    string $address,string $city,string $description=null) {
        $stmt = $this->database->connect()->prepare('
        INSERT INTO `parking`( `id_user`, `name`, `spaces`, `tags`, `hours`,`price`, `address`, `city`, `description`)
        VALUES (:id_user,:name,:spaces,:tags,:hours,:price,:address,:city,:description)
        ');
        $stmt->bindParam(':id_user', $_SESSION['id'], PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':spaces', $spaces, PDO::PARAM_STR);
        $stmt->bindParam(':tags', $tags, PDO::PARAM_STR);
        $stmt->bindParam(':hours', $hours, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':city', $city, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->execute();
    }
    //updates data in DB
    public function updateParking(int $id, string $name, string $tags=null,int $spaces,int $hours,float $price,
    string $address,string $city,string $description=null) {
        $stmt = $this->database->connect()->prepare('
        UPDATE `parking` SET `name`=:name, `spaces`=:spaces, `tags`=:tags,`hours`=:hours,
        `price`=:price,`address`=:address,`city`=:city,`description`=:description 
        WHERE `parking`.`id_parking`=:id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':spaces', $spaces, PDO::PARAM_STR);
        $stmt->bindParam(':tags', $tags, PDO::PARAM_STR);
        $stmt->bindParam(':hours', $hours, PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':city', $city, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->execute();
    }
    //deletes from DB
    public function deleteParking(int $id) {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM `parking` WHERE `parking`.`id_parking` = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
    }
}