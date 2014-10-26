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
  /*  protected $dbUsername = 'eerie_se';
     protected $dbPassword = 'NyUYN8xk';
     protected $dbConnstring = 'mysql:host=eerie.se.mysql;dbname=eerie_se';*/
        //PDO connection which all the other repos use
    public function connectdb(){

        if ($this->dbConnection == NULL)
            $this->dbConnection = new \PDO($this->dbConnstring, $this->dbUsername, $this->dbPassword);

        $this->dbConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $this->dbConnection;
    }
}