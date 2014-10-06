<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 06/10/14
 * Time: 13:36
 */

class adminView {

//  Navigation with getters for admin pages
    function adminWantsToLogin() {
        if(isset($_GET['admin'])) {
                return true;
            }
        return false;
    }
    function adminIsLoggedIn() {
        if(isset($_GET['logged'])) {
            return true;
        }
        return false;
    }
    function edit() {
        if(isset($_GET['edit'])) {
            return true;
        }
        return false;
    }
    function add() {
        if(isset($_GET['add'])) {
            return true;
        }
        return false;
    }





//  Different forms to present CRUD functionality for admin
    public function loginForm() {

    $ret = "
        <form>
          <div class='row'>
            <div class='large-6 columns'>
                <label> Username
              <!--<label class='error''>Error-->
                <input type='text' class='error' />
              </label>
             <!-- <small class='error'></small>-->
            </div>

            <div class='large-6 columns'>
                <label> Password
                <input type='password' />
              </label>
            </div>
            <a href='?logged' class='button expand'>LOGIN</a>
          </div>
        </form>
    ";
    return $ret;
}

public function loggedInForm() {

    $ret = "
             <div class='row'>
                <div class='large-12 columns'>
                <a href='?add' class='button expand'>ADD</a>
                <a href='?edit' class='button expand'>EDIT</a>
                </div>
            </div>
    ";
    return $ret;
    }
    public function addForm() {

        $ret = "
             <div class='row'>
                <div class='large-12 columns'>

                   http://www.w3schools.com/php/php_mysql_create.asp

                </div>
                <a href='?' class='button expand'>CONFIRM EDITS</a>
            </div>
    ";
        return $ret;
    }
    public function editForm() {

        $ret = "
             <div class='row'>
                <div class='large-12 columns'>

                        <table>
                          <thead>
                            <tr>
                              <th width=''>Table Header</th>
                              <th>Table Header</th>
                              <th width=''>Table Header</th>
                              <th width=''>Table Header</th>

                          </thead>
                          <tbody>
                            <tr>
                              <td><a>GO</a></td>
                              <td>This is longer content Donec id elit non mi porta gravida at eget metus.</td>
                              <td>Content Goes Here</td>
                              <td>Content Goes Here</td>
                            </tr>
                            <tr>
                              <td>Content Goes Here</td>
                              <td>This is longer Content Goes Here Donec id elit non mi porta gravida at eget metus.</td>
                              <td>Content Goes Here</td>
                              <td>Content Goes Here</td>
                            </tr>
                            <tr>
                              <td>Content Goes Here</td>
                              <td>This is longer Content Goes Here Donec id elit non mi porta gravida at eget metus.</td>
                              <td>Content Goes Here</td>
                              <td>Content Goes Here</td>
                            </tr>
                          </tbody>
                    </table>
                </div>
                <a href='?' class='button expand'>CONFIRM EDITS</a>
            </div>
    ";
        return $ret;
    }
}