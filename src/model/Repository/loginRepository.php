<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 07/10/14
 * Time: 18:08
 */

class loginRepository{

    protected $dbUsername = 'root';
    protected $dbPassword = 'root';
    protected $dbConnstring = 'mysql:host=localhost;dbname=webshop';
    protected $dbConnection;
    protected $dbTable;

    private $db_username;
    private $db_password;

    //PDO connection
    private function connectdb(){

        if ($this->dbConnection == NULL)
            $this->dbConnection = new \PDO($this->dbConnstring, $this->dbUsername, $this->dbPassword);

        $this->dbConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $this->dbConnection;
    }

    //Data import section
    public function getDBUsers($username) {

        $db = $this->connectdb();

        $sql = "SELECT * FROM webshop WHERE username  = ?";
        $params = array($username);

        $query = $db -> prepare($sql);
        $query -> execute($params);

        $result = $query -> fetch();
        $this->db_username = $result[1];
        $this->db_password = $result[2];

        return true;
    }

    //getter section
    public function getDBUsername(){
        return $this->db_username;

    }
    public function getDBPassword(){
        return $this->db_password;

    }
}
