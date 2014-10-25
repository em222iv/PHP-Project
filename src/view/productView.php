<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 03/10/14
 * Time: 14:26
 */


require_once("././src/model/productModel.php");
class viewClass {

    private $productModel;
    private $image;
    private $categories;
    private $category;
    private $articles;
    private $article;
    private $editArticle;
    function __construct() {
        $this->productModel = new productModel();
    }
    public function setImage($images) {
        $this->image = $images;

    }
    public function setCategories($db_categories) {

    $this->categories = $db_categories;
    }
    public function setArticles($db_articles) {
        $this->articles = $db_articles;
    }
    public function setArticleInfo($db_article) {
        $this->article = $db_article;

    }
    public function setEditArticleInfo() {
        $this->editArticle = array("true");
    }
    public function unsetEditArray() {
        $this->editArticle = array();
    }


    public function categoryDropDownLoop(){

        $ret = "<div class='large-12 small-12 columns'><a href=?><h4>Categories</h4></a></div>";
        foreach ($this->categories as $category) {
            $ret .= "<div class='large-3 small-6 columns'>";
            $ret .= '<a href="?category='. $category[1] .'"><img alt="" src=data:image/png;base64,'. base64_encode($category[2]) .'></a>';
            $ret .= '<h6 class=panel>'. $category[1] .'</h6></div>';
        }
        return $ret;
    }


    public function articleDropDownLoop(){
       $ret ="";

        if(isset($this->articles)){

            if ($this->articles[0] >= 1) {
                foreach ($this->articles as $article) {
                    $ret .= "<div class='large-3 small-6 columns'>";
                    $ret .= '<a href="?article='. $article[1] .'"><img  src=data:image/png;base64,'. base64_encode($article[4]) .' alt=""></a>';
                    $ret .= '<h6 class=panel>'. $article[1] .'</h6></div>';
                }
                return $ret;
            }else {
                $ret = "<div class='large-12 small-8 columns'><a href=?><h4>Articles - Back To Categories</h4></a></div>";
                $ret .= "<div class='large-12 small-6 columns'><h6 class=panel>No Articles Added Yet</h6></div>";
                return $ret;
                die();
            }
        }

    }

    public function getChosenCategory() {
        $request_path = $_SERVER['REQUEST_URI'];
        $path = explode("/", $request_path);
        $this->category = end($path);
        $this->category = str_replace("?category=","",$this->category);

        return $this->category;
    }

    public function getChosenArticle() {
        $request_path = $_SERVER['REQUEST_URI'];
        $path = explode("/", $request_path);
        $this->article = end($path);
        $this->article = str_replace("?article=","",$this->article);

        return $this->article;
    }

   public function getArticles() {
       if(isset($_GET["category"])){
           return true;
       }
       return false;
   }

    public function productForm() {

    if($this->getArticleInfo()){
            $products = $this->articleInfoForm();

        }
        elseif(!$this->articleDropDownLoop()){

            $products = $this->categoryDropDownLoop();

        }
      else {

            $products = $this->articleDropDownLoop();
        }

        //BUGG, LEVERERAR ALLTID ALLA SAMMA LISTA
        $ret = "

<!-- PRODUCTS -->
                 <div class='row'>
                          <div class='large-12 small-12 columns'>
                              <div class=row>

                                    $products

                              </div>
                          </div>
                      </div>
                   <div class=row>
                  <div class='large-12 columns'>
                      <div class=row>
                          <div class='large-8 columns'>
                              <div class='panel radius'>
                                  <div class=row>
                                      <div class='large-6 small-6 columns'>
                                            <a name=Cart></a>
                                          <h4>Cart</h4><hr/>
                                          <h5 class=subheader>This is your shoppingcart. Please mind your order to be correct.
                                          </h5>
                                          <div class=show-for-small>
                                                <a href=# class='small radius button expand'>Update cart</a><br>
                                                <a href='?checkout' class='small radius button expand'>Continue to checkout</a>
                                          </div>
                                      </div>
                                     <div class='large-6 small-6 columns'>
                                        <div class='products'>
                                            <div class='large-4 small-8 columns' ><a href='#'>BirdieBoo</a></div><br>
                                            <div class='large-1 small-3 columns'><a href='#'><span title='add'><i class='fi-plus large'></i></span></a></div>
                                            <div class='large-1 small-3 columns'><a href='#'><span title='decrease'><i class='fi-minus large'></i></span></a></div>
                                            <div class='large-1 small-3 columns'><a href='#'><span title='delete'><i class='fi-x large'></i></span></a></div>
                                            <div class='large-4 small-12 columns'><i class='fi-price-tag large'> 10.00</i></div>
                                            <br/><hr>
                                        </div>
                                     <div>

                                        <p>
                                            Total: TROlortlorlolo
                                        </p>
                                    </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class='large-4 columns hide-for-small'>
                          <h4>Options</h4><hr/>

                          <a href='?' class='large button expand' >
                                Update
                          </a>
                           <a href='?checkout' class='large button expand' >
                                 Continue to checkout
                          </a>
                      </div>
                  </div>
              </div>
          </div>
        ";

        return $ret;
    }

    public function getArticleInfo() {

        if(isset($_GET['article'])){
            return true;
        }
        return false;
    }



    public function articleInfoForm() {

        $articleName = $this->article[0][1];
        $articleDesc = $this->article[0][2];
        $articlePrice = $this->article[0][3];
        $articleImage = $this->article[0][4];
        $img = '<img src="data:image/png;base64,'.base64_encode($articleImage).'">';

        $ret = "
            <div class='large-12 small-8 columns'><a href=?><h4>Articles - Back To Categories</h4></a></div>
             <div class='large-3 panel columns'>
                 <fieldset>
                    $img
                    <h5>Name: $articleName</h5>
                    <h5>Price: $articlePrice sek</h5>
                    <hr>
                    <div class='row'>
                        <div class='large-12 columns'>
                        <a href='#' class='tiny button expand'>Put into Cart</a>

                    </div>
                </div>
              </div>

                 <div class='large-9 columns'>
                    <div class='panel'>
                        <h5>Description</h5><hr>
                        <p>$articleDesc</p>
                    </div>
                </div>

        ";
        return $ret;
    }
}