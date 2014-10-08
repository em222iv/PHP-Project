<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 07/10/14
 * Time: 16:07
 */

class loginController{
    private $adminView;
    private $loginController;
    private $loginModel;
    private $loginRepository;
    private $addView;

    private $username;
    private $password;

    private $db_username;
    private $db_password;

    public function __construct($loginController, adminView $adminView, loginModel $loginModel, loginRepository $loginRepository, AddView $addView) {
        $this->adminView =  $adminView;
        $this->loginController = $loginController;
        $this->loginModel = $loginModel;
        $this->loginRepository = $loginRepository;
        $this->addView = $addView;

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

            if($this->adminView->edit()){
                return $this->adminView->edit();
            }
            if($this->adminView->add()){
                return $this->addView->addForm();
            }

            return $this->adminView->loggedInForm();
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
    public function addControll() {
        if($this->addView->getAddCategory()){

        }
    }
}