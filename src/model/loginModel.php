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
    private $errorNameMSG;
    private $errorPassMSG;

    function __construct(loginRepository $loginRepository) {
        $this->loginRepository = $loginRepository;

    }

    public function userValidationModel($username,$password) {
        //validates input
        if($username == "" || $password == ""){
            $this->errorNameMSG = "You can't leave fields empty";
            return false;
        }
        if($username != strip_tags($username)) {
            $this->errorNameMSG = "Username contains non-valid characters";
            return false;
        }
        if(strlen($username) < 3){
            $this->errorNameMSG = "Username is to short. Atleast 3 characters";
            return false;
        }
        if(strlen($password) < 6){
            $this->errorPassMSG = "Password to short. Atleast 6 characters";
            return false;
        }
//validates db info with input
        $this->db_username = $this->loginRepository->getDBUsername();
        $this->db_password = $this->loginRepository->getDBPassword();

        if($username !== $this->db_username && password_verify($password, $this->db_password) ||
            $username == $this->db_username && !password_verify($password, $this->db_password) ||
            $username !== $this->db_username && !password_verify($password, $this->db_password)){

            $this->errorNameMSG = "Wrong Username Or";
            $this->errorPassMSG = "Wrong Password";
            return false;
        }

        if(password_verify($password, $this->db_password));
        {
            return true;
        }
    }
    //creates,validates and unsets session section
    public function createLoginSESSION() {
        if(!isset($_SESSION['login'])){
            $_SESSION['login'] = 1;
            return true;
        }
        return false;
    }
    public function loginSESSIONExist(){
        if(isset($_SESSION['login'])){
            return true;
        }
        return false;
    }
    public function killLoginSESSION(){

        unset($_SESSION['login']);
        return true;
    }
    //gets user information, to prevent hijack
    public function userSafetySession() {

        $_SESSION['usersafety'] = $_SERVER['HTTP_USER_AGENT'];
    }
    public function checkUserSafetySession() {
        if($_SESSION['usersafety'] === $_SERVER['HTTP_USER_AGENT']) {
            return true;
        }
    }
    //returns errormessages if validation goes wrong
    public function getNameErrorMSG() {
        return $this->errorNameMSG;
    }
    public function getPassErrorMSG() {
        return $this->errorPassMSG;
    }
}
