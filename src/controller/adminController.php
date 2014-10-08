<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 08/10/14
 * Time: 17:06
 */

class AdminController{
    private $adminView;
    private $loginController;

    private $addView;

    public function __construct( $loginController, adminView $adminView, AddView $addView,  $adminController) {

        $this->adminView =  $adminView;
        $this->loginController = $loginController;
        $this->addView = $addView;
        $this->adminController = $adminController;

    }

    public function adminControll() {

        if($this->adminView->getAdmin() || $this->adminView->edit() || $this->addView->add()|| $this->adminView->getLogged() || $this->addView->addCategory() || $this->addView->add() || $this->addView->addCategory()){

            return true;
        }
        return false;
    }


    public function addControll() {
        $this->adminView->loggedInForm();

    }


}

