<?php

require_once "Repository.php";
require_once __DIR__.'//..//Model//User.php';

class UserRepository extends Repository {

    public function getUser(string $email): ?User 
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM user WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user == false) {
            return null;
        }

        return new User(
            $user['email'],
            $user['hash'],
            $user['salt'],
            $user['name'],
            $user['surname'],
            $user['company'],
            $user['address'],
            $user['city'],
            $user['zip_code'],
            $user['product_key'],
            $user['role']
        );
    }

    public function createUser(string $email,string $hash,string $salt, string $name, string $surname, string $company=null,
    string $address, string $city, string $zip_code, string $product_key, string $role){
        $stmt = $this->database->connect()->prepare('
        INSERT INTO `user`( `name`, `surname`, `email`, `hash`, `salt`, `company`, `address`, `city`, `zip_code`, `product_key`, `role`)
        VALUES (:name,:surname,:email,:hash,:salt,:company,:address,:city,:zip_code,:product_key,:role)
        ');
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':hash', $hash, PDO::PARAM_STR);
        $stmt->bindParam(':salt', $salt, PDO::PARAM_STR);
        $stmt->bindParam(':company', $company, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':city', $city, PDO::PARAM_STR);
        $stmt->bindParam(':zip_code', $zip_code, PDO::PARAM_STR);
        $stmt->bindParam(':product_key', $product_key, PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);
        $stmt->execute();
    }

}