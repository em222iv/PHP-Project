<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 08/10/14
 * Time: 17:06
 */

class AdminController{
    private $loginController;
    private $adminView;
    private $addView;
    private $editView;

    private $chosenCategory;
    private $chosenArticle;

    private $addCategoryName;
    private $addCategoryImage;

    private $addArticleName;
    private $addArticleImage;
    private $addArticlePrice;
    private $addArticleDesc;

    private $editCategoryName;
    private $editCategoryImage;

    private $editArticleName;
    private $editArticleImage;
    private $editArticlePrice;
    private $editArticleDesc;

    private $adminModel;
    private $adminRepository;


    public function __construct( $loginController, adminView $adminView, AddView $addView,  $adminController, EditView $editView, AdminModel $adminModel, AdminRepository $adminRepository) {

        $this->adminModel = $adminModel;
        $this->adminRepository = $adminRepository;
        $this->adminView =  $adminView;
        $this->loginController = $loginController;
        $this->addView = $addView;
        $this->editView = $editView;
        $this->adminController = $adminController;



    }
    //check what page user is on
    //fullösning, måste göra bättre paging kontroll
    public function adminControll() {
        if($this->adminView->getAdmin() || $this->adminView->getLogged() || $this->addView->addCategory() || $this->addView->addArticle() || $this->addView->addMenu() || $this->editView->editCategory() || $this->editView->editArticle() || $this->editView->editMenu() || $this->addView->addCategoryConfirm() || $this->addView->addArticleConfirm()  || $this->editView->editCategoryConfirm()  || $this->editView->getEditArticleCategory() || $this->editView->editArticleConfirm()){

            return true;
        }
        return false;
    }

    public function addPaging() {

    }
    public function editPaging() {

    }


    public function addControll() {

        //Add section
        if($this->addView->addCategoryConfirm()){

            $this->addCategoryName = $this->addView->getAddCategoryName();

            if($this->addView->validateImage()){

                $this->addCategoryImage = $this->addView->getImage();


                if($this->adminModel->validateAddCategory($this->addCategoryName,$this->addCategoryImage)) {

                        $this->adminRepository->addCategoryToDB($this->addCategoryName,$this->addCategoryImage);
                }
            }
        }

        $this->addView->setCategories($this->adminRepository->getAllCategories());
        if($this->addView->addArticleConfirm()){

            $this->chosenCategory = $this->addView->getChosenCategory();
            $this->addArticleName = $this->addView->getAddArticleName();
            $this->addArticleDesc = $this->addView->getAddArticleDesc();
            $this->addArticlePrice = $this->addView->getAddArticlePrice();

            if($this->addView->validateImage()){

                //if picture validates, set image variable for database
                $this->addArticleImage = $this->addView->getImage();

                    if($this->adminModel->validateAddArticle($this->addArticleName,$this->addArticleDesc,$this->addArticlePrice)) {

                        $this->adminRepository->addArticleToDB($this->chosenCategory,$this->addArticleName,$this->addArticleDesc,$this->addArticlePrice,$this->addArticleImage);
                }
            }
        }



        //Edit section
        $this->editView->setCategories($this->adminRepository->getAllCategories());
        if($this->editView->editCategoryConfirm()){

            $this->chosenCategory = $this->editView->dropdownCategoryChoice();
            $this->editCategoryName = $this->editView->getEditCategoryName();

            if($this->editView->validateImage()){

                $this->editCategoryImage = $this->editView->getImage();
                //kolla ifall namnet redan finns?
                if($this->adminModel->validateEditCategory($this->editCategoryName)) {

                    $this->adminRepository->addEditedCategoryToDB($this->chosenCategory,$this->editCategoryName,$this->editCategoryImage);
                }
            }
        }

        if($this->editView->editArticle())  {
            //hämta ut den rätta kategorin

            $_SESSION['DDC'] = $this->editView->dropdownCategoryChoice();

            $this->chosenCategory = $this->editView->dropdownCategoryChoice();
            $this->editView->setArticles($this->adminRepository->getCategoryArticles($this->chosenCategory));


        }
        if($this->editView->editArticleConfirm()){
                $this->chosenCategory = $_SESSION['DDC'];
                $this->chosenArticle = $this->editView->dropdownArticleChoice();
                $this->editArticleName = $this->editView->getEditArticleName();
                $this->editArticleDesc = $this->editView->getEditArticleDesc();
                $this->editArticlePrice = $this->editView->getEditArticlePrice();

                if($this->editView->validateImage()){

                    //if picture validates, set image variable for database
                    $this->editArticleImage = $this->editView->getImage();

                    if($this->adminModel->validateEditArticle($this->editArticleName,$this->editArticleDesc,$this->editArticlePrice)) {

                        $this->adminRepository->addEditedArticleToDB($this->chosenCategory,$this->chosenArticle,$this->editArticleName,$this->editArticleDesc,$this->editArticlePrice,$this->editArticleImage);
                    }
                }
            }



        if($this->addView->addArticle()){
            return $this->addView->addArticleForm();
        }
        if($this->addView->addCategoryConfirm()){
            return $this->addView->addCategoryForm();
        }
        if($this->addView->addCategory()){
            return $this->addView->addCategoryForm();
        }
        if($this->editView->editArticle()){
            return $this->editView->editArticleForm();
        }
        if($this->editView->editArticleConfirm()){
            return $this->editView->editArticleCategoryForm();
        }
        if($this->editView->editCategory()){
            return $this->editView->editCategoryForm();
        }
        if($this->editView->editMenu()){
            return $this->editView->editForm();
        }
        if($this->editView->getEditArticleCategory()){
            return $this->editView->editArticleCategoryForm();
        }
        if($this->addView->addMenu()){
            return $this->addView->addForm();
        }

        return $this->adminView->loggedInForm();
    }
}