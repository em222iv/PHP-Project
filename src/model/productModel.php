<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 06/10/14
 * Time: 15:26
 */

require_once("commonModel.php");
class productModel{

    private $commonModel;
    //unsetta session vid lämpligt tillfälle.Annars buggar den och kommer innehålla "webshop.kategori"
    public function __construct(){
        $this->commonModel = new CommonModel();
    }
    public function storeCategory($category) {
            return $this->commonModel->storeCategory($category);
    }
    public function getStoredCategory() {
        if(isset($_SESSION['category'])){
            return $this->commonModel->getStoredCategory();
        }
    }
    public function unsetUserSessions() {
        unset($_SESSION['category']);
    }
    public function replaceSpaceWithChar($name) {
        return $this->commonModel->replaceSpaceWithChar($name);
    }

    ///FIXA DETTTA
    public function replaceCharWithSpace($names) {
        return $this->commonModel->replaceCharWithSpace($names);
    }
}
