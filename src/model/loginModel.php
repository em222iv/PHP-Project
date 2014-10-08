<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 07/10/14
 * Time: 18:08
 */

require_once('Repository/loginRepository.php');
class loginModel{

    private $loginRepository;
    private $db_username;
    private $db_password;
    private $errorMessage;

    function __construct() {
        $this->loginRepository = new loginRepository();

        $this->db_username = $this->loginRepository->getDBPassword();
        $this->db_password = $this->loginRepository->getDBPassword();

        $this->errorMessage = "";
    }

    public function userValidationModel($username,$password) {

        if($username !== $this->db_username && $password == $this->db_password ||
            $username == $this->db_username && $password !== $this->db_password ||
            $username !== $this->db_username && $password !== $this->db_password){

            $this->errorMessage = "";
            return false;
        }

        if($username == $this->db_username && $password == $this->db_password);
        {
            $this->loginRepository->getDBUsername();
        }

    }





}
