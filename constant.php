<?php
/**
 * Created by PhpStorm.
 * User: Wilson
 * Date: 5/15/2016
 * Time: 4:26 PM
 */
session_start();
if(!isset($_SESSION['user']) and $section !== "login"){
    header("location: login.php");
}else if(isset($_SESSION['user']) and $section == "login"){
    header("location: index.php");
}
define("BASE_URL","/bitdwilson/");
define("ROOT_URL",$_SERVER["DOCUMENT_ROOT"]."/bitdwilson/");
ini_set('display_errors', 'On');
error_reporting(E_ALL & ~E_NOTICE);
include "validate.php";

$dsn = 'mysql:host=localhost;port=3307;dbname=webapp';
$username = 'root';
$password = 'password';

try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $exp) {
    echo 'Connection to database is not successful.' . $exp->getMessage();
    die();
}

