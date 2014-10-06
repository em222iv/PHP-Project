<?php
/**
 * Created by PhpStorm.
 * User: erikmagnusson
 * Date: 03/10/14
 * Time: 14:25
 */
session_start();
error_reporting(E_ALL); ini_set('display_errors','on');
ini_set('default_charset', 'UTF-8');
date_default_timezone_set('Europe/Stockholm');

require_once("src/view/HTMLview.php");
require_once("src/controller/controller.php");


$view = new HTMLView();
$Controller = new ControllerClass();

$ControllerFormControll = $Controller->formControll();

$view->echoHTML($ControllerFormControll);
