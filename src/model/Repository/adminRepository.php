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
    private $db;

    public function __construct() {
        $this->dbConnection = new DBConnectionRepository();
        $this->db = $this->dbConnection->connectdb();
    }

    //add section
    public function addCategoryToDB($name,$image) {
        //table tar inte emot ÅÄÖ
         try {
            $tmpName = $image['tmp_name'];

            $fp = fopen($tmpName, 'r');
            $data = fread($fp, filesize($tmpName));
            fclose($fp);
            var_dump($name);
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
             echo "couldnt create category";
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
            echo "couldnt create article";
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
            echo "couldnt update category";
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
            echo "couldnt update article";
            return false;
        }

        return true;
    }

    public function addEditedArticleToDB($db_c_name,$db_a_name,$a_name,$a_desc,$a_price) {
        $table = $db_c_name;
        try {

            if($this->doesArticleExist($a_name)){

                $sql = "UPDATE $table
                         SET a_name = ?,a_description = ?,a_price = ?
                         WHERE a_name = ?";
                $q = $this->db->prepare($sql);

                $q->execute(array($a_name,$a_desc,$a_price,$db_a_name));
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





    //getters from database
    public function doesCategoryExist($c_name) {
        $results = $this->db->query("SHOW TABLES LIKE '$c_name'");

        if($results->rowCount()>0){
            echo 'category exists';
            return false;
        }
        return true;
    }

    public function doesArticleExist($a_name) {
        $results = $this->db->query("SHOW TABLES LIKE '$a_name'");

        //validering ska läggas i modell
        if(!$results) {
            return true;
        }
        if($results->rowCount()>0){echo 'table exists'; return false;}
        return true;
    }
    public function newArticlePicture($category,$a_name,$image) {
        $table = $category;

        $tmpName = $image['tmp_name'];

        $fp = fopen($tmpName, 'r');
        $data = fread($fp, filesize($tmpName));
        fclose($fp);

        $sql = "UPDATE $table
                     SET img = ?
                     WHERE a_name = ?";
        $q = $this->db->prepare($sql);

        $q->execute(array($data,$a_name));
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



//delas?


    public function getCategoryInfo($category){


        $sql = "SELECT * FROM categories WHERE c_name =  :c_name";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':c_name',$category, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll();



        return $result;
    }

    public function getArticleInfo($article,$category) {

        $a_name = $article;
        $c = $category;

        $sql = "SELECT * FROM $c WHERE a_name =  :a_name";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':a_name',$a_name, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }


    public function getCategoryArticles($c_name){

        $name = $c_name;

        $sql = "SELECT * FROM $name";
        $sth = $this->db->prepare($sql);
        $sth->execute();

        $result = $sth->fetchAll();

        return $result;
    }

    public function getAllCategories(){

        $sql = "SELECT * FROM categories";
        $sth = $this->db->prepare($sql);
        $sth->execute();

        $result = $sth->fetchAll();

        return $result;
    }

}

