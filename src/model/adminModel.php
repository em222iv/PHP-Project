<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 08/10/14
 * Time: 22:26
 */

class AdminModel{

    private $adminRepository;
    public function __construct(AdminRepository $adminRepository) {
        $this->adminRepository = $adminRepository;

    }

    public function validateAddArticle($name,$desc,$price) {

        if($this->adminRepository->doesArticleExist($name)){

            if(strlen($name) < 2){
                echo "Användarenamet är för kort. Minst 2 tecken";
                return false;
            }

            if(strlen($desc) < 10){
                echo "Det måste finnas en beskrivning av produkten";
                return false;
            }

            if($price = "" || $price < 1){
                echo "Ange ett pris";
                return false;
            }

            if($name != strip_tags($name)) {
                $this->username = strip_tags($name);
                echo "Användarnamnet innehåller ogiltiga tecken";
                return false;
            }

        }

        return true;
    }

    public function validateEditArticle($name,$desc,$price) {

        if(strlen($name) < 2){
            echo "Användarenamet är för kort. Minst 2 tecken";
            return false;
        }

        if(strlen($desc) < 10){
            echo "Det måste finnas en beskrivning av produkten";
            return false;
        }

        if($price = "" || $price < 1){
            echo "Ange ett pris";
            return false;
        }

        if($name != strip_tags($name)) {
            $this->username = strip_tags($name);
            echo "Användarnamnet innehåller ogiltiga tecken";
            return false;
        }
        return true;
    }

    public function validateAddCategory($name,$image) {

        if($this->adminRepository->doesCategoryExist($name)){
            if($name == ""){
                echo "No Category name";
                return false;
            }
            return true;
        }
    }

    public function validateEditCategory($name) {

        if($name == ""){
            echo "No Category name";
            return false;
        }

        return true;
    }

    public function storeCategory($category) {
        return $_SESSION['category'] = $category;
    }
    public function getStoreCategory() {
        return $_SESSION['category'];
    }
    public function replaceWhiteSpace($name) {

        return $name = preg_replace('/\s+/', '', $name);
    }

}
