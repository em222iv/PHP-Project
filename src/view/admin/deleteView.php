<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 14/10/14
 * Time: 21:28
 */

class deleteView {

    private $products;
    private $successMSG;

    private static $categoryDropdown = 'categoryDropdown';
    private static $delete = 'delete';
    private static $deleteCategory = 'deleteCategory';
    private static $chooseCategory = 'chooseCategory';
    private static $deleteCategoryConfirm = 'deleteCategoryConfirm';
    private static $deleteArticleConfirm = 'deleteArticleConfirm';
    private static $deleteArticle = 'deleteArticle';
    private static $chooseCategoryDropdown = 'chooseCategoryDropdown';
    private static $articleDropdown = 'articleDropdown';

    public function setCategories($db_categories) {
        $this->products = $db_categories;
    }

    public function setSuccessMSG($successMSG) {
        $this->successMSG = "<span class='success label'>$successMSG</span>";
    }
    private function categoryDropDownLoop(){
        $ret = '<select name='.self::$categoryDropdown.'>';

            if(isset($this->products)){
                foreach ($this->products as $category) {
                    $ret .= '<option value= '. $category[1] .'>' . $category [1]. '</option>';
                }
            }
            $ret .= '</select>';
            return $ret;

    }
    function getDeleteCategoryName() {
        if(isset($_POST[self::$categoryDropdown])) {
            return $_POST[self::$categoryDropdown];
        }
        return false;
    }
    public function delete() {
        if(isset($_GET[self::$delete])){

            return true;
        }
        return false;
    }

    //MENU SECTION WITH GETTERS
    public function deleteCategory() {
        if(isset($_GET[self::$deleteCategory])){

            return true;
        }
        return false;
    }
    public function chooseCategory() {
        if(isset($_GET[self::$chooseCategory])){
            return true;
        }
        return false;
    }
    public function deleteMenuForm() {

        $ret = "

                 <div class='row'>
                    <div class='large-12 columns'>
                    $this->successMSG
                       <h3>Administrator - Delete selection </h3>

                        <div class='large-12 columns'>
                             <a href='?".self::$deleteCategory."' class='button expand'>DELETE CATEGORY</a>
                             <a href='?".self::$chooseCategory."' class='button expand'>DELETE ARTICLE</a>
                            <a href='?logged' class='button expand'>BACK</a>
                        </div>
                    </div>
                </div>

    ";

        return $ret;
    }

    public function deleteCategoryConfirm() {
        if(isset($_POST[self::$deleteCategoryConfirm])){
            return true;
        }
        return false;
    }
    public function deleteCategoryForm() {

        $categories = $this->categoryDropDownLoop();
        $ret = "
            <form method='post' action='?".self::$deleteCategoryConfirm."' enctype='multipart/form-data'>
                 <div class='row'>
                    <div class='large-12 columns'>
                       <h3>Administrator - Delete Category</h3>
                        <div class='large-4 columns'>
                            <label>Select Category to delete
                                <select name='".self::$categoryDropdown."'>
                                    <?php
                                        $categories
                                </select>
                            </label>
                        </div>
                    </div>
                    <input type='submit' class='button expand' name='".self::$deleteCategoryConfirm."' value='DELETE CATEGORY'>
                    <a href='?".self::$delete."' class='button expand'>BACK</a>
                </div>
            </form>
    ";

        return $ret;
    }




    public function deleteArticle() {
        if(isset($_GET[self::$deleteArticle])){

            return true;
        }
        return false;
    }
    public function getChoosenCategory() {
        if(isset($_POST[self::$chooseCategoryDropdown])){
            return $_POST[self::$chooseCategoryDropdown];
        }
        return false;
    }
    public function chooseCategoryForm() {

        $categories = $this->categoryDropDownLoop();
        $ret = "
            <form method='post' action='?".self::$deleteArticle."' enctype='multipart/form-data'>
                 <div class='row'>
                    <div class='large-12 columns'>
                       <h3>Administrator - Delete Category</h3>
                        <div class='large-4 columns'>
                            <label>Select Category to delete
                                <select name='".self::$chooseCategoryDropdown."'>
                                    <?php
                                        $categories
                                </select>
                            </label>
                        </div>
                    </div>
                    <input type='submit' class='button expand' name='".self::$deleteArticle."' value='CHOOSE CATEGORY'>
                    <a href='?".self::$delete."' class='button expand'>BACK</a>
                </div>
            </form>
    ";

        return $ret;
    }




    public function deleteArticleConfirm() {
        if(isset($_GET[self::$deleteArticleConfirm])){
            return true;
        }
        return false;
    }
    public function articleDropdown() {
        if(isset($_POST[self::$articleDropdown])){
            return $_POST[self::$articleDropdown];
        }
        return false;
    }
    public function deleteArticleForm() {

        $article = $this->categoryDropDownLoop();
        $ret = "
            <form method='post' action='?".self::$deleteArticleConfirm."' enctype='multipart/form-data'>
                 <div class='row'>
                    <div class='large-12 columns'>
                       <h3>Administrator - Delete Article</h3>
                        <div class='large-4 columns'>
                            <label>Select Article to delete
                                <select name='".self::$articleDropdown."'>
                                    <?php
                                        $article
                                </select>
                            </label>
                        </div>
                    </div>
                    <input type='submit' class='button expand' name='".self::$deleteArticleConfirm."' value='CHOOSE ARTICLE'>
                    <a href='?".self::$chooseCategory."' class='button expand'>BACK</a>
                </div>
            </form>
    ";

        return $ret;
    }
}