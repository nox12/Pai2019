<?php

class Parking {
    private $id_parking;
    private $name;
    private $spaces;
    private $tags;
    private $hours;
    private $price;
    private $address;
    private $city;
    private $description;

    public function __construct(int $id_parking,string $name, int $spaces, string $tags=null, int $hours,float $price, string $address, 
    string $city, string $description=null){
        $this->id_parking = $id_parking;
        $this->name = $name;
        $this->spaces = $spaces;
        $this->tags = $tags;
        $this->hours = $hours;
        $this->price = $price;
        $this->address = $address;
        $this->city = $city;
        $this->description = $description;
    }

    public function getId():string {
        return $this->id_parking;
    }
    public function getName():string {
        return $this->name;
    }
    public function getSpaces():int {
        return $this->spaces;
    }
    public function getTags():string {
        return $this->tags;
    }
    public function getHours():int {
        return $this->hours;
    }
    public function getPrice():float {
        return $this->price;
    }
    public function getAddress():string {
        return $this->address;
    }
    public function getCity():string {
        return $this->city;
    }
    public function getDescription():string {
        if($this->description === NULL)return "";
        return $this->description;
    }

    public function setName(string $name) {
        $this->name = $name;
    }
    public function setSpaces(int $spaces) {
        $this->spaces = $spaces;
    }
    public function setTags(string $tags) {
        $this->tags = $tags;
    }
    public function setHours(int $hours) {
        $this->hours = $hours;
    }
    public function setPrice(float $price) {
        $this->price = $price;
    }
    public function setAddress(string $address) {
        $this->address = $address;
    }
    public function setCity(string $city) {
        $this->city = $city;
    }
    public function setDescription(string $description) {
        $this->description = $description;
    }
}