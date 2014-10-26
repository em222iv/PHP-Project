<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 06/10/14
 * Time: 17:49
 */

require_once("DBConnectionRepository.php");
require_once("commonRepository.php");
class productRepository{
    protected $dbTable;
    private $commonRepository;
    private $dbConnection;
    private $db;

    public function __construct() {
        $this->dbConnection = new DBConnectionRepository();
        $this->db = $this->dbConnection->connectdb();
        $this->commonRepository = new CommonRepository();
    }

    //PDO connection
    public function getAllCategories() {
        return $this->commonRepository->getAllCategories($this->db);
    }

    public function getArticlesFromChosenCategory($category) {

        return $this->commonRepository->getArticlesFromChosenCategory($this->db,$category);
    }

    public function getArticleInfo($article,$category) {
        return $this->commonRepository->getArticleInfo($this->db,$article,$category);
    }
}
