<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 08/10/14
 * Time: 14:38
 */


class EditView {




    public function setCategories($db_categories) {
        $this->categories = $db_categories;

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
                </div>
                <a href='?editCategory' class='button expand'>EDIT CATEGORY</a>
                <a href='?editArticle' class='button expand'>EDIT ARTICLE</a>
                <a href='?logged' class='button expand'>BACK</a>
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
                                <select name=dropdown>
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
    public function editArticle() {
        if(isset($_GET['editArticle'])){
            return true;
        }
        return false;
    }

    public function editArticleConfirm() {
        if(isset($_GET['editArticleConfirm'])){
            return true;
        }
        return false;
    }

    public function getCategoryChoice() {
        if(isset($_POST['dropdown'])){
            return $_POST['dropdown'];
        }
        return false;
    }

    public function editArticleForm() {

        $ret = "
            <form method='post' action='?editArticleConfirm' enctype='multipart/form-data'>
                 <div class='row'>
                    <div class='large-12 columns'>
                       <h3>Administrator - Edit Article</h3>
                        <div class='large-4 columns'>
                          <label>Article Name
                            <input type='text' placeholder='ex. Duuwrp the Owtter' />
                          </label>
                        </div>
                         <div class='large-2 columns'>
                          <label>Article price
                            <input type='number' name='quantity' min='1' max='10000'>
                          </label>
                        </div>
                        <div class='large-6 columns'>
                            <label>Article description
                                <textarea placeholder='Anything we need to know?'></textarea>
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
                    <input type='submit' class='button expand' name='editArticle' value='CONFIRM'>
                    <a href='?edit' class='button expand'>BACK</a>
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