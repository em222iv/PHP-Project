<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 03/10/14
 * Time: 14:27
 */
require_once("././src/view/productView.php");
require_once("././src/view/admin/adminView.php");
require_once("././src/view/admin/addView.php");
require_once("././src/view/admin/editView.php");
require_once("././src/view/checkoutView.php");

require_once("././src/model/productModel.php");
require_once("././src/model/loginModel.php");
require_once("././src/model/Repository/ProductRepository.php");
require_once("././src/model/Repository/loginRepository.php");

require_once("productController.php");
require_once("loginController.php");
require_once("adminController.php");


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
    private $addView;
    private $editView;
    private $adminController;

    public function __construct() {
        $this->checkoutView = new checkoutView();
        $this->view = new ViewClass();
        $this->adminView = new adminView();
        $this->addView = new AddView();
        $this->editView = new EditView();

        $this->productRepository = new ProductRepository();
        $this->productModel = new productModel();
        $this->productController = new productController($this->productModel,$this->adminView,$this->view, $this->productRepository);

        $this->adminController = new AdminController($this->loginController, $this->adminView, $this->addView, $this->adminController, $this->editView);

        $this->loginRepository = new loginRepository();
        $this->loginModel = new loginModel($this->loginRepository);
        $this->loginController = new loginController($this->loginModel, $this->loginRepository,$this->adminView, $this->adminController);



    }
    //direct errormessages from model to view
    function errorMSGHandler() {
    }

    public function formControll() {

        if($this->adminController->adminControll()){
            return $this->loginController->loginControll();
        }

        if($this->checkoutView->checkoutClicked()){
            return $this->checkoutView->checkoutUserInfoForm();
        }
        $this->productController->productControll();

        return $this->view->form();
    }
}