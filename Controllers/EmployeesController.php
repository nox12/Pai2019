<?php
require_once "AppController.php";
require_once "SecurityController.php";

class EmployeesController extends AppController {
    public function showEmployees() {
        if(!isset($_SESSION['id']) and !isset($_SESSION['role'])) {
            $temp = new SecurityController();
            $temp->render("login");
            return;
        }
        $this->render("employees");
    }
}