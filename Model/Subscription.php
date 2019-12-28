<?php

class Subscription {
    private $id_sub;
    private $id_parking;
    private $name;
    private $duration;
    private $price;
    private $desc;

    public function __construct(string $id_sub, string $id_parking, string $name, int $duration, float $price, string $desc) {
        $this->id_sub = $id_sub;
        $this->id_parking = $id_parking;
        $this->name = $name;
        $this->duration = $duration;
        $this->price = $price;
        $this->desc = $desc;
    }

    public function getId(): int {
        return $this->id_sub;
    }
    public function getIdParking(): string {
        return $this->id_parking;
    }
    public function getName(): string {
        return $this->name;
    }
    public function getDuration(): int {
        return $this->duration;
    }
    public function getPrice(): float {
        return $this->price;
    }
    public function getDescription(): string {
        return $this->desc;
    }
}