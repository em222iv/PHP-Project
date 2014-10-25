<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 08/10/14
 * Time: 22:26
 */

require_once("commonModel.php");
class AdminModel{
    private $commonModel;
    private $adminRepository;
    private $errorMSG;
    public function __construct(AdminRepository $adminRepository) {
        $this->adminRepository = $adminRepository;
        $this->commonModel = new CommonModel();
    }

    public function validateAddorEditContent($name = null,$desc = null,$price = null) {
            var_dump($price);
            if(isset($name)){

                if(strlen($name) < 2){
                    $this->errorMSG = 0;
                    return false;
                }

                if($name != strip_tags($name)) {
                    $this->errorMSG = 0;
                    return false;
                }
            }
            if(isset($desc)){
                if(strlen($desc) < 10){
                    $this->errorMSG = 1;
                    return false;
                }
                if($desc != strip_tags($desc)) {
                    $this->errorMSG = 1;
                    return false;
                }
            }
            if(isset($price)){
                if($price = ""){
                    var_dump('1');
                    $this->errorMSG = 2;
                    return false;
                }
            }

        return true;
    }


    public function storeCategory($category) {
        return $this->commonModel->storeCategory($category);
    }
    public function getStoredCategory() {
        if(isset($_SESSION['category'])){
            return $this->commonModel->getStoredCategory();
        }
    }
    public function storeArticle($article) {
        return $_SESSION['article'] = $article;
    }
    public function getStoredArticle() {
        return $_SESSION['article'];
    }

    public function replaceSpaceWithChar($name) {
        return $this->commonModel->replaceSpaceWithChar($name);
    }

    public function replaceCharWithSpace($names) {
        return $this->commonModel->replaceCharWithSpace($names);
    }
    public function getErrorMSG () {
        if(isset($this->errorMSG)){
            return $this->errorMSG;
        }
    }
}
