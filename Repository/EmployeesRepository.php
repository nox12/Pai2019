<?php
require_once "Repository.php";
require_once __DIR__.'//..//Model//Employee.php';

class EmployeesRepository extends Repository {
    //gets all employees data from DB
    public function getEmployees(string $id_user): array {
        $employees = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM employee WHERE id_user = :id
        ');
        $stmt->bindParam(':id', $id_user, PDO::PARAM_STR);
        $stmt->execute();

        $emp = [];
        while($employee = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($emp, $employee);
        }
        foreach($emp as $data) {
            $stmt = $this->database->connect()->prepare('
            SELECT * FROM data WHERE id_data = :id
            ');
            $stmt->bindParam(':id', $data['id_data'], PDO::PARAM_STR);
            $stmt->execute();

            $info = $stmt->fetch(PDO::FETCH_ASSOC);

            $temp = new Employee(
                $data['id_employee'],
                $data['id_data'],
                $info['email'],
                "", //password
                "", //salt
                $info['name'],
                $info['surname'],
                $info['address'],
                $info['city'],
                $info['zip_code'],
                $data['position'],
                $data['description'],
                "employee" //role
            );
            array_push($employees, $temp);
        }

        return $employees;
    }
    /* gets employee data from DB by @id
    * @param id is id of employee
    */ 
    public function getEmployee(int $id): Employee {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM employee WHERE id_employee = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM data WHERE id_data = :id
        ');
        $stmt->bindParam(':id', $data['id_data'], PDO::PARAM_STR);
        $stmt->execute();

        $info = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Employee(
            $data['id_employee'],
            $data['id_data'],
            $info['email'],
            "", //password
            "", //salt
            $info['name'],
            $info['surname'],
            $info['address'],
            $info['city'],
            $info['zip_code'],
            $data['position'],
            $data['description'],
            "employee" //role
            );
    }
    //checks if email exists
    public function checkEmail(string $email): ?string {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM data WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if($data == false) {
            return null;
        }
        return "exists";
    }
    //adds new employee to DB
    public function createEmployee(string $id,string $email,string $hash,string $salt,string $name,string $surname,
    string $address,string $city,string $zip,string $position,string $description=null,string $role){
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
        $stmt->bindParam(':zip_code', $zip, PDO::PARAM_STR);
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
        INSERT INTO `employee`( `id_user`,`id_data`, `position`, `description`)
        VALUES (:id_user,:id_data,:position,:description)
        ');
        $stmt->bindParam(':id_user', $id, PDO::PARAM_STR);
        $stmt->bindParam(':id_data', $data['id_data'], PDO::PARAM_STR);
        $stmt->bindParam(':position', $position, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->execute();
    }
    //updates data in DB
    public function updateEmployee(string $id,string $email,string $name,string $surname,
    string $address,string $city,string $zip,string $position,string $description) {
        $stmt = $this->database->connect()->prepare('
        UPDATE `employee` SET `position`=:position,`description`=:description 
        WHERE `employee`.`id_employee`=:id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':position', $position, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->execute();

        //get data id
        $stmt = $this->database->connect()->prepare('
            SELECT id_data FROM employee WHERE id_employee = :id
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
    //deletes from DB
    public function deleteEmployee(int $id) {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM employee WHERE id_employee = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $this->database->connect()->prepare('
            DELETE FROM `data` WHERE `data`.`id_data` = :id
        ');
        $stmt->bindParam(':id', $data['id_data'], PDO::PARAM_STR);
        $stmt->execute();

        $stmt = $this->database->connect()->prepare('
            DELETE FROM `employee` WHERE `employee`.`id_employee` = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
    }
}