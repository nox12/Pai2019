<?php
require_once "Controllers/SecurityController.php";

class Routing {
    private $routes = [];

    public function __construct(){
        $this->routes = [
            "index" => [
                'controller' => 'SecurityController',
                'action' => 'login'
            ]
        ];
    }

    public function run(){
        $page = isset($_GET["page"]) ? $_GET["page"]:"index";

        if(isset($this->routes[$page])) {
            $controller = $this->routes[$page]["controller"];
            $action = $this->routes[$page]["action"];

            $object = new $controller();
            $object->$action();
        }
    }
}