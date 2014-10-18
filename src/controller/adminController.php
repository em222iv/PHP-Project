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



    public function __construct($loginController,deleteView $deleteView, adminView $adminView, AddView $addView, $adminController, EditView $editView, AdminModel $adminModel, AdminRepository $adminRepository, viewClass $productView) {
        $this->deleteView = $deleteView;
        $this->adminModel = $adminModel;
        $this->adminRepository = $adminRepository;
        $this->adminView =  $adminView;
        $this->loginController = $loginController;
        $this->addView = $addView;
        $this->editView = $editView;
        $this->adminController = $adminController;
        $this->productView = $productView;


    }

    public function adminControll() {


        //Add section
        //add category
        if($this->addView->addCategoryConfirm()){

            $this->addCategoryName = $this->adminModel->replaceWhiteSpace($this->addView->getAddCategoryName());

            if($this->addView->validateImage()){

                $this->addCategoryImage = $this->addView->getImage();


                if($this->adminModel->validateAddorEditContent($this->addCategoryName)) {

                        $this->adminRepository->addCategoryToDB($this->addCategoryName,$this->addCategoryImage);
                }
            }
        }


        //add category
        $this->addView->setCategories($this->adminRepository->getAllCategories());
        if($this->addView->addArticleConfirm()){
            $this->chosenCategory = $this->addView->getChosenCategory();
            $this->addArticleName = $this->adminModel->replaceWhiteSpace($this->addView->getAddArticleName());
            $this->addArticleDesc = $this->addView->getAddArticleDesc();
            $this->addArticlePrice = $this->addView->getAddArticlePrice();

            if($this->addView->validateImage()){

                //if picture validates, set image variable for database
                $this->addArticleImage = $this->addView->getImage();

                    if($this->adminModel->validateAddorEditContent($this->addArticleName,$this->addArticleDesc,$this->addArticlePrice)) {

                        $this->adminRepository->addArticleToDB($this->chosenCategory,$this->addArticleName,$this->addArticleDesc,$this->addArticlePrice,$this->addArticleImage);
                }
            }
        }








        //Edit section
        //edit category
        $this->categories = $this->adminRepository->getAllCategories();
        $this->editView->setCategories($this->categories);
        if($this->editView->editCategory()){

            $this->adminModel->storeCategory($this->editView->dropdownCategoryChoice());
            $this->chosenCategory = $this->adminModel->getStoredCategory();
            var_dump($this->chosenCategory);


            $this->editView->setCategory($this->adminRepository->getCategoryInfo($this->chosenCategory));

            return $this->editView->editCategoryForm();
        }
        if($this->editView->editCategoryConfirm()){
            $this->chosenCategory = $this->adminModel->getStoredCategory();
            $this->editCategoryName = $this->adminModel->replaceWhiteSpace($this->editView->editCategoryName());

            if($this->editView->getEditImage()) {
                if($this->editView->validateImage()){

                    $this->editArticleImage = $this->editView->getImage();
                    $this->adminRepository->newCategoryPicture($this->chosenCategory,$this->editArticleImage);
                }
            }
            if($this->adminModel->validateAddorEditContent($this->editCategoryName)) {
                $this->adminRepository->addEditedCategoryToDB($this->chosenCategory,$this->editCategoryName);
            }
        }


        //edit article
        if($this->editView->chooseArticle())  {
            $this->adminModel->storeCategory($this->editView->dropdownCategoryChoice());

            $this->chosenCategory = $this->editView->dropdownCategoryChoice();

            $this->editView->setArticles($this->adminRepository->getCategoryArticles($this->chosenCategory));
        }

        if($this->editView->editArticle()){
            unset($_FILES['file']);
            $this->chosenCategory = $this->adminModel->getStoredCategory();

            $this->adminModel->storeArticle($this->editView->dropdownArticleChoice());
            $this->chosenArticle = $this->adminModel->getStoredArticle();
            $this->editView->setArticle($this->adminRepository->getArticleInfo($this->chosenArticle,$this->chosenCategory));

            return $this->editView->editArticleForm();
            exit();
        }

        if($this->editView->editArticleConfirm()){
            $this->chosenCategory = $this->adminModel->getStoredCategory();
            $this->chosenArticle = $this->adminModel->getStoredArticle();

            $this->editArticleName = $this->adminModel->replaceWhiteSpace($this->editView->getEditArticleName());
            $this->editArticleDesc = $this->editView->getEditArticleDesc();
            $this->editArticlePrice = $this->editView->getEditArticlePrice();


            if($this->editView->getEditImage()) {
                if($this->editView->validateImage()){

                    $this->editArticleImage = $this->editView->getImage();

                    $this->adminRepository->newArticlePicture($this->chosenCategory,$this->chosenArticle,$this->editArticleImage);
                }
            }

            if($this->adminModel->validateAddorEditContent($this->editArticleName,$this->editArticleDesc,$this->editArticlePrice)) {

                $this->adminRepository->addEditedArticleToDB($this->chosenCategory, $this->chosenArticle, $this->editArticleName, $this->editArticleDesc, $this->editArticlePrice);
            }
        }




        //DELETE SECTION

        if($this->deleteView->deleteCategory() || $this->deleteView->chooseCategory()){
            $this->categories=$this->adminRepository->getAllCategories();
            $this->deleteView->setCategories($this->categories);
        }
        if($this->deleteView->deleteCategoryConfirm()){
            $this->deleteCategoryName = $this->deleteView->getDeleteCategoryName();
            $this->adminRepository->deleteCategory($this->deleteCategoryName);
        }
        if($this->deleteView->deleteArticle()){
            $this->choosenCategoryName = $this->deleteView->getChoosenCategory();
            $this->adminModel->storeCategory($this->choosenCategoryName);
            $this->articles = $this->adminRepository->getCategoryArticles($this->choosenCategoryName);
            $this->deleteView->setCategories($this->articles);
        }
        if($this->deleteView->deleteArticleConfirm()){

            $this->categories = $this->adminModel->getStoredCategory();
            $this->chosenArticle = $this->deleteView->articleDropdown();
            $this->adminRepository->deleteArticle($this->categories,$this->chosenArticle);
        }


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

        if($this->adminView->getAdmin() || $this->adminView->getLogged()){return $this->adminView->loggedInForm();}
    }
}