<?php
/**
 * Created by PhpStorm.
 * User: Wilson
 * Date: 5/15/2016
 * Time: 4:26 PM
 */
session_start();
define("BASE_URL","/WebApp/");
define("ROOT_URL",$_SERVER["DOCUMENT_ROOT"]."/WebApp/");
ini_set('display_errors', 'On');

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

