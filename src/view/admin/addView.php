<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 08/10/14
 * Time: 14:38
 */

class AddView {
    private $categories;
    private $image;
    private $nameError;
    private $priceError;
    private $descError;
    private $imageError;
    private $successMSG;

    private static $addCategoryName = "addCategoryName";
    private static $file = "file";
    private static $addArticleName = "addArticleName";
    private static $addArticleDesc = "addArticleDesc";
    private static $addArticlePrice = "addArticlePrice";
    private static $add = "add";
    private static $addCategory = "addCategory";
    private static $addCategoryConfirm = "addCategoryConfirm";
    private static $addArticle = "addArticle";
    private static $addArticleConfirm = "addArticleConfirm";
    private static $categoryDropDown = "categoryDropDown";
    private static $dropdown = "dropdown";

    public function __construct(){

    }

    public function setCategories($db_categories) {
       $this->categories = $db_categories;
    }

    public function setErrorMSG($errorMSG) {

        if(is_string($errorMSG)){
            switch ($errorMSG) {
                case "nameError":
                    $this->nameError  = "<small class='error'>Invalid name: Name has to be longer than 2 character and only alphabetic or numeric character</small>";
                    break;
                case "imageError":
                    $this->imageError  = "<small class='error'>Invalid picture: Picture must be smaller than 1,5MB and be of types JPG/JPEG, PNG or GIF</small>";
                    break;
                case "priceError":
                    $this->priceError  = "<small class='error'>Invalid price: Price must be between 1 - 10000 and be of numeric characters</small>";
                    break;
                case "descError":
                    $this->descError  = "<small class='error'>Invalid description: Description must be longer than 10 characters </small>";
                    break;
                default:
                    break;
            }
        }
    }
    public function setSuccessMSG($successMSG) {
        $this->successMSG = "<span class='success label'>$successMSG</span>";
    }

    //Adding category input section
    function getAddCategoryName() {
        if(isset($_POST[self::$addCategoryName])) {
            return $_POST[self::$addCategoryName];
        }
        return false;
    }

    function getAddCategoryImage() {
        if(isset($_POST[self::$file])) {
            return $_POST[self::$file];
        }
        return false;
    }

    //Adding article input section
    function getAddArticleName() {
        if(isset($_POST[self::$addArticleName])) {
            return $_POST[self::$addArticleName];
        }
        return false;
    }
    function getAddArticleDesc() {
        if(isset($_POST[self::$addArticleDesc])) {
            return $_POST[self::$addArticleDesc];
        }
        return false;
    }

    function getAddArticlePrice() {
        if(isset($_POST[self::$addArticlePrice])) {
            return $_POST[self::$addArticlePrice];
        }
        return false;
    }
    function getAddArticleImage() {
        if(isset($_POST[self::$file])) {
            return $_POST[self::$file];
        }
        return false;
    }

    //Add menu section
    function addMenu() {
        if(isset($_GET[self::$add])) {
            return true;
        }
        return false;
    }

    public function addForm() {

        $ret = "
             <div class='row'>
                <div class='large-12 columns'>
                   <h3>Administrator</h3>
                    <a href='?".self::$addCategory."' class='button expand'>ADD CATEGORY</a>
                    <a href='?".self::$addArticle."' class='button expand'>ADD ARTICLE</a>
                    <a href='?logged' class='button expand'>BACK</a>
                </div>
            </div>
    ";
        return $ret;
    }

    //Add category section
    public function addCategory() {
        if(isset($_GET[self::$addCategory])){
            return true;
        }
        return false;
    }
    public function addCategoryConfirm() {
        if(isset($_GET[self::$addCategoryConfirm])){
            return true;
        }
        return false;
    }

