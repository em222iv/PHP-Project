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
require_once("././src/view/admin/deleteView.php");
require_once("././src/view/checkoutView.php");

require_once("././src/model/productModel.php");
require_once("././src/model/loginModel.php");
require_once("././src/model/adminModel.php");

require_once("././src/model/Repository/ProductRepository.php");
require_once("././src/model/Repository/loginRepository.php");
require_once("././src/model/Repository/adminRepository.php");

require_once("productController.php");
require_once("loginController.php");
require_once("adminController.php");

require_once("././src/view/errorHandler.php");


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
    private $adminModel;
    private $adminRepository;
    private $deleteView;
    private $errorHandler;


    public function __construct() {

        $this->checkoutView = new checkoutView();
        $this->view = new viewClass();

        $this->adminView = new adminView();



        $this->loginRepository = new loginRepository();
        $this->loginModel = new loginModel($this->loginRepository);

        $this->productRepository = new ProductRepository();
        $this->productModel = new productModel();
        $this->productController = new productController($this->productModel,$this->adminView,$this->view, $this->productRepository,$this->loginModel);

        $this->adminRepository = new AdminRepository();
        $this->adminModel = new AdminModel($this->adminRepository);


        $this->addView = new AddView();
        $this->editView = new EditView();
        $this->deleteView = new DeleteView();
        $this->errorHandler = new ErrorHandler($this->editView,$this->addView);

        $this->adminController = new AdminController($this->loginController,$this->deleteView, $this->adminView, $this->addView, $this->adminController, $this->editView,$this->adminModel,$this->adminRepository,$this->view,$this->errorHandler);
        $this->loginController = new loginController($this->loginModel, $this->loginRepository,$this->adminView, $this->adminController);


    }

    public function formControll() {

        $admincontroll = $this->loginController->loginControll();
        if($admincontroll != null){
            return $admincontroll;
        }

        if($this->checkoutView->checkoutClicked()){
            return $this->checkoutView->checkoutUserInfoForm();
        }
        $this->productController->productControll();

        return $this->view->productForm();
    }
}