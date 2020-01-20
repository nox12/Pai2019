<?php
require_once "AppController.php";
require_once __DIR__.'//..//Model//Parking.php';
require_once __DIR__.'//..//Model//Subscription.php';
require_once "SecurityController.php";
require_once __DIR__.'//..//Repository//ParkingRepository.php';
require_once __DIR__.'//..//Repository//SubscriptionRepository.php';

class BookingController extends AppController {
    //shows "booking" page
    public function booking() {
        if(!isset($_SESSION['id']) and !isset($_SESSION['role'])) {
            $temp = new SecurityController();
            $temp->render("login");
            return;
        }
        if ($this->isPost()) {
            $parkingRepository = new ParkingRepository();
            $subRepository = new SubscriptionRepository();
            $id = $_POST['id_parking'];

            $data = $parkingRepository->getParking($id);
            $subs = $subRepository->getSubs($id);
            $this->render("booking",["parking"=>$data, "subscription"=>$subs]);
            return;
        }
        $url = "http://$_SERVER[HTTP_HOST]/parknet";
        header("Location: {$url}?page=parkings");
    }
    //shows page for creating new parking subscription
    public function newBooking() {
        if(!isset($_SESSION['id']) and !isset($_SESSION['role'])) {
            $temp = new SecurityController();
            $temp->render("login");
            return;
        }
        if ($this->isPost()) {
            $parkingRepository = new ParkingRepository();
            $subRepository = new SubscriptionRepository();
            $id = $_POST['id_parking'];
            $data = $parkingRepository->getParking($id);
            $subs = $subRepository->getSubs($id);
            $this->render("bookinginfo",["parking"=>$data, "subscription"=>$subs, "sub"=>NULL]);
            return;
        }
        $url = "http://$_SERVER[HTTP_HOST]/parknet";
        header("Location: {$url}?page=parkings");
    }
    //shows booking info
    public function showBooking() {
        if(!isset($_SESSION['id']) and !isset($_SESSION['role'])) {
            $temp = new SecurityController();
            $temp->render("login");
            return;
        } 
        if ($this->isPost()) {
            $parkingRepository = new ParkingRepository();
            $subRepository = new SubscriptionRepository();
            $id = $_POST['selectSub'];
            $sub = $subRepository->getSub($id);
            $id_parking = $sub->getIdParking();
            $data = $parkingRepository->getParking($id_parking);
            $subs = $subRepository->getSubs($id_parking);
            $this->render("bookinginfo",["parking"=>$data, "subscription"=>$subs, "sub"=>$sub]);
            return;
        }
        $url = "http://$_SERVER[HTTP_HOST]/parknet";
        header("Location: {$url}?page=parkings");
    }
    //updates or creates new subscription
    public function saveBooking() {
        if(!isset($_SESSION['id']) and !isset($_SESSION['role'])) {
            $temp = new SecurityController();
            $temp->render("login");
            return;
        }
    
        if ($this->isPost()) {
            $subRepository = new SubscriptionRepository();
            $id = $_POST['id_sub'];
            $id_parking = $_POST['id_parking'];
            $name =$_POST['name'];
            $duration =$_POST['duration'];
            $price =$_POST['price'];
            $desc =$_POST['description'];

            if($id === NULL || $id === ""){
                $subRepository->createSub($id_parking, $name, $duration, $price, $desc);
                $url = "http://$_SERVER[HTTP_HOST]/parknet";
                header("Location: {$url}?page=parkings");
                return;
            }
            $subRepository->updateSub($id, $name, $duration, $price, $desc);
            $url = "http://$_SERVER[HTTP_HOST]/parknet";
            header("Location: {$url}?page=parkings");
            return;
        }
        $url = "http://$_SERVER[HTTP_HOST]/parknet";
        header("Location: {$url}?page=parkings");
    }
    //deletes subscription
    public function deleteBooking() {
        if(!isset($_SESSION['id']) and !isset($_SESSION['role'])) {
            $temp = new SecurityController();
            $temp->render("login");
            return;
        }
    
        if ($this->isPost()) {
            $subRepository = new SubscriptionRepository();
            $id = $_POST['id_sub'];
            $subRepository->deleteSub($id);

            $url = "http://$_SERVER[HTTP_HOST]/parknet";
            header("Location: {$url}?page=parkings");
        }
    }
}