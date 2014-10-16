<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 08/10/14
 * Time: 22:27
 */


require_once("DBConnectionRepository.php");
class AdminRepository{

    protected $dbTable;

    private $dbConnection;

    public function __construct() {
        $this->dbConnection = new DBConnectionRepository();
    }


    //add section
    public function addCategoryToDB($name,$image) {

        var_dump($name);
        $db = $this->dbConnection->connectdb();


       // $data = addslashes(file_get_contents ($image['tmp_name']));

        $tmpName = $image['tmp_name'];

        $fp = fopen($tmpName, 'r');
        $data = fread($fp, filesize($tmpName));
        fclose($fp);

        $sql = "INSERT INTO categories (c_name,img) VALUES (:c_name,:img)";
        $q = $db->prepare($sql);
        $q->execute(array(':c_name'=>$name,
                          ':img'=>$data));

        if($this->createArticleTable($name)) {

            return true;
        }
    }
    public function createArticleTable($name) {
        //table tar inte emot ÅÄÖ
        var_dump($name);
        $db = $this->dbConnection->connectdb();

        $sql = "CREATE TABLE IF NOT EXISTS $name (
                id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                a_name VARCHAR(50) NOT NULL,
                a_description VARCHAR(250) NOT NULL,
                a_price DOUBLE NOT NULL,
                img LONGBLOB NOT NULL
            )";

        $sq = $db->query($sql);

        return true;
    }

    public function addArticleToDB($category,$name,$desc,$price,$image) {

        $db = $this->dbConnection->connectdb();

        $tmpName = $image['tmp_name'];

        $fp = fopen($tmpName, 'r');
        $data = fread($fp, filesize($tmpName));
        fclose($fp);

        $sql = "INSERT INTO $category (a_name,a_description,a_price,img) VALUES (:a_name,:a_description,:a_price,:img)";
        $q = $db->prepare($sql);
        $q->execute(array(':a_name'=>$name,
                          ':a_description'=>$desc,
                          ':a_price'=>$price,
                          ':img'=>$data));
        return true;
    }


    //edit section

    public function addEditedCategoryToDB($db_c_name,$c_name,$image) {

        $db = $this->dbConnection->connectdb();
        try {
            if($this->doesCategoryExist($c_name)){

                $tmpName = $image['tmp_name'];

                $fp = fopen($tmpName, 'r');
                $data = fread($fp, filesize($tmpName));
                fclose($fp);

                 $sql = "UPDATE categories
                         SET c_name =?, img = ?
                         WHERE c_name = ?";
                $q = $db->prepare($sql);
                $q->execute(array($c_name,$data,$db_c_name));
            }

        } catch (Exception $e) {
            echo "couldnt update category";
            return false;
        }

        if($this->editArticleTable($db_c_name,$c_name)) {

            return true;
        }

    }
    public function editArticleTable($db_c_name,$c_name) {

        $db = $this->dbConnection->connectdb();

        try {$sql = " ALTER TABLE $db_c_name
                    RENAME TO $c_name";
        $db->query($sql);
        } catch (Exception $e) {
            echo "couldnt alter table";
            return false;
        }

        return true;
    }

    public function addEditedArticleToDB($db_c_name,$db_a_name,$a_name,$a_desc,$a_price,$image) {
        $table = $db_c_name;

        $db = $this->dbConnection->connectdb();
        try {

            if($this->doesArticleExist($a_name)){

                $tmpName = $image['tmp_name'];

                $fp = fopen($tmpName, 'r');
                $data = fread($fp, filesize($tmpName));
                fclose($fp);

                $sql = "UPDATE $table
                         SET a_name = ?,a_description = ?,a_price = ?, img = ?
                         WHERE a_name = ?";
                $q = $db->prepare($sql);
                $q->execute(array($a_name,$a_desc,$a_price,$data,$db_a_name));
            }

        } catch (Exception $e) {
            echo "couldnt update article";
            return false;
        }
    return true;

    }

    // DELETE SECTION
    public function deleteCategory($category) {
        $categoryTable = $category;
        $db = $this->dbConnection->connectdb();

        $sql = "DELETE FROM categories WHERE c_name =  :c_name";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':c_name',$category, PDO::PARAM_STR);
        $stmt->execute();

        $sql = "DROP TABLE $categoryTable";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return true;
    }
    public function deleteArticle($articleTable,$article) {
        var_dump($article);
        $db = $this->dbConnection->connectdb();

        $sql = "DELETE FROM $articleTable WHERE a_name =  :a_name";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':a_name',$article, PDO::PARAM_STR);
        $stmt->execute();

        return true;
    }

    //getters from database
    public function doesCategoryExist($c_name) {

        $db = $this->dbConnection->connectdb();

        $results = $db->query("SHOW TABLES LIKE '$c_name'");

        if($results->rowCount()>0){
            echo 'table exists';
            return false;
        }
        return true;
    }

    public function doesArticleExist($a_name) {

        $db = $this->dbConnection->connectdb();

        $results = $db->query("SHOW TABLES LIKE '$a_name'");

        //validering ska läggas i modell
        if(!$results) {
            return true;
        }
        if($results->rowCount()>0){echo 'table exists'; return false;}
        return true;
    }
    public function getAllCategories(){

        $db = $this->dbConnection->connectdb();

        $sql = "SELECT * FROM categories";
        $sth = $db->prepare($sql);
        $sth->execute();

        $result = $sth->fetchAll();

        return $result;
    }

    public function getCategoryArticles($c_name){
        var_dump($c_name);
        $name = $c_name;
        $db = $this->dbConnection->connectdb();

        $sql = "SELECT * FROM $name";
        $sth = $db->prepare($sql);
        $sth->execute();

        $result = $sth->fetchAll();

        return $result;
    }
}

