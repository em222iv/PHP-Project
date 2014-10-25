<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 08/10/14
 * Time: 14:38
 */


class EditView {

    private $categories;
    private $category;
    private $articles;
    private $article;

    private $errorMSG;
    private $successMSG;

    private static $edit = "edit";
    private static $editCategory = "editCategory";
    private static $editCategoryName = "editCategoryName";
    private static $editChooseCategory = "editChooseCategory";

    private static $editArticleCategory = "editArticleCategory";
    private static $chooseArticle = "chooseArticle";

    private static $articleDropdown = "articleDropdown";
    private static $editArticle = "editArticle";

    private static $categoryDropdown = "categoryDropdown";

    private static $editArticleConfirm = "editArticleConfirm";
    private static $editArticleName = "editArticleName";
    private static $editArticlePrice = "editArticlePrice";
    private static $editArticleDesc = "editArticleDesc";
    private static $editCategoryConfirm = "editCategoryConfirm";



    public function setCategories($db_categories) {
        $this->categories = $db_categories;
    }
    public function setCategory($db_category) {
        $this->category = $db_category;

    }
    public function setArticles($db_articles) {
        $this->articles = $db_articles;

    }
    public function setArticle($db_article) {
        $this->article = $db_article;
    }

    public function setEditErrorMSG($errorMSG) {

        $this->errorMSG = $errorMSG;
    }

    public function setSuccessMSG($successMSG) {
        $this->successMSG = "<span class='success label'>$successMSG</span>";
    }

    function editMenu() {
        if(isset($_GET[self::$edit])) {
            return true;
        }
        return false;
    }

    public function editForm() {

        $ret = "
             <div class='row'>
                <div class='large-12 columns'>
                   <h3>Administrator - Edit Menu</h3>

                    <a href=?".self::$editChooseCategory." class='button expand'>EDIT CATEGORY</a>
                    <a href=?".self::$editArticleCategory." class='button expand'>EDIT ARTICLE</a>
                    <a href='?logged' class='button expand'>BACK</a>
                </div>
                </div>
            </div>

    ";
        return $ret;
    }

    public function editCategory() {
        if(isset($_GET[self::$editCategory])){

            return true;
        }
        return false;
    }
    public function editChooseCategory() {
        if(isset($_GET[self::$editChooseCategory])){
            return true;
        }
        return false;
    }

    public function editChooseCategoryForm() {
        if(isset($this->errorMSG)){
            $errorMSG = "<small class='error'>$this->errorMSG</small>";
        }else {
            $errorMSG ="";
        }
        $categories = $this->categoryDropDownLoop();
        $ret = "
            <form method='post' action='?".self::$editCategory."' enctype='multipart/form-data'>
                 <div class='row'>
                    <div class='large-12 columns'>
                       <h3>Administrator - Edit Category</h3>
                            $this->successMSG
                            $errorMSG
                            <label>Select Category to edit
                            <select name=".self::$categoryDropdown.">
                            <?php
                                $categories
                            </select>
                         <input type='submit' class='button expand' name=".self::$editCategory." value='CONFIRM'>
                        <a href='?edit' class='button expand'>BACK</a>
                    </div>
                </div>
            </form>
    ";

        return $ret;
    }



    public function editCategoryName() {
        if(isset($_POST[self::$editCategoryName])){
            return $_POST[self::$editCategoryName];
        }
        return false;
    }
    public function editCategoryConfirm() {
        if(isset($_GET[self::$editCategoryConfirm])){
            return true;
        }
        return false;
    }
    public function editCategoryForm() {
        if(isset($this->category[0])){
        $categoryName = $this->category[0][1];
        $categoryImage = $this->category[0][2];
        $categoryName = "<input type=text name=editCategoryName value=$categoryName>";
        $img = '<img src="data:image/png;base64,'.base64_encode($categoryImage).'">';
        } else {
            $categoryName = "";
            $img = "";
        }

        $ret = "
            <form method='post' action='?".self::$editCategoryConfirm."' enctype='multipart/form-data'>
                 <div class='row'>
                    <div class='large-12 columns'>
                       <h3>Administrator - Edit Category</h3>
                       <div class='large-4 columns'>
                         <fieldset>
                          $img
                            <label>Change Picture
                                <input type='file' name='file' id='file'><br>
                            </label>
                          </fieldset>
                            $categoryName
                          </div>
                         <input type='submit' class='button expand' name=".self::$editCategoryConfirm." value='CONFIRM'>
                        <a href='?".self::$edit." class='button expand'>BACK</a>
                    </div>
                </div>
            </form>
    ";

        return $ret;
    }

    //Edit article section

    public function getEditArticleCategory() {
        if(isset($_GET[self::$editArticleCategory])){
            return true;
        }
        return false;
    }

    public function chooseArticle() {
        if(isset($_GET[self::$chooseArticle])){
            return true;
        }
        return false;
    }


    public function editArticleCategoryForm() {

        if(isset($this->errorMSG)){
            $errorMSG = "<small class='error'>$this->errorMSG</small>";
        }else {
            $errorMSG ="";
        }
        $categories = $this->categoryDropDownLoop();
        $ret = "
            <form method='post' action='?".self::$chooseArticle."' enctype='multipart/form-data'>
                 <div class='row'>
                    <div class='large-12 columns'>
                       <h3>Administrator - Choose Category</h3>
                        <label>Select Category to edit</label>
                        $this->successMSG
                        $errorMSG
                                <select name='".self::$categoryDropdown ."'>
                                    <?php
                                        $categories
                                </select>
                            </label>
                            <input type='submit' class='button expand' name=".self::$chooseArticle."  value='CONFIRM'>
                            <a href='?".self::$edit." class='button expand'>BACK</a>


                    </div>

                </div>
            </form>
    ";
        return $ret;
    }


