<?php

class Employee {
    private $id_employee;
    private $id_data;
    private $email;
    private $password;
    private $salt;
    private $name;
    private $surname;
    private $address;
    private $city;
    private $zipCode;
    private $role;

    private $position;
    private $desc;

    public function __construct(string $id_employee,string $id_data, string $email, string $password, string $salt, string $name, 
    string $surname, string $address, string $city, string $zipCode, string $position, string $description, string $role) {
        $this->id_employee = $id_employee;
        $this->id_data = $id_data;
        $this->email = $email;
        $this->password = $password;
        $this->salt = $salt;
        $this->name =$name;
        $this->surname =$surname;
        $this->address =$address;
        $this->city =$city;
        $this->zipCode =$zipCode;
        $this->position =$position;
        $this->desc =$description;
        $this->role = $role;
    }

    public function getEmail():string {
        return $this->email;
    }
    public function getPassword():string {
        return $this->password;
    }
    public function getSalt():string {
        return $this->salt;
    }
    public function getName():string {
        return $this->name;
    }
    public function getSurname():string {
        return $this->surname;
    }
    public function getAddress():string {
        return $this->address;
    }
    public function getCity():string {
        return $this->city;
    }
    public function getZip():string {
        return $this->zipCode;
    }
    public function getPosition():string {
        return $this->position;
    }
    public function getDescription():string {
        return $this->desc;
    }
    public function getRole():string {
        return $this->role;
    }
    public function getId():int {
        return $this->id_employee;
    }
    public function getIdData():int {
        return $this->id_data;
    }
    public function nullPass() {
        $this->password = '';
        $this->salt = '';
    }
}