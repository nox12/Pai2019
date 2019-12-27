<?php

class User {
    private $id;
    private $email;
    private $password;
    private $salt;
    private $name;
    private $surname;
    private $company;
    private $address;
    private $city;
    private $zipCode;
    private $productKey;
    private $role;

    public function __construct(int $id,string $email,string $password,string $salt, string $name, string $surname, string $company=null,
     string $address, string $city, string $zipCode, string $productKey, string $role ){
         $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->salt = $salt;
        $this->name = $name;
        $this->surname =$surname;
        $this->company= $company;
        $this->address = $address;
        $this->city = $city;
        $this->zipCode = $zipCode;
        $this->productKey = $productKey;
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
    public function getRole():string {
        return $this->role;
    }
    public function getId():int {
        return $this->id;
    }
    public function nullPass() {
        $this->password = '';
        $this->salt = '';
    }
}