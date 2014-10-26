<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 06/10/14
 * Time: 13:36
 */

class adminView {
    private static $loginButton = 'loginButton';
    private static $username = 'username';
    private static $password = 'password';
    private static $admin = 'admin';
    private static $logged = 'logged';
    private static $edit = 'edit';
    private static $delete = 'delete';
    private static $add = 'add';
    private static $logoutButton = 'logoutButton';

    private $nameErrorMSG;
    private $passErrorMSG;


    public function setLoginNameError($errorMSG) {
        if(isset($errorMSG)){
            $this->nameErrorMSG = "<small class='error'>".$errorMSG."</small>";
        }

    }
    public function setLoginPassError($errorMSG) {
        if(isset($errorMSG)){
            $this->passErrorMSG = "<small class='error'>".$errorMSG."</small>";
        }
    }


//  Navigation with getters for admin pages

    public function getloginButton() {
        if(isset($_POST[self::$loginButton]))
        {
            return $_POST[self::$loginButton];
        }
        return false;
    }

    public function getUsername() {
        if(isset($_POST[self::$username]))
        {
            return$_POST[self::$username];
        }
        return false;
    }

    public function getPassword(){
        if(isset($_POST[self::$password]))
        {
            return $_POST[self::$password];
        }
        return false;
    }

    function getAdmin() {
        if(isset($_GET[self::$admin])) {
                return true;
            }
        return false;
    }
    function getLogged() {
        if(isset($_GET[self::$logged])) {
            return true;
        }
        return false;
    }
    function edit() {
        if(isset($_GET[self::$edit])) {
            return true;
        }
        return false;
    }
    function add() {
        if(isset($_GET[self::$add])) {
            return true;
        }
        return false;
    }

    function logout() {
        if(isset($_POST[self::$logoutButton])) {
            return true;
        }
        return false;
    }


//  Different forms to present CRUD functionality for admin
    public function loginForm() {

    $ret = "
        <form method='post' action='?".self::$logged."'>
          <div class='row'>
            <h3>Administrator</h3>
            <div class='large-6 columns'>
                <label> Username
                    <label class='error'>
                    <input type='text' name='".self::$username."'>
                    </label>
                     ".$this->nameErrorMSG."
                     <br>
              </label>
            </div>
            <div class='large-6 columns'>
                <label> Password
                    <label class='error'>
                        <input type='password' name='".self::$password."'>
                    </label>
                    ".$this->passErrorMSG."
              </label>
            </div>
            <input type='submit' class='button expand' name='".self::$loginButton."' value='LOGIN'>
            <a href='?' class='button expand'>BACK</a>
          </div>
        </form>
    ";

    return $ret;
}

public function loggedInForm() {

    $ret = "
            <form method='post' action='?".self::$admin."'>
                 <div class='row'>
                    <div class='large-12 columns'>
                    <h3>Administrator</h3>
                    <a href='?".self::$add."' class='button expand'>ADD</a>
                    <a href='?".self::$edit."' class='button expand'>EDIT</a>
                    <a href='?".self::$delete."' class='button expand'>DELETE</a>
                    <input type='submit' class='button expand alert' name='".self::$logoutButton."' value='LOGOUT'>
                    </div>
                </div>
            </form>
    ";
    return $ret;
    }
    public function editForm() {

        $ret = "
             <div class='row'>
                <div class='large-12 columns'>
                    <h3>Administrator</h3>
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
                <a href='?".self::$logged."' class='button expand'>BACK</a>
            </div>
    ";
        return $ret;
    }
}