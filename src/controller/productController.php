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



    public function __construct(productModel $productModel,  adminView $adminView, viewClass $viewClass, productRepository $productRepository, loginModel $loginModel) {
        $this->productView = $viewClass;
        $this->adminView =  $adminView;
        $this->productModel = $productModel;
        $this->productRepository = $productRepository;
        $this->loginModel = $loginModel;
    }

    public function productControll() {
        $this->categories =$this->productRepository->getAllCategories();
        $this->productView->setCategories($this->categories);


        if($this->productView->getArticles()){
            $this->productModel->storeCategory($this->productView->getChosenCategory());
            $this->category = $this->productModel->getStoredCategory();

            $this->articles = $this->productRepository->getArticlesFromChosenCategory($this->category);
            $this->productView->setArticles($this->articles);

        }

        if($this->productView->getArticleInfo()){
            $this->productView->unsetEditArray();
            if($this->loginModel->loginSESSIONExist()){

                $this->productView->setEditArticleInfo();
            }
            $this->category = $this->productModel->getStoredCategory();
            $this->article = $this->productView->getChosenArticle();


            $this->article = $this->productRepository->getArticleInfo($this->article,$this->category);

            $this->productView->setArticleInfo($this->article);

        }

    }
}