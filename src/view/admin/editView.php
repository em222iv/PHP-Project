<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 08/10/14
 * Time: 14:38
 */


class EditView {


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
    public function editCategoryForm() {

        $ret = "
            <form>
                 <div class='row'>
                    <div class='large-12 columns'>
                       <h3>Administrator - Edit Category</h3>
                        <div class='large-4 columns'>
                          <label>Category Name
                            <input type='text' placeholder='ex. Otters' />
                          </label>
                        </div>
                        <div class='large-6 columns'>
                          <label>Choose Picture
                            <input type='file' name='file' id='file'><br>
                          </label>
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

    public function editArticleForm() {

        $ret = "
            <form>
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

}