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
    //validation for products going in to databse
    public function validateAddorEditContent($name = null,$desc = null,$price = null) {
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
                    $this->errorMSG = 2;
                    return false;
                }
            }
        return true;
    }
//storing info in sessions
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
    public function storeId($id) {
        return $_SESSION['id'] = $id;
    }
    public function getStoredId() {
        return $_SESSION['id'];
    }

    //replacing space with characters for databse
    //should be put in common model
    public function replaceSpaceWithChar($name) {
        return $this->commonModel->replaceSpaceWithChar($name);
    }
   //replacing character with - instead of spaces. to show for users
    //this because when i try to get URL of the chosen article, spaces arent aloud
    //should be put in common model- duplicate code
    public function replaceCharWithSpace($names) {
        return $this->commonModel->replaceCharWithSpace($names);
    }   //return error msg if validation fails
    public function getErrorMSG () {
        if(isset($this->errorMSG)){
            return $this->errorMSG;
        }
    }
}
