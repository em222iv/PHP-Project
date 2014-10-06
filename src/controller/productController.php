<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 03/10/14
 * Time: 14:27
 */
require_once("././src/view/productView.php");
require_once("././src/view/adminView.php");
require_once("././src/model/productModel.php");

class ControllerClass {

    private $view;
    private $adminView;
    private $productModel;

    public function __construct() {
        $this->view = new ViewClass();
        $this->adminView = new adminView();
        $this->productModel = new productModel();
    }
    //direct errormessages from model to view
    function controllerClass() {
    }

    public function formControll() {

        if($this->adminView->adminWantsToLogin()){
            return $this->adminView->loginForm();
        }
        if($this->adminView->adminIsLoggedIn()){
            return $this->adminView->loggedInForm();
        }
        if($this->adminView->edit()){
            return $this->adminView->editForm();
        }
        if($this->adminView->add()){
            return $this->adminView->addForm();
        }

        $this->productModel->importCategories();
        return $this->view->form();




    }
}