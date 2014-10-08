<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 08/10/14
 * Time: 14:38
 */

class AddView {


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

    public function addCategoryForm() {

        $ret = "
            <form>
                 <div class='row'>
                    <div class='large-12 columns'>
                       <h3>Administrator - Add new Category</h3>
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

    public function addArticleForm() {

        $ret = "
            <form>
                 <div class='row'>
                    <div class='large-12 columns'>
                       <h3>Administrator - Add new Article</h3>
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
                    <input type='submit' class='button expand' name='addArticle' value='CONFIRM'>
                    <a href='?add' class='button expand'>BACK</a>
                </div>
            </form>
    ";
        return $ret;
    }
}