<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 08/10/14
 * Time: 14:38
 */


class EditView {

    private $categories;
    private $articles;

    public function setCategories($db_categories) {
        $this->categories = $db_categories;
    }
    public function setArticles($db_articles) {
        $this->articles = $db_articles;

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

                <a href='?editCategory' class='button expand'>EDIT CATEGORY</a>
                <a href='?editArticleCategory' class='button expand'>EDIT ARTICLE</a>
                <a href='?logged' class='button expand'>BACK</a>
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

    public function editCategoryConfirm() {
        if(isset($_GET['editCategoryConfirm'])){
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

  
    public function dropdownArticleChoice() {
        if(isset($_POST['articleDropdown'])){
            return $_POST['articleDropdown'];
        }
        return false;
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

    public function editCategoryForm() {

        $categories = $this->categoryDropDownLoop();
        $ret = "
            <form method='post' action='?editCategoryConfirm' enctype='multipart/form-data'>
                 <div class='row'>
                    <div class='large-12 columns'>
                       <h3>Administrator - Edit Category</h3>
                        <div class='large-4 columns'>
                            <label>Select Category to edit
                                <select name='categoryDropdown'>
                                    <?php
                                        $categories
                                </select>
                            </label>
                            <label>New Category name
                            <input type='text' name='editCategoryName' />
                            </label>
                            <hr>
                        </div>
                        <div class='large-6 columns'>
                          <label>Choose Picture
                            <input type='file' name='file' id='file'><br>
                          </label>
                          <hr>
                        </div>
                    </div>
                    <input type='submit' class='button expand' name='editCategory' value='CONFIRM'>
                    <a href='?edit' class='button expand'>BACK</a>
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

    public function editArticle() {
        if(isset($_GET['editArticle'])){
            return true;
        }
        return false;
    }

    public function editArticleCategoryForm() {

        $categories = $this->categoryDropDownLoop();
        $ret = "
            <form method='post' action='?editArticle' enctype='multipart/form-data'>
                 <div class='row'>
                    <div class='large-12 columns'>
                       <h3>Administrator - Edit Article</h3>
                        <label>Select Category to edit
                                <select name='categoryDropdown'>
                                    <?php
                                        $categories
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


    private function articleDropDownLoop(){
        $ret = '<select name=articleDropdown>';

        foreach ($this->articles as $article) {
            $ret .= '<option value= '. $article[1] .'>' . $article [1]. '</option>';
        }
        $ret .= '</select>';
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

    public function editArticleForm() {

        $articles = $this->articleDropDownLoop();
        $ret = "
            <form method='post' action='?editArticleConfirm' enctype='multipart/form-data'>
                 <div class='row'>
                    <div class='large-12 columns'>

                       <div class='large-12 columns'>
                        <h3>Administrator - Edit Article</h3>
                        <label>Select Article to edit
                                <select name=articleDropdown>
                                    <?php
                                        $articles
                                </select>
                            </label>
                            <hr>
                        </div>

                      <div class='large-4 columns'>
                          <label>Article Name
                            <input type='text' placeholder='ex. Duuwrp the Owtter' name='editArticleName'/>
                          </label>
                        </div>
                         <div class='large-2 columns'>
                          <label>Article price
                            <input type='number' name='editArticlePrice' min='1' max='10000'>
                          </label>
                        </div>
                        <div class='large-6 columns'>
                            <label>Article description
                                <textarea placeholder='Anything we need to know?' name='editArticleDesc'></textarea>
                            </label>
                        </div>
                        <div class='large-12 columns'>
                            <label>Choose Picture
                            <fieldset>
                                <input type='file' name='file' id='file' accept='image/gif, image/jpeg, image/png'>
                            </fieldset>
                         </label>
                        </div>
                        <div class='large-12 columns'>
                          <input type='submit' class='button expand' name='editArticleConfirm' value='CONFIRM'>
                          <a href='?edit' class='button expand'>BACK</a>
                        </div>
                    </div>
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

            /*$img = ImageCreateFromJpeg($_FILES["file"]["tmp_name"]);

            $imageWidth = imagesx($img);
            $imageHeight = imagesy($img);
            $imageAspects = imagecreatetruecolor($imageWidth, $imageHeight);*/


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

        return $this->image;
    }
}