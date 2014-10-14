<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 06/10/14
 * Time: 17:49
 */

require_once("DBConnectionRepository.php");
class productRepository{

    protected $dbTable;
    private $categories;
    private $array;
    private $categoryObject;

    private $dbConnection;

    public function __construct() {
        $this->dbConnection = new DBConnectionRepository();

    }

    //PDO connection
    public function getAllCategories() {


        $db = $this->dbConnection->connectdb();

        $sql = "SELECT * FROM categories";
        $sth = $db->prepare($sql);
        $sth->execute();

        $result = $sth->fetchAll();

        return $result;
    }
    public function getCategories(){
        return $this->categories;

    }

    public function getArticlesFromChosenCategory($category) {
        $cat = $category;
        $db = $this->dbConnection->connectdb();

        $sql = "SELECT * FROM $cat";
        $sth = $db->prepare($sql);
        $sth->execute();

        $result = $sth->fetchAll();

        return $result;
    }
}
