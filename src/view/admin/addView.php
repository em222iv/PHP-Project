<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 08/10/14
 * Time: 14:38
 */

class AddView {


    public function getAddCategory() {
        if(isset($_GET['?add/category']))
        {
            return $_GET['?add/category'];
        }
        return false;
    }


    public function addForm() {

        $ret = "
             <div class='row'>
                <div class='large-12 columns'>
                   <h3>Administrator</h3>
                </div>
                <a href='?add/category' class='button expand'>Add Category</a>
                <a href='?add/article' class='button expand'>Add Article</a>
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
                    <input type='submit' class='button expand' name='addCategory' value='Add Cateogry'>
                    <a href='?add' class='button expand'>BACK</a>
                </div>
            </form>
    ";
        return $ret;
    }


}