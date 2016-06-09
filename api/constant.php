<?php
/**
 * Created by PhpStorm.
 * User: Wilson
 * Date: 6/6/2016
 * Time: 3:28 PM
 */
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
