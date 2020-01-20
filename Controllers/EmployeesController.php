<?php
require_once "AppController.php";
require_once "SecurityController.php";
require_once __DIR__.'//..//Model//Employee.php';
require_once __DIR__.'//..//Repository//EmployeesRepository.php';

class EmployeesController extends AppController {
    public function showEmployees() {
        if(!isset($_SESSION['id']) and !isset($_SESSION['role'])) {
            $temp = new SecurityController();
            $temp->render("login");
            return;
        }
        if($_SESSION['role'] === 'employee'){
            $url = "http://$_SERVER[HTTP_HOST]/parknet";
            header("Location: {$url}?page=parkings");
            return;
        }
        $empRepository = new EmployeesRepository();
        $data = $empRepository->getEmployees($_SESSION['id']);
        $this->render("employees",["employees"=>$data]);
    }
    //shows page for creating or updating data
    public function newEmployee(){
        if(!isset($_SESSION['id']) and !isset($_SESSION['role'])) {
            $temp = new SecurityController();
            $temp->render("login");
            return;
        }
        if($_SESSION['role'] === 'employee'){
            $url = "http://$_SERVER[HTTP_HOST]/parknet";
            header("Location: {$url}?page=parkings");
            return;
        }
        //for update
        if ($this->isPost()) {
            $empRepository = new EmployeesRepository();

            $id = $_POST['id_employee'];

            $data = $empRepository->getEmployee($id);
            $this->render("employeesinfo",["employee"=>$data]);
            return;
        }
        //for new one
        $this->render("employeesinfo",["employee"=>NULL]);
    }
    //updates or creates new employee
    public function employeeinfo(){
        if(!isset($_SESSION['id']) and !isset($_SESSION['role'])) {
            $temp = new SecurityController();
            $temp->render("login");
            return;
        }
        if($_SESSION['role'] === 'employee'){
            $url = "http://$_SERVER[HTTP_HOST]/parknet";
            header("Location: {$url}?page=parkings");
            return;
        }
        if ($this->isPost()) {
            $empRepository = new EmployeesRepository();

            $id = $_POST['id_employee'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm = $_POST['confirm'];
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $zip = $_POST['zip_code'];
            $position = $_POST['position'];
            $description = $_POST['description'];

            if($id === NULL || $id === ""){
                $user = $empRepository->checkEmail($email);
                //check if user exists
                if($user !== NULL){
                    $this->render("employeesinfo",["employee"=>NULL,'messages' => ['A user with that email address already exists']]);
                    return;
                }
                if($password !== $confirm){
                    $this->render("employeesinfo",["employee"=>NULL,'messages' => ['Your password and confirmation password do not match']]);
                    return;
                }

                $salt = random_int( 10000000 , 99999999 );
                $password = password_hash($password.$salt, PASSWORD_BCRYPT); //hash password

                $empRepository->createEmployee($_SESSION['id'],$email,$password, $salt, $name, $surname, $address, $city,$zip,$position, $description, "employee");

                $url = "http://$_SERVER[HTTP_HOST]/parknet";
                header("Location: {$url}?page=employees");
                return;
            }
            $empRepository->updateEmployee($id,$email, $name, $surname, $address, $city,$zip,$position, $description);
            $url = "http://$_SERVER[HTTP_HOST]/parknet";
            header("Location: {$url}?page=employees");
            return;
        }
        $url = "http://$_SERVER[HTTP_HOST]/parknet";
        header("Location: {$url}?page=employees");
    }

    public function deleteEmployee(){
        if(!isset($_SESSION['id']) and !isset($_SESSION['role'])) {
            $temp = new SecurityController();
            $temp->render("login");
            return;
        }
        if($_SESSION['role'] === 'employee'){
            $url = "http://$_SERVER[HTTP_HOST]/parknet";
            header("Location: {$url}?page=parkings");
            return;
        }
        if ($this->isPost()) {
            $empRepository = new EmployeesRepository();

            $id = $_POST['id_employee'];
            $empRepository->deleteEmployee($id);

            $url = "http://$_SERVER[HTTP_HOST]/parknet";
            header("Location: {$url}?page=employees");
        }
    }
}