    public function addCategoryForm() {

        $ret = "
            <form method='post' action='?".self::$addCategoryConfirm."' enctype='multipart/form-data'>
                 <div class='row'>
                    <div class='large-12 columns'>
                       <h3>Administrator - Add new Category</h3>
                        <div class='large-4 columns'>
                          <label>Category Name
                             <label class='error'>
                            <input type='text' placeholder='ex. Otters' name='".self::$addCategoryName."' />
                            </label>
                            $this->nameError
                          </label>
                          <br>
                        </div>
                        <div class='large-6 columns'>
                            <label for='file'>Choose Image</label>
                            <input type='file' name='file' id='file'><br>
                            $this->imageError
                        </div>
                        <div class='large-1 columns'>
                         $this->successMSG
                        </div>
                    </div>
                    <input type='submit' class='button expand' name='".self::$addCategory."' value='CONFIRM'>
                    <a href='?".self::$add."' class='button expand'>BACK</a>
                </div>
            </form>
    ";

        return $ret;
    }

    //Add article section

    public function addArticle() {
        if(isset($_GET[self::$addArticle])){
            return true;
        }
        return false;
    }
    public function addArticleConfirm() {
        if(isset($_GET[self::$addArticleConfirm])){
            return true;
        }
        return false;
    }
    public function categoryDropDown() {
        if(isset($_POST[self::$categoryDropDown])){

        }
        return false;
    }

    private function categoryDropDownLoop(){
        $ret = '<select name='.self::$dropdown.'>';

        foreach ($this->categories as $category) {
            $ret .= '<option value= '. $category[1] .'>' . $category [1]. '</option>';
        }
        $ret .= '</select>';
        return $ret;
    }
    public function getChosenCategory() {
        if(isset($_POST[self::$dropdown])){
            return $_POST[self::$dropdown];
        }
        return false;
    }

    public function addArticleForm() {

        $categories = $this->categoryDropDownLoop();

        $ret = "
            <form method='post' action='?".self::$addArticleConfirm."' enctype='multipart/form-data' >
                 <div class='row'>
                    <div class='large-12 columns'>
                       <h3>Administrator - Add new Article</h3>
                       <div class='large-12 columns'>
                          <label>Select Category $this->successMSG
                            <select name=".self::$dropdown.">
                            <?php
                                $categories
                            </select>
                          </label>
                        </div>
                        <hr>
                        <div class='large-4 columns'>
                          <label>Article Name
                            <label class='error'>
                            <input type='text' placeholder='ex. Duuwrp the Owtter' name='".self::$addArticleName."'/>
                            </label>
                             $this->nameError
                          </label>
                        </div>
                         <div class='large-2 columns'>
                          <label>Article price
                          <label class='error'>
                            <input type='number' name='".self::$addArticlePrice."' min='1' max='10000' required>
                            </label>
                          </label>
                          $this->priceError
                        </div>
                        <div class='large-6 columns'>
                            <label>Article description
                            <label class='error'>
                                <textarea placeholder='Anything we need to know?' name='".self::$addArticleDesc."'></textarea>
                                </label>
                            </label>
                            $this->descError
                        </div>
                        <div class='large-12 columns'>
                            <label>Choose Picture
                            <fieldset>
                                <input type='file' name='file' id='file' accept='image/gif, image/jpeg, image/png' >
                                $this->imageError
                            </fieldset>
                         </label>
                        </div>
                    </div>
                    <input type='submit' class='button expand' name='".self::$addArticle."' value='CONFIRM'>
                    <a href='?".self::$add."' class='button expand'>BACK</a>
                </div>
            </form>
    ";

        return $ret;
    }

    function validateImage() {
        if(isset($_FILES[self::$file])){
            $this->image = $_FILES[self::$file];

            if ($_FILES[self::$file]["error"] > 0) {

                $this->setErrorMSG("imageError");
                return false;
                //echo "Error: " . $_FILES["file"]["error"] . "<br>";
            } else {

                /*$img = ImageCreateFromJpeg($_FILES["file"]["tmp_name"]);

                $imageWidth = imagesx($img);
                $imageHeight = imagesy($img);
                $imageAspects = imagecreatetruecolor($imageWidth, $imageHeight);*/


                //echo "Upload: " . $_FILES["file"]["name"] . "<br>";
                //echo "Type: " . $_FILES["file"]["type"] . "<br>";
                if($_FILES[self::$file]["size"] > 3000000){
                    echo "Error, picture is to big";
                    return false;
                } //"Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
                //echo "Stored in: " . $_FILES["file"]["tmp_name"];
            }
        }
        return true;

    }
    public function getImage() {

        return $this->image;
    }
}