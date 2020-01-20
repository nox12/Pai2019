<?php
require_once "AppController.php";
require_once "ParkingsController.php";
require_once __DIR__.'//..//Model//User.php';
require_once __DIR__.'//..//Repository//UserRepository.php';

class SecurityController extends AppController {
    
    public function login() {
        $userRepository = new UserRepository();

        if ($this->isPost()) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if($email !== ''){
                $user = $userRepository->getUser($email);

                if ($user === NULL) {
                    $this->render('login', ['messages' => ['You need to sign up first']]);
                    return;
                }
                if ($user->getEmail() !== $email) {
                    $this->render('login', ['messages' => ['Wrong Email!']]);
                    return;
                }
                $salt = $user->getSalt();
                $password = password_verify($password.$salt,$user->getPassword());
                if (!$password) {
                    $this->render('login', ['messages' => ['Wrong password!']]);
                    return;
                }
                $user->nullPass();

                $_SESSION["id"] = $user->getId();
                $_SESSION["role"] = $user->getRole();

                $url = "http://$_SERVER[HTTP_HOST]/parknet";
                header("Location: {$url}?page=parkings");
                return;
            }
        }
        $this->render("login");
    }
    public function signup(){
        $userRepository = new UserRepository();
        if($this->isPost()) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmpassword = $_POST['confirmpassword'];
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $company = $_POST['company'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $zipcode = $_POST['zipcode'];
            $key = $_POST['key'];

            $user = $userRepository->getUser($email);
            //check if user exists
            if($user !== NULL){
                $this->render('signup', ['messages' => ['A user with that email address already exists']]);
                return;
            }
            if($password !== $confirmpassword){
                $this->render('signup', ['messages' => ['Your password and confirmation password do not match']]);
                return;
            }

            $salt = random_int( 10000000 , 99999999 );
            $password = password_hash($password.$salt, PASSWORD_BCRYPT); //hash password

            $userRepository->createUser($email, $password, $salt, $name, $surname, $company, $address, $city, $zipcode,
             $key, "user");
            
            $url = "http://$_SERVER[HTTP_HOST]/parknet";
            header("Location: {$url}?page=login");
        }
        $this->render("signup");
    }

    public function logout()
    {
        session_unset();
        session_destroy();

        $this->render('login', ['messages' => ['You have been successfully logged out!']]);
    }
    //shows setting page or updates data
    public function settings() {
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

        $userRepository = new UserRepository();
        //updates data
        if($this->isPost()) {
            $email = $_POST['email'];
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $company = $_POST['company'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $zip = $_POST['zip_code'];

            $userRepository->updateUser($_SESSION['id'],$email, $name, $surname, $address, $city,$zip,$company);
            
            $url = "http://$_SERVER[HTTP_HOST]/parknet";
            header("Location: {$url}?page=settings");
        }
        //shows page
        $user = $userRepository->getUserById($_SESSION['id']);

        $this->render("settings", ['user' =>$user]);
    }
}