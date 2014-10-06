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

    function __construct() {
        $this->productModel = new productModel();
    }

    public function form() {

        $image = $this->productModel->getCategoryImage();

        $ret = "

<!-- PRODUCTS -->
             <div class='row'>

                  <div class='large-12 columns'>
                      <div class=row>


                          <!--<div class='large-3 small-6 columns'>
                              <a><img src='pics/imgres-1.jpg'/></a>
                              <h6 class='panel'>Description</h6>
                          </div>

                          <div class='large-3 small-6 columns'>
                              <a href=''><img  src='pics/url.jpg'/></a>
                              <h6 class='panel'>Description</h6>
                          </div>

                          <div class='large-3 small-6 columns'>
                              <a><img src='pics/imgres-1.jpg'/></a>
                              <h6 class='panel'>Description</h6>
                          </div>


                          <div class='large-3 small-6 columns'>
                              <a><img src='pics/imgres-1.jpg'/></a>
                              <h6 class='panel'>Description</h6>
                          </div>-->



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
                                        <a href=# class=small radius button>Edit cart</a><br>
                                        <a href=# class=small radius button>Continue to checkout</a>
                                  </div>
                              </div>
                              <div class='large-6 small-6 columns'>
                                  <ul class=inline-list>
                                      <li>
                                            <a href=#>Article 1</a>
                                            <li>(1)<li/>
                                            <li><a><i class=fi-plus large></i></a><li/>
                                            <li><a><i class=fi-x large></i></a><li/>
                                      </li><br/><hr/>

                                      <li>
                                          <a href=#>Article 2</a>
                                          <li>(1)<li/>
                                          <li><a><i class=fi-plus large></i></a><li/>
                                          <li><a><i class=fi-x large></i></a><li/>
                                      </li><br/><hr/>
                                      <li>
                                            <a href=#>Article 2</a>
                                            <li>(2)<li/>
                                            <li><a><i class=fi-plus large></i></a><li/>
                                            <li><a><i class=fi-x large></i></a><li/>
                                      </li><br/><hr/>

                                  </ul>
                              </div>

                          </div>
                      </div>
                  </div>
                  <div class='large-4 columns hide-for-small'>
                      <h4>Options</h4><hr/>
                      <a class='large button expand' href=#Cart>
                            Update Cart
                      </a>
                      <a class='large button expand' href=#Cart>
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