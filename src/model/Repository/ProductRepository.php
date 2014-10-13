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
    private $image;
    private $categoryObject;

    private $dbConnection;

    public function __construct() {
        $this->dbConnection = new DBConnectionRepository();

    }

    //PDO connection
    public function importCategories() {

        $db = $this->dbConnection->connectdb();

        $sql = "SELECT * FROM categories";
        $params = array($this->categories);

        $query = $db -> prepare($sql);
        $query -> execute($params);

        $result = $query -> fetch();

        //hämta hem object från databas
        //ta emot i model och loopa ut till array
        //sätt in html till bild och skriv ut i productview
        $this->categories = $query->fetchAll();


        return true;
    }
    public function getCategories(){
        return $this->categories;

    }
}
