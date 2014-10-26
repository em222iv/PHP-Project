<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 08/10/14
 * Time: 22:27
 */


require_once("DBConnectionRepository.php");
require_once("commonRepository.php");

class AdminRepository{
    protected $dbTable;
    private $dbConnection;
    private $db;
    private $commonRepository;

    public function __construct() {
        $this->commonRepository = new CommonRepository();

        $this->dbConnection = new DBConnectionRepository();
        $this->db = $this->dbConnection->connectdb();

    }

    //add section
    public function addCategoryToDB($name,$image) {
        //table dont accept ÅÄÖ
         try {
            $tmpName = $image['tmp_name'];

            $fp = fopen($tmpName, 'r');
            $data = fread($fp, filesize($tmpName));
            fclose($fp);

            $sql = "INSERT INTO categories (c_name,img) VALUES (:c_name,:img);
                    CREATE TABLE IF NOT EXISTS $name (
                        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        a_name VARCHAR(50) NOT NULL,
                        a_description VARCHAR(250) NOT NULL,
                        a_price DOUBLE NOT NULL,
                        img LONGBLOB NOT NULL
            )";
            $q = $this->db->prepare($sql);
            $q->execute(array(':c_name'=>$name,
                              ':img'=>$data));

         } catch (Exception $e) {
             throw new Exception("failed to create category");
             return false;
         }
        return true;

    }
    public function addArticleToDB($category,$name,$desc,$price,$image) {

        try{
        $tmpName = $image['tmp_name'];

        $fp = fopen($tmpName, 'r');
        $data = fread($fp, filesize($tmpName));
        fclose($fp);

        $sql = "INSERT INTO $category (a_name,a_description,a_price,img) VALUES (:a_name,:a_description,:a_price,:img)";
        $q = $this->db->prepare($sql);
        $q->execute(array(':a_name'=>$name,
                          ':a_description'=>$desc,
                          ':a_price'=>$price,
                          ':img'=>$data));

        } catch (Exception $e) {
            throw new Exception("couldnt create article");
            return false;
        }
        return true;
    }

    //edit section
    public function addEditedCategoryToDB($db_c_name,$c_name) {
        try {
            if($this->doesCategoryExist($c_name)){

                 $sql = "UPDATE categories
                         SET c_name =?
                         WHERE c_name = ?";
                $q = $this->db->prepare($sql);
                $q->execute(array($c_name,$db_c_name));
            }

        } catch (Exception $e) {
            throw new Exception("coudlnt update category");
            return false;
        }


        if($this->editArticleTable($db_c_name,$c_name)) {

            return true;
        }
    }

    public function editArticleTable($db_c_name,$c_name) {

        try {$sql = " ALTER TABLE $db_c_name
                    RENAME TO $c_name";
            $this->db->query($sql);
        } catch (Exception $e) {
            throw new Exception("couldnt update article");
            return false;
        }

        return true;
    }

    public function addEditedArticleToDB($id,$db_c_name,$a_name,$a_desc,$a_price) {
        $table = $db_c_name;

                $sql = "UPDATE $table
                         SET a_name = ?,a_description = ?,a_price = ?
                         WHERE id = ?";
                $q = $this->db->prepare($sql);

                $q->execute(array($a_name,$a_desc,$a_price,$id));



    return true;
    }

    // DELETE SECTION
    public function deleteCategory($category) {
        $categoryTable = $category;

        $sql = "DELETE FROM categories WHERE c_name =  :c_name;
                DROP TABLE $categoryTable;
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':c_name',$category, PDO::PARAM_STR);
        $stmt->execute();

        return true;
    }
    public function deleteArticle($articleTable,$article) {

        $sql = "DELETE FROM $articleTable WHERE a_name =  :a_name";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':a_name',$article, PDO::PARAM_STR);
        $stmt->execute();

        return true;
    }

//picture section
    public function newArticlePicture($category,$id,$image) {
        $table = $category;

        $tmpName = $image['tmp_name'];

        $fp = fopen($tmpName, 'r');
        $data = fread($fp, filesize($tmpName));
        fclose($fp);

        $sql = "UPDATE $table
                     SET img = ?
                     WHERE id = ?";
        $q = $this->db->prepare($sql);

        $q->execute(array($data,$id));
    }
    public function newCategoryPicture($category,$image) {

        $tmpName = $image['tmp_name'];

        $fp = fopen($tmpName, 'r');
        $data = fread($fp, filesize($tmpName));
        fclose($fp);

        $sql = "UPDATE categories
                     SET img = ?
                     WHERE c_name = ?";
        $q = $this->db->prepare($sql);
        $q->execute(array($data,$category));
    }



    //checks if category alreayd exists
    public function doesCategoryExist($c_name) {
        try{
        $results = $this->db->query("SHOW TABLES LIKE '$c_name'");

        if($results->rowCount()>0){return false;}
        } catch (Exception $e) {
            echo "table exists";
            return false;
        }
        return true;

    }
    //checks if an article already exists
    public function doesArticleExist($a_name,$category) {
        try {
            $sql = "SELECT * FROM $category WHERE a_name =  :a_name";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':a_name',$a_name, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll();


        } catch (Exception $e) {
            throw new Exception("failed to see if article exists");
            return false;
        }
        if(count($result)>0){
            echo "article exists";
            return false;
        }
        return true;
    }
    //get specific info of one category
    public function getCategoryInfo($category){
        $sql = "SELECT * FROM categories WHERE c_name =  :c_name";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':c_name',$category, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;

    }
    //methods exists in commonModel since their shared with other Repos
    public function getArticleInfo($article,$category) {
       return $this->commonRepository->getArticleInfo($this->db,$article,$category);
    }

    public function getCategoryArticles($c_name){
        return $this->commonRepository->getArticlesFromChosenCategory($this->db,$c_name);
    }

    public function getAllCategories(){
        return $this->commonRepository->getAllCategories($this->db);
    }

}

