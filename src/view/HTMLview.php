<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 03/10/14
 * Time: 14:26
 */
class HTMLView {

    public function echoHTML($body) {
        echo "

            <!doctype html>
                  <head>
                    <meta charset=utf-8 />
                    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
                    <title>Webshop | Welcome</title>
                    <link rel=stylesheet href='css/foundation.css' />
                    <link rel=stylesheet href=css/foundation-icons.css />
                    <link rel=stylesheet href=css/style.css />
                    <script src=/js/vendor/modernizr.js></script>
                    <script src=/js/vendor/jquery.js></script>
                    <script src=/js/foundation/foundation.js></script>

                  </head>
                  <body>

<!-- MENU -->
               <div class='sticky'>
               <div class=row>
                      <div class='large-12 columns'>
                           <nav class='top-bar' data-topbar>
                              <ul class=title-area>
                                  <li class=name>
                                      <h1>
                                          <a href='/'>
                                           Badly stuffed animals
                                          </a>
                                      </h1>
                                  </li>
                                  <li class='toggle-topbar menu-icon'><a href=#><span>menu</span></a></li>
                              </ul>

                              <section class='top-bar-section'>
                                  <ul class=left>
                                        <li><a href=#Categories>Categories</a></li>
                                      <li><a href=#Cart>Cart</a></li>
                                  </ul>

                                  <ul class=right>
                                      <li class=search>
                                          <form>
                                              <input type=search>
                                          </form>
                                      </li>
                                      <li class=has-button>
                                          <a class='small button' href=#>Search</a>
                                      </li>
                                  </ul>
                              </section>
                           </nav>
                      </div>
                </div>
                </div>

<!-- SLIDER -->
                  <div class=row>
                      <div class='large-12 columns'>
                          <div class=slider>
                              <img src='https://c1.staticflickr.com/5/4137/4930746997_605b67a409_b.jpg' alt=''>
                              <!--<img src='/pics/url.jpg' alt=''>-->
                              <a href='#Categories'></a>

                          </div>
                          <hr/>

                      </div>

                  </div>
<!-- INSERT CONTENT -->

                $body

<!-- FOOTER -->
                <footer>
                <div class='row'>
                    <div class='large-12 columns'>
                        <hr>
                            <div class='large-6 columns'>
                                <p>© Copyright no one at all. Go to town.</p>
                            </div>
                            <div class='large-6 columns'>
                                <ul class='inline-list right'>
                                    <li><a href='?admin'>Administrator</a></li>
                                </ul>
                            </div>
                        </div>
                        </div>
                </footer>
            </body>
        </html>
        ";
    }
}