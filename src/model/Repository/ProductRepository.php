<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 06/10/14
 * Time: 17:49
 */
class productRepository{

    protected $dbUsername = 'root';
    protected $dbPassword = 'root';
    protected $dbConnstring = 'mysql:host=localhost;dbname=webshop';
    protected $dbConnection;
    protected $dbTable;
    private $categories;
    private $image;
    private $categoryObject;

    //PDO connection
    private function connectdb(){

        if ($this->dbConnection == NULL)
            $this->dbConnection = new \PDO($this->dbConnstring, $this->dbUsername, $this->dbPassword);

        $this->dbConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $this->dbConnection;
    }

    public function importCategories() {

        $db = $this->connectdb();

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
