<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 08/10/14
 * Time: 22:26
 */

class AdminModel{

    private $adminRepository;
    public function __construct(AdminRepository $adminRepository) {
        $this->adminRepository = $adminRepository;
    }

    public function validateAddorEditContent($name,$desc = null,$price = null) {

            if(isset($name)){
                if(strlen($name) < 2){
                    echo "Användarenamet är för kort. Minst 2 tecken";
                    return false;
                }

                if($name != strip_tags($name)) {
                    $this->username = strip_tags($name);
                    echo "Användarnamnet innehåller ogiltiga tecken";
                    return false;
                }
            }

            if(isset($desc)){
                if(strlen($desc) < 10){
                    echo "Det måste finnas en beskrivning av produkten";
                    return false;
                }
            }
            if(isset($price)){
                if($price = ""){
                    echo "Ange ett pris";
                    return false;
                }
            }

        return true;
    }


    public function storeCategory($category) {
        return $_SESSION['category'] = $category;
    }
    public function getStoredCategory() {
        return $_SESSION['category'];
    }
    public function storeArticle($article) {
        return $_SESSION['article'] = $article;
    }
    public function getStoredArticle() {
        return $_SESSION['article'];
    }
    public function replaceWhiteSpace($name) {

        return $name = preg_replace('/\s+/', '9', $name);
    }

    ///FIXA DETTTA
    public function replaceSlashWithSpace($name) {
        var_dump($name);
        $name1 = $name[0][1];
        var_dump($name1);
        return $name[0][1] = str_replace(9, " ", $name1);
    }

}
