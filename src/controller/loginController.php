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

    private $username;
    private $password;

    public function __construct($loginController, adminView $adminView, loginModel $loginModel, loginRepository $loginRepository) {
        $this->adminView =  $adminView;
        $this->loginController = $loginController;
        $this->loginModel = $loginModel;
        $this->loginRepository = $loginRepository;

        $this->username = $this->adminView->getUsername();
        $this->password = $this->adminView->getPassword();
    }

    public function loginControll() {


        $this->loginModel->userValidationModel($this->username,$this->password);
        //return $this->adminView->loggedInForm();


        if($this->adminView->edit()){
            return $this->adminView->editForm();
        }
        if($this->adminView->add()){
            return $this->adminView->addForm();
        }

        return $this->adminView->loginForm();

    }
}