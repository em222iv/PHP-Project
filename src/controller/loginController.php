<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 07/10/14
 * Time: 16:07
 */

class loginController{
    private $adminView;
    private $loginModel;
    private $loginRepository;
    private $adminController;

    private $username;
    private $password;
    private $db_username;
    private $db_password;

    public function __construct(loginModel $loginModel, loginRepository $loginRepository,adminView $adminView,  $adminController) {
        $this->loginModel = $loginModel;
        $this->loginRepository = $loginRepository;
        $this->adminView = $adminView;
        $this->adminController = $adminController;

        $this->username = $this->adminView->getUsername();
        $this->password = $this->adminView->getPassword();
    }

    public function loginControll() {

        //logout
        if($this->adminView->logout()){
           $this->loginModel->killLoginSESSION();
        }

        //login if session exist
        if($this->loginModel->loginSESSIONExist()){
            return $this->adminController->addControll();
        }

        //login verification -> logged in
        if($this->adminView->getLogged()){
            //check database for match
            $this->loginRepository->getDBUsers($this->username);

            $this->db_username = $this->loginRepository->getDBUsername();
            $this->db_password = $this->loginRepository->getDBPassword();

            if($this->loginModel->userValidationModel($this->username,$this->password)){
                if($this->loginModel->createLoginSESSION()){
                    return $this->adminView->loggedInForm();
                }
            }
        }
        //fixa url till ?admin
        return $this->adminView->loginForm();
    }
}