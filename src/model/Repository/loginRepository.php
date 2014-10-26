<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 07/10/14
 * Time: 18:08
 */


require_once("DBConnectionRepository.php");
class loginRepository{

    protected $dbTable;

    private $db_id;
    private $db_username;
    private $db_password;

    private $dbConnection;

    public function __construct() {
        $this->dbConnection = new DBConnectionRepository();

    }

    //Data import section
    public function getDBUsers($username) {

        $db = $this->dbConnection->connectdb();

        $sql = "SELECT * FROM admin WHERE username  = ?";
        $params = array($username);

        $query = $db -> prepare($sql);
        $query -> execute($params);

        $result = $query -> fetch();
        $this->db_id = $result[0];
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
    public function getDBId(){
        return $this->db_id;

    }
}
