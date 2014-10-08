<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 06/10/14
 * Time: 13:36
 */

class adminView {

//  Navigation with getters for admin pages

    public function getUsername() {
        if(isset($_POST['username']))
        {
            return $_POST['username'];
        }
        return false;
    }

    public function getPassword(){
        if(isset($_POST['password']))
        {
            return $_POST['password'];
        }
        return false;
    }

    function getAdmin() {
        if(isset($_GET['admin'])) {
                return true;
            }
        return false;
    }
    function getLogged() {
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

        <form method='post'>
          <div class='row'>
            <h3>Administrator</h3>
            <div class='large-6 columns'>
                <label> Username
              <!--<label class='error''>Error-->
                <input type='text' name='username'>
              </label>
             <!-- <small class='error'></small>-->
            </div>
            <div class='large-6 columns'>
                <label> Password
                    <input type='password' name='password'>
              </label>
            </div>
            <input type='submit' class='button expand' value='LOGIN'>
          </div>
        </form>
    ";

    return $ret;
}

public function loggedInForm() {

    $ret = "
             <div class='row'>
                <div class='large-12 columns'>
                <h3>Administrator</h3>
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