    private function articleDropDownLoop(){
        $ret = '<select name='.self::$articleDropdown.'>';

        foreach ($this->articles as $article) {
            $ret .= '<option value="'. $article[1] .'">' . $article [1]. '</option>';
        }
        $ret .= '</select>';
        return $ret;
    }
    public function dropdownArticleChoice() {
        if(isset($_POST[self::$articleDropdown])){
            return $_POST[self::$articleDropdown];
        }
        return false;
    }



    public function editArticle() {
        if(isset($_GET[self::$editArticle])){
            return true;
        }
        return false;
    }


    public function chooseArticleForm() {

        $articles = $this->articleDropDownLoop();
        $ret = "
            <form method='post' action='?".self::$editArticle."' enctype='multipart/form-data'>
                 <div class='row'>
                    <div class='large-12 columns'>
                       <h3>Administrator - Choose Article</h3>
                        <label>Select Category to edit
                                <select name=".self::$articleDropdown.">
                                    <?php
                                        $articles
                                </select>
                            </label>
                            <input type='submit' class='button expand' name=".self::$editArticle." value='CONFIRM'>
                            <a href='?".self::$edit." class='button expand'>BACK</a>
                    </div>

                </div>
            </form>
    ";
        return $ret;
    }




    public function editArticleConfirm() {
        if(isset($_GET[self::$editArticleConfirm])){
            return true;
        }
        return false;
    }

    public function getEditArticleName() {
        if(isset($_POST[self::$editArticleName])){
            return $_POST[self::$editArticleName];
        }
        return false;
    }
    public function getEditArticlePrice() {
        if(isset($_POST[self::$editArticlePrice])){
            return $_POST[self::$editArticlePrice];
        }
        return false;
    }
    public function getEditArticleDesc() {
        if(isset($_POST[self::$editArticleDesc])){
            return $_POST[self::$editArticleDesc];
        }
        return false;
    }

    public function getEditImage() {
        if(!file_exists($_FILES['file']['tmp_name']) || !is_uploaded_file($_FILES['file']['tmp_name'])) {
            return false;
        }
        return true;
    }

    public function editArticleForm() {
        if(isset($this->article[0])){
            $articleName = $this->article[0][1];
            $articleDesc = $this->article[0][2];
            $articlePrice = $this->article[0][3];

            $articleName = "<input type=text name=".self::$editArticleName." value=$articleName>";
            $articleDesc = "<textarea name=".self::$editArticleDesc.">$articleDesc</textarea>";
            $articlePrice = "<input type=number name=".self::$editArticlePrice." value=$articlePrice  min='1' max='10000' required>";

            $articleImage = $this->article[0][4];
        }else{
            $articleName = "";
            $articleDesc = "";
            $articlePrice = "";
            $articleImage = "";
        }

        $img = '<img src="data:image/png;base64,'.base64_encode($articleImage).'">';

        $ret = "
               <form method='post' action='?editArticleConfirm' enctype='multipart/form-data'>
                    <div class='large-12 columns'>
                        <div class='row'>
                             <div class='large-3 panel columns'>
                             <fieldset>
                                $img
                                <fieldset>
                                    <label>Change Picture
                                        <input type='file' name='file' id='file'><br>
                                    </label>
                                </fieldset>
                                <h5>Name: $articleName</h5>
                                <h5>Price: $articlePrice KR</h5>
                                </fieldset>


                            </div>
                             <div class='large-9 columns'>
                                <div class='panel'>
                                    <h5>Description</h5><hr>
                                    <p>$articleDesc</p>
                                </div>

                            </div>
                       <div class='large-9 small-12 columns'><input type='submit' class='button expand' name=".self::$editArticleConfirm." value='CONFIRM'></div>
                   </div>
               </form>

        ";
        return $ret;
    }

    private function categoryDropDownLoop(){
        $ret = '<select  name='.self::$categoryDropdown.'>';

        foreach ($this->categories as $category) {
            $ret .= '<option value="'. $category[1] .'">' . $category [1]. '</option>';
        }
        $ret .= '</select>';
        return $ret;
    }
    public function dropdownCategoryChoice() {
        if(isset($_POST[self::$categoryDropdown])){
            return $_POST[self::$categoryDropdown];
        }
        return false;
    }

    function validateImage() {
        if(isset($_FILES['file'])){
            $this->image = $_FILES["file"];

            if ($_FILES["file"]["error"] > 0) {

                echo "Error, no picture";
                return false;
                //echo "Error: " . $_FILES["file"]["error"] . "<br>";
            } else {


                //echo "Upload: " . $_FILES["file"]["name"] . "<br>";
                //echo "Type: " . $_FILES["file"]["type"] . "<br>";
                if($_FILES["file"]["size"] > 1500000){
                    echo "Error, picture is to big";
                    return false;
                } //"Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
                //echo "Stored in: " . $_FILES["file"]["tmp_name"];
            }
        }
        return true;

    }
    public function getImage() {
        if(isset($this->image)){
            return $this->image;
        }
    }
}