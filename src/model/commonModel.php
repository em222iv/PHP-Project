<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 20/10/14
 * Time: 16:08
 */

class CommonModel{
    public function __construct() {

    }
//storing category
    public function storeCategory($category) {
        return $_SESSION['category'] = $category;
    }
    public function getStoredCategory() {
        if(isset($_SESSION['category'])){
            return $_SESSION['category'];
        }
    }
    //replacing space with characters for databse
    public function replaceSpaceWithChar($name) {
        if(!is_string($name)){
            return false;
        }
        $search = array(' ', '-');
        return $name = str_replace($search, 'aa', $name);
    }
//replacing character with - instead of spaces. to show for users
    public function replaceCharWithSpace($names = null) {
         if(is_string($names) || $names == null){
             return $names[1][1] = "inga artiklar";
         }
        $search = array('aa', '-');
        if (count($names) == count($names, COUNT_RECURSIVE)) {
            $names[1] =  str_replace($search, "-", $names[1]);
        }
        else {
            $count = 0;
            foreach ($names as $name) {
                $name[1] = str_replace($search, "-", $name[1]);
                $names[$count][1] = $name[1];
                $count++;
            }
        }
        return $names;
    }
}