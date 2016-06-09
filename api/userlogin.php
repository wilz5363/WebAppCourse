<?php
/**
 * Created by PhpStorm.
 * User: Wilson
 * Date: 6/9/2016
 * Time: 4:47 AM
 */
include "constant.php";
$username = $_GET['username'];
$password = $_GET['password'];

$getUser = $conn->prepare("select count(*) as user_count from customer where username = ? and password = ?");
$getUser->bindParam(1, $username);
$getUser->bindParam(2, $password);
$getUser->execute();
$resultUser = $getUser->fetch(PDO::FETCH_ASSOC);
echo $resultUser['user_count'];