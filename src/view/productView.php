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
    private $products;
    private $category;

    function __construct() {
        $this->productModel = new productModel();
    }
    public function setImage($images) {
        $this->image = $images;

    }
    public function setProducts($db_products) {
        $this->products = $db_products;
    }

    public function productsProductDropDownLoop(){
      $ret = "";

        foreach ($this->products as $category) {
            $ret .= "<div class='large-3 small-6 columns'>";
            $ret .= '<a href=?category='. $category[1] .'><img src=data:image/png;base64,'. base64_encode($category[2]) .'>';
            $ret .= '<h6 class=panel> '. $category[1] .'</h6></div>';
        }

        return $ret;
    }

    public function getChosenCategory() {
        $request_path = $_SERVER['REQUEST_URI'];
        $path = explode("/", $request_path);
        $this->category = end($path);
        $this->category = str_replace("?category=","",$this->category);

        return $this->category;

    }
   public function getArticles() {
       $categoryname = $this->category;
       var_dump($_GET['?category='.$categoryname.'']);

       if(isset($_GET["?category=$categoryname"])){
           var_dump('works');
           return true;
       }
       return false;

   }


    public function productForm() {

        $products = $this->productsProductDropDownLoop();

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
                                  <div class=show-for-small align=center>
                                        <a href=# class='small radius button expand'>Update cart</a><br>
                                        <a href='?checkout' class='small radius button expand'>Continue to checkout</a>
                                  </div>
                              </div>
                             <div class='large-6 small-6 columns'>
                                <div id='products'>
                                    <div class='large-4 small-8 columns' ><a href='#'>BirdieBoo</a></div><br>
                                    <div class='large-1 small-3 columns'><a href='#'><span title='add'><i class='fi-plus large'></i></span></a></div>
                                    <div class='large-1 small-3 columns'><a href='#'><span title='decrease'><i class='fi-minus large'></i></span></a></div>
                                    <div class='large-1 small-3 columns'><a href='#'><span title='delete'><i class='fi-x large'></i></span></a></div>
                                    <div class='large-4 small-12 columns'><i class='fi-price-tag large'> 10.00</i></div>
                                    <br/><hr>
                                </div>
                                <div id='products'>
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
}