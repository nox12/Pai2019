<?php

class Parking {
    private $name;
    private $spaces;
    private $tags;
    private $hours;
    private $address;
    private $city;
    private $description;

    public function __construct(string $name, int $spaces, string $tags, int $hours, string $address, 
    string $city, string $description){
        $this->name = $name;
        $this->spaces = $spaces;
        $this->tags = $tags;
        $this->hours = $hours;
        $this->address = $address;
        $this->city = $city;
        $this->description = $description;
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
    public function getAddress():string {
        return $this->address;
    }
    public function getCity():string {
        return $this->city;
    }
    public function getDescription():string {
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