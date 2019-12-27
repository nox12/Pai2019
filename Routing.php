<?php
require_once "Controllers/SecurityController.php";
require_once "Controllers/ParkingsController.php";
require_once "Controllers/EmployeesController.php";
require_once "Controllers/BusinessController.php";

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