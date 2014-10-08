<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 03/10/14
 * Time: 14:27
 */
require_once("././src/view/productView.php");
require_once("././src/view/adminView.php");
require_once("././src/view/checkoutView.php");
require_once("././src/model/productModel.php");
require_once("././src/model/loginModel.php");
require_once("././src/model/Repository/ProductRepository.php");
require_once("././src/model/Repository/loginRepository.php");
require_once("productController.php");
require_once("loginController.php");


class ControllerClass {

    private $productRepository;
    private $view;
    private $adminView;
    private $productModel;
    private $productController;
    private $checkoutView;
    private $loginController;
    private $loginModel;
    private $loginRepository;

    public function __construct() {
        $this->checkoutView = new checkoutView();
        $this->view = new ViewClass();
        $this->adminView = new adminView();

        $this->productRepository = new ProductRepository();
        $this->productModel = new productModel();
        $this->productController = new productController($this->productModel,$this->adminView,$this->view, $this->productRepository);

        $this->loginModel = new loginModel();
        $this->loginRepository = new loginRepository();
        $this->loginController = new loginController($this->loginController, $this->adminView, $this->loginModel, $this->loginRepository);


    }
    //direct errormessages from model to view
    function errorMSGHandler() {
    }

    public function formControll() {
        if($this->adminView->getAdmin() || $this->adminView->edit() || $this->adminView->add()){
            return $this->loginController->loginControll();
        }


        if($this->checkoutView->checkoutClicked()){
            return $this->checkoutView->checkoutUserInfoForm();
        }
        $this->productController->productControll();

        return $this->view->form();

    }
}