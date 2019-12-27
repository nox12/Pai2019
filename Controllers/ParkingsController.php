<?php
require_once "AppController.php";
require_once __DIR__.'//..//Model//Parking.php';
require_once "SecurityController.php";
require_once __DIR__.'//..//Repository//ParkingRepository.php';

class ParkingsController extends AppController {
    public function showParkings(){
        if(!isset($_SESSION['id']) and !isset($_SESSION['role'])) {
            $temp = new SecurityController();
            $temp->render("login");
            return;
        }
        $parkingRepository = new ParkingRepository();
        $data = $parkingRepository->getParkings($_SESSION['id']);
        $this->render("parkings",["parkings"=>$data]);
    }

    public function newParking(){
        if(!isset($_SESSION['id']) and !isset($_SESSION['role'])) {
            $temp = new SecurityController();
            $temp->render("login");
            return;
        }
        if ($this->isPost()) {
            $parkingRepository = new ParkingRepository();

            $id = $_POST['id_parking'];

            $data = $parkingRepository->getParking($id);
            $this->render("parkinginfo",["parking"=>$data]);
        }
        $this->render("parkinginfo",["parking"=>NULL]);
    }

    public function parkinginfo(){
        if(!isset($_SESSION['id']) and !isset($_SESSION['role'])) {
            $temp = new SecurityController();
            $temp->render("login");
            return;
        }
        if ($this->isPost()) {
            $parkingRepository = new ParkingRepository();

            $id = $_POST['id_parking'];
            $Name = $_POST['name'];
            $Tags = $_POST['tags'];
            $Spaces = $_POST['spaces'];
            $Hours = $_POST['hours'];
            $Price = $_POST['price'];
            $Address = $_POST['address'];
            $City = $_POST['city'];
            $Description = $_POST['description'];

            if($id === NULL || $id === ""){
                $parkingRepository->createParking($Name, $Tags, $Spaces, $Hours, $Price, $Address, $City, $Description);

                $url = "http://$_SERVER[HTTP_HOST]/parknet";
                header("Location: {$url}?page=parkings");
                return;
            }
            $parkingRepository->updateParking($id, $Name, $Tags, $Spaces, $Hours, $Price, $Address, $City, $Description);
            $url = "http://$_SERVER[HTTP_HOST]/parknet";
            header("Location: {$url}?page=parkings");
            return;
        }
        $url = "http://$_SERVER[HTTP_HOST]/parknet";
        header("Location: {$url}?page=parkings");
    }

    public function deleteParking(){
        if(!isset($_SESSION['id']) and !isset($_SESSION['role'])) {
            $temp = new SecurityController();
            $temp->render("login");
            return;
        }
        if ($this->isPost()) {
            $parkingRepository = new ParkingRepository();

            $id = $_POST['id_parking'];
            $parkingRepository->deleteParking($id);

            $url = "http://$_SERVER[HTTP_HOST]/parknet";
            header("Location: {$url}?page=parkings");
        }
    }
}