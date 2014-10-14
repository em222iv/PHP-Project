<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 08/10/14
 * Time: 14:38
 */

class AddView {

    private $categories;
    private $category;
    private $value;

    public function __construct(){


    }

    public function setCategories($db_categories) {
       $this->categories = $db_categories;

    }

    private $image;

    //Adding category input section
    function getAddCategoryName() {
        if(isset($_POST['addCategoryName'])) {
            return $_POST['addCategoryName'];
        }
        return false;
    }

    function getAddCategoryImage() {
        if(isset($_POST['file'])) {
            return $_POST['file'];
        }
        return false;
    }

    //Adding article input section
    function getAddArticleName() {
        if(isset($_POST['addArticleName'])) {
            return $_POST['addArticleName'];
        }
        return false;
    }
    function getAddArticleDesc() {
        if(isset($_POST['addArticleDesc'])) {
            return $_POST['addArticleDesc'];
        }
        return false;
    }

    function getAddArticlePrice() {
        if(isset($_POST['addArticlePrice'])) {
            return $_POST['addArticlePrice'];
        }
        return false;
    }
    function getAddArticleImage() {
        if(isset($_POST['file'])) {
            return $_POST['file'];
        }
        return false;
    }

    //get Image






    //Add menu section
    function addMenu() {
        if(isset($_GET['add'])) {
            return true;
        }
        return false;
    }

    public function addForm() {

        $ret = "
             <div class='row'>
                <div class='large-12 columns'>
                   <h3>Administrator</h3>
                    <a href='?addCategory' class='button expand'>ADD CATEGORY</a>
                    <a href='?addArticle' class='button expand'>ADD ARTICLE</a>
                    <a href='?logged' class='button expand'>BACK</a>
                </div>
            </div>
    ";
        return $ret;
    }

    //Add category section
    public function addCategory() {
        if(isset($_GET['addCategory'])){
            return true;
        }
        return false;
    }
    public function addCategoryConfirm() {
        if(isset($_GET['addCategoryConfirm'])){
            return true;
        }
        return false;
    }

    public function addCategoryForm() {

        $ret = "
            <form method='post' action='?addCategoryConfirm' enctype='multipart/form-data'>
                 <div class='row'>
                    <div class='large-12 columns'>
                       <h3>Administrator - Add new Category</h3>
                        <div class='large-4 columns'>
                          <label>Category Name
                            <input type='text' placeholder='ex. Otters' name='addCategoryName' />
                          </label>
                        </div>
                        <div class='large-6 columns'>
                            <label for='file'>Filename:</label>
                            <input type='file' name='file' id='file'><br>
                        </div>
                    </div>
                    <input type='submit' class='button expand' name='addCategory' value='CONFIRM'>
                    <a href='?add' class='button expand'>BACK</a>
                </div>
            </form>
    ";

        return $ret;
    }

    //Add article section

    public function addArticle() {
        if(isset($_GET['addArticle'])){
            return true;
        }
        return false;
    }
    public function addArticleConfirm() {
        if(isset($_GET['addArticleConfirm'])){
            return true;
        }
        return false;
    }
    public function categoryDropDown() {
        if(isset($_POST['categoryDropDown'])){

        }
        return false;
    }

    private function categoryDropDownLoop(){
        $ret = '<select name=dropdown>';

        foreach ($this->categories as $category) {
            $ret .= '<option value= '. $category[1] .'>' . $category [1]. '</option>';
        }
        $ret .= '</select>';
        return $ret;
    }
    public function getChosenCategory() {
        if(isset($_POST['dropdown'])){
            return $_POST['dropdown'];
        }
        return false;
    }

    public function addArticleForm() {
        $categories = $this->categoryDropDownLoop();

        $ret = "
            <form method='post' action='?addArticleConfirm' enctype='multipart/form-data' >
                 <div class='row'>
                    <div class='large-12 columns'>
                       <h3>Administrator - Add new Article</h3>
                       <div class='large-12 columns'>
                          <label>Select Category
                            <select name=dropdown>
                            <?php
                                $categories
                            </select>
                          </label>
                        </div>
                        <hr>
                        <div class='large-4 columns'>
                          <label>Article Name
                            <input type='text' placeholder='ex. Duuwrp the Owtter' name='addArticleName'/>
                          </label>
                        </div>
                         <div class='large-2 columns'>
                          <label>Article price
                            <input type='number' name='addArticlePrice' min='1' max='10000'>
                          </label>
                        </div>
                        <div class='large-6 columns'>
                            <label>Article description
                                <textarea placeholder='Anything we need to know?' name='addArticleDesc'></textarea>
                            </label>
                        </div>
                        <div class='large-12 columns'>
                            <label>Choose Picture
                            <fieldset>
                                <input type='file' name='file' id='file' accept='image/gif, image/jpeg, image/png'>
                            </fieldset>
                         </label>
                        </div>
                    </div>
                    <input type='submit' class='button expand' name='addArticle' value='CONFIRM'>
                    <a href='?add' class='button expand'>BACK</a>
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
            if($_FILES["file"]["size"] > 3000000){
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