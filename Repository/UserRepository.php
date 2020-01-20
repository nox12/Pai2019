<?php

require_once "Repository.php";
require_once __DIR__.'//..//Model//User.php';

class UserRepository extends Repository {
    // gets user data from DB 
    public function getUser(string $email): ?User 
    {
        //for user
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM data WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if($data == false) {
            return null;
        }
        if($data['role'] === 'user') {
            $stmt = $this->database->connect()->prepare('
                SELECT * FROM user WHERE id_data = :data
            ');
            $stmt->bindParam(':data', $data['id_data'], PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            return new User(
                $user['id_user'],
                $data['email'],
                $data['hash'],
                $data['salt'],
                $data['name'],
                $data['surname'],
                $user['company'],
                $data['address'],
                $data['city'],
                $data['zip_code'],
                $user['product_key'],
                $data['role']
            );
        }
        //for employee login
        if($data['role'] === 'employee') {
            $stmt = $this->database->connect()->prepare('
                SELECT * FROM employee WHERE id_data = :data
            ');
            $stmt->bindParam(':data', $data['id_data'], PDO::PARAM_STR);
            $stmt->execute();

            $emp = $stmt->fetch(PDO::FETCH_ASSOC);

            return new User(
                $emp['id_user'],
                $data['email'],
                $data['hash'],
                $data['salt'],
                $data['name'],
                $data['surname'],
                "",
                $data['address'],
                $data['city'],
                $data['zip_code'],
                "",
                "employee"
            );
        }
    }
    //adds new user to DB
    public function createUser(string $email,string $hash,string $salt, string $name, string $surname, string $company=null,
    string $address, string $city, string $zip_code, string $product_key, string $role){
        //create data
        $stmt = $this->database->connect()->prepare('
        INSERT INTO `data`( `name`, `surname`, `email`, `hash`, `salt`, `address`, `city`, `zip_code`, `role`)
        VALUES (:name,:surname,:email,:hash,:salt,:address,:city,:zip_code,:role)
        ');
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':hash', $hash, PDO::PARAM_STR);
        $stmt->bindParam(':salt', $salt, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':city', $city, PDO::PARAM_STR);
        $stmt->bindParam(':zip_code', $zip_code, PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);
        $stmt->execute();
        //get data id
        $stmt = $this->database->connect()->prepare('
            SELECT id_data FROM data WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        //create user
        $stmt = $this->database->connect()->prepare('
        INSERT INTO `user`( `id_data`, `company`, `product_key`)
        VALUES (:id_data,:company,:product_key)
        ');
        $stmt->bindParam(':id_data', $data['id_data'], PDO::PARAM_STR);
        $stmt->bindParam(':company', $company, PDO::PARAM_STR);
        $stmt->bindParam(':product_key', $product_key, PDO::PARAM_STR);
        $stmt->execute();
    }
    /* gets user data from DB by @id
    * @param id is id of user
    */ 
    public function getUserById(int $id): User {
        //get info from "user" table
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM user WHERE id_user = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        //get info from "data" table
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM data WHERE id_data = :id_data
        ');
        $stmt->bindParam(':id_data', $user['id_data'], PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return new User(
            $user['id_user'],
            $data['email'],
            $data['hash'],
            $data['salt'],
            $data['name'],
            $data['surname'],
            $user['company'],
            $data['address'],
            $data['city'],
            $data['zip_code'],
            $user['product_key'],
            $data['role']
            );
    }
    //updates data in DB
    public function updateUser(int $id,string $email,string $name,string $surname,string $address,string $city,string $zip,
    string $company) {
        $stmt = $this->database->connect()->prepare('
        UPDATE `user` SET `company`=:company 
        WHERE `user`.`id_user`=:id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':company', $company, PDO::PARAM_STR);
        $stmt->execute();

        //get data id
        $stmt = $this->database->connect()->prepare('
            SELECT id_data FROM user WHERE id_user = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $this->database->connect()->prepare('
        UPDATE `data` SET `name`=:name,`surname`=:surname,`email`=:email,`address`=:address,`city`=:city,`zip_code`=:zip_code
        WHERE `data`.`id_data`=:id
        ');
        $stmt->bindParam(':id', $data['id_data'], PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':city', $city, PDO::PARAM_STR);
        $stmt->bindParam(':zip_code', $zip, PDO::PARAM_STR);
       
        $stmt->execute();
    }

}