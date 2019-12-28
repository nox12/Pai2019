<?php
require_once "Controllers/SecurityController.php";
require_once "Controllers/ParkingsController.php";
require_once "Controllers/EmployeesController.php";
require_once "Controllers/BusinessController.php";
require_once "Controllers/BookingController.php";

class Routing {
    private $routes = [];

    public function __construct(){
        $this->routes = [
            "login" => [
                'controller' => 'SecurityController',
                'action' => 'login'
            ],
            "signup" => [
                'controller' => "SecurityController",
                'action' => 'signup'
            ],
            "logout" => [
                'controller' => 'SecurityController',
                'action' => 'logout'
            ],
            "parkings" => [
                'controller' => 'ParkingsController',
                'action' => "showParkings"
            ],
            "newParking" => [
                'controller' => 'ParkingsController',
                'action' => "newParking"
            ],
            "parkinginfo" => [
                'controller' => 'ParkingsController',
                'action' => "parkinginfo"
            ],
            "deleteParking" => [
                'controller' => 'ParkingsController',
                'action' => "deleteParking"
            ],
            "booking" => [
                'controller' => 'BookingController',
                'action' => "booking"
            ],
            "newBooking" => [
                'controller' => 'BookingController',
                'action' => "newBooking"
            ],
            "showBooking" => [
                'controller' => 'BookingController',
                'action' => "showBooking"
            ],
            "saveBooking" => [
                'controller' => 'BookingController',
                'action' => "saveBooking"
            ],
            "deleteBooking" => [
                'controller' => 'BookingController',
                'action' => "deleteBooking"
            ],
            "employees" => [
                'controller' => "EmployeesController",
                'action' => "showEmployees"
            ],
            "business" => [
                'controller' => "BusinessController",
                'action' => "showBusiness"
            ]
        ];
    }

    public function run(){
        $page = isset($_GET["page"]) ? $_GET["page"]:"login";

        if(isset($this->routes[$page])) {
            $controller = $this->routes[$page]["controller"];
            $action = $this->routes[$page]["action"];

            $object = new $controller();
            $object->$action();
        }
    }
}