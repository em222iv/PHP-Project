<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 10/10/14
 * Time: 12:32
 */

class DBConnectionRepository {

    protected $dbUsername = 'root';
    protected $dbPassword = 'root';
    protected $dbConnstring = 'mysql:host=localhost;dbname=webshop';
    protected $dbConnection;
    //PDO connection
    public function connectdb(){

        if ($this->dbConnection == NULL)
            $this->dbConnection = new \PDO($this->dbConnstring, $this->dbUsername, $this->dbPassword);

        $this->dbConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $this->dbConnection;
    }
}