<?php
require_once "Appcontroller.php";

class SecurityController extends AppController {
    public function login() {
        $this->render("index");
    }
}