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

    function editMenu() {
        if(isset($_GET['edit'])) {
            return true;
        }
        return false;
    }

    public function editForm() {

        $ret = "
             <div class='row'>
                <div class='large-12 columns'>
                   <h3>Administrator - Edit Menu</h3>
                    <a href='?editChooseCategory' class='button expand'>EDIT CATEGORY</a>
                    <a href='?editArticleCategory' class='button expand'>EDIT ARTICLE</a>
                    <a href='?logged' class='button expand'>BACK</a>
                </div>
                </div>
            </div>

    ";
        return $ret;
    }

    public function editCategory() {
        if(isset($_GET['editCategory'])){

            return true;
        }
        return false;
    }



    private function categoryDropDownLoop(){
        $ret = '<select name=categoryDropdown>';

        foreach ($this->categories as $category) {
            $ret .= '<option value= '. $category[1] .'>' . $category [1]. '</option>';
        }
        $ret .= '</select>';
        return $ret;
    }


    public function dropdownCategoryChoice() {
        if(isset($_POST['categoryDropdown'])){
            return $_POST['categoryDropdown'];
        }
        return false;
    }

    function getEditCategoryName() {
        if(isset($_POST['editCategoryName'])) {
            return $_POST['editCategoryName'];
        }
        return false;
    }
    public function editCategoryConfirm() {
        if(isset($_GET['editCategoryConfirm'])){
            return true;
        }
        return false;
    }
    public function editChooseCategory() {
        if(isset($_GET['editChooseCategory'])){
            return true;
        }
        return false;
    }

    public function editChooseCategoryForm() {

        $categories = $this->categoryDropDownLoop();
        $ret = "
            <form method='post' action='?editCategory' enctype='multipart/form-data'>
                 <div class='row'>
                    <div class='large-12 columns'>
                       <h3>Administrator - Edit Category</h3>
                            <label>Select Category to edit
                            <select name='categoryDropdown'>
                            <?php
                                $categories
                            </select>
                         <input type='submit' class='button expand' name='editCategory' value='CONFIRM'>
                        <a href='?edit' class='button expand'>BACK</a>
                    </div>
                </div>
            </form>
    ";

        return $ret;
    }



    public function editCategoryName() {
        if(isset($_POST['editCategoryName'])){
            return $_POST['editCategoryName'];
        }
        return false;
    }
    public function editCategoryForm() {

        $categoryName = $this->category[0][1];
        $categoryImage = $this->category[0][2];

        $categoryName = "<input type=text name=editCategoryName value=$categoryName>";

        $img = '<img src="data:image/png;base64,'.base64_encode($categoryImage).'">';

        $ret = "
            <form method='post' action='?editCategoryConfirm' enctype='multipart/form-data'>
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
                         <input type='submit' class='button expand' name='editCategoryConfirm' value='CONFIRM'>
                        <a href='?edit' class='button expand'>BACK</a>
                    </div>
                </div>
            </form>
    ";

        return $ret;
    }

    //Edit article section

    public function getEditArticleCategory() {
        if(isset($_GET['editArticleCategory'])){
            return true;
        }
        return false;
    }

    public function chooseArticle() {
        if(isset($_GET['chooseArticle'])){
            return true;
        }
        return false;
    }


    public function editArticleCategoryForm() {

        $categories = $this->categoryDropDownLoop();
        $ret = "
            <form method='post' action='?chooseArticle' enctype='multipart/form-data'>
                 <div class='row'>
                    <div class='large-12 columns'>
                       <h3>Administrator - Choose Category</h3>
                        <label>Select Category to edit</label>
                                <select name='categoryDropdown'>
                                    <?php
                                        $categories
                                </select>
                            </label>
                            <input type='submit' class='button expand' name='chooseArticle' value='CONFIRM'>
                            <a href='?edit' class='button expand'>BACK</a>


                    </div>

                </div>
            </form>
    ";
        return $ret;
    }


    private function articleDropDownLoop(){
        $ret = '<select name=articleDropdown>';

        foreach ($this->articles as $article) {
            $ret .= '<option value= '. $article[1] .'>' . $article [1]. '</option>';
        }
        $ret .= '</select>';
        return $ret;
    }
    public function dropdownArticleChoice() {
        if(isset($_POST['articleDropdown'])){
            return $_POST['articleDropdown'];
        }
        return false;
    }



    public function editArticle() {
        if(isset($_GET['editArticle'])){
            return true;
        }
        return false;
    }


    public function chooseArticleForm() {

        $articles = $this->articleDropDownLoop();
        $ret = "
            <form method='post' action='?editArticle' enctype='multipart/form-data'>
                 <div class='row'>
                    <div class='large-12 columns'>
                       <h3>Administrator - Choose Article</h3>
                        <label>Select Category to edit
                                <select name='articleDropdown'>
                                    <?php
                                        $articles
                                </select>
                            </label>
                            <input type='submit' class='button expand' name='editArticle' value='CONFIRM'>
                            <a href='?edit' class='button expand'>BACK</a>
                    </div>

                </div>
            </form>
    ";
        return $ret;
    }




    public function editArticleConfirm() {
        if(isset($_GET['editArticleConfirm'])){
            return true;
        }
        return false;
    }

    public function getEditArticleName() {
        if(isset($_POST['editArticleName'])){
            return $_POST['editArticleName'];
        }
        return false;
    }
    public function getEditArticlePrice() {
        if(isset($_POST['editArticlePrice'])){
            return $_POST['editArticlePrice'];
        }
        return false;
    }
    public function getEditArticleDesc() {
        if(isset($_POST['editArticleDesc'])){
            return $_POST['editArticleDesc'];
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

        $articleName = $this->article[0][1];
        $articleDesc = $this->article[0][2];
        $articlePrice = $this->article[0][3];

        $articleName = "<input type=text name=editArticleName value=$articleName>";
        $articleDesc = "<textarea name='editArticleDesc'>$articleDesc</textarea>";
        $articlePrice = "<input type=text name=editArticlePrice value=$articlePrice>";
        $articleImage = $this->article[0][4];

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
                       <div class='large-9 small-12 columns'><input type='submit' class='button expand' name='editArticleConfirm' value='CONFIRM'></div>
                   </div>
               </form>

        ";
        return $ret;
    }

    function validateImage() {

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
        return true;

    }
    public function getImage() {
        if(isset($this->image)){
            return $this->image;
        }
    }
}