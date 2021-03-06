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

        //if logout is pressed, session is unset
        if($this->adminView->logout()){
           $this->loginModel->killLoginSESSION();
        }

        //login if session exis and checks if a different webbrowser contains the same session.
        if($this->loginModel->loginSESSIONExist()){
            if($this->loginModel->checkUserSafetySession()){
                return $this->adminController->adminControll();
            }
        }

        //login verification -> logged in
        if($this->adminView->getLogged()){
            //check database for match
            $this->loginRepository->getDBUsers($this->username);

            $this->db_username = $this->loginRepository->getDBUsername();
            $this->db_password = $this->loginRepository->getDBPassword();
            //validates input from user
            if($this->loginModel->userValidationModel($this->username,$this->password)){
                if($this->loginModel->createLoginSESSION()){
                    $this->loginModel->userSafetySession();
                    return $this->adminView->loggedInForm();
                }
            }
        }
        //controls error MSGs for loginview
        $this->adminView->setLoginNameError($this->loginModel->getNameErrorMSG());
        $this->adminView->setLoginPassError($this->loginModel->getPassErrorMSG());
        //return to login page if nothing matches
        if($this->adminView->getAdmin() || $this->adminView->getLogged()){return $this->adminView->loginForm();}
    }
}