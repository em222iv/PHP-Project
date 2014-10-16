<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 06/10/14
 * Time: 15:26
 */

class productModel{

    private $array;
  function categories($categories) {

  }

    public function getCategories(){
        return $this->categories;

    }
    public function getCategoryArray(){
        return $this->array;

    }
    //unsetta session vid lämpligt tillfälle.Annars buggar den och kommer innehålla "webshop.kategori"

    public function storeCategory($category) {
            $_SESSION['category'] = $category;

    }
    public function getStoredCategory() {
        if(isset($_SESSION['category'])){
            return $_SESSION['category'];
        }

    }
}
