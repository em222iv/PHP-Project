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
    private $editView;

    public function __construct( $loginController, adminView $adminView, AddView $addView,  $adminController, EditView $editView) {

        $this->adminView =  $adminView;
        $this->loginController = $loginController;
        $this->addView = $addView;
        $this->editView = $editView;
        $this->adminController = $adminController;

    }
    //check what page user is on
    public function adminControll() {
        if($this->adminView->getAdmin()|| $this->adminView->getLogged() || $this->addView->addCategory() || $this->addView->addArticle() || $this->addView->addMenu() || $this->editView->editCategory() || $this->editView->editArticle() || $this->editView->editMenu()){

            return true;
        }
        return false;
    }

    //controls whitch of the add pages user is on
    public function addControll() {

        if($this->addView->addArticle()){
            return $this->addView->addArticleForm();
        }
        if($this->addView->addCategory()){
            return $this->addView->addCategoryForm();
        }
        if($this->addView->addMenu()){
            return $this->addView->addForm();
        }

        if($this->editView->editArticle()){
            return $this->editView->editArticleForm();
        }

        if($this->editView->editCategory()){
            return $this->editView->editCategoryForm();
        }
        if($this->editView->editMenu()){
            return $this->editView->editForm();
        }




        return $this->adminView->loggedInForm();
    }
}

