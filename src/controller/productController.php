<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 03/10/14
 * Time: 14:27
 */


class productController {

    private $productView;
    private $adminView;
    private $productModel;

    public function __construct(productModel $productModel,  adminView $adminView, viewClass $viewClass, productRepository $productRepository) {
        $this->productView = $viewClass;
        $this->adminView =  $adminView;
        $this->productModel = $productModel;
        $this->productRepository = $productRepository;
    }

    public function productControll() {
        $this->productRepository->importCategories();
        $this->productModel->categories($this->productRepository->getCategories());

    }
}