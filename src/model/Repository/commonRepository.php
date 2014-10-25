<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 18/10/14
 * Time: 21:01
 */

class CommonRepository{
    public function __construct() {


    }

    public function getAllCategories($db) {

        $sql = "SELECT * FROM categories";
        $sth = $db->prepare($sql);
        $sth->execute();

        $result = $sth->fetchAll();

        return $result;
    }
    public function getCategories(){
        return $this->categories;

    }

    public function getArticlesFromChosenCategory($db,$category) {

       $categoryname = $category;
       try {
            $sql = "SELECT * FROM $categoryname";
            $sth = $db->prepare($sql);
            $sth->execute();

            $result = $sth->fetchAll();

        } catch (Exception $e) {
           throw new Exception("You will have to choose a category");
            return false;
        }
        return $result;
        }
    public function getArticleInfo($db,$article,$category) {

        $sql = "SELECT * FROM $category WHERE a_name =  :a_name";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':a_name',$article , PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }



}