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
    private $deleteView;

    private $categories;
    private $articles;
    private $choosenCategoryName;

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

    private $productView;
    private $errorHandler;



    public function __construct($loginController,deleteView $deleteView, adminView $adminView, AddView $addView, $adminController, EditView $editView, AdminModel $adminModel, AdminRepository $adminRepository, viewClass $productView,ErrorHandler $errorHandler) {
        $this->deleteView = $deleteView;
        $this->adminModel = $adminModel;
        $this->adminRepository = $adminRepository;
        $this->adminView =  $adminView;
        $this->loginController = $loginController;
        $this->addView = $addView;
        $this->editView = $editView;
        $this->adminController = $adminController;
        $this->productView = $productView;
        $this->errorHandler = $errorHandler;
    }

    public function adminControll() {



        //Add section
        //add category
        if($this->addView->addCategoryConfirm()){
            $this->addCategoryName = $this->adminModel->replaceSpaceWithChar($this->addView->getAddCategoryName());

            if($this->addView->validateImage()){
                $this->addCategoryImage = $this->addView->getImage();

                if($this->adminModel->validateAddorEditContent($this->addCategoryName)) {

                    if($this->adminRepository->doesCategoryExist($this->addCategoryName)){
                        $this->adminRepository->addCategoryToDB($this->addCategoryName,$this->addCategoryImage);
                        $this->addView->setSuccessMSG("success");
                    }
                }
            }
        }

        //add article
        $this->categories = $this->adminRepository->getAllCategories();

        $this->categories  = $this->adminModel->replaceCharWithSpace($this->categories);

        $this->addView->setCategories($this->categories);
        if($this->addView->addArticleConfirm()){
            $this->chosenCategory = $this->adminModel->replaceSpaceWithChar($this->addView->getChosenCategory());
            $this->addArticleName = $this->adminModel->replaceSpaceWithChar($this->addView->getAddArticleName());

            $this->addArticleDesc = $this->addView->getAddArticleDesc();
            $this->addArticlePrice = $this->addView->getAddArticlePrice();

            if($this->addView->validateImage()){

                $this->addArticleImage = $this->addView->getImage();
                    if($this->adminModel->validateAddorEditContent($this->addArticleName,$this->addArticleDesc,$this->addArticlePrice)) {
                        if($this->adminRepository->doesArticleExist($this->addArticleName,$this->chosenCategory)){
                            $this->adminRepository->addArticleToDB($this->chosenCategory,$this->addArticleName,$this->addArticleDesc,$this->addArticlePrice,$this->addArticleImage);
                            $this->addView->setSuccessMSG("success");
                    }
                }
            }
        }

        //Edit section
        //edit category
        $this->categories = $this->adminModel->replaceCharWithSpace($this->adminRepository->getAllCategories());
        $this->editView->setCategories($this->categories);


        if($this->editView->editCategory()){


                $this->adminModel->storeCategory($this->adminModel->replaceSpaceWithChar($this->editView->dropdownCategoryChoice()));

                $this->chosenCategory = $this->adminModel->getStoredCategory();
                $this->chosenCategory = $this->adminRepository->getCategoryInfo($this->chosenCategory);

                $this->chosenCategory = $this->adminModel->replaceCharWithSpace($this->chosenCategory);
                $this->editView->setCategory($this->chosenCategory);


                return $this->editView->editCategoryForm();

        }

        if($this->editView->editCategoryConfirm()){

            $this->chosenCategory = $this->adminModel->getStoredCategory();
            $this->editCategoryName = $this->adminModel->replaceSpaceWithChar($this->editView->editCategoryName());

            if($this->editView->getEditImage()) {

                if($this->editView->validateImage()){
                    $this->editArticleImage = $this->editView->getImage();
                    $this->adminRepository->newCategoryPicture($this->chosenCategory,$this->editArticleImage);
                }
            }

            if($this->adminModel->validateAddorEditContent($this->editCategoryName)) {


                if($this->adminRepository->doesCategoryExist($this->editCategoryName)){
                    $this->adminRepository->addEditedCategoryToDB($this->chosenCategory,$this->editCategoryName);
                    $this->editView->setSuccessMSG("success");

                }
            }
        }


        //edit article
        if($this->editView->chooseArticle())  {
            try {

                $this->adminModel->storeCategory($this->adminModel->replaceSpaceWithChar($this->editView->dropdownCategoryChoice()));
                $this->chosenCategory = $this->adminModel->getStoredCategory();

                $this->editView->setArticles($this->adminModel->replaceCharWithSpace($this->adminRepository->getCategoryArticles($this->chosenCategory)));
            }catch(Exception $e) {
                echo 'Error: ' .$e->getMessage();
                return $this->editView->editArticleCategoryForm();
            }
        }

        if($this->editView->editArticle()){
            //unset i vyn
            unset($_FILES['file']);
            try {
            $this->chosenCategory = $this->adminModel->getStoredCategory();
            $this->adminModel->storeArticle($this->adminModel->replaceSpaceWithChar($this->editView->dropdownArticleChoice()));
            $this->chosenArticle = $this->adminModel->getStoredArticle();
            $this->editView->setArticle($this->adminModel->replaceCharWithSpace($this->adminRepository->getArticleInfo($this->chosenArticle,$this->chosenCategory)));

                $id  = $this->adminRepository->getArticleInfo($this->chosenArticle,$this->chosenCategory);
                $_SESSION['id'] = $id[0][0];
                var_dump( $_SESSION['id']);
            return $this->editView->editArticleForm();
            exit();
            }catch(Exception $e) {
                echo 'Error: ' .$e->getMessage();
                return $this->editView->editArticleCategoryForm();
            }
        }

        if($this->editView->editArticleConfirm()){
            try{

                $this->chosenCategory = $this->adminModel->getStoredCategory();
                $this->chosenArticle = $this->adminModel->getStoredArticle();

                $this->editArticleName = $this->adminModel->replaceSpaceWithChar($this->editView->getEditArticleName());
                $this->editArticleDesc = $this->editView->getEditArticleDesc();
                $this->editArticlePrice = $this->editView->getEditArticlePrice();
                $id = $_SESSION['id'];
                if($this->editView->getEditImage()) {

                    if($this->editView->validateImage()){
                        $this->editArticleImage = $this->editView->getImage();
                        $this->adminRepository->newArticlePicture($this->chosenCategory,$id,$this->editArticleImage);
                    }
                }
            }catch(Exception $e) {
                echo 'Error: ' .$e->getMessage();
                return $this->editView->editArticleCategoryForm();
            }
            if($this->adminModel->validateAddorEditContent($this->editArticleName,$this->editArticleDesc,$this->editArticlePrice)) {
                try {
                    $this->adminRepository->addEditedArticleToDB($id,$this->chosenCategory, $this->editArticleName, $this->editArticleDesc, $this->editArticlePrice);
                    $this->editView->setSuccessMSG("success");
                }catch(Exception $e) {
                    echo 'Error: ' .$e->getMessage();
                    return $this->editView->editArticleCategoryForm();
                }
            }
        }


        //DELETE SECTION
        try {
            if($this->deleteView->deleteCategory() || $this->deleteView->chooseCategory()){
                $this->categories=$this->adminRepository->getAllCategories();
                $this->deleteView->setCategories($this->adminModel->replaceCharWithSpace($this->categories));
            }
            if($this->deleteView->deleteCategoryConfirm()){
                $this->deleteCategoryName = $this->adminModel->replaceSpaceWithChar($this->deleteView->getDeleteCategoryName());
                $this->adminRepository->deleteCategory($this->deleteCategoryName);
                $this->deleteView->setSuccessMSG("success");
            }
        }catch(Exception $e) {
            echo 'Error: ' .$e->getMessage();
            return $this->deleteView->deleteMenuForm();
            die();
        }
        try{
            if($this->deleteView->deleteArticle()){
                $this->choosenCategoryName = ($this->adminModel->replaceSpaceWithChar($this->deleteView->getChoosenCategory()));
                $this->adminModel->storeCategory($this->choosenCategoryName);
                $this->articles = $this->adminRepository->getCategoryArticles($this->choosenCategoryName);
                $this->deleteView->setCategories(($this->adminModel->replaceCharWithSpace($this->articles)));
            }
            if($this->deleteView->deleteArticleConfirm()){
                $this->categories = ($this->adminModel->replaceSpaceWithChar($this->adminModel->getStoredCategory()));
                $this->chosenArticle = ($this->adminModel->replaceSpaceWithChar($this->deleteView->articleDropdown()));
                $this->adminRepository->deleteArticle($this->categories,$this->chosenArticle);
                $this->deleteView->setSuccessMSG("success");
        }
        }catch(Exception $e) {
            echo 'Error: ' .$e->getMessage();
            return $this->deleteView->deleteMenuForm();
        }

        $this->errorHandler->setErrorMSG($this->adminModel->getErrorMSG());

        //delete
        if($this->deleteView->delete()){
            return $this->deleteView->deleteMenuForm();
        }
        if($this->deleteView->chooseCategory()){
            return $this->deleteView->chooseCategoryForm();
        }
        if($this->deleteView->deleteArticle()) {
            return $this->deleteView->deleteArticleForm();
        }
        if($this->deleteView->deleteCategory()){
            return $this->deleteView->deleteCategoryForm();
        }
        if($this->deleteView->deleteCategoryConfirm() || $this->deleteView->deleteArticleConfirm()){
            return $this->deleteView->deleteMenuForm();
        }

        //add
        if($this->addView->addArticle()){
            return $this->addView->addArticleForm();
        }
        if($this->addView->addCategoryConfirm()){
            return $this->addView->addCategoryForm();
        }
        if($this->addView->addCategory()){
            return $this->addView->addCategoryForm();
        }
        if($this->addView->addArticleConfirm()){
            return $this->addView->addArticleForm();
        }

        //edit
        if($this->editView->chooseArticle()){
            return $this->editView->chooseArticleForm();
        }
        if($this->editView->editArticleConfirm()){
            return $this->editView->editArticleCategoryForm();
        }
        if($this->editView->editCategoryConfirm()){
            return $this->editView->editChooseCategoryForm();
        }
        if($this->editView->editMenu()){
            return $this->editView->editForm();
        }
        if($this->editView->editChooseCategory()){
            return $this->editView->editChooseCategoryForm();
        }
        if($this->editView->getEditArticleCategory()){
            return $this->editView->editArticleCategoryForm();
        }
        if($this->addView->addMenu()){
            return $this->addView->addForm();
        }

        if($this->adminView->getAdmin() || $this->adminView->getLogged()){
            return $this->adminView->loggedInForm();
        }
    }
}