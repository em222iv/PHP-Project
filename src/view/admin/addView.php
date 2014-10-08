<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 08/10/14
 * Time: 14:38
 */

class AddView {

    public function addCategory() {
        if(isset($_GET['addCategory'])){

            return true;
        }
        return false;
    }

    function add() {
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
                </div>
                <a href='?addCategory' class='button expand'>ADD CATEGORY</a>
                <a href='?addArticle' class='button expand'>ADD ARTICLE</a>
                <a href='?logged' class='button expand'>BACK</a>
            </div>
    ";
        return $ret;
    }
    public function addCategoryForm() {

        $ret = "
            <form>
                 <div class='row'>
                    <div class='large-12 columns'>
                       <h3>Administrator</h3>
                        <div class='large-4 columns'>
                          <label>Category Name
                            <input type='text' placeholder='ex. Otters' value='categoryName'/>
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


}