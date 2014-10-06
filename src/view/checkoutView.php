<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 06/10/14
 * Time: 14:46
 */

class checkoutView {

//  Navigation with getters for admin pages
    function checkoutClicked() {
        if(isset($_GET['checkout'])) {
            return true;
        }
        return false;
    }

//  Different forms to present CRUD functionality for admin
    public function checkoutUserInfoForm() {

        $ret = "
        <form>

            <div class='row'>
                <div class='large-3 columns'>
                  <label>First name
                    <input type='text' placeholder='ex. Erik' />
                  </label>
                </div>
                <div class='large-5 columns'>
                  <label>Last name
                    <input type='text' placeholder='ex. Magnusson' />
                  </label>
                </div>
                <hr>
                <div class='large-3 columns''>
                  <label>Adress 1
                    <input type='text' placeholder='ex. Adelgatan' />
                  </label>
                </div>
                <div class='large-3 columns''>
                  <label>Adress 2
                    <input type='text' placeholder='Moms adress' />
                  </label>
                </div>
                <hr>
                 <div class='large-6 columns'>
                  <label>Town/City
                    <input type='text' placeholder='Calemare' />
                  </label>
                </div>
                <hr>
                 <div class='large-6 columns'>
                  <label>Phone
                    <input type='text' placeholder='+45 70 435 23 41' />
                  </label>
                </div>
                <hr>
                <div class='large-12 columns'>
                    <label>Textarea Label
                        <textarea placeholder='Anything we need to know?'></textarea>
                    </label>
                </div>
                <div class='large-12 columns'>
                  <label>Payment method
                    <select>
                      <option value='Visa'>Visa</option>
                      <option value='Mastercard'>Mastercard</option>
                      <option value='Invoice'>Invoice</option>
                    </select>
                  </label>
            </div>
        </form>


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
                                            <li><a><span title='add'><i class=fi-plus large></i></span></a><li/>
                                            <li><a><span title='decrease'><i class=fi-minus large></i></span></a><li/>
                                            <li><a><span title='delete'><i class=fi-x large></i></span></a><li/>
                                            <li><i class='fi-price-tag large'> 10.00</i><li/>
                                      </li><br/><hr/>
                                      <li>
                                          <a href=#>Article 2</a>
                                          <li>(1)<li/>
                                         <li><a><span title='add'><i class=fi-plus large></i></span></a><li/>
                                          <li><a><span title='decrease'><i class=fi-minus large></i></span></a><li/>
                                          <li><a><span title='delete'><i class=fi-x large></i></span></a><li/>
                                          <li><i class='fi-price-tag large'> 100.00</i><li/>
                                      </li><br/><hr/>
                                      <li>
                                            <a href=#>Article 2</a>
                                            <li>(2)<li/>
                                            <li><a><span title='add'><i class=fi-plus large></i></span></a><li/>
                                            <li><a><span title='decrease'><i class=fi-minus large></i></span></a><li/>
                                            <li><a><span title='delete'><i class=fi-x large></i></span></a><li/>
                                            <li><i class='fi-price-tag large'> 267.00</i><li/>
                                      </li><br/><hr/>
                                      <li>
                                            Total: Five billion dollars
                                      </li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class='large-4 columns hide-for-small'>
                      <h4>Options</h4><hr/>

                      <a href='?checkout' class='large button expand' >
                            Update
                      </a>
                       <a href='?checkout' class='large button expand' >
                            Confirm purchase
                      </a>
                  </div>
              </div>
          </div>
      </div>
    ";
        return $ret;
    }
}