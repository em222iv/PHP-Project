<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 07/10/14
 * Time: 18:08
 */

//require_once('Repository/loginRepository.php');
class loginModel{

    private $loginRepository;
    private $db_username;
    private $db_password;
    private $errorMessage;

    function __construct(loginRepository $loginRepository) {
        $this->loginRepository = $loginRepository;
        $this->errorMessage = "";
    }

    //validates db info with input
    public function userValidationModel($username,$password) {


        $this->db_username = $this->loginRepository->getDBUsername();
        $this->db_password = $this->loginRepository->getDBPassword();


       if($username !== $this->db_username && password_verify($password, $this->db_password) ||
            $username == $this->db_username && !password_verify($password, $this->db_password) ||
            $username !== $this->db_username && !password_verify($password, $this->db_password)){

            $this->errorMessage = "";
            return false;
        }

        if($username == "" || $password == "" || $this->db_username == "" || $this->db_password == ""){
            $this->errorMessage = "You can't leave fields empty";
            return false;
        }

        if(password_verify($password, $this->db_password));
        {
            return true;
        }
    }
    public function createLoginSESSION() {
        if(!isset($_SESSION['login'])){
            $_SESSION['login'] = 1;
            return true;
        }
        $this->errorMessage = "no session created";
        return false;
    }
    public function loginSESSIONExist(){
        if(isset($_SESSION['login'])){
            return true;
        }
        $this->errorMessage = "no session exists";
        return false;
    }
    public function killLoginSESSION(){

        unset($_SESSION['login']);
        return true;
    }
    public function userSafetySession() {
        $_SESSION['usersafety'] = $_SERVER['HTTP_USER_AGENT'];
    }
    public function checkUserSafetySession() {
        if($_SESSION['usersafety'] = $_SERVER['HTTP_USER_AGENT']) {
            return true;
        }
    }
}
