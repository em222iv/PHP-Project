<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 03/10/14
 * Time: 14:27
 */


class productController{

    private $productView;
    private $adminView;
    private $productModel;
    private $loginModel;

    private $categories;
    private $category;
    private $articles;
    private $article;

    //constructor get injected with objects, sets them
    public function __construct(productModel $productModel,  adminView $adminView, viewClass $viewClass, productRepository $productRepository, loginModel $loginModel) {
        $this->productView = $viewClass;
        $this->adminView =  $adminView;
        $this->productModel = $productModel;
        $this->productRepository = $productRepository;
        $this->loginModel = $loginModel;
    }
    //controls flow of productpage
    public function productControll() {
        //shows categories on startpage
        $this->categories =$this->productRepository->getAllCategories();
        $this->productView->setCategories($this->productModel->replaceCharWithSpace($this->categories));

        //gets array of chosen category articles and shows them
        if($this->productView->getArticles()){
            $this->productModel->storeCategory($this->productModel->replaceSpaceWithChar($this->productView->getChosenCategory()));

            $this->category = $this->productModel->getStoredCategory();

            $this->articles = $this->productRepository->getArticlesFromChosenCategory($this->category);
            $this->productView->setArticles($this->productModel->replaceCharWithSpace($this->articles));
        }

        //gets specific article
        if($this->productView->getArticleInfo()){
            $this->productView->unsetEditArray();
            if($this->loginModel->loginSESSIONExist()){
                $this->productView->setEditArticleInfo();
            }
            $this->category = $this->productModel->getStoredCategory();
            //replace functions changes whitespace to characters for because of database issues.
            $this->article = $this->productModel->replaceSpaceWithChar($this->productView->getChosenArticle());
            $this->article = $this->productModel->replaceCharWithSpace($this->productRepository->getArticleInfo($this->article,$this->category));
            $this->productView->setArticleInfo($this->article);
        }
    }
}