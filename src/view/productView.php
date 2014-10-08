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

    function __construct() {
        $this->productModel = new productModel();
    }
    public function setImage($images) {
        $this->image = $images;

    }


    public function form() {


        $ret = "

<!-- PRODUCTS -->
             <div class='row'>

                  <div class='large-12 small-12 columns'>
                      <div class=row>


                          <div class='large-3 small-6 columns'>
                              <a><img src='pics/imgres-1.jpg'/></a>
                              <h6 class='panel'>Description</h6>
                          </div>

                          <div class='large-3 small-6 columns'>
                              <a href=''><img  src='pics/imgres-1.jpg'/></a>
                              <h6 class='panel'>Description</h6>
                          </div>

                          <div class='large-3 small-6 columns'>
                              <a><img src='pics/imgres-1.jpg'/></a>
                              <h6 class='panel'>Description</h6>
                          </div>


                          <div class='large-3 small-6 columns'>
                              <a><img src='pics/imgres-1.jpg'/></a>
                              <h6 class='panel'>Description</h6>
                          </div>

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
                                        <a href=# class='small radius button expand'>Confirm purchase</a>
                                  </div>
                              </div>
                             <div class='large-6 small-6 columns'>

                                <div id='products'>

                                    <div class='large-4 small-8 columns' ><a href='#'>BirdieBoo</a></div>
                                    <div class='large-1 small-8 columns'><a href='#'><span title='add'><i class='fi-plus large'></i></span></a></div>
                                    <div class='large-1 small-8 columns'><a href='#'><span title='decrease'><i class='fi-minus large'></i></span></a></div>
                                    <div class='large-1 small-8 columns'><a href='#'><span title='delete'><i class='fi-x large'></i></span></a></div>
                                    <div class='large-4 small-12 columns'><i class='fi-price-tag large'> 10.00</i></div>
                                    <br/><hr>

                                    <div class='large-4 small-8 columns' ><a href='#'>Article 1</a></div>
                                    <div class='large-1 small-8 columns'><a href='#'><span title='add'><i class='fi-plus large'></i></span></a></div>
                                    <div class='large-1 small-8 columns'><a href='#'><span title='decrease'><i class='fi-minus large'></i></span></a></div>
                                    <div class='large-1 small-8 columns'><a href='#'><span title='delete'><i class='fi-x large'></i></span></a></div>
                                    <div class='large-4 small-12 columns'><i class='fi-price-tag large'> 10.00</i></div>
                                    <br/><hr>

                                    <div class='large-4 small-8 columns' ><a href='#'>Article 1</a></div>
                                    <div class='large-1 small-8 columns'><a href='#'><span title='add'><i class='fi-plus large'></i></span></a></div>
                                    <div class='large-1 small-8 columns'><a href='#'><span title='decrease'><i class='fi-minus large'></i></span></a></div>
                                    <div class='large-1 small-8 columns'><a href='#'><span title='delete'><i class='fi-x large'></i></span></a></div>
                                    <div class='large-4 small-12 columns'><i class='fi-price-tag large'> 10.00</i></div>
                                    <br/><hr>
                            <div>
                                                    <p>
                                                        Total: TROlortlorlolo
                                                    </p>
                                                </div>
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
                                     To checkout
                              </a>
                          </div>
                      </div>
                  </div>
              </div>
        ";
        return $ret;
    }
}