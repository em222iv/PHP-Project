<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 14/10/14
 * Time: 21:28
 */

class deleteView {

    private $products;

    public function setCategories($db_categories) {
        $this->products = $db_categories;
    }


    private function categoryDropDownLoop(){
        $ret = '<select name=categoryDropdown>';

        if(isset($this->products)){
        foreach ($this->products as $category) {
            $ret .= '<option value= '. $category[1] .'>' . $category [1]. '</option>';
        }
        }
        $ret .= '</select>';
        return $ret;
    }
    function getDeleteCategoryName() {
        if(isset($_POST['categoryDropdown'])) {
            return $_POST['categoryDropdown'];
        }
        return false;
    }
    public function delete() {
        if(isset($_GET['delete'])){

            return true;
        }
        return false;
    }









    //MENU SECTION WITH GETTERS
    public function deleteCategory() {
        if(isset($_GET['deleteCategory'])){

            return true;
        }
        return false;
    }
    public function chooseCategory() {
        if(isset($_GET['chooseCategory'])){
            return true;
        }
        return false;
    }
    public function deleteMenuForm() {

        $ret = "

                 <div class='row'>
                    <div class='large-12 columns'>
                       <h3>Administrator - Delete selection </h3>
                        <div class='large-12 columns'>
                             <a href='?deleteCategory' class='button expand'>DELETE CATEGORY</a>
                             <a href='?chooseCategory' class='button expand'>DELETE ARTICLE</a>
                            <a href='?logged' class='button expand'>BACK</a>
                        </div>
                    </div>
                </div>

    ";

        return $ret;
    }





    public function deleteCategoryConfirm() {
        if(isset($_POST['deleteCategoryConfirm'])){
            return true;
        }
        return false;
    }
    public function deleteCategoryForm() {

        $categories = $this->categoryDropDownLoop();
        $ret = "
            <form method='post' action='?deleteCategoryConfirm' enctype='multipart/form-data'>
                 <div class='row'>
                    <div class='large-12 columns'>
                       <h3>Administrator - Delete Category</h3>
                        <div class='large-4 columns'>
                            <label>Select Category to delete
                                <select name='categoryDropdown'>
                                    <?php
                                        $categories
                                </select>
                            </label>
                        </div>
                    </div>
                    <input type='submit' class='button expand' name='deleteCategoryConfirm' value='DELETE CATEGORY'>
                    <a href='?delete' class='button expand'>BACK</a>
                </div>
            </form>
    ";

        return $ret;
    }




    public function deleteArticle() {
        if(isset($_GET['deleteArticle'])){

            return true;
        }
        return false;
    }
    public function getChoosenCategory() {
        if(isset($_POST['chooseCategoryDropdown'])){
            return $_POST['chooseCategoryDropdown'];
        }
        return false;
    }
    public function chooseCategoryForm() {

        $categories = $this->categoryDropDownLoop();
        $ret = "
            <form method='post' action='?deleteArticle' enctype='multipart/form-data'>
                 <div class='row'>
                    <div class='large-12 columns'>
                       <h3>Administrator - Delete Category</h3>
                        <div class='large-4 columns'>
                            <label>Select Category to delete
                                <select name='chooseCategoryDropdown'>
                                    <?php
                                        $categories
                                </select>
                            </label>
                        </div>
                    </div>
                    <input type='submit' class='button expand' name='deleteArticle' value='CHOOSE CATEGORY'>
                    <a href='?delete' class='button expand'>BACK</a>
                </div>
            </form>
    ";

        return $ret;
    }




    public function deleteArticleConfirm() {
        if(isset($_GET['deleteArticleConfirm'])){
            return true;
        }
        return false;
    }
    public function articleDropdown() {
        if(isset($_POST['articleDropdown'])){
            return $_POST['articleDropdown'];
        }
        return false;
    }
    public function deleteArticleForm() {

        $article = $this->categoryDropDownLoop();
        $ret = "
            <form method='post' action='?deleteArticleConfirm' enctype='multipart/form-data'>
                 <div class='row'>
                    <div class='large-12 columns'>
                       <h3>Administrator - Delete Article</h3>
                        <div class='large-4 columns'>
                            <label>Select Article to delete
                                <select name='articleDropdown'>
                                    <?php
                                        $article
                                </select>
                            </label>
                        </div>
                    </div>
                    <input type='submit' class='button expand' name='deleteArticleConfirm' value='CHOOSE ARTICLE'>
                    <a href='?chooseCategory' class='button expand'>BACK</a>
                </div>
            </form>
    ";

        return $ret;
    }
}