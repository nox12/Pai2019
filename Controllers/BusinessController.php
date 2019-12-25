<?php
require_once "AppController.php";
require_once "SecurityController.php";

class BusinessController extends AppController {
    public function showBusiness(){
        if(!isset($_SESSION['id']) and !isset($_SESSION['role'])) {
            $temp = new SecurityController();
            $temp->render("login");
            return;
        }
        $this->render("business");
    }
}