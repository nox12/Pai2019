<?php
require_once "AppController.php";
require_once __DIR__.'//..//Model//Parking.php';
require_once "SecurityController.php";

class ParkingsController extends AppController {
    public function showParkings(){
        if(!isset($_SESSION['id']) and !isset($_SESSION['role'])) {
            $temp = new SecurityController();
            $temp->render("login");
            return;
        }
        $parking1 = new Parking("Super Parking", 26, "Tir", 24, "Warszawska 24", "Krakow", "opis parkingu");
        $data = [$parking1];
        $this->render("parkings",["parkings"=>$data]);
    }
}