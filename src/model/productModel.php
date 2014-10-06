<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 06/10/14
 * Time: 15:26
 */

class productModel{

    protected $dbUsername = 'root';
    protected $dbPassword = 'root';
    protected $dbConnstring = 'mysql:host=localhost;dbname=webshop';
    protected $dbConnection;
    protected $dbTable;
    private $categories;
    private $image;

    //PDO connection
    private function connectdb(){

        if ($this->dbConnection == NULL)
            $this->dbConnection = new \PDO($this->dbConnstring, $this->dbUsername, $this->dbPassword);

        $this->dbConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $this->dbConnection;
    }

    public function importCategories() {


        $db = $this->connectdb();


        $sql = "SELECT * FROM Categories";
        $params = array($this->categories);

        $query = $db -> prepare($sql);
        $query -> execute($params);

        $result = $query -> fetch();
        $this->categories = $result;

     var_dump('1');
        foreach($query as $result){
            $array =  $result[0];
            $array = $result[1];
            $this->image = "<dd>" .
                '<img src="data:image/jpeg;base64,'.
                base64_encode($result[2]).
                '" width="20" height="20">' . "</dd>";
            $this->categories;
        }


        return true;

    }

    public function getCategories(){
        return $this->categories;

    }
    public function getCategoryImage(){

        return $this->image;

    }
}
