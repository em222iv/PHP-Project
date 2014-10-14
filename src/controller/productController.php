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
    private $categories;
    private $category;
    private $articles;


    public function __construct(productModel $productModel,  adminView $adminView, viewClass $viewClass, productRepository $productRepository) {
        $this->productView = $viewClass;
        $this->adminView =  $adminView;
        $this->productModel = $productModel;
        $this->productRepository = $productRepository;
    }

    public function productControll() {
        $this->categories =$this->productRepository->getAllCategories();
        //$this->productModel->categories($this->productRepository->getCategories());
        $this->productView->setProducts($this->categories);


        $this->category = $this->productView->getChosenCategory();
        if($this->productView->getArticles()){
            var_dump('2');

        $this-> articles = $this->productRepository->getArticlesFromChosenCategory($this->category);

        }
    }
}